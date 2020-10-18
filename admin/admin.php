<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="admin.css">
    <title>久伴-B/S核心版-控制面板</title>
</head>
<body>
    <?php
    include_once('../php/key.php');
    if ($_GET['key'] == md5(parse_ini_file("../ini/webIni.ini")['userID'] . parse_ini_file("../ini/webIni.ini")['userPW'] . date("H", time()) . 'fc')){
    ?>
    <div id="content">
        <iframe id="content-url">
        </iframe>
    </div>
    <div id="option">
        <div id="option-bg"></div>
        <div id="info" class="options">信息</div>
        <div id="set" class="options">设置</div>
        <div id="logs" class="options">日志</div>
        <div id="about" class="options">关于</div>
    </div>
    <?php 
    } 
    else
        echo('<script>window.location.href="index.php"</script>');
    ?>
</body>

<script>
//自动排列options
(function(){
    var options = document.getElementsByClassName('options');
    var optionsQuantity = options.length;
    var bodyWidth = document.body.scrollWidth;
    var objWidth = options[0].scrollWidth;
    var interval = bodyWidth / (optionsQuantity + 1);
    for (var i = 0; i < optionsQuantity; i++)
        options[i].style.marginLeft = ((i + 1) * interval) - (objWidth / 2) + "px";
}());

//options点击效果
(function(){
    var options = document.getElementsByClassName('options');
    for (var i = 0; i < options.length; i++){
        options[i].onclick = function(){
            for (var j = 0; j < options.length; j++){
                options[j].style.color = "#555";
                options[j].setAttribute('is', 'no');
            }
            this.style.color = "white";
            this.setAttribute('is', 'yep');
            document.getElementById('content-url').src = 
                this.getAttribute('id') + '.php?key=<?php $keyObj = new key(); echo $keyObj->getKey();?>';
        }
    }
}());

//options移入效果
(function(){
    var options = document.getElementsByClassName('options');
    for (var i = 0; i < options.length; i++){
        options[i].onmouseover = function(){
            this.style.color = "#fff";
        }
        options[i].onmouseout = function(){
            if (this.getAttribute('is') == 'yep')
                return;
            this.style.color = "#555"
        }
    }
}());

//初始化
(function(){
    document.getElementsByClassName('options')[0].onclick();
}());
</script>
</html>