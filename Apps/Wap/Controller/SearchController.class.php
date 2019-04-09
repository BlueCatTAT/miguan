<?php

namespace Wap\Controller;

use Think\Controller;

class SearchController extends Controller {

    protected $_account = 'shaoyang';
    protected $_app_id  = '780bbf7c7d094461b9d2982e66f803d7';
    protected $_app_key = '74b0a11a86a044a5b30bdade08218a50';
    protected $_miguan_token_url = 'https://mi.juxinli.com/api/access_token';
    protected $_miguan_search_url = 'https://mi.juxinli.com/api/search';

    function report() {
        if ($_POST) {
            $token = $this->_get_token();
            $get_data = [
                'name'          => '晋京',
                'id_card'       => '410181198905104557',
                'phone'         => '13683582516',
                'client_secret' => $this->_app_key,
                'access_token'  => $token,
                'version'       => 'v3'
            ];
            $url = $this->_miguan_search_url . '?' . http_build_query($get_data);
            $token_res = curl_get($url);
            echo "<pre>";
            var_dump($token_res);
            echo "</pre>";
        } else {
            $this->display();
        }
    }

    function _get_token()
    {
        $url = $this->_miguan_token_url . '?client_secret=' . $this->_app_key . '&account=' . $this->_account;
        $token_res = curl_get($url);
        $token_res = json_encode($token_res, true);
        if ($token_res['code'] != 'MIGUAN_ACCESS_SUCCESS') {
            $this->error($token_res['message']);
        }
        return $token_res['data']['access_token'];
    }
}
