<?php
include_once('Event.php');

/**
 * User submitted event class
 * User: Allaire
 * Date: 21.01.2016
 */
class Submission extends Event {
    protected $type = null;
    protected $format = null;
    protected $signup_description = null;

    public function __construct($id, $type, $region, $name, $url, $description, $format, $fee, $prize, $signup,
                                $signup_description, $picture) {
        parent::__construct($id, $region, $name, $url, $description, $fee, $prize, $signup, $picture);
        $this->type = $type;
        $this->format = $format;
        $this->signup_description = $signup_description;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getFormat() {
        return $this->format;
    }

    public function setFormat($format){
        $this->format = $format;
    }

    public function getSignupDescription() {
        return $this->signup_description;
    }

    public function setSignupDescription($signup_description) {
        $this->signup_description = $signup_description;
    }

    public function getProperties() {
        return array('submissions', 'id');
    }

    public function getTableProperties() {
        return array(
            'ttype' => 'type',
            'region_id' => 'region',
            'tname' => 'name',
            'turl' => 'url',
            'tdescription' => 'description',
            'tformat' => 'format',
            'tprize' => 'prize',
            'tfee' => 'fee',
            'tsignups' => 'signup',
            'lsignups_description' => 'signup_description',
            'tpicture' => 'picture'
        );
    }

    public static function count() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("SELECT COUNT(*) FROM submissions");
        $st->execute();
        $number = $st->fetchColumn();
        return $number;
    }

}
