<?php

namespace GroundBeefin\FoodTruckFoodie\Test;

use GroundBeefin\FoodTruckFoodie\{
	User, Truck, Post
};

//use phpDocumentor\Reflection\Types\This;

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
	 * User  ; this is for foreign key relations
	 * @var User
	 **/
	protected $user = null;
	/**
	 * truck that created the post; this is a foreign key
	 * @var $truck
	 */
	protected $truck = null;
	/**
	 * valid $user hash
	 * @var $VALID_USER_HASH
	 */
	protected $VALID_USER_HASH;

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
	 * valid activationToken to create the profile object to own the test
	 * @var string $VALID_ACTIVATION
	 */
	protected $VALID_ACTIVATION;


	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp()  : void {
			// run the default setUp() method first
			parent::setUp();

			//create and salt the hash for the mocked user
			$password = "abc123";
			$this->VALID_USER_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
			$this->VALID_ACTIVATION = bin2hex(random_bytes(16));

			// create and insert the mocked user
//			$userId = generateUuidV4();
			$this->user = new User(generateUuidV4(), $this->VALID_ACTIVATION,"https://media.giphy.com/media/3og0INyCmHlNylks9O/giphy.gif", "boo@boo.com", $this->VALID_USER_HASH, "test name");
			$this->user->insert($this->getPDO());

			// create and insert the mocked truck
			$this->truck = new Truck(generateUuidV4(), $this->user->getUserId(), "https://media.giphy.com/media/3og0INyCmHlNylks9O/giphy.gif", "test@phpunit.de","mexican", "https://image.com/media", "FoodTruckOne", "5055554463", "image.url", "true");
			$this->truck->insert($this->getPDO());


			// calculate the date (just use the time the unit test was setup...)
			$this->VALID_POSTDATE = new \DateTime();
		}



	/**
	 * test inserting a valid Post and verify that the actual mySQL data matches
	 **/
	public function testInsertValidPost() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("post");

		// create a new Post and insert to into mySQL
		$postId = generateUuidV4();
		$post = new Post($postId, $this->truck->getTruckId(), $this->user->getUserId(), $this->VALID_POSTCONTENT, $this->VALID_POSTDATE);
		$post->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPost = Post::getPostByPostId($this->getPDO(), $this->getPostId());

		$this->assertEquals($pdoPost->getPostId()->toString(), $postId->toString());
		$this->assertEquals($pdoPost->getPostTruckId(), $post->getPostId()->toString());
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
		$post = new Post($this->post->getPostId, $this->truck->getTruckId(), $this->user->getUserId(), $this->VALID_POSTCONTENT, $this->VALID_POSTDATE);
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
		$numRows = $this->getConnection()->getRowCount("post");

		// create a new Post and insert to into mySQL
		$postId = generateUuidV4();
		$post = new Post($this->post->getPostId, $this->truck->getTruckId(), $this->user->getUserId(), $this->VALID_POSTCONTENT, $this->VALID_POSTDATE);
		$post->insert($this->getPDO());

		// delete the Post from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("post"));
		$post->delete($this->getPDO());

		// grab the data from mySQL and enforce the Post does not exist
		$pdoPost = Post::getPostByPostTruckId($this->getPDO(), $post->getPostId());
		$this->assertNull($pdoPost);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("post"));
	}

	/**
	 * test inserting a Post and regrabbing it from mySQL
	 *
	 *
	 *
	 * @throws \Exception
	 */
	public function testGetValidPostByPostTruckId() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("post");

		// create a new Post and insert to into mySQL
		$postId = generateUuidV4();
		$post = new Post($postId, $this->truck->getTruckId(), $this->user->getUserId(), $this->VALID_POSTCONTENT, $this->VALID_POSTDATE);
		$post->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Post::getPostByPostTruckId($this->getPDO(), $this->post->getPostId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("post"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("GroundBeefin\\FoodTruckFoodie\\Post", $results);

		// grab the result from the array and validate it
		$pdoPost = $results[0];
		$this->assertEquals($pdoPost->getPostTruckId(), $this->truck->getTruckId());
		$this->assertEquals($pdoPost->getPostUserId(), $this->user->getUserId());
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoPost->getPostDate()->getTimestamp(), $this->VALID_POSTDATE->getTimestamp());
	}

	/**
	 * test grabbing all Posts
	 **/
	public function testGetAllValidPosts() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("post");

		// create a new Post and insert to into mySQL
		$postId = generateUuidV4();
		$post = new Post($postId, $this->truck->getTruckId(), $this->user->getUserId(), $this->VALID_POSTCONTENT, $this->VALID_POSTDATE);
		$post->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Post::getAllPosts($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("post"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodie\\Post", $results);

		// grab the result from the array and validate it
		$pdoPost = $results[0];
		$this->assertEquals($pdoPost->getPostId(), $postId);
		$this->assertEquals($pdoPost->getTruckPostId(), $this->truck->getPostTruckId());
		$this->assertEquals($pdoPost->getPostContent(), $this->VALID_POSTCONTENT);
		//format the date too seconds since the beginning of time to avoid round off error
		$this->assertEquals($pdoPost->getPostDate()->getTimestamp(), $this->VALID_POSTDATE->getTimestamp());
	}
}


