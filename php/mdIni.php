<?php
error_reporting(0);
class mdIni
{
    private $fileUrl;

    public function __construct($fileUrl)
    {
        $temp = __DIR__;
        $temp = substr($temp, 0, -3);
        $this->fileUrl = $temp . $fileUrl;
        $file = fopen($this->fileUrl, "a");
        fclose($file);
    }

    //获取配置文件
    public function getKeyValue($key = '', $group = '')
    {
        $keyArr = parse_ini_file($this->fileUrl, true);
        //print_r($keyArr);
        if ($group != '') {
            if ($key != '')
                return (is_null($keyArr[$group][$key]) ? false : $keyArr[$group][$key]);
            return (is_null($keyArr[$group]) ? false : $keyArr[$group]);
        }
        if ($key != '')
            return (is_null($keyArr[$key]) ? false : $keyArr[$key]);
        return (is_null($keyArr) ? false : $keyArr);
    }

    //设置配置文件
    public function setKeyValue($key, $value, $group = '')
    {
        $keyArr = parse_ini_file($this->fileUrl, true);
        //print_r($keyArr);
        if ($key != '' && $value != '') {
            if ($group == '') {
                $keyArr[$key] = $value;
            } else {
                $keyArr[$group][$key] = $value;
            }
        } else
            return;

        copy($this->fileUrl, $this->fileUrl . '.bak');
        $file = fopen($this->fileUrl, 'r+');
        $str = "";

        $keyTemp = array();
        $keyTemp = array_keys($keyArr);
        //print_r($keyTemp);
        for ($i = 0; $i < count($keyTemp); $i++) {
            if (is_array($keyArr[$keyTemp[$i]])) {
                $keyInKey = array();
                $keyInKey = array_keys($keyArr[$keyTemp[$i]]);
                $str = '[' . $keyTemp[$i] . "]\n";
                fwrite($file, $str);
                for ($j = 0; $j < count($keyArr[$keyTemp[$i]]); $j++) {
                    $str = $keyInKey[$j] . '=' . $keyArr[$keyTemp[$i]][$keyInKey[$j]] . "\n";
                    fwrite($file, $str);
                }
            } else {
                $str = $keyTemp[$i] . '=' . $keyArr[$keyTemp[$i]] . "\n";
                fwrite($file, $str);
            }
        }
        fclose($file);
    }

    //追加配置文件
    public function addKeyValue($key, $value)
    {
        $file = fopen($this->fileUrl, "a+");
        $str = $key . "=" . $value . "\n";
        fwrite($file, $str);
        fclose($file);
    }

    //查找
    public function findKey($key)
    {
        $keyArr = parse_ini_file($this->fileUrl);
        if (array_key_exists($key, $keyArr))
            return array($key => $keyArr[$key]);
        return false;
    }

    //删除
    public function delKey($key, $group = '')
    {
        $keyArr = parse_ini_file($this->fileUrl, true);
        if ($group == '') {
            if (!array_key_exists($key, $keyArr))
                return false;
            unset($keyArr[$key]);
        } else {
            if (!array_key_exists($key, $keyArr[$group]))
                return false;
            unset($keyArr[$group][$key]);
        }

        copy($this->fileUrl, $this->fileUrl . '.bak');
        $file = fopen($this->fileUrl, 'w+');
        $str = "";

        $keyTemp = array();
        $keyTemp = array_keys($keyArr);
        //print_r($keyTemp);
        for ($i = 0; $i < count($keyTemp); $i++) {
            if (is_array($keyArr[$keyTemp[$i]])) {
                $keyInKey = array();
                $keyInKey = array_keys($keyArr[$keyTemp[$i]]);
                $str = '[' . $keyTemp[$i] . "]\n";
                fwrite($file, $str);
                for ($j = 0; $j < count($keyArr[$keyTemp[$i]]); $j++) {
                    $str = $keyInKey[$j] . '=' . $keyArr[$keyTemp[$i]][$keyInKey[$j]] . "\n";
                    fwrite($file, $str);
                }
            } else {
                $str = $keyTemp[$i] . '=' . $keyArr[$keyTemp[$i]] . "\n";
                fwrite($file, $str);
            }
        }
        fclose($file);
    }
}
