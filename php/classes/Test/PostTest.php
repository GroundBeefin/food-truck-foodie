<?php

namespace Groundbeefin\FoodTruckFoodie\Test;
use Groundbeefin\FoodTruckFoodie\{
	User, Truck, Post
};

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 * Full PHPUnit test for the Post class
 *
 * This is a complete PHPUnit test of the Post class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested valid inputs.
 *
 * @see Post
 * @author LeonelaGutierrez <Leonela_Gutierrez@hotmail.com>
 **/
class PostTest extends FoodTruckFoodieTest {
	/**
	 * User with registered truck ; this is for foreign key relations
	 * @var User
	 **/
	protected $user = null;
	/**
	 * valid $user hash
	 * @var $VALID_USER_HASH
	 */
	protected $VALID_USER_HASH;
	/**
	 * truck that created the post; this is a foreign key
	 * @var $truck
	 */
	protected $truck = null;
	/**
	 * valid truckId to create the object to own the test
	 * @var $VALID_TRUCK_ID
	 */
	protected $VALID_TRUCK_ID;
	/**
	 * content of the Post
	 * @var string $VALID_POSTCONTENT
	 **/
	protected $VALID_POSTCONTENT = "PHPUnit test passing";
	/**
	 * content of the updated Post
	 * @var string $VALID_POSTCONTENT2
	 **/
	protected $VALID_POSTCONTENT2 = "PHPUnit test still passing";
	/**
	 * timestamp of the Post; this starts as null and is assigned later
	 * @var \DateTime $VALID_POSTDATE
	 **/
	protected $VALID_POSTDATE = null;
	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp()  : void {
			// run the default setUp() method first
			parent::setUp();

			//create and salt the hash for the mocked profile
			$password = "abc123";
			$this->VALID_USER_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);

			// create and insert a User to own the test Post
			$this->user = new User(generateUuidV4(), null,"@handle", "https://media.giphy.com/media/3og0INyCmHlNylks9O/giphy.gif", "test@phpunit.de",$this->VALID_USER_HASH, "+12125551212");
			$this->user->insert($this->getPDO());

			// create and insert the mocked truck profile
			$this->truck = new Truck(generateUuidV4(), null,"@phpunit", "https://media.giphy.com/media/3og0INyCmHlNylks9O/giphy.gif", "test@phpunit.de",$this->VALID_HASH, "+12125551212");
			$this->truck->insert($this->getPDO());

			// create  and insert the mocked post
			$this->post = new Post(generateUuidV4(), $this->post->getPostId(), "PHPUnit like test passing");
			$this->post->insert($this->getPDO());

			// calculate the date (just use the time the unit test was setup...)
			$this->VALID_POSTDATETIME = new \DateTime();
		}


	/**
	 * test inserting a valid Post and verify that the actual mySQL data matches
	 **/
	public function testInsertValidPost() : void {


		// create a new Post and insert to into mySQL
		$postId = generateUuidV4();
		$post = new Post($postId, $this->truck->getTruckId(), $this->VALID_POSTCONTENT, $this->VALID_POSTDATE);
		$post->insert($this->getPDO());


		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPost = Post::getPostByPostTruckId($this->getPDO(), $post->getPostTruckId());

		$this->assertEquals($pdoPost->getPostId()->toString(), $postId->toString());
		$this->assertEquals($pdoPost->getPostTruckId(), $post->getPostId()->toString());
		$this->assertEquals($pdoPost->getPostUserId(), $post->getPostId()->toString());
		$this->assertEquals($pdoPost->getPostContent(), $this->VALID_POSTCONTENT);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoPost->getPostDate()->getTimestamp(), $this->VALID_POSTDATE->getTimestamp());
	}


	/**
	 * test inserting a Post, editing it, and then updating it
	 **/
	public function testUpdateValidPost() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("post");

		// create a new Post and insert to into mySQL
		$postId = generateUuidV4();
		$post = new Post($postId, $this->profile->getPostTruckId(), $this->VALID_POSTCONTENT, $this->VALID_POSTDATE);
		$post->insert($this->getPDO());

		// edit the Post and update it in mySQL
		$post->setPostContent($this->VALID_POSTCONTENT2);
		$post->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPost = Post::getPostByPostTruckId($this->getPDO(), $post->getPostId());

		$this->assertEquals($pdoPost->getPostId()->toString(), $postId->toString());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("post"));
		$this->assertEquals($pdoPost->getPostTruckId()->toString(), $this->truck->getTruckId()->toString());
		$this->assertEquals($pdoPost->getPostContent(), $this->VALID_POSTCONTENT2);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoPost->getPostDate()->getTimestamp(), $this->VALID_POSTDATE->getTimestamp());
	}


	/**
	 * test creating a Post and then deleting it
	 **/
	public function testDeleteValidPost() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");
		// create a new Tweet and insert to into mySQL
		$tweetId = generateUuidV4();
		$tweet = new Tweet($tweetId, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());
		// delete the Tweet from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$tweet->delete($this->getPDO());
		// grab the data from mySQL and enforce the Tweet does not exist
		$pdoTweet = Tweet::getTweetByTweetId($this->getPDO(), $tweet->getTweetId());
		$this->assertNull($pdoTweet);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("tweet"));
	}
	/**
	 * test grabbing a Tweet that does not exist
	 **/
	public function testGetInvalidTweetByTweetId() : void {
		// grab a profile id that exceeds the maximum allowable profile id
		$tweet = Tweet::getTweetByTweetId($this->getPDO(), generateUuidV4());
		$this->assertNull($tweet);
	}
	/**
	 * test inserting a Tweet and regrabbing it from mySQL
	 *
	 *
	 **/
	public function testGetValidTweetByTweetProfileId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");
		// create a new Tweet and insert to into mySQL
		$tweetId = generateUuidV4();
		$tweet = new Tweet($tweetId, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Tweet::getTweetByTweetProfileId($this->getPDO(), $tweet->getTweetProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DataDesign\\Tweet", $results);
		// grab the result from the array and validate it
		$pdoTweet = $results[0];

		$this->assertEquals($pdoTweet->getTweetId(), $tweetId);
		$this->assertEquals($pdoTweet->getTweetProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoTweet->getTweetDate()->getTimestamp(), $this->VALID_TWEETDATE->getTimestamp());
	}
	/**
	 * test grabbing a Tweet that does not exist
	 **/
	public function testGetInvalidTweetByTweetProfileId() : void {
		// grab a profile id that exceeds the maximum allowable profile id
		$tweet = Tweet::getTweetByTweetProfileId($this->getPDO(), generateUuidV4());
		$this->assertCount(0, $tweet);
	}
	/**
	 * test grabbing a Tweet by tweet content
	 **/
	public function testGetValidTweetByTweetContent() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");
		// create a new Tweet and insert to into mySQL
		$tweetId = generateUuidV4();
		$tweet = new Tweet($tweetId, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Tweet::getTweetByTweetContent($this->getPDO(), $tweet->getTweetContent());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertCount(1, $results);
		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DataDesign\\Tweet", $results);
		// grab the result from the array and validate it
		$pdoTweet = $results[0];
		$this->assertEquals($pdoTweet->getTweetId(), $tweetId);
		$this->assertEquals($pdoTweet->getTweetProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoTweet->getTweetDate()->getTimestamp(), $this->VALID_TWEETDATE->getTimestamp());
	}
	/**
	 * test grabbing a Tweet by content that does not exist
	 **/
	public function testGetInvalidTweetByTweetContent() : void {
		// grab a tweet by content that does not exist
		$tweet = Tweet::getTweetByTweetContent($this->getPDO(), "Comcast has the best service EVER #comcastLove");
		$this->assertCount(0, $tweet);
	}
	/**
	 * test grabbing all Tweets
	 **/
	public function testGetAllValidTweets() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");
		// create a new Tweet and insert to into mySQL
		$tweetId = generateUuidV4();
		$tweet = new Tweet($tweetId, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Tweet::getAllTweets($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\DataDesign\\Tweet", $results);
		// grab the result from the array and validate it
		$pdoTweet = $results[0];
		$this->assertEquals($pdoTweet->getTweetId(), $tweetId);
		$this->assertEquals($pdoTweet->getTweetProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoTweet->getTweetDate()->getTimestamp(), $this->VALID_TWEETDATE->getTimestamp());
	}
}