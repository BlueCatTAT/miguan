<?php

namespace Wap\Controller;

use Think\Controller;

class DataPlatformController extends Controller {
   
    protected $_account = 'shaoyang';
    protected $_app_id  = '780bbf7c7d094461b9d2982e66f803d7';
    //protected $_app_id  = '780bbf7c7d094461b9d2982e66f803d7';
    protected $_app_key = 'b2adf64605654d458e71deb45bd35e06';  
    //protected $_app_key = '74b0a11a86a044a5b30bdade08218a50';

    protected $_auth_url = 'https://viptest.juxinli.com/h5/authorize/';
    //protected $_auth_url = 'https://vip.juxinli.com/h5/authorize/';
    
    protected $_api_url = 'https://viptest.juxinli.com/data_platform_api';
    //protected $_api_url = 'https://vip.juxinli.com/data_platform_api';
    
    function report() {
        $string = 'http://58.87.110.104/data_platform/callback.html';
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        $get_data = [
            'api_key' => $this->_app_key,
            'callback_url' => $data
        ];
        $url = $this->_auth_url.'telecom?' . http_build_query($get_data);
        $url = $this->_auth_url.'taobao?' . http_build_query($get_data);
        //$url = $this->_auth_url.'jingdong?' . http_build_query($get_data);
        header("Location: " . $url);            
    }

    function callback()
    {
        $token = I('get.token');

        $header[] = "Authorization: Basic " . base64_encode($this->_app_id . ":" . $this->_app_key);
        $url = $this->_api_url . '/raw_data/' . $token;
        $res = curl_get($url, $header); 
        echo "<pre>";
        var_dump($_POST, $_GET, $res);
        echo "</pre>";
    }
}
