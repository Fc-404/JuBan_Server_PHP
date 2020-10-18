<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>logs</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        font-size: 100px;
    }
    #logs {
        padding: 12vh 4vw;
    }
    .log {
        color: white;
        font-weight: 100;
        font-size: .28rem;
        line-height: .56rem;
    }
    hr {
        border: none;
        border-top: 2px solid #ccc;
    }
</style>
<body>
    <div id="logs">
        <?php
        include_once('../php/key.php');
        $key = new key();
        if ($_GET['key'] != $key->getKey()){
            $logObj->addLog('外来客', '尝试进入logs文件');
            return;
        }

        $myfile = fopen("../ini/logs.ini", "r") or die("Unable to open file!");
        // 输出一行直到 end-of-file
        while(!feof($myfile)) {
           echo('<p class="log">' . fgets($myfile) . '</p><hr>');
        }
        fclose($myfile);
        ?>
    </div>
</body>
</html>