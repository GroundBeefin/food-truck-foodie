<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";

use GroundBeefin\FoodTruckFoodie\{
	User, Truck, Post
};

/**
 * Cloudinary API for Images
 *
 * @author Marty Bonacci
 * @version 1.0
 */

// start session
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// prepare an empty reply
$reply = new StdClass();
$reply->status = 200;
$reply->data = null;
try {

	// Grab the MySQL connection
	$secrets = new \Secrets("/etc/apache2/capstone-mysql/foodie.ini");
	$pdo = $secrets->getPdoObject();
	$cloudinary = $secrets->getSecret("cloudinary");

	//determine which HTTP method is being used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];
	$userId = filter_input(INPUT_GET, "imageTweetId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$truckId = filter_input(INPUT_GET, "profileId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	\Cloudinary::config(["cloud_name" => $cloudinary->cloudName, "api_key" => $cloudinary->apiKey, "api_secret" => $cloudinary->apiSecret]);

	// process GET requests
	if($method === "GET") {
		// set XSRF token
		setXsrfCookie();
		$reply->data = Truck::getAllImages($pdo)->toArray();
	} elseif($method === "POST") {
		//enforce that the end user has a XSRF token.
		verifyXsrf();
		//use $_POST super global to grab the needed Id
		$truckId = filter_input(INPUT_POST, "truckId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		// assigning variable to the user profile, add image extension
		$tempUserFileName = $_FILES["image"]["tmp_name"];
		// upload image to cloudinary and get public id
		$cloudinaryResult = \Cloudinary\Uploader::upload($tempUserFileName, array("width" => 200, "crop" => "scale"));
		// after sending the image to Cloudinary, create a new image
		$truck = new Truck(generateUuidV4(), $truckId, $cloudinaryResult["signature"], $cloudinaryResult["secure_url"]);
		$truck->insert($pdo);
		// update reply
		$reply->message = "Image uploaded Ok";
	}
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-Type: application/json");
// encode and return reply to front end caller
echo json_encode($reply);