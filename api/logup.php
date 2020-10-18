<?php
/**
 * logup templet
 * .../Juban/api/logup.php?id=###&pw=md5(md5(###))&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-logup');
    echo('<return>false</return>');
    return;
}

$user = new mdIni('ini/user/user.ini');

if (!$user->findKey($_GET['id'])){
    echo('<return>false</return>');
    return;
}

if ($user->getKeyValue($_GET['id']) == $_GET['pw']){
    $log->addLog($_GET['name'], '登录');
    echo('<return>true</return>');
    return;
}
echo('<return>false</return>');
?>