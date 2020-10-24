<?php
/**
 * findMiss templet
 * .../Juban/api/findMiss.php?id=###&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-findMiss');
    echo('<return>false</return>');
    return;
}

$miss = new mdIni('ini/miss.ini');
$missObj = $miss->findKey($_GET['id']);
if ($missObj)
    echo("<return>true</return>
    <id>". $_GET['id'] ."</id>
    <missId>". $missObj[$_GET['id']] ."</missId>");
else
    echo('<return>false</return>');
?>