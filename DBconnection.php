<?php

define("_DBTYPE", "mysql");
define("_HOST", "localhost");
define("_DB", "proveedores2");
define("_USSER", "root");
define("_PASS", "root");


class DBconnection {

    private static $_instance;

    protected function getConnection() {
        if (!self::$_instance) {
                $controlador = new mysqli_driver();
                $controlador->report_mode = MYSQLI_REPORT_ALL;
            try {
                self::$_instance = new mysqli(_HOST, _USSER, _PASS, _DB);
                return self::$_instance;
            } catch (mysqli_sql_exception $_exception) {
                return new DBerror('Se ha producido un error en la conexion', $_exception->getCode(), $_exception->getMessage());
            }
        }
    }


    public function disconnect(){ $this->_connection->close(); }
}