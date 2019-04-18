<?php

namespace Wap\Controller;

use Think\Controller;

class SearchController extends Controller {

    protected $_account = 'shaoyang';
    protected $_app_id  = '780bbf7c7d094461b9d2982e66f803d7';
    protected $_app_key = '74b0a11a86a044a5b30bdade08218a50';
    protected $_miguan_token_url = 'https://mi.juxinli.com/api/access_token';
    protected $_miguan_search_url = 'https://mi.juxinli.com/api/search';

    protected $_mifeng_search_url = 'https://www.juxinli.com/orgApi/rest/v3/applications';

    function report_mifeng()
    {
        if ( ! $_POST) {
            $this->display('search_mifeng');
        } else {
            $post_data = [
                'selected_website' => [
                    [
                        'website'  => 'jingdong',
                        'category' => 'e_business'
                    ]
                ],
                'skip_mobile' => false,
                'basic_info' => [
                    'name'           => '晋京',
                    'id_card_num'    => '410181198905104557',
                    'cell_phone_num' => '13683582516' 
                ]
            ];
            $url = $this->_mifeng_search_url . '/' . $this->_account;
            $header = [
                'Content-Type: application/json; charset=utf-8'
            ];
            $res = curl_post($url, json_encode($post_data), $header);       
        }
        echo "<pre>";
        var_dump($res);
        echo "</pre>";
    }

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
            $this->_check_code(I('post.phone'), I('post.code'));
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

            //记录log 
            $pass = I('post.pass');
            $this->_set_search_log($uid, $get_data['name'], $get_data['id_card'], $get_data['phone'], $get_data['client_secret'], $get_data['access_token'], $pass);

            $this->display();
        } else {
            $this->display('search');
        }
    }

    function get_report()
    {
        if ( ! $_POST) {
            $id = I('get.id');
            $this->display();
        } else {
            $pass = I('post.pass');
            $id = I('post.id');

            $Search = M('Search');
            $search_info = $Search->where(['id' => $id])->find();
            if ($search_info['pass'] != $pass) {
                $this->error("免密错误");
            }
            
            $get_data = [
                'name'          => $search_info['name'],
                'id_card'       => $search_info['id_card'],
                'phone'         => $search_info['phone'],
                'client_secret' => $this->_app_key,
                'access_token'  => $search_info['access_token'],
                'version'       => 'v3'
            ];
            $url = $this->_miguan_search_url . '?' . http_build_query($get_data);
            $data = curl_get($url);
            $data = json_decode($data, true);
            if ($data['code'] != 'MIGUAN_SEARCH_SUCCESS') {
                $this->error($data['message']);
            }
            $this->data = $data['data'];

            $this->display('report');
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

    private function _set_search_log($uid, $name, $id_card, $phone, $client_secret, $access_token, $pass)
    {
        $search_data = [
            'uid'           => $uid,
            'name'          => $name,
            'id_card'       => $id_card,
            'phone'         => $phone,
            'client_secret' => $client_secret,
            'access_token'  => $access_token,
            'pass'          => $pass,
            'version'       => 'v3',
            'created_time'  => time(),
            'updated_time'  => time()
        ];
        $Search = M('Search');
        $Search->add($search_data);
        $Member = M('Member');
        $Member->where(['id' => $uid])->setDec('balance');
    }

    private function _check_code($mobile, $code)
    {
        $Vcode = M('Vcode');
        $vcode_info = $Vcode->where(['mobile' => $mobile, 'status' => 1])->order(['id' => 'desc'])->find();
        if ( ! $vcode_info) {
            $this->error('验证码无效');
        }
        if ($vcode_info['code'] != $code) {
            $this->error('验证码错误');
        }
        $Vcode->where(['id' => $vcode_info['id']])->save(['status' => 2]);
    }
}
