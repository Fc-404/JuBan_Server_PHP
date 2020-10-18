<?php
/**
 * mdSeedInfo templet
 * .../Juban/api/mdSeedInfo.php?seedId=###&type=###&value=###&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-mdSeedInfo');
    echo('<return>false</return>');
    return;
}

$fileUrl = '../ini/seed/'. $_GET['seedId']. '.ini';
if (file_exists($fileUrl)){
    //功能注册
    $CD = array("watering", "manure", "debug", "weeding");
    //
    if (!in_array($_GET['type'], $CD)){
        echo('<return>false</return>');
        return;
    }
    $seedInfoObj = new mdIni('ini/seed/'. $_GET['seedId']. '.ini');
    $seedInfoObj->setKeyValue($_GET['type'], $_GET['value'], 'CD');
    echo('<return>true</return>');
    return;
}
else
    echo('<return>false</return>');
    return;
?>