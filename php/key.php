<?php
/**
 * TEMP
 * 
 * put key
 * <?php $keyObj = new key(); echo $keyObj->getKey();?>
 * 
 * get key
 * $key = new key();
 * if ($_GET['key'] != $key->getKey())
 *   return;
 */
class key{
    private $key;

    // time options Y-m-d-H-i-s
    public function __construct($keyWord = 'fc_404', $time = 'H'){
        $time = date($time, time());
        $this->key = md5($keyWord . $time);
    }

    public function getKey(){
        return $this->key;
    }
}
?>