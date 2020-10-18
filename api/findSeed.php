<?php
/**
 * findSeed templet
 * .../Juban/api/findSeed.php?id=###&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-findSeed');
    echo('<return>false</return>');
    return;
}

$seed = new mdIni('ini/seed.ini');
$seedObj = $seed->findKey($_GET['id']);
if ($seedObj)
    echo("<return>true</return>
    <id>". $_GET['id'] ."</id>
    <seedId>". $seedObj[$_GET['id']] ."</seedId>");
else
    echo('<return>false</return>');
?>