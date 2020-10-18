<?php
include_once('key.php');
include_once('mdIni.php');
include_once('mdLog.php');

$key = new key();
$webIni = new mdIni("ini/webIni.ini");
$logObj = new mdLog();

if ($_GET['key'] != $key->getKey()){
    $logObj->addLog('外来客', '尝试进入mdUser文件修改运行状态');
    return;
}

$userId = $_POST['userId'];
$userPw = $_POST['userPw'];

if ($_GET['type'] == "in"){
    $webIni->setKeyValue("userID", $userId, "USER");
    $webIni->setKeyValue("userPW", $userPw, "USER");
    $logObj->addLog($userId, "login");
    echo('<script>alert("注册成功！"); window.location.href=document.referrer;</script>');
}
if ($_GET['type'] == "up"){
    if ($webIni->getKeyValue("userID", "USER") == $userId && $webIni->getKeyValue("userPW", "USER") == $userPw){
        $logObj->addLog($userId, "logup");
        echo "<script>console.log('".date("Hi", time())."')</script>";
        echo('<script>window.location.href="../admin/admin.php?key=' . md5($userId . $userPw . date("H", time()) . 'fc') . '"</script>');
    }
    else{
        $logObj->addLog($userId, "logup error");
        echo('<script>alert("登录错误！"); window.history.go(-1);</script>');
    }
}
if ($_GET['type'] == "md"){
    $webIni->setKeyValue("userID", $userId, "USER");
    $webIni->setKeyValue("userPW", $userPw, "USER");
    $logObj->addLog($userId, "modifcation");
    echo('<script>alert("修改成功！"); window.location.href=document.referrer;</script>');
}
?>