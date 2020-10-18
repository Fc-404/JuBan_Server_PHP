<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>久伴-B/S核心版</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    html {
        font-size: 100px;
    }

    body {
        background-color: #eee;
    }

    .logup, .login{
        font-size: .6rem;
        font-weight: 100;
        display: block;
        text-align: center;
        color: #0084ff;
    }
    #submit {
        font-size: .2rem;
        user-select: none;
        color: #0084ff;
        background-color: white;
        display: block;
        height: calc(40px + .2rem);
        width: calc(40px + .2rem);
        text-align: center;
        line-height: calc(40px + .2rem);
        border-radius: 50%;
        border: 2px solid #0084ff;
        margin: auto;
    }
    #submit:hover {
        color: white;
        background-color: #0084ff;
    }

    input {
        color: #0084ff;
        font-size: .18rem;
        height: .3rem;
        width: 2rem;
        display: block;
        margin: .2rem auto;
        border-radius: 12px;
        border: 2px solid #0084ff;
        outline: none;
        padding: 2px 5px;
    }
</style>

<body>
    <div style="width: 100%; height: 1rem; background: #eee;"></div>
    <?php
    error_reporting(0);
    include_once('../php/key.php');
    
    $info = parse_ini_file("../ini/webIni.ini");
    if ($info['userID'] == null){
        $info_file = fopen("../ini/webIni.ini", "a");
        fclose($info_file);
        ?>
    <h1 class="login">注册</h1>
    <form action="../php/mdUser.php?type=in&key=<?php $keyObj = new key(); echo $keyObj->getKey();?>" method="POST">
        <input type="text" id="userId" name="userId">
        <input type="password" id="userPw" name="userPw">
        <mybutton id="submit">注册</mybutton>
    </form>
    <?php
    }
    else{
        ?>
    <h1 class="logup">登录</h1>
    <form action="../php/mdUser.php?type=up&key=<?php $keyObj = new key(); echo $keyObj->getKey();?>" method="POST">
        <input type="text" id="userId" name="userId">
        <input type="password" id="userPw" name="userPw">
        <mybutton id="submit">登录</mybutton>
    </form>
    <?php
    }
    ?>
    <div style="width: 100%; height: 1rem; background: #eee;"></div>
</body>
<script>
    document.getElementById('submit').onclick = function () {
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
</script>

</html>