<?php
/**
 * delMiss templet
 * .../Juban/api/delMiss.php?id=###&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-delMiss');
    echo('<return>false</return>');
    return;
}

$missObj = new mdIni('ini/miss.ini');
if ($_GET['id'] != null){
    $missObj->delKey($_GET['id']);
    echo('<return>true</return>');
    return;
}
echo('<return>false</return>');
?>