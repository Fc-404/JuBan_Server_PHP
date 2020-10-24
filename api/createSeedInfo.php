<?php
/**
 * createSeedInfo templet
 * .../Juban/api/createSeedInfo.php?seedId=###&A=###&B=###&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-createSeedInfo');
    echo('<return>false</return>');
    return;
}

$seedObj = new mdIni('ini/seed.ini');
if ($seedObj->findKey($_GET['A']) == false ||
    $seedObj->findKey($_GET['B']) == false){
    echo('<return>false</return>');
    return;
}
if ($seedObj->findKey($_GET['A'])[$_GET['A']] == $_GET['seedId'] &&
    $seedObj->findKey($_GET['B'])[$_GET['B']] == $_GET['seedId']){
    //INFO
    $seedInfoObj = new mdIni('ini/seed/' . $_GET['seedId'] . '.ini');
    $seedInfoObj->setKeyValue('id', $_GET['seedId'], 'INFO');
    $seedInfoObj->setKeyValue('A', $_GET['A'], 'INFO');
    $seedInfoObj->setKeyValue('B', $_GET['B'], 'INFO');
    $seedInfoObj->setKeyValue('birthday', date("Y-m-d-H-i-s", time()), 'INFO');
	$seedInfoObj->setKeyValue('love', '0', 'INFO');
	$seedInfoObj->setKeyValue('index', '0', 'INFO');
	$seedInfoObj->setKeyValue($_GET['A'].'mood', '开心', 'INFO');
	$seedInfoObj->setKeyValue($_GET['B'].'mood', '开心', 'INFO');
    //CD
    $seedInfoObj->setKeyValue('watering', '0', 'CD');
    $seedInfoObj->setKeyValue('manure', '0', 'CD');
    $seedInfoObj->setKeyValue('debug', '0', 'CD');
    $seedInfoObj->setKeyValue('weeding', '0', 'CD');
    //DIARY
    $seedInfoObj->setKeyValue(date("Y-m-d-H-i-s", time()) , 'all###'. 'leave'. '###'.'恭喜你们获得一颗神奇种子，开始你们的故事吧。',
    'DIARY');
    echo('<return>true</return>');
    return;
}
else
    echo('<return>false</return>');
    return;
?>