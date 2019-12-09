<?php

// adding new users
use GroundBeefin\FoodTruckFoodie\Post;
use GroundBeefin\FoodTruckFoodie\Truck;
use GroundBeefin\FoodTruckFoodie\User;
require_once dirname(__DIR__, 1) . "/vendor/autoload.php";
require_once(dirname(__DIR__) . "/Classes/autoload.php");
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require("uuid.php");
$secrets = new \Secrets("/etc/apache2/capstone-mysql/foodie.ini");
$pdo = $secrets->getPdoObject();


$hash = password_hash("abc123", PASSWORD_ARGON2I, ["time_cost" => 384]);

$user = new User(generateUuidV4(), null, "https://www.ilovesupper.com/?lightbox=imagem1l", "leonela.naguti+4@gmail.com", $hash, "Kristen Galegor");
$user->insert($pdo);
echo "Kristen's user profile :". $user->getUserId() . PHP_EOL;


$user2 = new User(generateUuidV4(), null, "https://s3-media0.fl.yelpcdn.com/bphoto/UANJrdAtpwF8b1ygAPNrAA/o.jpg", "leonela.naguti+3@gmail.com", $hash, "Bobby McGee");
$user2->insert($pdo);
echo "Bobby's user profile :". $user2->getUserId() . PHP_EOL;


$user3 = new User(generateUuidV4(), null, "http://box5352.temp.domains/~diadelo2/wp-content/uploads/2019/04/takos-229.jpg", "leonela.naguti+2@gmail.com", $hash, "Cheff Domonic");
$user3->insert($pdo);
echo "Dominic's user profile :". $user3->getUserId() . PHP_EOL;

//adding new food trucks for users

//$truckUserId = generateUuidV4();

$truck = new Truck(generateUuidV4(), $user->getUserId(), "https://www.ilovesupper.com/?lightbox=imagem1l", "leonela.naguti+4@gmail.com", "Comfort Food", "https://www.ilovesupper.com/menu", "The Supper Truck", "505.796.2181", null);
$truck->insert($pdo);


$truck2 = new Truck(generateUuidV4(), $user2->getUserId(), "https://s3-media0.fl.yelpcdn.com/bphoto/jRMk8IwrTxC92VIO0fpK7g/o.jpg", "leonela.naguti+3@gmail.com", "Mexican", "https://s3-media0.fl.yelpcdn.com/bphoto/3gX7YZxFBqlYG-JT6k96mw/o.jpg", "Taco Bus", "(505) 301-7512", null);
$truck2->insert($pdo);

$truck3 = new Truck(generateUuidV4(), $user3->getUserId(), "http://box5352.temp.domains/~diadelo2/wp-content/uploads/2019/04/DDLT-LogoR.jpg", "leonela.naguti+1@gmail.com", "Mexican", "https://s3-media0.fl.yelpcdn.com/bphoto/BQZUZ_hKFvaNhnHVOXgVYQ/o.jpg", "Dia De Los Takos", "(505) 550-8540", null);
$truck3->insert($pdo);
//adding posts for food trucks

//$newPostUserId = generateUuidV4();

$post = new Post(generateUuidV4(), $truck->getTruckId(), $user->getUserId(), "This is a post for a food truck", $newPostDatetime = null);
$post->insert($pdo);

$post2 = new Post(generateUuidV4(), $truck2->getTruckId(), $user2->getUserId(), "This another post for a food truck", $newPostDatetime = null);
$post2->insert($pdo);

$post3 = new Post(generateUuidV4(), $truck3->getTruckId(), $user3->getUserId(), "This a third post for a food truck", $newPostDatetime = null);
$post3->insert($pdo);
