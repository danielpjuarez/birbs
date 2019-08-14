<?php

namespace Birbs\Peep;
require_once("autoload.php");
require_once(dirname(__DIR__, 1) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/**
 * This is the Sighting class. It will handle user-submitted bird sightings to the correct table.
 * @author Ruth E. Dove <senoritaruth@gmail.com>
 * @version 1.0
 **/

class Sighting implements \jsonSerializable {
	use ValidateUuid;
	use ValidateDate;

/**
 * id for this sighting; primary key
 * @var Uuid $sightingId
 **/
	private $sightingId;

/**
 * id for the bird species table; foreign key
 * @var Uuid $sightingSpeciesId
 **/
	private $sightingSpeciesId;

/**
 * id for the user who is submitting this sighting; foreign key
 * @var Uuid $sightingUserProfileId
 **/
	private $sightingUserProfileId;

	/**
	 * this is the photo of the bird uploaded with the bird sighting
	 * @var string $sightingBirdPhoto
	 **/
	private $sightingBirdPhoto;

	/**
	 * this is the date and time of a bird sighting
	 * @var \DateTime $sightingDateTime
	 */
	private $sightingDateTime;

	/**
 * this is the latitude for the location data of a bird sighting
 * @var float $sightingLocX
 **/
	private $sightingLocX;

/**
 * this is the longitude for the location data of a bird sighting
 * @var float $sightingLocY
 */
	private $sightingLocY;

/**
 * constructor for this sighting
 *
 * @param string|Uuid $newSightingId of this sighting or null if a new sighting
 * @param string|Uuid $newSightingSpeciesId
 * @param string|Uuid $newSightingUserProfileId of the Profile that posted this sighting
 * @param string $newSightingBirdPhoto
 * @param \DateTime|string|null $newSightingDateTime date and time sighting was sent or null if set to current date and time
 * @param float $newSightingLocX
 * @param float $newSightingLocY
 * @throws \InvalidArgumentException if data types are not valid
 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
 * @throws \TypeError if data types violate type hints
 * @throws \Exception if some other exception occurs
 * @Documentation https://php.net/manual/en/language.oop5.decon.php
 **/
	public function __construct($newSightingId, $newSightingUserProfileId, $newSightingSpeciesId, float $newSightingLocX, float $newSightingLocY, \DateTime $newSightingDateTime, string $newSightingBirdPhoto) {
		try {
			$this->setSightingId($newSightingId);
			$this->setSightingSpeciesId($newSightingSpeciesId);
			$this->setSightingUserProfileId($newSightingUserProfileId);
			$this->setSightingBirdPhoto($newSightingBirdPhoto);
			$this->setSightingDateTime($newSightingDateTime);
			$this->setSightingLocX($newSightingLocX);
			$this->setSightingLocY($newSightingLocY);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
//accessors in alphabetical order

/**
 * accessor method for sightingId
 * @return Uuid value of sighting ID (or null if new)
 **/
	public function getSightingId(): Uuid {
		return ($this->sightingId);
	}

/**
 * accessor method for the sighting species Id
 * @return Uuid sighting species Id
 **/
	public function getSightingSpeciesId(): Uuid {
		return $this->sightingSpeciesId;
	}

/** accessor method for Sighting user profile ID
 * @return Uuid value of the sighting user profile ID
 **/
	public function getSightingUserProfileId(): Uuid {
		return $this->sightingUserProfileId;
	}

/**
 * accessor for sighting birdPhoto
 *
 * @return string value of the bird photo url
 **/
	public function getSightingBirdPhoto(): string {
		return $this->sightingBirdPhoto;
	}

/**
 * accessor for sighting dateTime
 *
 * @return \DateTime value for sighting date time
 **/
	public function getSightingDateTime(): \DateTime {
		return $this->sightingDateTime;
	}

/**
 * accessor for sighting LocX
 *
 * @return float for sightingLocX
 **/
	public function getSightingLocX(): float {
		return $this->sightingLocX;
	}

	/**
	 * accessor for sighting LocY
	 *
	 * @return float for sightingLocY
	 **/
	public function getSightingLocY(): float {
		return $this->sightingLocY;
	}

//mutators in alphabetical order

/**
 * mutator method for sighting ID
 * @param Uuid $newSightingId value of sighting ID
 * @throws \RangeException if $sightingId is no positive
 * @throws \TypeError if the sighting ID is not Uuid
 **/
	public function setSightingId($newSightingId): void {
		try {
			$uuid = self::validateUuid($newSightingId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store the sighting ID
		$this->sightingId = $uuid;
	}

	/**
	 *mutator method for sighting species ID
	 *
	 * @param Uuid| string $newSightingSpeciesId
	 * @throws \RangeException if the $newSightingSpeciesId is not positive
	 * @throws \TypeError if the profile ID is not
	 **/
	public function setSightingSpeciesId(Uuid $newSightingSpeciesId): void {
		try {
			$uuid = self::validateUuid($newSightingSpeciesId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->sightingSpeciesId = $uuid;
	}

	/**
	 *mutator method for sighting user profile ID
	 *
	 * @param Uuid| string $newSightingUserProfileId
	 * @throws \RangeException if the $newSightingUserId is not positive
	 * @throws \TypeError if the profile ID is not Uuid
	 **/
	public function setSightingUserProfileId(Uuid $newSightingUserProfileId): void {
		try {
			$uuid = self::validateUuid($newSightingUserProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->sightingUserProfileId = $uuid;
	}

/**
 * mutator method for the bird photo url
 *
 * @param string $newSightingBirdPhoto new value of bird photo url
 * @throws \InvalidArgumentException if the url is not a string or is insecure
 * @throws \RangeException if the url is > 255 characters
 * @throws \TypeError if the url is not a string
 **/
	public function setSightingBirdPhoto(string $newSightingBirdPhoto): void {
		$newSightingBirdPhoto = trim($newSightingBirdPhoto);
		$newSightingBirdPhoto = filter_var($newSightingBirdPhoto, FILTER_SANITIZE_URL, FILTER_VALIDATE_URL);
		if(strlen($newSightingBirdPhoto) > 255) {
			throw(new \RangeException("image link is insecure, is not a url, or is too long"));
		}
		$this->sightingBirdPhoto = $newSightingBirdPhoto;
	}

/**
 * mutator method for sighting datetime
 *
 * @param \DateTime|string|null $newSightingDateTime Sighting as a DateTime object or string (or null to load the current time)
 * @throws \InvalidArgumentException if $newDateTime is not a valid object or string
 * @throws \RangeException if $newSightingDateTime is a date that does not exist
 * @throws \Exception find out why i would throw this exception
 *
 */
	public function setSightingDateTime(\DateTime $newSightingDateTime): void {
		if($newSightingDateTime === null) {
			$this->sightingDateTime = new \DateTime();
			return;
		}

		try {
			$newSightingDateTime = self::validateDateTime($newSightingDateTime);
		} catch(\InvalidArgumentException | \RangeException | \Exception $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->sightingDateTime = $newSightingDateTime;
	}

/**
 * mutator method for sighting LocX
 *
 * @param float $newSightingLocX
 * @throws \InvalidArgumentException if sightingLocX is not a float
 * @throws \RangeException if not to the thousandths decimal place
 * @throws \TypeError if sightingLocX is not a float
 **/
	public function setSightingLocX(float $newSightingLocX) {
		//check if it's a float
		if(empty($newSightingLocX) === true) {
			throw(new \InvalidArgumentException("Location data is empty"));
		}
		if(is_float($newSightingLocX) !== true) {
			throw(new \TypeError("location data is not valid"));
		}
		$this->sightingLocX = $newSightingLocX;
	}

/**
 * mutator method for sighting LocY
 *
 * @param float $sightingLocY
 * @throws \InvalidArgumentException if sightingLocY is not a float
 * @throws \RangeException if not to the thousandths decimal place
 * @throws \TypeError if sightingLocY is not a float
 **/
	public function setSightingLocY(float $newSightingLocY) {
		//check if it's a float
		if(empty($newSightingLocY) === true) {
			throw(new \InvalidArgumentException("Location data is empty"));
		}
		if(is_float($newSightingLocY) !== true) {
			throw(new \TypeError("location data is not valid"));
		}
		$this->sightingLocY = $newSightingLocY;
	}

/**
 * inserts this sighting into mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
	public function insert(\PDO $pdo) : void {

		// create query template
		$query = "INSERT INTO sighting(sightingId,sightingSpeciesId, sightingUserProfileId, sightingBirdPhoto, sightingDateTime, sightingLocX, sightingLocY) VALUES(:sightingId, :sightingSpeciesId, :sightingUserProfileId, :sightingBirdPhoto, :sightingDateTime, :sightingLocX, :sightingLocY)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->sightingDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["sightingId" => $this->sightingId->getBytes(), "sightingSpeciesId" => $this->sightingSpeciesId->getBytes(),"sightingUserProfileId" => $this->sightingUserProfileId->getBytes(), "sightingBirdPhoto" => $this->sightingBirdPhoto, "sightingDateTime" => $formattedDate, "sightingLocX" => $this->sightingLocX, "sightingLocY" => $this->sightingLocY];
		$statement->execute($parameters);
	}

/**
 * deletes this sighting from mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM sighting WHERE sightingId = :sightingId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["sightingId" => $this->sightingId->getBytes()];
		$statement->execute($parameters);
	}

	//gets a single sighting by sightingId
	/**
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $sighingIdto search for the sighting
	 * @return sightingBySightingI|null sighting or null if sighting is not found
	 * @throws \PDOException where there are MySQL-related errors found
	 * @throws \TypeError when a variable is not found to be the right data type
	 **/
public static function getSightingBySightingId(\PDO $pdo, $sightingId) : ?Sighting {
//sanitize the sighting before searching
try {
		$sightingId = self::validateUuid($sightingId);
	} catch (\InvalidArgumentException | \RangeException | \TypeError | \Exception $exception) {
	throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	//create the query template
	$query = "SELECT sightingId, sightingSpeciesId, sightingUserProfileId, sightingBirdPhoto, sightingDateTime, sightingLocX, sightingLocY FROM sighting WHERE sightingId = :sightingId";
	$statement =$pdo->prepare($query);
	//bind the sightingId to the template placeholder
	$parameters = ["sightingId" => $sightingId->getBytes()];
	$statement->execute($parameters);
	//grab the sighting from MySQL
	try {
		$sighting = null;
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $statement->fetch();
		if($row !== false) {
			$todo = new Sighting($row["sightingId"], $row["sightingSpeciesId"], $row["sightingUserProfileId"], $row["sightingBirdPhoto"], $row["sightingDateTime"], $row["sightingLocX"], $row["sightingLocY"]);
		}
	} catch(\Exception $exception) {
	//if the row can't be converted,rethrow it
		throw(new \PDOException($exception->getMessage(), 0, $exception));
		return($sighting);
	}
}

	// this is the jsonSerialize part of the class (check the example)
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["sightingId"] = $this->sightingId->toString();
		$fields["sightingUserProfileId"] = $this->sightingUserProfileId->toString();
		$fields["sightingSpeciesId"] = $this->sightingSpeciesId->toString();

		//format the date so that the front end can consume it
		$fields["sightingDateTime"] = round(floatval($this->sightingDateTime->format("U.u")) * 1000);
		echo get_class($fields);
		return($fields);
	}
} //class closing bracket

