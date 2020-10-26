<?php
/**
 * mdSeedInfo templet
 * .../Juban/api/mdSeedInfo.php?seedId=###&id=###&type=###&value=###&key=md5('fc' . 'i')
 */

include_once('../php/key.php');
include_once('../php/mdIni.php');
include_once('../php/mdLog.php');

$key = new key('fc', 'i');
$log = new mdLog();
if ($_GET['key'] != $key->getKey()){
    $log->addLog('外来者', '尝试访问api-mdSeedInfo');
    echo('<return>false</return>');
    return;
}

$fileUrl = '../ini/seed/'. $_GET['seedId']. '.ini';
if (file_exists($fileUrl)){
    //功能注册
    $INFO = array("mood", "pendant", "love");
    $CD = array("浇水"=>"watering", "施肥"=>"manure", "杀虫"=>"debug", "除草"=>"weeding");
    //
    $seedInfoObj = new mdIni('ini/seed/'. $_GET['seedId']. '.ini');
    if (in_array($_GET['type'], $INFO)){

        if ($_GET['type'] == "mood"){
            $seedInfoObj->setKeyValue($_GET['id'].$_GET['type'], $_GET['value'], 'INFO');
            $seedInfoObj->addKeyValue(date("Y-m-d-H-i-s", time()),
                $_GET['id'] . '###'. $_GET['type']. '###'. '换了个心情--'.$_GET['value']  );
            
        }else if ($_GET['type'] == "love"){
            $love = $seedInfoObj->getKeyValue('love', 'INFO');
            if (!is_numeric($_GET['value']))
                echo('<return>false</return>');
            $seedInfoObj->setKeyValue('love', $love + $_GET['value'], 'INFO');
            echo('<return>true</return>');
            return;
        }else
            $seedInfoObj->setKeyValue($_GET['type'], $_GET['value'], 'INFO');

    }else if(in_array($_GET['type'], $CD)){

        $seedInfoObj->setKeyValue($_GET['type'], $_GET['value'], 'CD');
        $seedInfoObj->addKeyValue(date("Y-m-d-H-i-s", time()),
                $_GET['id'] . '###'. $_GET['type']. '###我刚刚给我们的树'.array_keys($CD, $_GET['type'])[0].'了');

    }else{
        echo('<return>false</return>');
        return;
    }
    echo('<return>true</return>');
}else
    echo('<return>false</return>');
    return;
?>