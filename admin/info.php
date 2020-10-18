<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>info</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    html {
        font-size: 100px;
        color: white;
    }

    #container {
        padding: 12vh 6vw;
        position: relative;
    }
    #icon {
        padding: 0;
        margin: 0;
        font-size: 1rem;
        font-weight: 900;
        display: block;
        position: absolute;
        right: 12vw;
        top: calc(12vh - 50px);
    }
    h1 {
        margin-top: 100px;
        font-size: .64rem;
        font-weight: 200;
    }
    p {
        font-size: .32rem;
        font-weight: 100;
        padding: 12px .64rem;
    }
    span:hover {
        color: #bbb;
    }
</style>
<body>
    <div id="container">
        <?php
        include_once('../php/key.php');
        $key = new key();
        if ($_GET['key'] != $key->getKey()){
            $logObj->addLog('外来客', '尝试进入info文件');
            return;
        }
        ?>
        <h1 id="icon">JuBan</h1>
        <h1>服务器信息</h1>
        <p>PHP 版本：<span><?php echo(PHP_VERSION)?></span></p>
        <p>协议版本：<span><?php print_r($_SERVER['SERVER_PROTOCOL'])?></span></p>
        <p>服务器地址：<span><?php echo($_SERVER['SERVER_NAME'])?></span></p>
        <p>服务器端口：<span><?php echo($_SERVER['SERVER_PORT'])?></span></p>
        <p>服务器环境：<span><?php echo($_SERVER['SERVER_SOFTWARE'])?></span></p>
        <p>服务器操作系统：<span><?php echo(php_uname('s'))?></span></p>
        <h1>客户端信息</h1>
        <p>浏览器信息：<span><?php print_r($_SERVER['HTTP_USER_AGENT'])?></span></p>
        <p>客户端IP：<span><?php print_r($_SERVER['REMOTE_ADDR'])?></span></p>
        <h1>版本信息</h1>
        <p>服务端版本：<span>1.0</span></p>
    </div>
</body>
</html>