<?php
include_once('../mdLog.php');
include_once('../key.php');
$logObj = new mdLog();
$key = new key();

if (!is_file('../../ini.zip')){
    $logObj->addLog('管理员或未知', '下载备份数据出错');
    echo("<script>alert('没有备份');window.location.href='../../admin/set.php?key=" . $key->getKey() . "'</script>");
    return;
}

$logObj->addLog('管理员或未知', '下载备份数据');
echo("<script>window.open('../../ini.zip');window.location.href='../../admin/set.php?key=" . $key->getKey() . "'</script>");
?>
