<?php

/**
 * Class to handle events
 */

abstract class Event {

  // Properties

  protected $id = null;
  protected $region = null;
  protected $name = null;
  protected $url = null;
  protected $description = null;
  protected $fee = null;
  protected $prize = null;
  protected $signup = null;
  protected $picture = null;
  public static $allowedTables = array('regions', 'tournaments', 'leagues', 'submissions');

  // Constructor

  public function __construct ($id, $region, $name, $url, $description, $fee, $prize, $signup, $picture) {
    $this->id = $id;
    $this->region = $region;
    $this->name = $name;
    $this->url = $url;
    $this->description = $description;
    $this->fee = $fee;
    $this->prize = $prize;
    $this->signup = $signup;
    $this->picture = $picture;
  }

  public function getID() {
    return $this->id;
  }

  public function setID($id) {
    $this->id = $id;
  }

  public function getRegion() {
    return $this->region;
  }

  public function setRegion($region) {
    $this->region = $region;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getUrl() {
    return $this->url;
  }

  public function setUrl($url) {
    $this->url = $url;
  }

  public function getDescription() {
    return $this->description;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function getFee() {
    return $this->fee;
  }

  public function setFee($fee) {
    $this->fee = $fee;
  }

  public function getPrize() {
    return $this->prize;
  }

  public function setPrize($prize) {
    $this->prize = $prize;
  }

  public function getSignup() {
    return $this->signup;
  }

  public function setSignup($signup) {
    $this->signup = $signup;
  }

  public function getPicture() {
    return $this->picture;
  }

  public function setPicture($picture) {
    $this->picture = $picture;
  }

  /**
   * Returns a single Event object from the database, chosen by ID
   * @param $id int ID of the Event object
   * @param $type String Region of the Event object
   * @return League|Tournament Event object (either League or Tournament)
   */
  public static function getByID($id, $type) {
    if (in_array($type, self::$allowedTables)) {
      $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
      $st = $conn->prepare("SELECT * FROM $type WHERE id = :id");
      $st->bindValue(":id", $id, PDO::PARAM_INT);
      $st->execute();
      $row = $st->fetch();

      switch ($type) {
        case 'tournaments':
          return new Tournament ($row['id'], $row['region_id'], $row['tname'], $row['turl'], $row['tdescription'],
              $row['tformat'], $row['tfee'], $row['tprize'], $row['tsignups'], $row['tpicture']);
          break;
        case 'leagues':
          return new League ($row['id'], $row['region_id'], $row['lname'], $row['lurl'], $row['ldescription'],
              $row['lfee'], $row['lprize'], $row['lsignups'], $row['lsignups_description'], $row['lpicture']);
          break;
        case 'submissions':
          return new Submission($row['id'], $row['ttype'], $row['region_id'], $row['tname'], $row['turl'], $row['tdescription'],
              $row['tformat'], $row['tfee'], $row['tprize'], $row['tsignups'], $row['lsignups_description'], $row['tpicture']);
      }
    }
}

  /**
   * Returns a list of Event objects from the database
   * @param int $numRows Number of objects to be retrieved
   * @param $type String Type of Event object
   * @param $region int Region of Event object
   * @return array Array with all retrieved Event objects
   */
  public static function getList($numRows=100, $type, $region) {
    if (in_array($type, self::$allowedTables)) {
      $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
      $st = $conn->prepare("SELECT * FROM $type WHERE region_id = :region LIMIT :numRows");
      $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
      $st->bindValue(":region", $region, PDO::PARAM_INT);
      $st->execute();
      $list = array();

      switch ($type) {
        case 'tournaments':
          while ($row = $st->fetch()) {
            $list[] = new Tournament ($row['id'], $row['region_id'], $row['tname'], $row['turl'], $row['tdescription'],
                $row['tformat'], $row['tfee'], $row['tprize'], $row['tsignups'], $row['tpicture']);
          }
          break;
        case 'leagues':
          while ($row = $st->fetch()) {
            $list[] = new League ($row['id'], $row['region_id'], $row['lname'], $row['lurl'], $row['ldescription'],
                $row['lfee'], $row['lprize'], $row['lsignups'], $row['lsignups_description'], $row['lpicture']);
          }
      }

      return $list;
    }
  }

  public static function getSubmissions() {
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $st = $conn->prepare("SELECT * FROM submissions");
    $st->execute();
    $list = array();

      while ($row = $st->fetch()) {
        $list[] = new Submission($row['id'], $row['ttype'], $row['region_id'], $row['tname'], $row['turl'], $row['tdescription'],
                  $row['tformat'], $row['tfee'], $row['tprize'], $row['tsignups'], $row['lsignups_description'], $row['tpicture']);
      }

      return $list;
  }

  /**
   * Updates an Event object in the database
   */
  public function update() {
    // Check if Object has ID
    if ( is_null($this->id) ) trigger_error("Event::update(): Attempt to update an Event that does not have its ID set.", E_USER_ERROR);

    // Update Object in Database
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $properties = $this->getProperties();
    $table = $this->getTableProperties();

    $sql = "UPDATE $properties[0] SET ";
    foreach ($table as $item => $value) {
      $sql .= "$item=:$value, ";
    }
    $sql = rtrim($sql, ', ');
    $sql .= " WHERE id=:id";

    $st = $conn->prepare($sql);
    foreach ($table as $item => $value) {
      $st->bindValue("$value", $this->$value);
    }
    $st->bindValue(":id", $this->id, PDO::PARAM_INT);
    $st->execute();
    $conn = null;
  }

  /**
   * Deletes an Event object from the database
   */
  public function delete() {
    // Check if Object has ID
    if ( is_null($this->id) ) trigger_error("Event::delete(): Attempt to delete an Event that does not have its ID set.", E_USER_ERROR);

    // Delete Object from Database
    $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    $properties = $this->getProperties();
    $st = $conn->prepare("DELETE FROM $properties[0] WHERE id = :id LIMIT 1");
    $st->bindValue(":id", $this->id, PDO::PARAM_INT);
    $st->execute();
    $conn = null;
  }

  /**
   * Inserts an Event object into the database
   */
  public function insert() {
    // Does the Object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Event::insert(): Attempt to insert an Event object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert the Tournament
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $properties = $this->getProperties();
    $table = $this->getTableProperties();

    // Generate the SQL-String
    $sql = "INSERT INTO $properties[0] (";
    foreach ($table as $item => $value){
      $sql .= "$item, ";
    }
    $sql = rtrim($sql, ', ');
    $sql .= ") VALUES (";
    foreach ($table as $item => $value) {
      $sql .= ":$value, ";
    }
    $sql = rtrim($sql, ', ');
    $sql .= ")";

    $st = $conn->prepare($sql);
    foreach ($table as $item => $value) {
      $st->bindValue("$value", $this->$value);
    }
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }

  public abstract function getProperties();
  public abstract function getTableProperties();

}