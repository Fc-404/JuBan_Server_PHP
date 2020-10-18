<?php
include_once('key.php');
include_once('mdIni.php');
include_once('mdLog.php');
$key = new key();
$webIniObj = new mdIni('ini/webIni.ini');
$logObj = new mdLog();

if ($_GET['key'] != $key->getKey()){
    $logObj->addLog('外来客', '尝试进入mdRun文件修改运行状态');
    return;
}

if ($_GET['run'] == 'on'){
    $webIniObj->setKeyValue('run', '1', 'INFO');
    $logObj->addLog('管理员', '开启服务');
}
if ($_GET['run'] == 'off'){
    $webIniObj->setKeyValue('run', '0', 'INFO');
    $logObj->addLog('管理员', '关闭服务');
}
echo("<script>window.location.href='../admin/set.php?key=" . $key->getKey() . "'</script>");
?>