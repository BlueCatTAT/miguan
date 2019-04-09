<?php

namespace Wap\Controller;

use Think\Controller;

class SearchController extends Controller {

    protected $_app_id  = '780bbf7c7d094461b9d2982e66f803d7';
    protected $_app_key = '74b0a11a86a044a5b30bdade08218a50';
    protected $_miguan_url = 'https://mi.juxinli.com/api/access_token';

    function report() {
        $url = $this->_miguan_url . '?client_secret=' . $this->_app_key . '&account=' . $this->_app_id;
        $res = curl_get($url);
        echo "<pre>";
        var_dump($url, $res);
        echo "</pre>";
        $this->display();
    }
}
