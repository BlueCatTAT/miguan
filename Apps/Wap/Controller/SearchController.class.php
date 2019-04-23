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

    function report() {
        $uid = is_login();
        if ( ! $uid) {
            $this->redirect('/user/index');
        }

        $Member = M('Member');
        $member_info = $Member->where(['id' => $uid])->find();

        if ($member_info['balance'] < 1) {
            //$this->redirect('/pay/make_order');
        }

        $trade_no = $this->_make_order($uid);
        $this->trade_no = $trade_no;
        $this->display('search');
    }

    function report_his()
    {
        $id = I('get.id');
        $Search = M('Search');
        $search_info = $Search->where(['id' => $id])->find();
        $data = json_decode($search_info['data'], true);
        $this->data = $data['data'];      
        $this->display('report');
    }

    function search_log()
    {
        $uid = is_login();
        if ( ! $uid) {
            echo json_encode(['status' => -1]);
            exit;
        }
        $code = I('post.code');
        $name = I('post.name');
        $id_card = I('post.id_card');
        $phone = I('post.phone');
        $pass = I('post.pass');
        
        $Vcode = M('Vcode');
        $vcode_info = $Vcode->where(['mobile' => $phone, 'status' => 1])->order(['id' => 'desc'])->find();
        if ( ! $vcode_info) {
            echo json_encode(['status' => 0, 'msg' => '验证码无效']);
            exit;
        }
        if ($vcode_info['code'] != $code) {
            echo json_encode(['status' => 0, 'msg' => '验证码错误']);
            exit;
        }
        $Vcode->where(['id' => $vcode_info['id']])->save(['status' => 2]);

        $Search = M('Search');    
        $search_data = [
            'uid'          => $uid,
            'name'         => $name,
            'id_card'      => $id_card,
            'phone'        => $phone,
            'pass'         => $pass,
            'trade_no'     => $trade_no,
            'created_time' => time(),
            'updated_time' => time()
        ];
        $search_id = $Search->add($search_data);
        echo json_encode(['status' => 1, 'id' => $search_id]);
    }

    function get_report()
    {
        $id = I('get.id');
        $Search = M('Search');
        $search_info = $Search->where(['id' => $id])->find();
        if ( ! $search_info) {
            $this->error('未找到报告');
        }
        
        $token = $this->_get_token();
        $get_data = [
            'name'          => $search_info['name'],
            'id_card'       => $search_info['id_card'],
            'phone'         => $search_info['phone'],
            'client_secret' => $this->_app_key,
            'access_token'  => $token,
            'version'       => 'v3'
        ];
        $url = $this->_miguan_search_url . '?' . http_build_query($get_data);
        $data = curl_get($url);
        $update_info = [
            'client_secret' => $this->_app_key,
            'access_token'  => $token,
            'data' => $data,
            'status' => 2
        ];
        $Search->where(['id' => $search_info['id']])->save($update_info);
        
        $data = json_decode($data, true);
        if ($data['code'] != 'MIGUAN_SEARCH_SUCCESS') {
            $this->error($data['message']);
        }
        $this->data = $data['data'];

        $this->display('report');
    }

    function get_report2()
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

    private function _make_order($uid)
    {
        $Member = M('Member');
        $member_info = $Member->where(['id' => $uid])->find();
        
        $Order = M('Order');
        
        $trade_no = date("YmdHis").rand(1000, 9999);
        $fee = 2800;
        $fee = 1;

        $order_data = [
            'uid' => $uid,
            'trade_no' => $trade_no,
            'fee' => $fee,
            'created_time' => time(),
            'updated_time' => time()
        ];
        if ( ! $Order->add($order_data)) {
            $this->error('创建订单失败');
        }
        
        import("Wap.Util.weixin.tool.JsApiPay");
        import("Wap.Util.weixin.tool.lib.WxPayApi");
        
        $tools = new \JsApiPay();
        $openId = $member_info['openid'];

        $input = new \WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no($trade_no);
        $input->SetTotal_fee($fee);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://www.zhixinrenapp.com/pay/notify_url");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $config = new \WxPayConfig();
        
        $payapi = new \WxPayApi();
        $order = $payapi::unifiedOrder($config, $input);
        $jsApiParameters = $tools->GetJsApiParameters($order);
        $editAddress = $tools->GetEditAddressParameters();
        
        $this->jsApiParameters = $jsApiParameters;
        $this->editAddress = $editAddress;
    }
}
