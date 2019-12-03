<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";

use GroundBeefin\FoodTruckFoodie\Post;
/**
 * api for the Post class
 *
 * @author Valente Meza <valebmeza@gmail.com> / Leonela Gutierrez <leonela_gutierrez@hotmail.com>
 **/
//verify the session, start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try {
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/foodie.ini");
	$pdo = $secrets->getPdoObject();
	//determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];
	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$postUserId = filter_input(INPUT_GET, "postUserId", FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$postTruckId = filter_input(INPUT_GET, "postTruckId", FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$postContent = filter_input(INPUT_GET, "postContent", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true )) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 402));
	}
	// handle GET request - if id is present, that post is returned
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();
		//get a specific post
		if(empty($id)=== false) {
			// if the user is logged in grab all the tweets by that user based  on who is logged in
			$reply->data = Post::getPostByPostId($pdo, $id);
		}
		elseif(empty($postTruckId) === false) {
			$reply->data = Post::getPostByPostTruckId($pdo, $postTruckId);
		};


	} else if($method === "PUT" || $method === "POST") {
		// enforce the Truck has a XSRF token
		verifyXsrf();
		// enforce the user is signed in
		if(empty($_SESSION["user"]) === true) {
			throw(new \InvalidArgumentException("you must be logged in to post", 401));
		}
		$requestContent = file_get_contents("php://input");
		// Retrieves the JSON package that the front end sent, and stores it in $requestContent. Here we are using file_get_contents("php://input") to get the request from the front end. file_get_contents() is a PHP function that reads a file into a string. The argument for the function, here, is "php://input". This is a read only stream that allows raw data to be read from the front end request which is, in this case, a JSON package.
		$requestObject = json_decode($requestContent);
		// This Line Then decodes the JSON package and stores that result in $requestObject
		//make sure post content is available (required field)
		if(empty($requestObject->postContent) === true) {
			throw(new \InvalidArgumentException ("No content for Post.", 405));
		}
		// make sure post date is accurate (optional field)
		if(empty($requestObject->postDatetime) === true) {
			$requestObject->postDatetime = null;
		}
		//perform the actual put or post
		if($method === "PUT") {
			// retrieve the post to update
			$post = Post::getPostByPostId($pdo, $id);
			if($post === null) {
				throw(new RuntimeException("Post does not exist", 404));
			}
			//enforce the end user has a JWT token
			//enforce the user is signed in and only trying to edit their own post
			if(empty($_SESSION["user"]) === true || $_SESSION["user"]->getUserId()->toString() !== $post->getPostUserId()->toString()) {
				throw(new \InvalidArgumentException("You are not allowed to edit this post", 403));
			}
			validateJwtHeader();
			// update all attributes
			//$post->setPostDatetime($requestObject->postDatetime);
			$post->setPostContent($requestObject->postContent);
			$post->update($pdo);
			// update reply
			$reply->message = "Post updated OK";
		} else if($method === "POST") {
			// enforce the user is signed in
			if(empty($_SESSION["user"]) === true) {
				throw(new \InvalidArgumentException("you must be logged in to post ", 403));
			}
			//enforce the end user has a JWT token
			validateJwtHeader();
			// create new post and insert into the database
			$post = new Post(generateUuidV4(),$requestObject->postTruckId ,$_SESSION["user"]->getUserId(), $requestObject->postContent, null);
			$post->insert($pdo);
			// update reply
			$reply->message = "Post created OK";
		}

	} else if($method === "DELETE") {
		//enforce that the end user has a XSRF token.
		verifyXsrf();
		// retrieve the Post to be deleted
		$post = Post::getPostByPostId($pdo, $id);
		if($post === null) {
			throw(new RuntimeException("Post does not exist", 404));
		}

		//enforce the user is signed in and only trying to edit their own post
		if(empty($_SESSION["user"]) === true || $_SESSION["user"]->getUserId()->toString() !== $post->getPostUserId()->toString()) {
			throw(new \InvalidArgumentException("You are not allowed to delete this post", 403));
		}

		//enforce the end user has a JWT token
		validateJwtHeader();
		// delete post
		$post->delete($pdo);
		// update reply
		$reply->message = "Post deleted!";
	} else {
		throw (new InvalidArgumentException("Invalid HTTP method request", 418));
	}
// update the $reply->status $reply->message
} catch(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
// encode and return reply to front end caller
header("Content-type: application/json");
echo json_encode($reply);