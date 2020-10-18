<?php
/**
 * login templet
 * .../Juban/api/login.php?id=###&pw=md5(###)&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-login');
    echo('<return>false</return>');
    return;
}

$user = new mdIni('ini/user/user.ini');

if ($user->findKey($_GET['id'])){
    echo('<return>false</return>');
    return;
}

$log->addLog($_GET['id'], '注册');
$user->setKeyValue($_GET['id'], $_GET['pw']);
echo('<return>true</return>')
?>