<?php

namespace GroundBeefin\FoodTruckFoodie;
require_once("autoload.php");
require_once(dirname(__DIR__, 1) ."/vendor/autoload.php");

use phpDocumentor\Reflection\Types\Boolean;
use Ramsey\Uuid\Uuid;
use TypeError;
use GroundBeefin\FoodTruckFoodie\ValidateDate;

/**
 * Class for Post
 *
 * @author Leonela Guteirrez <leonela_gutierrez@hotmail.com>
 **/
class Post implements \JsonSerializable {
	use ValidateUuid;
	use ValidateDate;
	/**
	 * Id for post; this is the primary key
	 * @var Uuid/ $postId
	 **/
	private $postId;
	/**
	 * Truck Id this is a foreign key
	 * @var Uuid/ $postTruckId
	 **/
	private $postTruckId;
	/**
	 * User Id  this is a foreign key
	 * @var Uuid/ $postUserId
	 **/
	private $postUserId;
	/**
	 * this is the content of post up to 144 characters
	 * @var string $postContent
	 ***/
	private $postContent;
	/**
	 * This is the date and time post was made
	 * @var $postDatetime
	 **/
	private $postDatetime;

	/***
	 * constructor for this post
	 *
	 * @param string|Uuid $postId id of this post if new post
	 * @param string|Uuid $postTruckId id of food truck for new post
	 * @param string|Uuid $postUserId id of user for new post
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 * */

	public function __construct($newPostId, $newPostTruckId, $newPostUserId, string $newPostContent, $newPostDatetime = null) {
		try {
			$this->setPostId($newPostId);
			$this->setPostTruckId($newPostTruckId);
			$this->setPostUserId($newPostUserId);
			$this->setPostContent($newPostContent);
			$this->setPostDatetime($newPostDatetime);

		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {

			//determine what exception was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for post id
	 *
	 * @return Uuid value of the post id
	 **/
	public function getPostId(): Uuid {
		return ($this->postId);
	}

	/**
	 * mutator method for post id
	 *
	 * @param Uuid/string $newPostId new value of post id
	 * @param \RangeException if $newPostId is not a uuid
	 * @throws \TypeError if $newPostId is not a uuid
	 **/
	public function setPostId($newPostId) : void {
		try {
			$uuid = self::validateUuid($newPostId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the post id
		$this->postId = $uuid;
	}

	/**
	 * accessor method for post truck id
	 *
	 * @return Uuid of the post tuck id
	 **/
	public function getPostTruckId(): Uuid {
		return ($this->postTruckId);
	}


	/**
	 * gets the Tweet by tweetId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string|Uuid $tweetId tweet id to search for
	 * @return Tweet|null Tweet found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getPostByPostId(\PDO $pdo, $postId) : ?Post {
		// sanitize the postId before searching
		try {
			$postId = self::validateUuid($postId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT postId, postTruckId, postUserId, postContent, postDatetime FROM post WHERE postId = :postId";
		$statement = $pdo->prepare($query);
		// bind the post id to the place holder in the template
		$parameters = ["postId" => $postId->getBytes()];
		$statement->execute($parameters);
		// grab the post from mySQL
		try {
			$post = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$post = new Post($row["postId"], $row["postTruckId"], $row["postUserId"], $row["postContent"], $row["postDatetime"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($post);
	}




	/**
	 * mutator method for post truck id
	 *
	 * @param Uuid|string $newPostTruckId new post truck id
	 * @throws  \RangeException if $newPostId is no a uuid
	 * @throws  \TypeError if $newPostId is not a uuid
	 **/
	public function setPostTruckId($newPostTruckId): void {
		try {
			$uuid = self::validateUuid($newPostTruckId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the post truck id
		$this->postTruckId = $uuid;
	}


	/**
	 * accessor method for post user id
	 *
	 * @return int value of the post user id
	 **/
	public function getPostUserId(): Uuid {
		return ($this->postUserId);
	}

	/**
	 * mutator method for post user id
	 *
	 * @param Uuid|string $newPostUserId new post user id
	 * @param \RangeException if $newPostUserId is not positive
	 * @throws \TypeError if $newPostUserId is not a uuid
	 **/
	public function setPostUserId($newPostUserId): void {
		try {
			$uuid = self::validateUuid($newPostUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the post id
		$this->postUserId = $uuid;
	}

	/**
	 * accessor method for post content
	 *
	 * @return string value of post content
	 **/
	public function getPostContent(): string {
		return ($this->postContent);
	}

	/**
	 * mutator method for post content
	 *
	 * @param string $newPostContent new value of post content
	 * @throws \InvalidArgumentException if $newPostContent is not a string or insecure
	 * @throws \RangeException if $newPostContent is > 144 characters
	 * @throws TypeError if $newPostContent is not a string
	 **/
	public function setPostContent(string $newPostContent): void {
		// verify the post content is secure
		$newPostContent = trim($newPostContent);
		$newPostContent = filter_var($newPostContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPostContent) === true) {
			throw(new \InvalidArgumentException("Post content is empty or insecure"));
		}

		// verify the post content will fit in the database
		if(strlen($newPostContent) > 140) {
			throw(new \RangeException("post content too large"));
		}

		// store the post content
		$this->postContent = $newPostContent;
	}

	/**
	 * accessor method for post datetime
	 *
	 * @return \DateTime value of post date time
	 **/
	public function getPostDatetime(): \DateTime {
		return ($this->postDatetime);
	}

	/**
	 * mutator method for post datetime
	 *
	 * @param \DateTime|string|null $newPostDatetime post date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newPostDatetime is not a valid object or string
	 * @throws \RangeException if $newPostDatetime is a date time that does not exist
	 **/
	public function setPostDatetime($newPostDatetime = null): void {
		// base case: if the date is null, use the current date and time
		if($newPostDatetime === null) {
			$this->postDatetime = new \DateTime();
			return;
		}

		// store the post date using the ValidateDate trait
		try {
			$newPostDatetime = self::validateDateTime($newPostDatetime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->postDatetime = $newPostDatetime;
	}


	/**
	 * inserts this Post into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {
		// create query template
		$query = "INSERT INTO post(postId, postTruckId, postUserId, postContent, postDatetime) VALUES(:postId, :postTruckId, :postUserId, :postContent, :postDatetime)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->postDatetime->format("Y-m-d H:i:s.u");
		$parameters = ["postId" => $this->postId->getBytes(), "postTruckId" => $this->postTruckId->getBytes(), "postUserId" => $this->postUserId->getBytes(), "postContent" =>$this->postContent, "postDatetime" => $formattedDate];
		$statement->execute($parameters);
	}
	/**
	 * deletes this Post from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {
		// create query template
		$query = "DELETE FROM post WHERE postId = :postId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holder in the template
		$parameters = ["postId" => $this->postId->getBytes()];
		$statement->execute($parameters);
	}
	/**
	 * updates this Post in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {
		// create query template
		$query = "UPDATE post SET postTruckId = :postTruckId, postContent = :postContent, postDatetime = :postDatetime WHERE postId = :postId";
		$statement = $pdo->prepare($query);
		$formattedDate = $this->postDatetime->format("Y-m-d H:i:s.u");
		$parameters = ["postId" => $this->postId->getBytes(),"postTruckId" => $this->postTruckId->getBytes(), "postContent" => $this->postContent, "postDatetime" => $formattedDate];
		$statement->execute($parameters);
	}


	/**
	 * gets the Post by post truck id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $postTruckId truck id to search for
	 * @return \SplFixedArray SplFixedArray of Post found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 **/
	public static function getPostByPostTruckId(\PDO $pdo, $postTruckId) : \SPLFixedArray {
		try {
			$postTruckId = self::validateUuid($postTruckId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT postId, postTruckId, postUserId, postContent, postDatetime FROM post WHERE postTruckId = :postTruckId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["postTruckId" => $postTruckId->getBytes()];
		$statement->execute($parameters);

		// build an array of posts
		$posts = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$post = new Post($row["postId"],$row["postTruckId"],$row["postUserId"], $row["postContent"], $row["postDatetime"]);
				$posts[$posts->key()] = $post;
				$posts->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($posts);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		//format the date so that the front end can consume it
		$fields["postId"] = $this->postId;
		$fields["postTruckId"] = $this->postTruckId;
		$fields["postUserId"] = $this->postUserId;
		$fields["postContent"] = $this->postContent;
		$fields["postDatetime"] = round(floatval($this->postDatetime->format("U.u")) * 1000);
		return ($fields);
	}

}


