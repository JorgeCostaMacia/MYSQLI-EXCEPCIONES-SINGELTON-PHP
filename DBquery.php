<?php

include_once "DBconnection.php";

class DBquery extends DBconnection {

    public function createDB($name){
        $result = [];
        $result["succes"] = true;

        try {
            $result['result'] = $this->connection->prepare('CREATE DATABASE ' . $name . ";");
            $result['result']->execute();
            $result['result'] = $this->connection->affected_rows;
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = false;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Crear base de datos', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function dropDB($dropDatabase){
        $result = [];
        $result["succes"] = true;

        try {
            $result['result'] = $this->connection->prepare('DROP DATABASE '. $dropDatabase . ";");
            $result['result']->execute();
            $result['result'] = $this->connection->affected_rows;
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = false;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Borrar base de datos', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function createTable($name, $values = ""){
        $result = [];
        $result["succes"] = true;

        try {
            $result['result'] = $this->connection->prepare('CREATE TABLE ' . $name . ' ' . $values . ";");
            $result['result']->execute();
            $result['result'] = $this->connection->affected_rows;
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = true;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Crear tabla', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function dropTable($dropTable){
        $result = [];
        $result["succes"] = true;

        try {
            $result['result'] = $this->connection->prepare('DROP TABLE '. $dropTable . ";");
            $result['result']->execute();
            $result['result'] = $this->connection->affected_rows;
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = false;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Borrar tabla', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function truncateTable($truncateTable){
        $result = [];
        $result["succes"] = true;

        try {
            $result['result'] = $this->connection->prepare('TRUNCATE TABLE '. $truncateTable . ";");
            $result['result']->execute();
            $result['result'] = $this->connection->affected_rows;
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = false;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Truncar tabla', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function setFK($setFOREIGN_KEY_CHECKS = "1"){
        $result = [];
        $result["succes"] = true;

        try {
            $result['result'] = $this->connection->prepare('SET FOREIGN_KEY_CHECKS= '. $setFOREIGN_KEY_CHECKS . ";");
            $result['result']->execute();
            $result['result'] = $result['result']->get_result();
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = false;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Cambiar FK', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function setAutocommit($autocommit = "true"){
        $result = [];
        $result["succes"] = true;

        try {
            $this->connection->autocommit($autocommit);
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = false;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Cambiar autocommit', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function setSAFE_UPDATES($SQL_SAFE_UPDATES = "1"){
        $result = [];
        $result["succes"] = true;

        try {
            $result['result'] = $this->connection->prepare('SET SQL_SAFE_UPDATES= '. $SQL_SAFE_UPDATES . ";");
            $result['result']->execute();
            $result['result'] = $result['result']->get_result();
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = false;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Cambiar FK', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function select($select, $from, $more = ""){
        $result = [];
        $result["succes"] = true;

        try {
            $result['result'] = $this->connection->prepare('SELECT '. $select . ' FROM ' . $from . " " . $more . ";");
            $result['result']->execute();
            $result['result'] = $result['result']->get_result();
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = false;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Select', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function format_select_Object($result, $className){
        $formatResult = [];

        while ($obj = $result->fetch_object($className)) {
            $formatResult[] = $obj;
        }

        return $formatResult;
    }

    public function format_select_Assoc($result){
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($insertInto, $values) {
        $result = [];
        $result["succes"] = true;

        try {
            $result['result'] = $this->connection->prepare('INSERT INTO ' . $insertInto . ' VALUES ' . $values . ';');
            $result['result']->execute();
            $result['result'] = $this->connection->affected_rows;
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = false;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Insert', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function insertSelect($insertInto, $select, $from, $more = "") {
        $result = [];
        $result["succes"] = true;

        try {
            $result['result'] = $this->connection->prepare('INSERT INTO ' . $insertInto . ' SELECT ' . $select . ' FROM ' . $from . ' ' .$more . ';');
            $result['result']->execute();
            $result['result'] = $this->connection->affected_rows;
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = false;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Insert', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function update($update, $set, $more = ""){
        $result = [];
        $result["succes"] = true;

        try {
            $result['result'] = $this->connection->prepare('UPDATE ' . $update . ' SET ' . $set . " " . $more . ';');
            $result['result']->execute();
            $result['result'] = $this->connection->affected_rows;
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = false;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Update', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function delete($deleteFrom, $where){
        $result = [];
        $result["succes"] = true;

        try {
            $result['result'] = $this->connection->prepare('DELETE FROM ' . $deleteFrom . ' WHERE ' . $where . ';');
            $result['result']->execute();
            $result['result'] = $this->connection->affected_rows;
        }
        catch (mysqli_sql_exception $_exception) {
            $result["succes"] = false;
            $result["error"] = new DBerror('No se ha podido realizar la accion: Delete', $_exception->getCode(), $_exception->getMessage());
        }

        return $result;
    }

    public function _prepareLogin($loginEmail, $loginPassword = ""){
        $arrayResut = [];
        if( $loginPassword != ""){
            $_ressult = $this->_connection->prepare('SELECT * FROM usuarios WHERE nomUsser = ? AND passUsser = ?');
            $ok = $_ressult->bind_param('ss',$loginEmail, $loginPassword);
            $ok = $_ressult->execute();
        }
        else {
            $_ressult = $this->_connection->prepare('SELECT * FROM usuarios WHERE nomUsser = ?');
            $ok = $_ressult->bind_param('s',$loginEmail);
            $ok = $_ressult->execute();
        }
        if ($ok != FALSE) {
            $nomUsser = "";
            $passUsser = "";
            $ok = $_ressult->bind_result($nomUsser, $passUsser);

            while ($_ressult->fetch()) {
                $arrayResut["nomUsser"] = $nomUsser;
            }

            $_ressult->close();

            return $arrayResut;
        }
    }

    public function _prepareGetAccount($loginEmail, $loginPassword){
        $_ressult = $this->_connection->prepare('INSERT INTO usuarios  VALUES (?,?)');
        $ok = $_ressult->bind_param('ss',$loginEmail, $loginPassword);
        $ok = $_ressult->execute();
        $_ressult->close();
    }

    public function transaction($querys){
        $result = [];
        $result["succes"] = true;

        $this->connection->autocommit(false);

        foreach($querys as $key=>$query) {
            $result[$key] = [];
            $result[$key]["query"] = $query;

            try {
                $result[$key]['result'] = $this->connection->prepare($query);
                $result[$key]['result']->execute();
                $result[$key]['result'] = $result[$key]['result']->get_result();
                $result[$key]['affected_rows'] = $this->connection->affected_rows;
                $result[$key]['succes'] = true;
            }
            catch (mysqli_sql_exception $_exception) {
                $result["succes"] = false;
                $result[$key]['succes'] = false;
                $result["error"] = new DBerror('No se ha podido realizar la accion: Transaccion', $_exception->getCode(), $_exception->getMessage());
            }
        }

        if(!$result["succes"]){ $this->connection->rollback(); }
        else { $this->connection->commit(); }

        return $result;
    }
}