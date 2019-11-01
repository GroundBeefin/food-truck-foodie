<?php
namespace Groundbeefin\FoodTruckFoodie;

require_once ("autoload.php");
require_once(dirname(__DIR__, 1) ."/classes/autoload.php");

use InvalidArgumentException;
use phpDocumentor\Reflection\Types\Integer;
use Ramsey\Uuid\Uuid;

/**
 * Class for user
 * @package Groundbeefin\FoodTruckFoodie
 *
 * @User Zachary Sanchez <zacharyesanchez22@gmail.com>
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
	 * @var string $userAvatarUrl
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
		$this->setUserProfileHash($newUserHash);
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
	} catch(InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	//convert and store the user id
	$this->userId = $uuid;
}

	/**
	 *mutator method for user activation token
	 *
	 * @param string|null $newUserActivationTokenActivationToken
	 */
	public function setUserActivationToken(?string $newUserActivationTokenActivationToken): void {
		if($newUserActivationTokenActivationToken === null) {
			$this->userActivationToken = null;
			return;
		}
		$newUserActivationTokenActivationToken = strtolower(trim($newUserActivationTokenActivationToken));
		if(ctype_xdigit($newUserActivationTokenActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 32 characters
		if(strlen($newUserActivationTokenActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}
		$this->userActivationToken = $newUserActivationTokenActivationToken;
	}
	/**
	 * mutator method for user avatar url
	 * @param string|null $newUserAvatarUrl
	 * @throws InvalidArgumentException if $newUserAvatarUrl is not a string or insecure
	 * 
	 */
	public function setUserAvatarUrl(?string $newUserAvatarUrl): void {
		if($newUserAvatarUrl === null) {
			$this->getUserAvatarUrl = null;
			return;
		}
		//verify the at avatar is secure
		$newUserAvatarUrl = trim($newUserAvatarUrl);
		$newUserAvatarUrl = filter_var($newUserAvatarUrl, FILTER_VALIDATE_URL);
		if($newUserAvatarUrl === false) {
			throw(new InvalidArgumentException("user url is empty or insecure"));
		}
		if(strlen($newUserAvatarUrl) > 255) {
			throw(new \RangeException("avatar is too large"));
		}
		// store  the at handle
		$this->userAvatarUrl = $newUserAvatarUrl;
	}

	/**
	 * accessor method for email
	 *
	 * @return string value of email
	 */
	public function getUserEmail(): string {
		return $this->userEmail;
	}
	/**
	 * mutator method for email
	 *
	 * @param string $newUserEmail new value of email
	 * @throws InvalidArgumentException if $newEmail is not valid email or insecure
	 * @throws \RangeException if $newEmail is > 128 characters
	 * @throws \TypeError if $newEmail is not a string
	 */

	public function setUserEmail(string $newUserEmail): void {
		//verify the email is secure
		$newUserEmail = trim($newUserEmail);
		$newUserEmail = filter_var($newUserEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newUserEmail) === true) {
			throw(new InvalidArgumentException("profile email is empty or insecure"));
		}
		//verify the email will fit in the database
		if(strlen($newUserEmail) > 128) {
			throw(new \RangeException("profile email is too large"));
		}
		$this->userEmail = $newUserEmail;
	}
	/**
	 * accessor method for userHash
	 *
	 * @return string value of hash
	 */
	public function getUserProfileHash(): string {
		return $this->userHash;
	}
	/**
	 * mutator method for user profile hash password
	 *
	 * @param string $newUserProfileHash
	 * @throws InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 97 characters
	 * @throws \TypeError if profile hash is not a string
	 */
	public function setUserProfileHash(string $newUserProfileHash): void {
		//enforce that the has is properly formatted
		$newUserProfileHash = trim($newUserProfileHash);
		$newUserProfileHash = strtolower($newUserProfileHash);
		if(empty($newUserProfileHash) === true) {
			throw(new InvalidArgumentException("user password hash is empty or insecure"));
		}
		//enforce hash is really an Argon hash
		if(!ctype_xdigit($newUserProfileHash)) {
			throw(new InvalidArgumentException("user password hash is empty or insecure"));
		}
		//enforce that the has is exactly 97 characters.
		if(strlen($newUserProfileHash) !== 97) {
			throw(new \RangeException("user hash must be 97 characters"));
		}
		//store the hash
		$this->userHash = $newUserProfileHash;
	}
	/**
	 * mutator method for userName
	 *
	 * @param string $newUserName new value of userName
	 * @throw \InvalidArgumentException if $newUserName is not a string or insecure
	 * @throw \RangeException if $newUserName is > 16 characters
	 * @throws \TypeError if $newUserName is not a string
	 */
	public function setUserName(string $newUserName): void {
		//verify the username is secure
		$newUserName = trim($newUserName);
		$newUserName = filter_var($newUserName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserName) > 32) {
			throw(new \RangeException("userName is too large"));
		}
		//store the hash
		$this->userName = $newUserName;
	}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["userId"] = $this->userId->toString();
		unset($fields["userHash"]);
		return ($fields);
	}

	/**
	 * inserts this user into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related error occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo): void {
		//create query template
		$query = "INSERT INTO user(userId, userActivationToken, userAvatarUrl, userEmail, userHash, userUsername)
VALUES (:userId, :userActivationToken, :userAvatarUrl, :userEmail, :userHash, :userUsername)";
		$statement = $pdo->prepare($query);
	}
	/**
	 * deletes this user from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function delete(\PDO $pdo): void {
		//create query template
		$query = "DELETE FROM user WHERE userId = :userId";
		$statement = $pdo->prepare($query);
		//bind the member variables to the place holder in the template
		$parameters = ["userId" => $this->userId->getBytes()];
		$statement->execute($parameters);
	}
	/**
	 * updates this User in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function update(\PDO $pdo): void {
		//create query template
		$query = "UPDATE user SET userId = :userId, userActivationToken = :userActivationToken, userAvatarUrl = :userAvatarUrl, userEmail = :userEmail, userHash = :userHash, userName = :userName";
		$statement = $pdo->prepare($query);
		$parameters = ["userId" => $this->userId->getBytes(), "userActivationToken" => $this->userActivationToken->getBytes(), "userAvatarUrl" => $this->userAvatarUrl->getBytes(), "userEmail" => $this->userEmail->getBytes(), "userHash" => $this->userHash->getBytes(), "userName" => $this->userName->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * Specify data which should be serialized to JSON
	 * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize() {
		// TODO: Implement jsonSerialize() method.
	}
}
