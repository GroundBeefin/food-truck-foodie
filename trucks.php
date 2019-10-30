<?php
namespace Groundbeefin\FoodTruckFoodie;
require_once ("autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * This class if the truck user
 * @package Groundbeefin\FoodTruckFoodie
 * @author Ian W Foster <ian.foster95@yahoo.com>
 * @version 001.1
 */
class Truck {
	use ValidateUuid;
	/**
	 * This is the id for this profile; this is the primary key
	 * @var Uuid $truckId
	 */
	private $truckId;
	/**
	 * This is the trucks user id; this is a foreign key
	 * @var string $truckUserId
	 */
	private $truckUserId;
	/**
	 * The avatar url for this truck
	 * @var string $trucksAvatarUrl
	 * */
	private $truckAvatarUrl;
	/**
	 * This is the email for the truck
	 * @var string $truckEmail
	 */
	private $truckEmail;
	/**
	 * This is the tuck food type
	 * @var string $truckFoodType
	 */
	private $truckFoodType;
	/**
	 * This is the truck menu url
	 * @var $truckMenuUrl
	 */
	private $truckMenuUrl;
	/**
	 * This is the name of the truck
	 * @var $truckName
	 */
	private $truckName;
	/**
	 * this is the phone number of the truck
	 * @var $truckPhoneNumber
	 */
	private $truckPhoneNumber;
	/**
	 * this is the truck verify image
	 * @var $truckVerifyImage
	 * */
	private $truckVerifyImage;
	/**
	 * this is the truck verify checked
	 * @var $truckVerifyChecked
	 * */
	private $truckVerifyChecked;

	/**
	 * constructor for this truck
	 *
	 * @param string|Uuid $newTruckId id of this user if a new user
	 * @param string $newTruckUserId activation token to sage guard against malicious accounts
	 * @param string $newTruckAvatarUrl string containing truck url
	 * @param string $newTruckEmail string containing email
	 * @param string $newTruckFoodType string containing food type of truck
	 * @param string $newTruckMenuUrl string containing Url for truck menu
	 * @param string $newTruckName string containing truckName
	 * @param string $newTruckPhoneNumber containing truckPhoneNumber
	 * @param string $newTruckVerifyImage containing truckVerifyImage
	 * @param string $newTruckVerifyChecked containing truckVerifyChecked
	 * */
	public function __construct($newTruckId, $newTruckUserId, $newTruckAvatarUrl, $newTruckEmail, $newTruckFoodType, $newTruckMenuUrl, $newTruckName, $newTruckPhoneNumber, $newTruckVerifyImage, $newTruckVerifyChecked) {
		try {
			$this->setTruckId($newTruckId);
			$this->setTruckUserId($newTruckUserId);
			$this->setTruckAvatarUrl($newTruckAvatarUrl);
			$this->setTruckEmail($newTruckEmail);
			$this->setTruckFoodType($newTruckFoodType);
			$this->setTruckMenuUrl($newTruckMenuUrl);
			$this->setTruckName($newTruckName);
			$this->setTruckPhoneNumber($newTruckPhoneNumber);
			$this->setTruckVerifyImage($newTruckVerifyImage);
			$this->setTruckVerifyChecked($newTruckVerifyChecked);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \ TypeError $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
}
	/**
 	* *accessor method for tuck id
 	*
 	* @retun Uuid value of truck id (or null if ne Truck)
 	*/
	public function getTruckId(): Uuid {
		return ($this->truckId);
}
/**
 * mutator method for truck id
 *
 * @param Uuid | string $newTruckId
 * @param RangeException  if new truck id is not a positive
 * @throw TypeError if $newTruckId is not a Uuid
 **/
public function setTruckId($newTruckId): void {
	Try{
		$uuid = self::validateUuid($newTruckId);
	}catch( \InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw (new $exceptionType($exception->getMessage(), 0,$exception));
	}
	//convert and store this author id
	$this->truckId = $uuid;
}

/**
 * accessor method for truck user id
 *
 * @return string|value of truck user id
 */

public function getTruckUserId(): ?string {
	return ($this->truckUserId);
}
/**
 * mutator method for truck avatar url
 *
 * @param string $newTruckAvatarUrl new value of at truck
 * @throws InvalidArgumentException if $newTruckAvatarUrl is not a string or insecure
 * @throws RangeException if $newTruckAvatarUrl is > 32 characters
 * @throws TypeError if $newTruckAvatarUrl is not a string
 **/
public function setTruckAvatarUrl(string $newTruckAvatarUrl): void {
	// verify the at int is secure
	$newTruckAvatarUrl = trim($newTruckAvatarUrl);
	$newTruckAvatarUrl = filter_var($newTruckAvatarUrl, FILTER_VALIDATE_URL;
	if(empty($newTruckAvatarUrl) === true) {
		throw(new InvalidArgumentException("Truck at handle is empty or insecure"));
	}
	// verify the at handle will fit in the database
	if(strlen($newTruckAvatarUrl) > 255) {
		throw(new RangeException("Truck at handle is too large"));
	}

// store the avatar url
	$this->truckAvatarUrl = $newTruckAvatarUrl;
}
/**
 * accessor method for email for the truck
 *
 * @return string value of email for the truck
 **/
public function getTruckEmail(): string {
	return $this->truckEmail;
}
/**
 * mutator method for email for the truck
 *
 * @param string $newTruckEmail new value of email
 * @throws InvalidArgumentException if $newTruckEmail is not a valid email or insecure
 * @throws RangeException if $newTruckEmail is > 128 characters
 * @throws TypeError if $newTruckEmail is not a string
 **/
public function setTruckEmail(string $newTruckEmail): void {
	//verify email is secure
	$newTruckEmail = trim($newTruckEmail);
	$newTruckEmail = filter_var($newTruckEmail, FILTER_VALIDATE_EMAIL);
	if(empty($newTruckEmail) === true) {
		throw (new \InvalidArgumentException("Truck email is empty or insecure"));
	}
	//store trucks email
	$this->truckEmail = $newTruckEmail;
}
/**
 * accessor method for food type
 *
 * @return string value of food type
 * */
public function getTruckFoodType(): string {
	return ($this->truckFoodType);
	/**
	 * mutator method for truck food type
	 *
	 * @param string $newTruckFoodType
	 * @throws InvalidArgumentException if the truck food type is not available
	 * @throws RangeException if the food truck type is >128 characters
	 * @throws TypeError if truck food type is not a string
	 */
	public function setTruckFoodType(string $newTruckFoodType): void {
		//determines what food type are available
		$newTruckFoodType = trim($newTruckFoodType);
		$newTruckFoodType = filter_var($newTruckFoodType, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newTruckFoodType) === true) {
			throw (new \InvalidArgumentException("Truck food type is not available"));
		}
		//verify the truck food type will fit database
		if(strlen($newTruckFoodType) > 128) {
			throw(new \RangeException("Truck food type is too long"));
		}
		//truck food type
		$this->truckFoodType = $newTruckFoodType;
	}

}


