<?php
namespace Groundbeefin\FoodTruckFoodie;

require_once ("autoload.php");
require_once(dirname(__DIR__, 1) ."/vendor/autoload.php");
use Ramsey\Uuid\Uuid;

/**
 * Class for user
 * @package Groundbeefin\FoodTruckFoodie
 *
 * @author Zachary Sanchez <zacharyesanchez22@gmail.com>
 */

class User {
	use ValidateUuid;
	/**
	 * Id for this profile; this is the primary key
	 * @var Uuid $userId
	 */
	private $userId;
	/**
	 * activation token for this user
	 * @var string $userActivationToken
	 */
	private $userActivationToken;
	/**
	 * avatar url for this user
	 * @var string userAvatarUrl
	 */
	private $userAvatarUrl;
	/**
	 * email for this user; this a unique index
	 * @var string $userEmail
	 */
	private $userEmail;
	/**
	 * hash for profile password
	 * @var $userProfileHash
	 */
	private $userHash;
	/**
	 * name of this user
	 * @var $userName
	 */
	private $userName;
/***
 * constructor for this user
 *
 * @param string|Uuid $newUserId id of this user if a new user
 * @param string $newUserActivationToken activation token to sage guard against malicious accounts
 * @param string $newUserAvatarUrl string containing
 * @param string $newUserEmail string containing email
 * @param string $newUserHash string containing password hash
 * @param string $newUserName string containing username
 */
public function __construct($newUserId, $newUserActivationToken, $newUserAvatarUrl, $newUserEmail, $newUserHash, $newUserName) {
	try {
		$this->setUserId($newUserId);
		$this->setUserActivationToken($newUserActivationToken);
		$this->setUserAvatarUrl($newUserAvatarUrl);
		$this->setUserEmail($newUserEmail);
		$this->setUserHash($newUserHash);
		$this->setUserName($newUserName);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		//determine what exception type was thrown
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
}

/**
 * accessor method for user id
 *
 *@return Uuid value of this user id (or null if new User)
 */
public function getUserId(): Uuid {
	return ($this->userId);
}
/**
 * mutator method for user id
 *
 * @param Uuid| string $newUserId value of new user id
 * @throws \RangeException if $newUserId is not positive
 * @throws \TypeError if the user Id is not
 */
public function setUserId($newUserId): void {
	try {
		$uuid = self::validateUuid($newUserId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	//convert and store the user id
	$this->userId = $uuid;
}

}
