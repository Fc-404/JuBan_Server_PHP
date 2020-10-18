<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>info</title>
</head>
<style>
    html {
        font-size: 100px;
    }
    #text {
        padding: 2vh 4vw;
        color: white;
    }
    h1:nth-child(1) {
        font-weight: 100;
        font-size: .86rem;
        text-align: center;
    }
    h1:nth-child(1) span {
        font-size: .32rem;
    }
    h1:nth-last-child(1) {
        font-size: .32rem;
        text-align: center;
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
</style>
<body>
    <div id="text">
        <?php
        include_once('../php/key.php');
        $key = new key();
        if ($_GET['key'] != $key->getKey()){
            $logObj->addLog('外来客', '尝试进入about文件');
            return;
        }
        ?>
        <h1>久伴    <span>--时间是最好的告白</span></h1>
        <h1>故事</h1>
        <p>夏至和秋分如同他们的名字一样，一个在南，一个在北。
            <br>一次偶然，夏至获得了一颗神奇种子，这颗种子必须由两个人合种，否则它就不会生长，进入无休无止的睡眠。
            <br>这颗种子也必须由两个人共同养护，它才会茁壮生长。
            <br>成长过程中，它会记录两个人的美好时光、它会包容彼此的怨念、它会一直陪伴着它的两个主人，
            <br>除非...算了，我们不谈除非，把那令人不开心的结局，让时间去吞没吧。</p>
        <h1>介绍</h1>
        <p>软件开发的初衷是让我们在快时代中挤出时间，来享受生活、陶冶情操、升华思维。</p>
        <p>这个版本是 B/S 架构，后续也许会开发性能更好的 C/S 架构。</p>
        <p>时间充足、资金不紧的话，也许会开发多平台，以及更好的后期维护。</p>
        <h1>作者</h1>
        <p>Fc_404--郭佳龙</p>
        <h1>致谢</h1>
        <p>黑虎阿福--秦健</p>
        <p>爬爬--贺涛</p>
        <p>小熊软糖--杨玉婷</p>
        <h1>版权所有  Fc_404  2020</h1>
    </div>
</body>
</html>