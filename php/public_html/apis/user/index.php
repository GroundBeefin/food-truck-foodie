<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
use GroundBeefin\FoodTruckFoodie\User;
/**
 * API for User
 *
 * @author Gkephart
 * @version 1.0
 */
//verify the session, if it is not active start it
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/foodie.ini");
	$pdo = $secrets->getPdoObject();

	//determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];

	// sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userActivationToken = filter_input(INPUT_GET, "userActivationToken", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userAvatarUrl = filter_input(INPUT_GET, "userAvatarUrl", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userEmail = filter_input(INPUT_GET, "userEmail", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userHash = filter_input(INPUT_GET, "userHash", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userName = filter_input(INPUT_GET, "userName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	// make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie();

		//gets a post by content
		if(empty($id) === false) {
			$reply->data = User::getUserByUserId($pdo, $id);

		} else if(empty($userEmail) === false) {
			$reply->data = User::getUserByUserEmail($pdo, $userEmail);
		}
		else {
			//who knows... we may want this!
			$reply->data = User::getAllusers($pdo)->toArray();
		}



	} elseif($method === "PUT") {
		//enforce that the XSRF token is present in the header
		verifyXsrf();

		//enforce the end user has a JWT token
		//validateJwtHeader();

		//enforce the user is signed in and only trying to edit their own profile
		if(empty($_SESSION["user"]) === true || $_SESSION["user"]->getUserId()->toString() !== $id) {
			throw(new \InvalidArgumentException("You are not allowed to access this user", 403));
		}

		validateJwtHeader();
		//decode the response from the front end
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//retrieve the profile to be updated
		$user = User::getUserByUserId($pdo, $id);
		if($user === null) {
			throw(new RuntimeException("User does not exist", 404));
		}

		//user avatar url is a required field
		if(empty($requestObject->userAvatarUrl) === true) {
			$requestObject->userAvatarUrl = $user->getUserAvatarUrl();
		}

		//user email is a required field
		if(empty($requestObject->userEmail) === true) {
			throw(new \InvalidArgumentException ("No user email present", 405));
		}

		//user name is a required field
		if(empty($requestObject->userName) === true) {
			throw(new \InvalidArgumentException ("User name is too long", 405));
		}

		$user->setUserAvatarUrl($requestObject->userAvatarUrl);
		$user->setUserEmail($requestObject->userEmail);
		$user->setUserName($requestObject->userName);
		$user->update($pdo);

		// update reply
		$reply->message = "Profile information updated";
	} elseif($method === "DELETE") {

		//verify the XSRF Token
		verifyXsrf();

		//enforce the end user has a JWT token
		//validateJwtHeader();

		$user = User::getUserByUserId($pdo, $id);
		if($user === null) {
			throw (new RuntimeException("User does not exist"));
		}

		//enforce the user is signed in and only trying to edit their own user profile
		if(empty($_SESSION["user"]) === true || $_SESSION["user"]->getUserId()->toString() !== $user->getUserId()->toString()) {
			throw(new \InvalidArgumentException("You are not allowed to access this user", 403));
		}

		validateJwtHeader();

		//delete the post from the database
		$user->delete($pdo);
		$reply->message = "User Deleted";

	} else {
		throw (new InvalidArgumentException("Invalid HTTP request", 400));
	}

	// catch any exceptions that were thrown and update the status and message state variable fields
} catch
(\Exception | \TypeError $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}

header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}

// encode and return reply to front end caller
echo json_encode($reply);