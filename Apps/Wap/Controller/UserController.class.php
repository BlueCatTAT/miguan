<?php

namespace Wap\Controller;

use Think\Controller;

class UserController extends RootController {

    protected $_base_url = 'http://www.zhixinrenapp.com/';
    protected $_appid = 'wx1e21ad441e4e2576';
    protected $_appsecret = 'a26010468f9791b8d5939b3728600e52';

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
        $code = $_GET['code'];
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->_appid.'&secret='.$this->_appsecret.'&code='.$code.'&grant_type=authorization_code';
        $res = curl_get($url);
        $res = json_decode($res, true);
        $access_token = $res['access_token'];
        $openid = $res['openid'];

        $url2 = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $res2 = curl_get($url2);
        $res2 = json_decode($res2, true);
        echo "<pre>";
        var_dump($res2);
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
