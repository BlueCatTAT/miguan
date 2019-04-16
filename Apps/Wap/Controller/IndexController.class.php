<?php

namespace Wap\Controller;

use Think\Controller;

class IndexController extends Controller {

    protected $_msm_url = 'http://apis.7moor.com/v20160818/customer/getTemplate/N00000000556';
    protected $_accountid = 'T00000001267';
    protected $_apisecret = 'c97dcb10-602d-11e9-898d-7708a1f6d461';

    public function _empty() {
        $this->index();
    }

    function index() {
        $this->display();
    }

    function home() 
    {
        $this->display();
    }

    function product()
    {
        $this->display();
    }

    function msg()
    {
        $time = date('YmdHis', time());
        $header[] = "Content-Type:application/json;charset=utf-8";
        $header[] = "Authorization: " . base64_encode($this->_accountid.':'.$time).";";

        //帐号Id + 帐号APISecret +时间戳
        $sig = strtoupper(md5($this->_accountid.$this->_apisecret.$time)); 
        $url = $this->_msm_url . '?sig=' . $sig;
        $res = curl_post($url, '', $header); 
        echo "<pre>";
        var_dump($res);
        echo "</pre>";
    }
}
