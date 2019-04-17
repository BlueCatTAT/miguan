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
        $uid = is_login();
        if ( ! $uid) {
            $this->redirect('/user/index');
        }

        $Member = M('Member');
        $member_info = $Member->where(['id' => $uid])->find();

        if ($member_info['balance'] < 1) {
            $this->redirect('/pay/make_order');
        }

        if ($_POST) {
            $token = $this->_get_token();
            $get_data = [
                'name'          => I('post.name'),
                'id_card'       => I('post.id_card'),
                'phone'         => I('post.phone'),
                'client_secret' => $this->_app_key,
                'access_token'  => $token,
                'version'       => 'v3'
            ];
            $url = $this->_miguan_search_url . '?' . http_build_query($get_data);
            $data = curl_get($url);
            $data = json_decode($data, true);
            if ($data['code'] != 'MIGUAN_SEARCH_SUCCESS') {
                $this->error($data['message']);
            }
            $this->data = $data['data'];
            $this->display();
        } else {
            $this->display('search');
        }
    }

    function _get_token()
    {
        $url = $this->_miguan_token_url . '?client_secret=' . $this->_app_key . '&account=' . $this->_account;
        $token_res = curl_get($url);
        $token_res = json_decode($token_res, true);
        if ($token_res['code'] != 'MIGUAN_ACCESS_SUCCESS') {
            $this->error($token_res['message']);
        }
        return $token_res['data']['access_token'];
    }
}
