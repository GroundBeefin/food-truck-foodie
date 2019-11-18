<?php
require_once dirname(__DIR__, 3) . "/vendor/autoload.php";
require_once dirname(__DIR__, 3) . "/Classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once dirname(__DIR__, 3) . "/lib/xsrf.php";
require_once dirname(__DIR__, 3) . "/lib/jwt.php";
require_once dirname(__DIR__, 3) . "/lib/uuid.php";

use GroundBeefin\FoodTruckFoodie\{User, Truck, Post};

/**
 * api for the truck class
 *
 * @author Ian W Foster <ian.foster95@yahoo.com>
 **/

//verify the session start if not active
if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;
try{



	$secrets = new \Secrets("/etc/apache2/capstone-mysql/foodie.ini");
	$pdo = $secrets->getPdoObject();




	//determine which HTTP method was used
	$method = $_SERVER["HTTP_X_HTTP_METHOD"] ?? $_SERVER["REQUEST_METHOD"];

	//sanitize input
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$truckId = filter_input(INPUT_GET, "truckId", FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
	$truckUserId = filter_input(INPUT_GET, "truckUserId", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$truckAvatarUrl = filter_input(INPUT_GET, "truckAvatarUrl", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$truckEmail = filter_input(INPUT_GET, "truckEmail", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$truckFoodType = filter_input(INPUT_GET, "truckFoodType", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$truckMenuUrl = filter_input(INPUT_GET, "truckMenuUrl", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$truckName = filter_input(INPUT_GET, "truckName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$truckPhoneNumber = filter_input(INPUT_GET, "truckPhoneNumber", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$truckVerifyImage = filter_input(INPUT_GET, "truckVerifyImage", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$truckVerifiedCheck = filter_input(INPUT_GET, "truckVerifiedCheck", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
}

