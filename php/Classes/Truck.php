<?php
namespace Groundbeefin\FoodTruckFoodie;
require_once ("autoload.php");

use Ramsey\Uuid\Uuid;
/**
 * This class is the truck user
 * @package Groundbeefin\FoodTruckFoodie
 * @author Ian W Foster <ian.foster95@yahoo.com>
 * @version 001.1
 */
class Truck  implements \JsonSerializable {
	use ValidateUuid;
	/**
	 * This is the id for this profile; this is the primary key
	 * @var Uuid $truckId
	 */
	private $truckId;
	/**
	 * This is the trucks user id; this is a foreign key
	 * @var Uuid $truckUserId
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
	 * This is the truck food type
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
	 * @var $truckVerifiedCheck
	 * */
	private $truckVerifiedCheck;

	/**
	 * constructor for this truck
	 *
	 * @param Uuid | string $newTruckId id of this user if a new user
	 * @param Uuid | string $newTruckUserId  of the truck
	 * @param string $newTruckAvatarUrl string containing truck url to add to trucks Avatar
	 * @param string $newTruckEmail string containing email
	 * @param string $newTruckFoodType string containing food type of the truck
	 * @param string $newTruckMenuUrl string containing Url for truck menu
	 * @param string $newTruckName string containing the actual name of the truck
	 * @param string $newTruckPhoneNumber containing the phone number to contact the truck
	 * @param string $newTruckVerifyImage containing the verify image to see if this is a real food truck
	 * @param string $newTruckVerifiedCheck containing the data that the truck has been checked and verified as a real food truck.
	 * */


	public function __construct($newTruckId, $newTruckUserId, $newTruckAvatarUrl, $newTruckEmail, $newTruckFoodType, $newTruckMenuUrl, $newTruckName, $newTruckPhoneNumber, $newTruckVerifyImage, ?bool $newTruckVerifiedCheck) {
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
			$this->setTruckVerifiedCheck($newTruckVerifiedCheck);
		} catch(\InvalidArgumentException | \RangeException | \Exception|  \TypeError $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
 	* *accessor method for truck id
 	*
 	* @retun Uuid value of truck id (or null if ne Truck)
 	*/
	public function getTruckId(): Uuid {
		return ($this->truckId);
}
/**
 * mutator method for truck id
 *
 * @param String | Uuid | string $newTruckId
 * @param \RangeException  if new truck id is not a Uuid
 * @throw \TypeError if $newTruckId is not a Uuid
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
 * @return  string| Uuid value of truck user id
 */

	public function getTruckUserId(): Uuid {
		return ($this->truckUserId);
}
	/**
	 * mutator method for truck user id
	 *
	 * @param String | Uuid $newTruckUserId
	 * @param \RangeException  if new truck user id is not a Uuid
	 * @throw \TypeError if $newTruckUserId is not a Uuid
	 **/


	public function setTruckUserId($newTruckUserId): void {
		Try {
			$uuid = self::validateUuid($newTruckUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store this truck user id
		$this->truckUserId = $uuid;
	}


	/**
	 * accessor method for email for the truck
	 *
	 * @return string for avatar url  for the truck
	 **/
	public function getTruckAvatarUrl(): string {
		return ($this->truckAvatarUrl);
	}

/**
 * mutator method for truck avatar url
 *
 * @param string $newTruckAvatarUrl new truck
 * @throws \InvalidArgumentException if new truck avatar url is not a string
 * @throws \RangeException if new truck avatar url is > 255 characters
 * @throws \\TypeError if new truck avatar url is not a string
 **/


	public function setTruckAvatarUrl(string $newTruckAvatarUrl): void {
		// verify the at int is secure
			$newTruckAvatarUrl = trim($newTruckAvatarUrl);
			$newTruckAvatarUrl = filter_var($newTruckAvatarUrl, FILTER_VALIDATE_URL);
		if(empty($newTruckAvatarUrl) === true) {
			throw(new \InvalidArgumentException("Truck at avatar is empty"));
	}
	// verify the at avatar will fit in the database
		if(strlen($newTruckAvatarUrl) > 255) {
			throw(new \RangeException("Truck Url is too long"));
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
 * @throws \InvalidArgumentException if $newTruckEmail is not a valid email or insecure
 * @throws \RangeException if $newTruckEmail is > 128 characters
 * @throws \\TypeError if $newTruckEmail is not a string
 **/


	public function setTruckEmail(string $newTruckEmail): void {
		//verify email is secure
		$newTruckEmail = trim($newTruckEmail);
		$newTruckEmail = filter_var($newTruckEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newTruckEmail) === true) {
			throw (new \InvalidArgumentException("Truck email is empty or insecure"));
	}
	//store trucks email
		$this->truckEmail = $newTruckEmail;
}
/**
 * accessor method for the truck food type
 *
 * @return string value of food type
 * */

	public function getTruckFoodType(): string {
		return $this->truckFoodType;
}
	/**
	 * mutator method for the truck food type
	 *
	 * @param string $newTruckFoodType
	 * @throws \InvalidArgumentException if the truck food type is not available
	 * @throws \RangeException if the food truck type is >128 characters
	 * @throws \\TypeError if truck food type is not a string
	 */


	public function setTruckFoodType($newTruckFoodType): void {
		//determines what food type are available for the trucks
			$newTruckFoodType = trim($newTruckFoodType);
			$newTruckFoodType = filter_var($newTruckFoodType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($newTruckFoodType) === true) {
			throw (new \InvalidArgumentException("Truck food type is not defined"));
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
	 * @param string $newTruckMenuUrl new menu of at truck
	 * @throws \InvalidArgumentException if $newTruckMenuUrl is not a string or insecure
	 * @throws \RangeException if $newTruckAvatarUrl is > 255 characters
	 * @throws \\TypeError if $newTruckAvatarUrl is not a string
	 **/


	public function setTruckMenuUrl( $newTruckMenuUrl): void {
		// verify the at int is secure
			$newTruckMenuUrl = trim($newTruckMenuUrl);
			$newTruckMenuUrl = filter_var($newTruckMenuUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newTruckMenuUrl) === true) {
			throw(new \InvalidArgumentException("Truck menu url is not available at this time"));
		}
		// verify the truck menu will fit in the database
		if(strlen($newTruckMenuUrl) > 255) {
			throw(new \RangeException("Truck food menu url is too large"));

		}

// store the truck avatar url
		$this->truckMenuUrl = $newTruckMenuUrl;
	}
	/**
	 * accessor method for the name of the truck
	 *
	 * @return string value of Name or null
	 **/
	public function getTruckName(): string {
		return ($this->truckName);
	}
	/** mutator method for the name of the truck
	 * @throws \InvalidArgumentException when truck name is empty
	 * @throws \RangeException if the truck name is too long
	 * @param string| null or new truck name
	 */


	public function setTruckName(?string $newTruckName): void {
		//if $truck name is null return it right away
		if(empty($newTruckName) === null) {
			$this->truckName =null;
			return;
		}
		//verify the name of the truck is secure
		$newTruckName = trim($newTruckName);
		$newTruckName = filter_var($newTruckName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newTruckName) === true) {
			throw(new \InvalidArgumentException("Truck name is empty "));
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
     * @return string value of the truck phone number
	*/
    public function getTruckPhoneNumber(): string {
		return ($this->truckPhoneNumber);
	}
	/** mutator method for truck phone number
	*
	 * @param string the new truck phone number
	 * @throws \InvalidArgumentException if truck name is not there
	 * @throws \RangeException if truck phone number is empty
	*/


	public function setTruckPhoneNumber( $newTruckPhoneNumber) :void  {
		//verify the phone number is secure
		$newTruckPhoneNumber = trim($newTruckPhoneNumber);
		$newTruckPhoneNumber = filter_var($newTruckPhoneNumber, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newTruckPhoneNumber) === true){
			throw(new \InvalidArgumentException("truck phone number is empty"));
		}
		if(strlen($newTruckPhoneNumber)  > 32) {
			throw(new \RangeException("truck phone number too long "));
		}

//store the phone number
		$this->truckPhoneNumber = $newTruckPhoneNumber;
	}

	/**
	 * accessor method for Verify image url
	 *
	 * @return string of the verify image url
	 **/
	public function getTruckVerifyImage(): string {
		return ($this->truckVerifyImage);
	}

	/**
	 * mutator for truck verify image url
	 *
	 * @param string $newTruckVerifyImage new  url for image to verify whether truck is valid or not valid
	 * @throws \UnexpectedValueException if new truck verify image is not valid or if is empty.
	 * @throws \RangeException if new truck verify image is >225 characters
	 */


	public function setTruckVerifyImage($newTruckVerifyImage) {
		//verify the verify image is secure
		$newTruckVerifyImage = trim($newTruckVerifyImage);
		$newTruckVerifyImage = filter_var($newTruckVerifyImage, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if($newTruckVerifyImage === false) {
			throw (new \UnexpectedValueException("The image url is not valid or empty"));
		}
		if(strlen($newTruckVerifyImage) > 255) {
			throw(new \RangeException("Truck food menu url is too large"));

		}
		// convert and store the verify truck image url
		$this->truckVerifyImage = $newTruckVerifyImage;
	}
	/**
	 * accessor method for verify check
	 *
	 * @return boolean value of verify check
	 **/
	public function getTruckVerifiedCheck(): bool {
		return($this->truckVerifiedCheck);
	}


	/**
	 * mutator method for truck verify check
	 *
	 * @param boolean $newTruckVerifiedCheck new value of truck verify check
	 * @throws \InvalidArgumentException if $newTruckVerifiedCheck is false
	 **/
	public function setTruckVerifiedCheck(?bool $newTruckVerifiedCheck) {
		// verify check content is secure
		$newTruckVerifiedCheck = filter_var($newTruckVerifiedCheck, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
		if($newTruckVerifiedCheck === null ) {
			$this->truckVerifiedCheck = false;
			return;
		}
		$this->truckVerifiedCheck = $newTruckVerifiedCheck;
	}


	/**
	 * inserts this truck into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \\TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// create query template
		$query = "INSERT INTO truck(truckId, truckUserId, truckAvatarUrl, truckEmail, truckFoodType, truckMenuUrl, truckName, truckPhoneNumber, truckVerifyImage, truckVerifiedCheck) VALUES(:truckId, :truckUserId, :truckAvatarUrl, :truckEmail, :truckFoodType, :truckMenuUrl, :truckName, :truckPhoneNumber, :truckVerifyImage, :truckVerifiedCheck)";
		$statement = $pdo->prepare($query);

		//bind the truck variables to placeholder template
		$parameters = ["truckId" => $this->truckId->getBytes(), "truckUserId" => $this->truckUserId->getBytes(), "truckAvatarUrl" => $this->truckAvatarUrl, "truckEmail" => $this->truckEmail, "truckFoodType" => $this->truckFoodType, "truckMenuUrl"=> $this->truckMenuUrl, "truckName" => $this->truckName, "truckPhoneNumber" => $this->truckPhoneNumber, "truckVerifyImage" => $this->truckVerifyImage, "truckVerifiedCheck" => $this->truckVerifiedCheck];
		$statement->execute($parameters);


	}

	/**
	 * updates this truck in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \\TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE truck SET truckUserId = :truckUserId, truckAvatarUrl = :truckAvatarUrl, truckEmail= :truckEmail, truckFoodType= :truckFoodType, truckMenuUrl= :truckMenuUrl, truckName= :truckName, truckPhoneNumber= :truckPhoneNumber, truckVerifyImage= :truckVerifyImage, truckVerifiedCheck= :truckVerifiedCheck WHERE truckId = :truckId";
		$statement = $pdo->prepare($query);
		$parameters = ["truckId" => $this->truckId->getBytes(), "truckUserId" => $this->truckUserId->getBytes(), "truckAvatarUrl" => $this->truckAvatarUrl, "truckEmail" => $this->truckEmail, "truckFoodType" => $this->truckFoodType, "truckMenuUrl"=> $this->truckMenuUrl, "truckName" => $this->truckName, "truckPhoneNumber" => $this->truckPhoneNumber, "truckVerifyImage" => $this->truckVerifyImage, "truckVerifiedCheck" => $this->truckVerifiedCheck];
		$statement->execute($parameters);

	}

	/**
	 * deletes this truck from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM truck WHERE truckId = :truckId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["truckId" => $this->truckId->getBytes()];
		$statement->execute($parameters);
	}
	/**
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid $truckId
	 * @return truck
	 */
	//get truck by truck id
	public static function getTruckByTruckId(\PDO $pdo, $truckId) : ?Truck {
		try {
			$truckId = self::validateUuid($truckId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT truckId, truckUserId, truckAvatarUrl, truckEmail, truckFoodType, truckMenuUrl, truckName, truckPhoneNumber, truckVerifyImage, truckVerifiedCheck FROM truck WHERE truckId = :truckId";
		$statement = $pdo->prepare($query);
		// bind the truck id to the place holder in the template
		$parameters = ["truckId" => $truckId->getBytes()];
		$statement->execute($parameters);

			try {
				$truck = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $statement->fetch();
				if($row !== false) {
					$truck = new Truck($row["truckId"], $row["truckUserId"], $row["truckAvatarUrl"], $row["truckEmail"], $row["truckFoodType"], $row["truckMenuUrl"], $row["truckName"], $row["truckPhoneNumber"], $row["truckVerifyImage"], $row["truckVerifiedCheck"]);
				}
			}catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}

		return($truck);
	}


//get truck by food type
	public static function getTruckByTruckFoodType(\PDO $pdo, string $truckFoodType) : \SplFixedArray {
		// sanitize the description before searching
		$truckFoodType = filter_var($truckFoodType, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($truckFoodType) === true) {
			throw(new \PDOException("truck food type is invalid"));
		}

		// create query template
		$query = "SELECT truckId, truckUserId, truckAvatarUrl, truckEmail, truckFoodType, truckMenuUrl, truckName, truckPhoneNumber, truckVerifyImage, truckVerifiedCheck FROM truck WHERE truckFoodType LIKE :truckFoodType";
		$statement = $pdo->prepare($query);
		// bind the truck food type to the place holder in the template
		$parameters = ["truckFoodType" => $truckFoodType];
		$statement->execute($parameters);
		// build an array of trucks
		$trucks = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$truck = new Truck($row["truckId"], $row["truckUserId"], $row["truckAvatarUrl"], $row["truckEmail"], $row["truckFoodType"], $row["truckMenuUrl"], $row["truckName"], $row["truckPhoneNumber"], $row["truckVerifyImage"], $row["truckVerifiedCheck"]);
				$trucks[$trucks->key()] = $truck;
				$trucks->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($trucks);
	}
//get truck by truck user id
	public static function getTruckByTruckUserId(\PDO $pdo, string $truckUserId) : \SplFixedArray {
		try {
			$truckUserId = self::validateUuid($truckUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT truckId, truckUserId, truckAvatarUrl, truckEmail, truckFoodType, truckMenuUrl, truckName, truckPhoneNumber, truckVerifyImage, truckVerifiedCheck FROM truck WHERE truckUserId = :truckUserId";
		$statement = $pdo->prepare($query);
		// bind the truck food type to the place holder in the template
		$parameters = ["truckUserId" => $truckUserId->getBytes()];
		$statement->execute($parameters);
		// build an array of trucks
		$trucks = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$truck = new Truck($row["truckId"], $row["truckUserId"], $row["truckAvatarUrl"], $row["truckEmail"], $row["truckFoodType"], $row["truckMenuUrl"], $row["truckName"], $row["truckPhoneNumber"],  $row["truckVerifyImage"], $row["truckVerifiedCheck"]);
				$trucks[$trucks->key()] = $truck;
				$trucks->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($trucks);
	}


	//get truck by truck name method
	/**
	 * gets the Truck by Truck name
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string
	 * @return truck|null user or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getTruckByTruckName(\PDO $pdo, string $truckName) : \SplFixedArray {
		// sanitize the description before searching
		$truckName = trim($truckName);
		$truckName = filter_var($truckName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($truckName) === true) {
			throw(new \PDOException("truck name is invalid"));
		}

		//escape any mySql wild cards
		$truckName = str_replace("_", "\\_", str_replace("%", "\\%", $truckName));

		// create query template
		$query = "SELECT truckId, truckUserId, truckAvatarUrl, truckEmail, truckFoodType, truckMenuUrl, truckName, truckPhoneNumber, truckVerifyImage, truckVerifiedCheck FROM truck WHERE truckName LIKE :truckName";
		$statement = $pdo->prepare($query);

		// bind the truck food type to the place holder in the template
		$truckName = "%$truckName%";
		$parameters = ["truckName" => $truckName];
		$statement->execute($parameters);

		// build an array of trucks
		$trucks = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$truck = new Truck($row["truckId"], $row["truckUserId"], $row["truckAvatarUrl"], $row["truckEmail"], $row["truckFoodType"], $row["truckMenuUrl"], $row["truckName"], $row["truckPhoneNumber"],  $row["truckVerifyImage"], $row["truckVerifiedCheck"]);
				$trucks[$trucks->key()] = $truck;
				$trucks->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($trucks);
	}


	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function JsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["truckId"] = $this->truckId->toString();
		$fields["truckUserId"] = $this->truckUserId->toString();

		return($fields);

	}

}