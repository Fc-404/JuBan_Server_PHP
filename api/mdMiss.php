<?php
/**
 * mdMiss templet
 * .../Juban/api/mdMiss.php?id=###&myId=###&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-mdMiss');
    echo('<return>false</return>');
    return;
}

$missObj = new mdIni('ini/miss.ini');
if ($_GET['id'] != null && $_GET['myId'] != null){
    $missObj->setKeyValue($_GET['id'], $_GET['myId']);
	echo('<return>true</return>');
}
?>