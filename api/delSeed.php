<?php
/**
 * delSeed templet
 * .../Juban/api/delSeed.php?id=###&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-delSeed');
    echo('<return>false</return>');
    return;
}

$seedObj = new mdIni('ini/seed.ini');
if ($_GET['id'] != null){
    $seedObj->delKey($_GET['id']);
    echo('<return>true</return>');
}
?>