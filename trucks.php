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
		 *@var $truckPhoneNumber
		 */
		private $truckPhoneNumber;
	/**
	 * constructor for this truck
	 *
	 * @param string|Uuid $newTruckId id of this user if a new user
	 * @param string $newTruckUserId activation token to sage guard against malicious accounts
	 * @param string $newTuckAvatarUrl string containing truck url
	 * @param string $newTruckEmail string containing email
	 * @param string $newTruckFoodType string containing food type of truck
	 * @param string $newTuckMenuUrl string containing Url for truck menu
	 * @param string $newTruckName string containing truckName
	 */
	public function __construct($newTruckId, $newTruckUserId, $newTruckAvatarUrl, $newTruckEmail, $newTruckFoodType, $newTruckMenuUrl, $newTruckName, $newTruckPhoneNumber) {
		try {: {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
}