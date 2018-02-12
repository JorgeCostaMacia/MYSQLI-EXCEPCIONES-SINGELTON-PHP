<?php

class DBerror {

    public $errmessage;
    public $errcodeexception;
    public $errmessageexception;

    public function __construct($errmessage, $errcodeexception = "", $errmessageexception = "") {
        $this->errmessage = $errmessage;
        $this->errcodeexception = $errcodeexception;
        $this->errmessageexception = $errmessageexception;
    }

    public function getErrmessage() { return $this->errmessage; }
    public function setErrmessage($errmessage) { $this->errmessage = $errmessage; }

    public function getErrcodeexception() { return $this->errcodeexception; }
    public function setErrcodeexception($errcodeexception) { $this->errcodeexception = $errcodeexception; }

    public function getErrmessageexception() { return $this->errmessageexception; }
    public function setErrmessageexception($errmessageexception) { $this->errmessageexception = $errmessageexception; }
}
