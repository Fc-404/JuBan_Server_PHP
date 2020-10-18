<?php
/**
 * findNeed templet
 * .../Juban/api/findNeed.php?id=###&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-findNeed');
    echo('<return>false</return>');
    return;
}

$need = new mdIni('ini/need.ini');
$needObj = $need->getKeyValue();
if (!$needObj){
    echo('<return>false</return>');
    return false;
}
if ($_GET['id'] == 'all'){
    echo('<return>true</return>');
    foreach ($needObj as $key=>$value)
        echo("<need><id>$key</id><sign>$value</sign></need>");
    return;
}
$needObj = $need->findKey($_GET['id']);
if ($needObj){
    echo('<return>true</return>');
    echo("<id>". $_GET['id'] ."</id><sign>". $needObj[$_GET['id']] ."</sign>");
}
else
    echo('<return>false</return>');
?>