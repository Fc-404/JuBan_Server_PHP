<?php
/**
 * mdSeedInfo templet
 * .../Juban/api/mdSeedInfo.php?seedId=###&id=###&type=###&value=###&key=md5('fc' . 'i')
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
    $INFO = array("mood", "pendant", "love");
    $CD = array("watering", "manure", "debug", "weeding");
    //
    $seedInfoObj = new mdIni('ini/seed/'. $_GET['seedId']. '.ini');
    if (in_array($_GET['type'], $INFO)){
        if ($_GET['type'] == "mood"){
            $seedInfoObj->setKeyValue($_GET['id'].$_GET['type'], $_GET['value'], 'INFO');
        }else 
            $seedInfoObj->setKeyValue($_GET['type'], $_GET['value'], 'INFO');
    }else if(in_array($_GET['type'], $CD)){
        $seedInfoObj->setKeyValue($_GET['type'], $_GET['value'], 'CD');
    }else{
        echo('<return>false</return>');
    }
    $seedInfoObj->addKeyValue(date("Y-m-d-H-i-s", time()),
    $_GET['id'] . '###'. $_GET['type']. '###'. $_GET['value']  );
    echo('<return>true</return>');
    return;
}
else
    echo('<return>false</return>');
    return;
?>