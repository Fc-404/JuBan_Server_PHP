<?php
include_once('key.php');
include_once('mdLog.php');

$key = new key();
$logObj = new mdLog();

if ($_GET['key'] != $key->getKey()){
    $logObj->addLog('外来者', '尝试清空日志');
    return;
}

unlink('../ini/logs.ini');
$logObj->addLog('管理员', '清空日志');
echo("<script>window.location.href='../admin/set.php?key=" . $key->getKey() . "'</script>");
?>