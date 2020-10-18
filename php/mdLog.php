<?php
include_once("mdIni.php");
class mdLog{
    private $maxLength = 1024;
    private $logObj;

    public function __construct($logUrl = "ini/logs.ini"){
        $this->logObj = new mdIni($logUrl);
    }

    public function addLog($id, $something){
        $str = '"' . date("Y-m-d-H-i-s", time()) . '###' . $_SERVER['REMOTE_ADDR'] . '###' . $something . '"';
        $this->logObj->addKeyValue($id, $str);
    }
}
?>