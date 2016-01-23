<?php
include_once('Event.php');
/**
 * Tournament Class.
 * User: Allaire
 * Date: 11.12.2015
 */

class Tournament extends Event {
    protected $format = null;

    public function __construct($id, $region, $name, $url, $description, $format, $fee, $prize, $signup, $picture) {
        parent::__construct($id, $region, $name, $url, $description, $fee, $prize, $signup, $picture);
        $this->format = $format;
    }

    public function getFormat() {
        return $this->format;
    }

    public function setFormat($format){
        $this->format = $format;
    }

    public function getProperties() {
        return array('tournaments', 'id');
    }

    public function getTableProperties() {
        return array(
            'region_id' => 'region',
            'tname' => 'name',
            'turl' => 'url',
            'tdescription' => 'description',
            'tformat' => 'format',
            'tprize' => 'prize',
            'tfee' => 'fee',
            'tsignups' => 'signup',
            'tpicture' => 'picture'
        );
    }

    public static function count() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("SELECT COUNT(*) FROM tournaments");
        $st->execute();
        $number = $st->fetchColumn();
        return $number;
    }

}