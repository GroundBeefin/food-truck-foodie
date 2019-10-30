<?php

namespace Groundbeefin\FoodTruckFoodie;
require_once("autoload.php");
require_once(dirname(__DIR__, 1) ."/vendor/autoload.php");
use Ramsey\Uuid\Uuid;

/**
 * Cloass for Post
 *
 * @author Leonela Guteirrez <leonela_gutierrez@hotmail.com>
 **/
class post implements \JsonSerializable {
	use ValidateUuid;
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
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 * */

	public function __construct($newPostId, $newPostTruckId, $newPostUserId, $newPostContent, $newPostDatetime) {
		try {
			$this->setPostId($newPostId);
			$this->setPostTruckId($newPostTruckId);
			$this->setPostUserId($newPostUserId);
			$this->setPostContent($newPostContent);
			$this->setPostDatetime($newPostDatetime);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for post id
	 *
	 * @return int value of the post id
	 **/
	public function getPostId(): Uuid {
		return ($this->postId);
	}

	/**
	 * mutator method for post id
	 *
	 * @param Uuid|string $newPostId new post id
	 * @param \RangeException if $newPostId is not positive
	 * @Throws \TypeError if $newPostId is not a uuid
	 **/
	public function setPostId($newPostId): void {
		try {
			$uuid = self::validateUuid($newPostId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the post id
		$this->postId = $uuid;
	}

	/**
	 * accessor method for Truck post id
	 *
	 * @return int value of the post truck id
	 **/
	public function getPostTruckId(): Uuid {
		return ($this->postTruckId);
	}

	/**
	 * mutator method for post truck id
	 *
	 * @param Uuid|string $newPostTruckId new post truck id
	 * @param \RangeException if $newPostId is not positive
	 * @Throws \TypeError if $newPostId is not a uuid
	 **/
	public function setPostTruckId($newPostTruckId): void {
		try {
			$uuid = self::validateUuid($newPostTruckId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
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
	 * @Throws \TypeError if $newPostUserId is not a uuid
	 **/
	public function setPostUserId($newPostUserId): void {
		try {
			$uuid = self::validateUuid($newPostUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
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
	public function getPostContent() : string {
		return($this->postContent);
	}

	/**
	 * mutator method for post content
	 *
	 * @param string $newPostContent new value of post content
	 * @throws \InvalidArgumentException if $newPostContent is not a string or insecure
	 * @throws \RangeException if $newPostContent is > 144 characters
	 * @throws \TypeError if $newPostContent is not a string
	 **/
	public function setPostContent(string $newPostContent) : void {
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
	public function getPostDatetime() : \DateTime {
		return($this->postDatetime);
	}

	/**
	 * mutator method for post datetime
	 *
	 * @param \DateTime|string|null $newPostDatetime post date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newPostDatetime is not a valid object or string
	 * @throws \RangeException if $newPostDatetime is a date time that does not exist
	 **/
	public function setPostDatetime($newPostDatetime = null) : void {
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


}

/**Post:
postId binary(16) not null,
postTruckId binary(16),
postUserId binary(16),
postContent varchar(144) null,
postDatetime datetime(6) not null,
primary key (postId