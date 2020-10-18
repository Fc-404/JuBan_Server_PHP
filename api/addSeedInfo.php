<?php
/**
 * addSeedInfo templet
 * .../Juban/api/addSeedInfo.php?seedId=###&id=###&type=###&value=###&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-addSeedInfo');
    echo('<return>false</return>');
    return;
}

$fileUrl = '../ini/seed/'. $_GET['seedId']. '.ini';
if (file_exists($fileUrl)){
    //功能注册
    $DIARY = array("mood", "pendant", "leave", "share");
    //功能检测
    if (!in_array($_GET['type'], $DIARY)){
        echo('<return>false</return>');
        return;
    }

    $seedInfoObj = new mdIni('ini/seed/'. $_GET['seedId']. '.ini');
    //检测用户是否是此种子文件用户
    if (!($seedInfoObj->findKey('A')['A'] == $_GET['id']) &&
        !($seedInfoObj->findKey('B')['B'] == $_GET['id']) &&
        ($_GET['id'] != 'all')  ){
        echo('<return>false</return>');
        return;
    }
    
    $seedInfoObj->addKeyValue($_GET['id'],
    date("Y-m-d-H-i-s", time()). '###'. $_GET['type']. '###'.$_GET['value']  );
    echo('<return>true</return>');
    return;
}
else
    echo('<return>false</return>');
    return;
?>