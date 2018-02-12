<?php

include_once "DBquery.php";

class DBusser extends DBquery {
    public $connection;

    function __construct() {
        $this->connection = DBconnection::getConnection();
    }

    public function getConnection() { return $this->connection; }
    public function setConnection($connection) { $this->connection = $connection; }
}