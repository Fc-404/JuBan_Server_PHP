<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>set</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }
    html {
        font-size: 100px;
        color: white;
    }
    #setDiv {
        margin: 2vh 4vw;
    }
    h1 {
        font-size: .64rem;
        font-weight: 200;
        display: block;
        margin-top: 100px;
    }
    p{
        font-size: .32rem;
        font-weight: 100;
        margin: 12px .64rem;
    }

    myButton {
        display: inline-block;
        padding: 6px 12px;
        font-size: .28rem;
        background-color: #0084ff;
        border: 3px solid white;
        border-radius: 12px;
        user-select: none;
    }
    myButton:hover {
        box-shadow: 2px 2px 12px 1px #555;
    }
    myButton:active {
        background-color: white;
        color: #0084ff;
    }

    input {
        color: white;
        font-size: .18rem;
        height: .3rem;
        width: 2rem;
        display: inline-block;
        margin: .2rem 100px;
        border-radius: 12px;
        border: 2px solid white;
        outline: none;
        padding: 2px 5px;
        background-color: #0084ff;
    }
</style>
<body>
    <div id="setDiv">
        <?php
        include_once('../php/key.php');
        include_once('../php/mdIni.php');
        include_once('../php/mdLog.php');

        $key = new key();
        if ($_GET['key'] != $key->getKey()){
            $logObj->addLog('外来客', '尝试进入mdRun文件修改运行状态');
            return;
        }

        $webIniObj = new mdIni('ini/webIni.ini');
        ?>
        <h1>服务状态</h1>
        <p>
            <myButton id="runOn" onclick="runOn()">开启</myButton>
            <myButton id="runOff" onclick="runOff()" style="margin-left: 100px;">关闭</myButton>
        </p>
        <h1>备份与重置</h1>
        <p>
            <myButton onclick="backupData()">备份站点数据</myButton>
            <myButton onclick="downBackup(1)" style="margin-left: 100px;">下载备份数据</myButton>
        </p>
        <div style="width: 100%; height: 60px;"></div>
        <p>
            <myButton onclick="clearLog()">清空日志</myButton>
            <myButton onclick="alert('暂不支持非手动重置')" style="margin-left: 100px;">重置站点</myButton>
        </p>
        <h1>用户</h1>
        <p>
            <form action="../php/mdUser.php?type=md&key=<?php $keyObj = new key(); echo $keyObj->getKey();?>" method="POST">
                <input type="text" id="userId" name="userId" value="<?php echo $webIniObj->getKeyValue('userID', 'USER') ?>">
                <myButton class="md">修改用户名</myButton>
                <br>
                <input type="text" id="userPw" name="userPw" value="<?php echo $webIniObj->getKeyValue('userPW', 'USER') ?>">
                <myButton class="md">修改密码</myButton>
            </form>
        </p>
    </div>
    <div style="height: 200px; width: 100%;"></div>
</body>
<script>
    function runOn(updata = 1){
        document.getElementById('runOn').style.background = "white";
        document.getElementById('runOn').style.color = "#0084ff";
        document.getElementById('runOff').style.background = "#0084ff";
        document.getElementById('runOff').style.color = "white";
        if (updata == 1)
            window.location.href = '../php/mdRun.php?run=on&key=<?php $keyObj = new key(); echo $keyObj->getKey();?>';
    }
    function runOff(updata = 1){
        document.getElementById('runOff').style.background = "white";
        document.getElementById('runOff').style.color = "#0084ff";
        document.getElementById('runOn').style.background = "#0084ff";
        document.getElementById('runOn').style.color = "white";
        if (updata == 1)
            window.location.href = '../php/mdRun.php?run=off&key=<?php $keyObj = new key(); echo $keyObj->getKey();?>';
    }

    //备份站点数据
    function backupData(){
        window.location.href = 
            '../php/addZip.php?zipPath=ini.zip&dirPath=ini&key=<?php $keyObj = new key(); echo $keyObj->getKey();?>';
    }
    //下载站点数据
    function downBackup(on = 0){
        window.location.href = '../php/patck/addDownLog.php';
    }
    //
    function clearLog(){
        window.location.href = '../php/clearLog.php?key=<?php $keyObj = new key(); echo $keyObj->getKey();?>';
    }
    //
    for (var i = 0; i < 2; i++){
        document.getElementsByClassName('md')[i].onclick = function () {
            var regular = /^([0-9a-zA-Z]|[-_]){1,16}$/;
            if (!regular.exec(document.getElementById('userId').value)) {
                alert("\n用户名必须由 1 至 16 位 数字、字母、- 或 _ 组成\n");
                return;
            }
            regular = /^([0-9a-zA-Z]|[-_]){6,16}$/;
            if (!regular.exec(document.getElementById('userPw').value)) {
                alert("\n密码必须由 6 至 16 位 数字、字母、- 或 _ 组成\n");
                return;
            }
            this.parentElement.submit();
        }
    }
</script>
<?php
//加载后处理
    if ($webIniObj->getKeyValue('run', 'INFO'))
        echo '<script> runOn(0); </script>';
    else 
        echo '<script> runOff(0); </script>';
?>
</html>