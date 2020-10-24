<?php
/**
 * delNeed templet
 * .../Juban/api/delNeed.php?id=###&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-delNeed');
    echo('<return>false</return>');
    return;
}

$needObj = new mdIni('ini/need.ini');
if ($_GET['id'] != null){
    $needObj->delKey($_GET['id']);
    echo('<return>true</return>');
}
?>