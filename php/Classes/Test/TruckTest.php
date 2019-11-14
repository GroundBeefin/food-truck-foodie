<?php

namespace GroundBeefin\FoodTruckFoodie\Test;

use GroundBeefin\FoodTruckFoodie\{
	Post, Truck, User
};

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");
// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 * Full PHPUnit test for the Truck class
 *
 * This is a complete PHPUnit test of the TruckP class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Truck
 * @author Ian W Foster <ian.foster95@yahoo.com>
 **/
class TruckTest extends FoodTruckFoodieTest {

	/** user who created the truck
	 *@var string $VALID_USER_ID
	 */
	protected $user;

		/** user  who set up truck activation token
		 *@var user activation token
		 */
	protected $VALID_USER_ACTIVATION_TOKEN;

	/**
	 * users hash
	 */
	protected $VALID_USER_HASH;

	/**
	 * valid truck user id
	 */

	protected $VALID_TRUCK_USER_ID;


	/**
	 * valid truck avatar url
	 * @var string $VALID_TRUCK_AVATAR_URL
	 **/
	protected $VALID_TRUCK_AVATAR_URL = "https://media.giphy.com/media/3og0INyCmHlNylks9O/giphy.gif";


	/**
	 * valid  truck email to use
	 * @var string $VALID_TRUCK_EMAIL
	 **/
	protected $VALID_TRUCK_EMAIL = "test@phpunit.de";

	/**
	 * valid truck food type
	 * @var string $VALID_TRUCK_FOOD_TYPE
	 */
	protected $VALID_TRUCK_FOOD_TYPE = "japanese";

	/**
	 * valid truck menu url
	 * @var string $VALID_TRUCK_MENU_URL
	 **/
	protected $VALID_TRUCK_MENU_URL = "https://media.giphy.com/media/3og0INyCmHlNylks9O/giphy.gif";

	/**
	 * valid truck name
	 * @var string $VALID_TRUCK_NAME
	 **/
	protected $VALID_TRUCK_NAME = "Street Hibachi";

	/**
	 * valid truck name
	 * @var string $VALID_TRUCK_NAME
	 **/
	protected $VALID_TRUCK_NAME_2 = "japanese Hibachi";

	/**
	 * valid phone number to use
	 * @var string $VALID_TRUCK_PHONE_NUMBER
	 **/

	protected $VALID_TRUCK_PHONE_NUMBER = "5055555555";

	/**
	 * valid hash to use
	 * @var $VALID_TRUCK_VERIFY_IMAGE
	 */
	protected $VALID_TRUCK_VERIFY_IMAGE = "img...";

	/**
	 * valid hash to use
	 * @var
	 **/

	protected $VALID_TRUCK_VERIFIED_CHECK = "verified";
	/**
	 * create decedent objects before running test
	 */

	/**
	 * run the default setup operation to create salt and hash.
	 */
	public final function setUp(): void {
		parent::setUp();
		$password = "abc123";
		$this->VALID_USER_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_USER_ACTIVATION_TOKEN = bin2hex(random_bytes(16));


		// create and insert a User to own the test Truck
//		$userId = generateUuidV4();
		$user = new User(generateUuidV4(), $this->VALID_USER_ACTIVATION_TOKEN, "https://media.giphy.com/media/3og0INyCmHlNylks9O/giphy.gif", "test@phpunit.de", $this->VALID_USER_HASH, "Street Hibachi");
		$user->insert($this->getPDO());
	}

	/**
	 * test inserting a Tuck, editing it, and then updating it
	 **/
	public function testUpdateValidTruck(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("truck");
		// create a new Truck and insert to into mySQL
		$truckId = generateUuidV4();
		$truck = new Truck($truckId, $this->user->getUserId(), $this->VALID_TRUCK_AVATAR_URL, $this->VALID_TRUCK_EMAIL, $this->VALID_TRUCK_FOOD_TYPE, $this->VALID_TRUCK_MENU_URL, $this->VALID_TRUCK_NAME, $this->VALID_TRUCK_PHONE_NUMBER, $this->VALID_TRUCK_VERIFY_IMAGE, $this->VALID_TRUCK_VERIFIED_CHECK);
		$truck->insert($this->getPDO());
		// edit the Truck and update it in mySQL
		$truck->setTruckName($this->VALID_TRUCK_NAME_2);
		$truck->update($this->getPDO());
		$pdoTruck = Truck::getTruckByTruckId($this->getPDO(), $truck->getTruckId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("truck"));
		$this->assertEquals($pdoTruck->getTruckUserId()->toString(), $this->user->getUserId()->toString());
		$this->assertEquals($pdoTruck->getTruckId(), $truckId);
		$this->assertEquals($pdoTruck->getTruckAvatarUrl(), $this->VALID_TRUCK_AVATAR_URL);
		$this->assertEquals($pdoTruck->getTruckEmail(), $this->VALID_TRUCK_EMAIL);
		$this->assertEquals($pdoTruck->getTruckFoodType(), $this->VALID_TRUCK_FOOD_TYPE);
		$this->assertEquals($pdoTruck->getTruckMenuUrl(), $this->VALID_TRUCK_MENU_URL);
		$this->assertEquals($pdoTruck->getTruckName(), $this->VALID_TRUCK_NAME);
		$this->assertEquals($pdoTruck->getTruckPhoneNumber(), $this->VALID_TRUCK_PHONE_NUMBER);
		$this->assertEquals($pdoTruck->getTruckVerifyImage(), $this->VALID_TRUCK_VERIFY_IMAGE);
		$this->assertEquals($pdoTruck->getTruckVerifiedCheck(), $this->VALID_TRUCK_VERIFIED_CHECK);
	}

	/**
	 * test inserting a valid Tuck  and verify that the actual mySQL data matches
	 **/
	public function testInsertValidTruck(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("truck");

		$truckId = generateUuidV4();



		$truck = new Truck($truckId, $this->user->getUserId(), $this->VALID_TRUCK_AVATAR_URL, $this->VALID_TRUCK_EMAIL, $this->VALID_TRUCK_FOOD_TYPE, $this->VALID_TRUCK_MENU_URL, $this->VALID_TRUCK_NAME, $this->VALID_TRUCK_PHONE_NUMBER, $this->VALID_TRUCK_VERIFY_IMAGE, $this->VALID_TRUCK_VERIFIED_CHECK);
		$truck->insert($this->getPDO());

		// grab the data from MySQL and enforce the fields match expectations
		$pdoTruck = Truck::getTruckByTruckId($this->getPDO(), $truck->getTruckId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("truck"));
		$this->assertEquals($pdoTruck->getTruckId(), $truckId);
		$this->assertEquals($pdoTruck->getTruckUserId(), $this->VALID_TRUCK_USER_ID);
		$this->assertEquals($pdoTruck->getTruckAvatarUrl(), $this->VALID_TRUCK_AVATAR_URL);
		$this->assertEquals($pdoTruck->getTruckEmail(), $this->VALID_TRUCK_EMAIL);
		$this->assertEquals($pdoTruck->getTruckFoodType(), $this->VALID_TRUCK_FOOD_TYPE);
		$this->assertEquals($pdoTruck->getTruckMenuUrl(), $this->VALID_TRUCK_MENU_URL);
		$this->assertEquals($pdoTruck->getTruckName(), $this->VALID_TRUCK_NAME);
		$this->assertEquals($pdoTruck->getTruckPhoneNumber(), $this->VALID_TRUCK_PHONE_NUMBER);
		$this->assertEquals($pdoTruck->getTruckVerifyImage(), $this->VALID_TRUCK_VERIFY_IMAGE);
		$this->assertEquals($pdoTruck->getTruckVerifiedCheck(), $this->VALID_TRUCK_VERIFIED_CHECK);
	}


	/**
	 * test creating a Truck and then deleting it
	 **/
	public function testDeleteValidTruck(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("truck");
		// create a new Truck and insert to into mySQL
		$truckId = generateUuidV4();
		$truck = new Truck($truckId, $this->user->getUserId(), $this->VALID_TRUCK_AVATAR_URL, $this->VALID_TRUCK_EMAIL, $this->VALID_TRUCK_FOOD_TYPE, $this->VALID_TRUCK_MENU_URL, $this->VALID_TRUCK_NAME, $this->VALID_TRUCK_PHONE_NUMBER, $this->VALID_TRUCK_VERIFY_IMAGE, $this->VALID_TRUCK_VERIFIED_CHECK);
		$truck->insert($this->getPDO());
		// delete the Truck from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("truck"));
		$truck->delete($this->getPDO());
		// grab the data from mySQL and enforce the Truck does not exist
		$pdoTruck = Truck::getTruckByTruckId($this->getPDO(), $truck->getTruckId());
		$this->assertNull($pdoTruck);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("truck"));


	}

	public function testGetValidTruckByTruckId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("truck");
		// create a new Truck and insert to into mySQL
		$truckId = generateUuidV4();
		$truck = new Truck($truckId, $this->user->getUserId(), $this->VALID_TRUCK_AVATAR_URL, $this->VALID_TRUCK_EMAIL, $this->VALID_TRUCK_FOOD_TYPE, $this->VALID_TRUCK_MENU_URL, $this->VALID_TRUCK_NAME, $this->VALID_TRUCK_PHONE_NUMBER, $this->VALID_TRUCK_VERIFY_IMAGE, $this->VALID_TRUCK_VERIFIED_CHECK = "verified");
		$truck->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Truck::getTruckByTruckId($this->getPDO(), $truck->getTruckId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("truck"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodie\\Truck", $results);
		// grab the result from the array and validate it
		$pdoTruck = $results[0];
		$this->assertEquals($pdoTruck->getTruckId(), $truckId);
		$this->assertEquals($pdoTruck->getTruckId(), $this->user->getUserId());

	}

	/**
	 * test grabbing a Truck by truckFoodType
	 **/
	public function testTruckByTruckFoodType(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("truck");
		// create a new Truck and insert to into mySQL
		$truckId = generateUuidV4();
		$truck = new Truck($truckId, $this->user->getUserId(), $this->VALID_TRUCK_AVATAR_URL, $this->VALID_TRUCK_EMAIL, $this->VALID_TRUCK_FOOD_TYPE, $this->VALID_TRUCK_MENU_URL, $this->VALID_TRUCK_NAME, $this->VALID_TRUCK_PHONE_NUMBER, $this->VALID_TRUCK_VERIFY_IMAGE, $this->VALID_TRUCK_VERIFIED_CHECK);
		$truck->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Truck::getTruckByTruckFoodType($this->getPDO(), $truck->getTruckFoodType());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("truck"));
		$this->assertCount(1, $results);
		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodie\\Truck", $results);
		// grab the result from the array and validate it
		$pdoTruck = $results[0];
		$this->assertEquals($pdoTruck->getTruckId(), $truckId);
		$this->assertEquals($pdoTruck->getTruckUserId(), $this->user->getUserId());
		$this->assertEquals($pdoTruck->getTruckFoodType(), $this->VALID_TRUCK_FOOD_TYPE);
	}

	public function testGetValidTruckByTruckUserId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("truck");
		// create a new Truck and insert to into mySQL
		$truckId = generateUuidV4();
		$truck = new Truck($truckId, $this->user->getUserId(), $this->VALID_TRUCK_AVATAR_URL, $this->VALID_TRUCK_EMAIL, $this->VALID_TRUCK_FOOD_TYPE, $this->VALID_TRUCK_MENU_URL, $this->VALID_TRUCK_NAME, $this->VALID_TRUCK_PHONE_NUMBER, $this->VALID_TRUCK_VERIFY_IMAGE, $this->VALID_TRUCK_VERIFIED_CHECK);
		$truck->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Truck::getTruckByTruckUserId($this->getPDO(), $truck->getTruckUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("truck"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodie\\Truck", $results);
		// grab the result from the array and validate it
		$pdoTruck = $results[0];
		$this->assertEquals($pdoTruck->getTruckId(), $truckId);
		$this->assertEquals($pdoTruck->getTruckUserId(), $this->user->getUserId());

	}

	/**
	 * test grabbing a Truck by truckName
	 **/
	public function testTruckByTruckName(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("truck");
		// create a new Truck and insert to into mySQL
		$truckId = generateUuidV4();
		$truck = new Truck($truckId, $this->user->getUserId(), $this->VALID_TRUCK_AVATAR_URL, $this->VALID_TRUCK_EMAIL, $this->VALID_TRUCK_FOOD_TYPE, $this->VALID_TRUCK_MENU_URL, $this->VALID_TRUCK_NAME, $this->VALID_TRUCK_PHONE_NUMBER, $this->VALID_TRUCK_VERIFY_IMAGE, $this->VALID_TRUCK_VERIFIED_CHECK);
		$truck->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$results = Truck::getTruckByTruckName($this->getPDO(), $truck->getTruckName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("truck"));
		$this->assertCount(1, $results);
		// enforce no other objects are bleeding into the test
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Foodie\\Truck", $results);
		// grab the result from the array and validate it
		$pdoTruck = $results[0];
		$this->assertEquals($pdoTruck->getTruckId(), $truckId);
		$this->assertEquals($pdoTruck->getTruckUserId(), $this->user->getUserId());
		$this->assertEquals($pdoTruck->getTruckName(), $this->VALID_TRUCK_NAME);
	}
}



