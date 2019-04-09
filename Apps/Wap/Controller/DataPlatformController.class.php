<?php

namespace Wap\Controller;

use Think\Controller;

class DataPlatformController extends Controller {
   
    protected $_account = 'shaoyang';
    protected $_app_id  = '780bbf7c7d094461b9d2982e66f803d7';
    protected $_app_key = '74b0a11a86a044a5b30bdade08218a50';
    protected $_miguan_token_url = 'https://mi.juxinli.com/api/access_token';
    protected $_miguan_search_url = 'https://mi.juxinli.com/api/search';
    
    function report() {
        $this->display();
    }
}
