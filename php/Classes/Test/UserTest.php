<?php

namespace GroundBeefin\FoodTruckFoodie\Test;

use GroundBeefin\FoodTruckFoodie\ {User};

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 * Full PHPUnit test for the User class
 *
 * This is a complete PHPUnit test of the User class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see User
 * @author Zachary Sanchez <zacharyesanchez22@gmail.com>
 **/
class UserTest extends FoodTruckFoodieTest {
	/**
	 * valid user Id to user
	 * @var string $USER_ID
	 */
	protected $VALID_USER_ID = "generateUuidV4()";
	/*
	 * valid user activation token
	 * @var int @VALID_USER_ACTIVATION_TOKEN
	 */
	protected $VALID_USER_ACTIVATION_TOKEN;
	/**
	 * valid at user avatar url to use
	 * @var string $VALID_USER_AVATAR_URL
	 **/
	protected $VALID_USER_AVATAR_URL = "https://media.giphy.com/media/3og0INyCmHlNylks9O/giphy.gif";
	/**
	 * valid email to use
	 * @var string $VALID_EMAIL
	 **/
	protected $VALID_USER_EMAIL = "test@phpunit.de";
	/**
	 * valid hash to use
	 * @var $VALID_USER_HASH
	 */
	protected $VALID_USER_HASH;
	/**
	 * valid user name
	 * @var string $VALID_USER_NAME
	 **/
	protected $VALID_USER_NAME = "test user";

	/**
	 * run the default setup operation to create salt and hash.
	 */
	public final function setUp(): void {
		parent::setUp();
		$password = "abc123";
		$this->VALID_USER_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_USER_ACTIVATION_TOKEN = bin2hex(random_bytes(16));
	}

	/**
	 * test inserting a valid User and verify that the actual mySQL data matches
	 **/
	public function testInsertValidUser(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		$userId = generateUuidV4();

		$user = new User($userId, $this->VALID_USER_ACTIVATION_TOKEN, $this->VALID_USER_AVATAR_URL, $this->VALID_USER_EMAIL, $this->VALID_USER_HASH, $this->VALID_USER_NAME);
		$user->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_USER_ACTIVATION_TOKEN);
		$this->assertEquals($pdoUser->getUserAvatarUrl(), $this->VALID_USER_AVATAR_URL);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USER_EMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_USER_HASH);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USER_NAME);
	}

	/**
	 * test inserting a User, editing it, and then updating it
	 **/
	public function testUpdateValidUser() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		// create a new User and insert to into mySQL
		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_USER_ACTIVATION_TOKEN, $this->VALID_USER_AVATAR_URL, $this->VALID_USER_EMAIL, $this->VALID_USER_HASH, $this->VALID_USER_NAME);
		$user->insert($this->getPDO());

		// edit the User and update it in mySQL
		$user->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = USER::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_USER_ACTIVATION_TOKEN);
		$this->assertEquals($pdoUser->getUserAvatarUrl(), $this->VALID_USER_AVATAR_URL);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USER_EMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_USER_HASH);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USER_NAME);
	}

	/**
	 * test creating a User and then deleting it
	 **/
	public function testDeleteValidUser(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_USER_ACTIVATION_TOKEN, $this->VALID_USER_AVATAR_URL, $this->VALID_USER_EMAIL, $this->VALID_USER_HASH, $this->VALID_USER_NAME);
		$user->insert($this->getPDO());

		// delete the User from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$user->delete($this->getPDO());
		
		// grab the data from mySQL and enforce the User does not exist
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertNull($pdoUser);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("user"));
	}

	/**
	 * test inserting a User and regrabbing it from mySQL
	 **/
	public function testGetValidUserByUserId(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_USER_ACTIVATION_TOKEN, $this->VALID_USER_AVATAR_URL, $this->VALID_USER_EMAIL, $this->VALID_USER_HASH, $this->VALID_USER_NAME);
		$user->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_USER_ACTIVATION_TOKEN);
		$this->assertEquals($pdoUser->getUserAvatarUrl(), $this->VALID_USER_AVATAR_URL);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USER_EMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_USER_HASH);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USER_NAME);
	}

	/**
	 * test grabbing a User that does not exist
	 **/
	public function testGetInvalidUserByUserId(): void {
		// grab a user id that exceeds the maximum allowable user id
		$fakeUserId = generateUuidV4();
		$user = User::getUserByUserId($this->getPDO(), $fakeUserId);
		$this->assertNull($user);
	}

	/**
	 * test grabbing a User by user id
	 **/
	public function testGetUserByUserId(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		$userId = generateUuidV4();
		$user = new User($userId, $this->VALID_USER_ACTIVATION_TOKEN, $this->VALID_USER_AVATAR_URL, $this->VALID_USER_EMAIL, $this->VALID_USER_HASH, $this->VALID_USER_NAME);
		$user->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUser());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $userId);
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_USER_ACTIVATION_TOKEN);
		$this->assertEquals($pdoUser->getUserAvatarUrl(), $this->VALID_USER_AVATAR_URL);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_USER_EMAIL);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_USER_HASH);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_USER_NAME);
	}

	/**
	 * test grabbing a User by an user id that does not exists
	 **/
	public function testGetInvalidProfileByEmail(): void {
		// grab an email that does not exist
		$user = User::getUserByUserId($this->getPDO(), "does@not.exist");
		$this->assertNull($user);
	}
}

