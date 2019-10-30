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
		 * @var string $trucksUserId
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
}