<?php
include_once('Event.php');
/**
 * League Class.
 * User: Allaire
 * Date: 11.12.2015
 */

class League extends Event {
    protected $signup_description = null;

    public function __construct($id, $region, $name, $url, $description, $fee, $prize, $signup, $signup_description, $picture) {
        parent::__construct($id, $region, $name, $url, $description, $fee, $prize, $signup, $picture);
        $this->signup_description = $signup_description;
    }

    public function getSignupDescription() {
        return $this->signup_description;
    }

    public function setSignupDescription($signup_description){
        $this->signup_description = $signup_description;
    }

    public function getProperties() {
        return array ('leagues', 'id');
    }

    public function getTableProperties() {
        return array(
            'region_id' => 'region',
            'lname' => 'name',
            'lurl' => 'url',
            'ldescription' =>'description',
            'lfee' => 'fee',
            'lprize' => 'prize',
            'lsignups' => 'signup',
            'lsignups_description' => 'signup_description',
            'lpicture' => 'picture'
        );
    }

    public static function count() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("SELECT COUNT(*) FROM leagues");
        $st->execute();
        $number = $st->fetchColumn();
        return $number;
    }

}

?>