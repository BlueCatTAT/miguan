<?php

namespace Wap\Controller;

use Think\Controller;

class DataPlatformController extends Controller {
   
    protected $_account = 'shaoyang';
    protected $_app_id  = '780bbf7c7d094461b9d2982e66f803d7';
    protected $_app_key = '74b0a11a86a044a5b30bdade08218a50';

    protected $_auth_url = 'https://viptest.juxinli.com/h5/authorize/';
    //protected $_auth_url = 'https://vip.juxinli.com/h5/authorize/';
    
    function report() {
        $get_data = [
            'api_key' => $this->_app_key,
            'callback_url' => 'http://58.87.110.104/data_platform/callback.html'
        ];
        $url = $this->_auth_url.'telecom?' . http_build_query($get_data);
        header("Location: " . $url); 
    }

    function callback()
    {
        echo "<pre>";
        var_dump($_POST, $_GET);
        echo "</pre>";
    }
}
