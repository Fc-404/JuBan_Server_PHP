<?php
/**
 * getSeedInfo templet
 * .../Juban/api/getSeedInfo.php?seedId=###&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-getSeedInfo');
    echo('<return>false</return>');
    return;
}

$fileUrl = '../ini/seed/'. $_GET['seedId']. '.ini';
if (file_exists($fileUrl)){
    $seedInfoObj = new mdIni('ini/seed/'. $_GET['seedId']. '.ini');
    $resultObj = $seedInfoObj->getKeyValue();
    echo('<return>true</return>');
    //
    foreach ($resultObj as $Key=>$value){
        echo("<$Key>");
        foreach ($value as $id=>$str){
            echo("<$id>$str</$id>");
        }
        echo("</$Key>");
    }
    return;
}
else
    echo('<return>false</return>');
    return;

?>