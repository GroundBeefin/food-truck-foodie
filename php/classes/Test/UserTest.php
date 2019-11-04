<?php
namespace Groundbeefin\FoodTruckFoodie;
use Groundbeefin\FoodTruckFoodie; {
	User; Trucks; Post;
};
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
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 **/
class UserTest extends FoodTruckFoodieTest {
	/**
	 * valid user Id to user
	 * @var string $USER_ID
	 */
	protected $VALID_USER_ID;
	/*
	 * valid activation
	 * @var int @VALID_ACTIVATION
	 */
	protected $VALID_ACTIVATION;
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
	 * @var $VALID_USER_PROFILE_HASH
	 */
	protected $VALID_USER_PROFILE_HASH;
	/**
	 * valid user name
	 * @var string $VALID_PHONE
	 **/
	protected $VALID_USER_NAME;
	/**
	 * run the default setup operation to create salt and hash.
	 */
	public final function setUp() : void {
		parent::setUp();
		//
		$password = "abc123";
		$this->VALID_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 384]);
		$this->VALID_ACTIVATION = bin2hex(random_bytes(16));
	}
	/**
	 * test inserting a valid Profile and verify that the actual mySQL data matches
	 **/
	public function testInsertValidProfile() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");
		$userId = generateUuidV4();
		$user = new User($UserId, $this->VALID_USER_ID, $this->VALID_USER_ACTIVATION_TOKEN, $this->VALID_USER_AVATAR_URL, $this->VALID_USER_EMAIL, $this->VALID_USER_PROFILE_HASH, $this->VALID_USER_NAME);
		$user->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoUser->getUserId(), $profileId); $this->VALID_USER_ID
		$this->assertEquals($pdoUser->getUserActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoUser->getUserAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoUser->getUserEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoUser->getUserProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoUser->getUserName(), $this->VALID_PHONE);
	}
	/**
	 * test inserting a Profile, editing it, and then updating it
	 **/
	public function testUpdateValidProfile() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		// create a new Profile and insert to into mySQL
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE,$this->VALID_PROFILE_AVATAR_URL, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_PHONE);
		$profile->insert($this->getPDO());
		// edit the Profile and update it in mySQL
		$profile->setProfileAtHandle($this->VALID_ATHANDLE2);
		$profile->update($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $profile->getProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileAtHandle(), $this->VALID_ATHANDLE2);
		$this->assertEquals($pdoProfile->getProfileAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PHONE);
	}
	/**
	 * test creating a Profile and then deleting it
	 **/
	public function testDeleteValidProfile() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_PHONE);
		$profile->insert($this->getPDO());
		// delete the Profile from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$profile->delete($this->getPDO());
		// grab the data from mySQL and enforce the Profile does not exist
		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $profile->getProfileId());
		$this->assertNull($pdoProfile);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("profile"));
	}
	/**
	 * test inserting a Profile and regrabbing it from mySQL
	 **/
	public function testGetValidProfileByProfileId() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_PHONE);
		$profile->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileId($this->getPDO(), $profile->getProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileAtHandle(), $this->VALID_ATHANDLE);
		$this->assertEquals($pdoProfile->getProfileAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PHONE);
	}
	/**
	 * test grabbing a Profile that does not exist
	 **/
	public function testGetInvalidProfileByProfileId() : void {
		// grab a profile id that exceeds the maximum allowable profile id
		$fakeProfileId = generateUuidV4();
		$profile = Profile::getProfileByProfileId($this->getPDO(), $fakeProfileId );
		$this->assertNull($profile);
	}
	public function testGetValidProfileByAtHandle() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_PHONE);
		$profile->insert($this->getPDO());
		//grab the data from MySQL
		$results = Profile::getProfileByProfileAtHandle($this->getPDO(), $this->VALID_ATHANDLE);
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("profile"));
		//enforce no other objects are bleeding into profile
		$this->assertContainsOnlyInstancesOf("Edu\\CNM\\DataDesign\\Profile", $results);
		//enforce the results meet expectations
		$pdoProfile = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileAtHandle(), $this->VALID_ATHANDLE);
		$this->assertEquals($pdoProfile->getProfileAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PHONE);
	}
	/**
	 * test grabbing a Profile by at handle that does not exist
	 **/
	public function testGetInvalidProfileByAtHandle() : void {
		// grab an at handle that does not exist
		$profile = Profile::getProfileByProfileAtHandle($this->getPDO(), "@doesnotexist");
		$this->assertCount(0, $profile);
	}
	/**
	 * test grabbing a Profile by email
	 **/
	public function testGetValidProfileByEmail() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_PHONE);
		$profile->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileEmail($this->getPDO(), $profile->getProfileEmail());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileAtHandle(), $this->VALID_ATHANDLE);
		$this->assertEquals($pdoProfile->getProfileAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PHONE);
	}
	/**
	 * test grabbing a Profile by an email that does not exists
	 **/
	public function testGetInvalidProfileByEmail() : void {
		// grab an email that does not exist
		$profile = Profile::getProfileByProfileEmail($this->getPDO(), "does@not.exist");
		$this->assertNull($profile);
	}
	/**
	 * test grabbing a profile by its activation
	 */
	public function testGetValidProfileByActivationToken() : void {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");
		$profileId = generateUuidV4();
		$profile = new Profile($profileId, $this->VALID_ACTIVATION, $this->VALID_ATHANDLE, $this->VALID_PROFILE_AVATAR_URL, $this->VALID_EMAIL, $this->VALID_HASH, $this->VALID_PHONE);
		$profile->insert($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileActivationToken($this->getPDO(), $profile->getProfileActivationToken());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profileId);
		$this->assertEquals($pdoProfile->getProfileActivationToken(), $this->VALID_ACTIVATION);
		$this->assertEquals($pdoProfile->getProfileAtHandle(), $this->VALID_ATHANDLE);
		$this->assertEquals($pdoProfile->getProfileAvatarUrl(), $this->VALID_PROFILE_AVATAR_URL);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_EMAIL);
		$this->assertEquals($pdoProfile->getProfileHash(), $this->VALID_HASH);
		$this->assertEquals($pdoProfile->getProfilePhone(), $this->VALID_PHONE);
	}
	/**
	 * test grabbing a Profile by an email that does not exists
	 **/
	public function testGetInvalidProfileActivation() : void {
		// grab an email that does not exist
		$profile = Profile::getProfileByProfileActivationToken($this->getPDO(), "6675636b646f6e616c646472756d7066");
		$this->assertNull($profile);
	}
}