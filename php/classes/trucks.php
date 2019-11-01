<?php
namespace Groundbeefin\FoodTruckFoodie;
require_once ("autoload.php");

use http\Exception\InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use RangeException;
use TypeError;

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
	//convert and store this truck id
	$this->truckId = $uuid;
}

/**
 * accessor method for truck user id
 *
 * @return string|  value of truck user id
 */

public function getTruckUserId(): ?string {
	return ($this->truckUserId);
}
	/**
	 * mutator method for truck user id
	 *
	 * @param Uuid | string $newTruckId
	 * @param RangeException  if new truck id is not a positive
	 * @throw TypeError if $newTruckId is not a Uuid
	 **/
	public function setTruckUserId($newTruckId): void {
		Try {
			$uuid = self::validateUuid($newTruckId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store this truck id
		$this->truckUserId = $uuid;
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
	$newTruckAvatarUrl = filter_var($newTruckAvatarUrl, FILTER_VALIDATE_URL);
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
	return $this->truckFoodType;
}
	/**
	 * mutator method for truck food type
	 *
	 * @param string $newTruckFoodType
	 * @throws \InvalidArgumentException if the truck food type is not available
	 * @throws \RangeException if the food truck type is >128 characters
	 * @throws \TypeError if truck food type is not a string
	 */
	public
	function setTruckFoodType(string $newTruckFoodType): void {
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


/**
 * accessor method for the menu url to the truck
 *
 * @return string value of the menu url for the truck
 **/
public function getTruckMenuUrl(): string {
	return $this->truckMenuUrl;
}
	/**
	 * mutator method for truck avatar url
	 *
	 * @param string $newTruckAvatarUrl new value of at truck
	 * @throws \InvalidArgumentException if $newTruckAvatarUrl is not a string or insecure
	 * @throws \RangeException if $newTruckAvatarUrl is > 32 characters
	 * @throws \TypeError if $newTruckAvatarUrl is not a string
	 **/
	public function setTruckMenuUrl(string $newTruckMenuUrl): void {
		// verify the at int is secure
		$newTruckMenuUrl = trim($newTruckMenuUrl);
		$newTruckMenuUrl = filter_var($newTruckMenuUrl, FILTER_VALIDATE_URL);
		if(empty($newTruckMenueUrl) === true) {
			throw(new \InvalidArgumentException("Truck menu url is not available at this time"));
		}
		// verify the at handle will fit in the database
		if(strlen($newTruckMenuUrl) > 255) {
			throw(new \RangeException("Truck food menu url is too large"));

		}

// store the truck avatar url
		$this->truckMenuUrl = $newTruckMenuUrl;
	}
	/**
	 * accessor method for truckName
	 *
	 * @return string value of Name or null
	 **/
	public
	function getTruckUserName(): string {
		return ($this->truckName);
	}
	/** mutator method for truck name
	 *
	 *@param string| null $newTruckName
	 */
	public function setTruckName(?string $newTruckName): void {
		//if $truckname is null return it right away
		if(empty($newTruckName) === null) {
			$this->truckName =null;
			return;
		}
		//verify the name of the truck is secure
		$newTruckName = trim($newTruckName);
		$newTruckName = filter_var($newTruckName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newTruckName) === true) {
			throw(new \InvalidArgumentException("Truck name is empty or insecure."));
		}
		//verify the  truck name will fit in database
		if(strlen($newTruckName) > 32) {
			throw(new \RangeException( "Truck name is too large."));
		}
	//store truck name
		$this->truckName =$newTruckName;
}
	/** accessor method for truck phone number
	*
     * @return int value of the truck phone number
	*/
    public function getTruckPhoneNumber(): int {
		return ($this->truckPhoneNumber);
	}
	/** mutator method for truck phone number
	*
* @param Integer $newTruckPhoneNumber
	*/
public function setTruckPhoneNumber(Int $newTruckPhoneNumber)  {
		//verify the phone number is secure
		$newTruckPhoneNumber = filter_var($newTruckPhoneNumber, FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
		if($newTruckPhoneNumber < 0||$newTruckPhoneNumber > 10) {
			throw(new \RangeException("truck phone number is empty or insecure"));
		}

//store the phone number
		$this->truckPhoneNumber = $newTruckPhoneNumber;
	}

	/**
	 * accessor method for Verify image url
	 *
	 * @return int value of the verify image url
	 **/
	public function getTruckVerifyImage(): string {
		return ($this->truckVerifyImage);
	}

	/**
	 * mutator for truck verify image url
	 *
	 * @param string $newTruckVerifyImage new value of the avatar url for image to verify whether truck is valid or not
	 * @throws \UnexpectedValueException if $newTruckVerifyImage is not a string or insecure
	 * @throws \RangeException if $newTruckVerifyImage is >32 characters
	 * @throws \TypeError if $newTruckVerifyImage is not a string
	 */
	public function setTruckVerifyImage($newTruckVerifyImage) {
		//verify the verify image is secure
		$newTruckVerifyImage = trim($newTruckVerifyImage);
		$newTruckVerifyImage = filter_var($newTruckVerifyImage, FILTER_VALIDATE_URL);
		if($newTruckVerifyImage === false) {
			throw (new \UnexpectedValueException("verify image url is not valid or empty"));
		}
		// convert and store the verify truck image url
		$this->truckVerifyImage = $newTruckVerifyImage;
	}
	/**
	 * accessor method for verify check
	 *
	 * @return int value of verify check
	 **/
	public function getTruckVerifyChecked(): int {
		return($this->truckVerifyChecked);
	}

	/**
	 * mutator method for truck verify check
	 *
	 * @param string $newTruckVerifyChecked new value of truck verify check
	 * @throws \InvalidArgumentException if $newTruckVerifyChecked is not a tiny int
	 * @throws \RangeException if $newTruckVerifyChecked is < than 1 or two
	 * @throws \TypeError if $newTruckVerifyChecked is not an int
	 **/
	public function setTruckVerifyChecked(int $newTruckVerifyChecked)  {
		// verify check content is secure
		$newTruckVerifyChecked = filter_var($newTruckVerifyChecked, FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
		if($newTruckVerifyChecked  >1 ) {
			throw(new \RangeException("verify check content is not valid. "));
		}


		// Convert and store the truck verification content
		$this->truckVerifyChecked = $newTruckVerifyChecked;
	}




//get truck by food type
public static function getTruckByTruckFoodType(\PDO $pdo, string $truckFoodType, $trucks) : \SplFixedArray {
	// sanitize the description before searching
	$truckFoodType = filter_var($truckFoodType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty($truckFoodType) === true) {
		throw(new \PDOException("truck food type is invalid"));
	}

	// create query template
	$query = "SELECT truckId, truckActivationToken, truckAvatarUrl, truckEmail, truckFoodType, truckMenuUrl, truckVerifyImage, truckVerifiedCheck, truckName FROM truck WHERE truckFoodType LIKE :truckFoodType";
	$statement = $pdo->prepare($query);
	// bind the truck food type to the place holder in the template
	$parameters = ["truckFoodType" => $truckFoodType];
	$statement->execute($parameters);
	// build an array of trucks
	$truck = new \SplFixedArray($statement->rowCount());
	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	while(($row = $statement->fetch()) !== false) {
		try {
			$truck = new Truck($row["truckId"], $row["truckActivationToken"], $row["truckAvatarUrl"], $row["truckFoodType"], $row["truckMenuUrl"], $row["truckVerifiedCheck"], $row["truckName"], $row["truckPhoneNumber"], $row["truckVerifiedImage"]););
			$truck[$truck->key()] = $truck;
			$truck->next();
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
	}
	return($trucks);
}
public static function getTruckByTruckUserId(\PDO $pdo, string $truckUserId, $trucks) : \SplFixedArray {
	try {
		$truckUserId = self::validateUuid($truckUserId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}

	// create query template
	$query = "SELECT truckId, truckActivationToken, truckAvatarUrl, truckEmail, truckFoodType, truckMenuUrl, truckVerifyImage, truckVerifiedCheck, truckName FROM truck WHERE truckUserId LIKE :truckUserId";
	$statement = $pdo->prepare($query);
	// bind the truck food type to the place holder in the template
	$parameters = ["truckUserId" => $truckUserId];
	$statement->execute($parameters);
	// build an array of trucks
	$truck = new \SplFixedArray($statement->rowCount());
	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	while(($row = $statement->fetch()) !== false) {
		try {
			$truck = new Truck($row["truckId"], $row["truckActivationToken"], $row["truckAvatarUrl"], $row["truckFoodType"], $row["truckMenuUrl"], $row["truckVerifiedCheck"], $row["truckName"], $row["truckPhoneNumber"], $row["truckVerifiedImage"]););
			$truck[$truck->key()] = $truck;
			$truck->next();
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
	}
	return($trucks);
	}



}
