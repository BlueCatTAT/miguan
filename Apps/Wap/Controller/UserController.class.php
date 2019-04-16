<?php

namespace Wap\Controller;

use Think\Controller;

class UserController extends RootController {

    protected $_base_url = 'http://www.zhixinrenapp.com/';
    protected $_appid = 'wx1e21ad441e4e2576';

    public function _empty() {
        $this->index();
    }

    function index() {
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->_appid . '&redirect_uri=' . $this->_base_url . 'user/callback&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        header("Location: " . $url);            
        $this->display();
    }

    function callback()
    {
        echo "<pre>";
        var_dump($_GET, $_POST);
        echo "</pre>";
    }

    function logout()
    {
        cookie('user_LOGGED', null);
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
        $this->redirect('/wap/user/index');
    }

    function msg()
    {
        $this->display();
    }
}
