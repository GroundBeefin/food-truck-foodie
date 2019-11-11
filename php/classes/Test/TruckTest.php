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
	/**
	 * valid truck id to use
	 * @var string $VALID_TRUCK_ID
	 */
	protected $VALID_TRUCK_ID;

	/**
	 * valid at truck user id  to use
	 * @var string $VALID_TRUCK_USER_ID
	 **/
	protected $VALID_TRUCK_USER_ID = "@phpunit";

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
	 * run the default setup operation to create salt and hash.
	 */
	public final function setUp(): void {
		parent::setUp();
		$password = "abc123";
		$this->VALID_USER_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_USER_ACTIVATION_TOKEN = bin2hex(random_bytes(16));


		// create and insert a User to own the test Truck
		$this->user = new User();
		$this->user->insert($this->getPDO());
	}


	/**
	 * test inserting a valid Tuck  and verify that the actual mySQL data matches
	 **/
	public function testInsertValidTruck(): void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("truck");

		$truckId = generateUuidV4();


		$truck = new Truck($truckId, $this->user->getUserId(),$this->VALID_TRUCK_AVATAR_URL,$this->VALID_TRUCK_EMAIL,$this->VALID_TRUCK_FOOD_TYPE,$this->VALID_TRUCK_MENU_URL,,"Street Hibachi","5055555555","img...","verified");
		$truck->insert($this->getPDO());

		// grab the data from MySQL and enforce the fields match expectations
		$pdoTruck = Truck::getTruckByTruckId($this->getPDO(), $truck->getTruckId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("truck"));
		$this->assertEquals($pdoTruck->getTruckId(), $truckId);
		$this->assertEquals($pdoTruck->getTruckUserId(), $this->VALID_TR)




 		