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

$user = new User(generateUuidV4(), null, "https://static.wixstatic.com/media/2462fd_0d26898bbf88def0a5de05dee979da49.jpg/v1/fill/w_549,h_348,al_c,q_90,usm_0.66_1.00_0.01/2462fd_0d26898bbf88def0a5de05dee979da49.webp", "leonela.naguti+4@gmail.com", $hash, "Kristen Galegor");
$user->insert($pdo);
echo "Kristen's user profile :". $user->getUserId() . PHP_EOL;


$user2 = new User(generateUuidV4(), null, "https://s3-media0.fl.yelpcdn.com/bphoto/UANJrdAtpwF8b1ygAPNrAA/o.jpg", "leonela.naguti+3@gmail.com", $hash, "Bobby McGee");
$user2->insert($pdo);
echo "Bobby's user profile :". $user2->getUserId() . PHP_EOL;


$user3 = new User(generateUuidV4(), null, "http://box5352.temp.domains/~diadelo2/wp-content/uploads/2019/04/takos-229.jpg", "leonela.naguti+2@gmail.com", $hash, "Cheff Domonic");
$user3->insert($pdo);
echo "Dominic's user profile :". $user3->getUserId() . PHP_EOL;

$user4 = new User(generateUuidV4(), null, "https://www.google.com/maps/uv?hl=en&pb=!1s0x872212a7878d20d5:0x236f059d7227e146!3m1!7e115!4shttps://lh5.googleusercontent.com/p/AF1QipOVaBEPKWD70oMf0Y3F0Ls2UAEtB7aWJ9224jLG%3Dw260-h175-n-k-no!5sfood+trucks+in+albuquerque+new+mexico+-+Google+Search&imagekey=!1e10!2sAF1QipOVaBEPKWD70oMf0Y3F0Ls2UAEtB7aWJ9224jLG", "leonela.naguti+4@gmail.com", $hash, "Sweet pea");
$user4->insert($pdo);
echo "Sweet's user profile :". $user->getUserId() . PHP_EOL;

$user5 = new User(generateUuidV4(), null, "https://www.google.com/maps/uv?hl=en&pb=!1s0x872212b9cc4cafbf:0x91635cd3e370f456!3m1!7e115!4shttps://lh5.googleusercontent.com/p/AF1QipO6UhAI5ppc8fhGrj_ZIzw81tjW6QoSMHzSiJ5x%3Dw260-h175-n-k-no!5sfood+trucks+in+albuquerque+new+mexico+-+Google+Search&imagekey=!1e10!2sAF1QipO6UhAI5ppc8fhGrj_ZIzw81tjW6QoSMHzSiJ5x
https://www.google.com/maps/uv?hl=en&pb=!1s0x872212a7878d20d5:0x236f059d7227e146!3m1!7e115!4shttps://lh5.googleusercontent.com/p/AF1QipOVaBEPKWD70oMf0Y3F0Ls2UAEtB7aWJ9224jLG%3Dw260-h175-n-k-no!5sfood+trucks+in+albuquerque+new+mexico+-+Google+Search&imagekey=!1e10!2sAF1QipOVaBEPKWD70oMf0Y3F0Ls2UAEtB7aWJ9224jLG", "leonela.naguti+4@gmail.com", $hash, "Papa Joe Daddieo");
$user5->insert($pdo);
echo "Papa's user profile :". $user->getUserId() . PHP_EOL;

//adding new food trucks for users

//$truckUserId = generateUuidV4();

$truck = new Truck(generateUuidV4(), $user->getUserId(), "https://static.wixstatic.com/media/2462fd_0d26898bbf88def0a5de05dee979da49.jpg/v1/fill/w_549,h_348,al_c,q_90,usm_0.66_1.00_0.01/2462fd_0d26898bbf88def0a5de05dee979da49.webp", "leonela.naguti+4@gmail.com", "Comfort Food", "https://www.ilovesupper.com/menu", "The Supper Truck", "505.796.2181", null);
$truck->insert($pdo);


$truck2 = new Truck(generateUuidV4(), $user2->getUserId(), "https://s3-media0.fl.yelpcdn.com/bphoto/jRMk8IwrTxC92VIO0fpK7g/o.jpg", "leonela.naguti+3@gmail.com", "Mexican", "https://s3-media0.fl.yelpcdn.com/bphoto/3gX7YZxFBqlYG-JT6k96mw/o.jpg", "Taco Bus", "(505) 301-7512", null);
$truck2->insert($pdo);

$truck3 = new Truck(generateUuidV4(), $user3->getUserId(), "http://box5352.temp.domains/~diadelo2/wp-content/uploads/2019/04/DDLT-LogoR.jpg", "leonela.naguti+1@gmail.com", "Mexican", "https://s3-media0.fl.yelpcdn.com/bphoto/BQZUZ_hKFvaNhnHVOXgVYQ/o.jpg", "Dia De Los Takos", "(505) 550-8540", null);
$truck3->insert($pdo);

$truck4= new Truck(generateUuidV4(), $user->getUserId(), "https://www.google.com/maps/uv?hl=en&pb=!1s0x872212a7878d20d5:0x236f059d7227e146!3m1!7e115!4shttps://lh5.googleusercontent.com/p/AF1QipOVaBEPKWD70oMf0Y3F0Ls2UAEtB7aWJ9224jLG%3Dw260-h175-n-k-no!5sfood+trucks+in+albuquerque+new+mexico+-+Google+Search&imagekey=!1e10!2sAF1QipOVaBEPKWD70oMf0Y3F0Ls2UAEtB7aWJ9224jLG", "leonela.naguti+4@gmail.com", "Comfort Food", "https://www.google.com/maps/uv?hl=en&pb=!1s0x872212a7878d20d5:0x236f059d7227e146!3m1!7e115!4shttps://lh5.googleusercontent.com/p/AF1QipOVaBEPKWD70oMf0Y3F0Ls2UAEtB7aWJ9224jLG%3Dw260-h175-n-k-no!5sfood+trucks+in+albuquerque+new+mexico+-+Google+Search&imagekey=!1e10!2sAF1QipOVaBEPKWD70oMf0Y3F0Ls2UAEtB7aWJ9224jLG", "With Love Waffles Food Truck", "505.933.0424", null);
$truck4->insert($pdo);

$truck5 = new Truck(generateUuidV4(), $user->getUserId(), "https://www.google.com/maps/uv?hl=en&pb=!1s0x872212b9cc4cafbf:0x91635cd3e370f456!3m1!7e115!4shttps://lh5.googleusercontent.com/p/AF1QipO6UhAI5ppc8fhGrj_ZIzw81tjW6QoSMHzSiJ5x%3Dw260-h175-n-k-no!5sfood+trucks+in+albuquerque+new+mexico+-+Google+Search&imagekey=!1e10!2sAF1QipO6UhAI5ppc8fhGrj_ZIzw81tjW6QoSMHzSiJ5x
https://www.google.com/maps/uv?hl=en&pb=!1s0x872212a7878d20d5:0x236f059d7227e146!3m1!7e115!4shttps://lh5.googleusercontent.com/p/AF1QipOVaBEPKWD70oMf0Y3F0Ls2UAEtB7aWJ9224jLG%3Dw260-h175-n-k-no!5sfood+trucks+in+albuquerque+new+mexico+-+Google+Search&imagekey=!1e10!2sAF1QipOVaBEPKWD70oMf0Y3F0Ls2UAEtB7aWJ9224jLG", "leonela.naguti+4@gmail.com", "Mexican", "https://www.google.com/maps/uv?hl=en&pb=!1s0x872212b9cc4cafbf:0x91635cd3e370f456!3m1!7e115!4shttps://lh5.googleusercontent.com/p/AF1QipN7HALcl7Yr3IbY3TaPO4Rv2Vm8HJFquUtECq8s%3Dw130-h87-n-k-no!5sfood+trucks+in+albuquerque+new+mexico+-+Google+Search&imagekey=!1e10!2sAF1QipN7HALcl7Yr3IbY3TaPO4Rv2Vm8HJFquUtECq8su", "Taco Locos grill", "505.918.0964", null);
$truck5->insert($pdo);
//adding posts for food trucks

//$newPostUserId = generateUuidV4();

$post = new Post(generateUuidV4(), $truck->getTruckId(), $user->getUserId(), "This is a post for a food truck", $newPostDatetime = null);
$post->insert($pdo);

$post2 = new Post(generateUuidV4(), $truck2->getTruckId(), $user2->getUserId(), "This another post for a food truck", $newPostDatetime = null);
$post2->insert($pdo);

$post3 = new Post(generateUuidV4(), $truck3->getTruckId(), $user3->getUserId(), "This a third post for a food truck", $newPostDatetime = null);
$post3->insert($pdo);

$post4 = new Post(generateUuidV4(), $truck->getTruckId(), $user->getUserId(), "This is a post for  food truck 4", $newPostDatetime = null);
$post4->insert($pdo);

$post5 = new Post(generateUuidV4(), $truck->getTruckId(), $user->getUserId(), "This is a post for  food truck 5", $newPostDatetime = null);
$post5->insert($pdo);
