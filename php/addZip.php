<?php
include_once('mdLog.php');
include_once('key.php');
include_once('zip.php');

$key = new key();
$logObj = new mdLog();

if ($_GET['key'] != $key->getKey()){
    $logObj->addLog('外来客', '尝试进入addZip文件');
    return;
}

if (!$_GET['zipPath'] || !is_dir('../' . $_GET['dirPath'])){
    echo '<script>alert("路径错误")</script>';
    return;
}

$zipPath = '../' . $_GET['zipPath'];
$dirPath = '../' . $_GET['dirPath'];

if (is_file($zipPath))
    copy($zipPath, $zipPath . '.bak');

$zip = new ZipArchive();
try {
    $zip->open($zipPath, ZipArchive::CREATE);
    addFileToZip($dirPath, $zip);
    $zip->close();
    $logObj->addLog('管理员', '备份数据');
} catch (\Exception $m){
    echo '<script>alert("' . $m->getMessage() . '"></script>';
    $logObj->addLog('管理员', '备份数据失败');
}
echo("<script>window.location.href='../admin/set.php?key=" . $key->getKey() . "'</script>");
?>