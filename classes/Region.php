<?php
/**
 * Region Class.
 * User: Allaire
 * Date: 12.12.2015
 */

class Region {
    private $id = null;
    private $region = null;

    public function __construct($id, $region) {
        $this->id = $id;
        $this->region = $region;
    }

    public function getID() {
        return $this->id;
    }

    public function getRegion() {
        return $this->region;
    }

    public function setRegion($region) {
        $this->region = $region;
    }

    public static function getList($numRows = 100) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("SELECT * FROM regions LIMIT :numRows");
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();

        while ($row = $st->fetch()) {
            $list[] = new Region ($row['id'], $row['region']);
        }

        return $list;
    }

    public static function count() {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("SELECT COUNT(*) FROM regions");
        $st->execute();
        $number = $st->fetchColumn();
        return $number;
    }

}

?>