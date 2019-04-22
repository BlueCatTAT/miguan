<?php

namespace Wap\Controller;

use Think\Controller;

class IndexController extends Controller {

    public function _empty() {
        $this->index();
    }

    function index() {
        $uid = is_login();
        if ( ! $uid) {
            $this->redirect('/user/index');
        }

        $Member = M('Member');
        $member_info = $Member->where(['id' => $uid])->find();
        if ($member_info['mobile']) {
            $this->redirect('/index/product');
        } else {
            if ($_POST) {
                $mobile = I('post.mobile');
                $code = I('post.code');
                $Vcode = M('Vcode');
                $vcode_info = $Vcode->where(['mobile' => $mobile, 'status' => 1])->order(['id' => 'desc'])->find();
                if (!$vcode_info) {
                    $this->error('验证码无效');
                }
                if ($vcode_info['code'] != $code) {
                    $this->error('验证码错误');
                }
                $Member->where(['id' => $uid])->save(['mobile' => $mobile]);
                $Vcode->where(['id' => $vcode_info['id']])->save(['status' => 2]);
                $this->redirect('/index/product');
            } else {
                $this->display();
            }
        }
    }

    function home() 
    {
        $this->display();
    }

    function product()
    {
        $this->display();
    }

    function msg()
    {
        $time = date('YmdHis');
        $authorization = base64_encode($this->_accountid.':'.$time);
        $sig=strtoupper(md5($this->_accountid.$this->_apisecret.$time)); 
        echo "<pre>";
        var_dump($this->_accountid.':'.$time, $authorization);
        echo "</pre>";
        echo "<pre>";
        var_dump($this->_accountid.$this->_apisecret.$time, $sig);
        echo "</pre>";
        
        $data = [
            "num" => "13683582516",
            "templateNum" => "5",
            "var1" => "888666"
        ];

        $header[] = "Accept: application/json";
        $header[] = "Content-type: application/json;charset='utf-8'";
        $header[] = "Content-Length: ".strlen( json_encode($data) );
        $header[] = "Authorization: ".$authorization;

        //帐号Id + 帐号APISecret +时间戳
        $url = $this->_msm_url . '?sig=' . $sig;

        $ch = curl_init ();
        curl_setopt($ch, CURLOPT_URL, ($url));//地址
        curl_setopt($ch, CURLOPT_POST, 1);   //请求方式为post
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data)); //post传输的数据。
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        
        $errno = curl_errno($ch);
        $info  = curl_getinfo($ch);

        $return = curl_exec($ch);
        echo "<pre>";
        var_dump($data, $return, $url, $errno, $info);
        echo "</pre>";exit;


        $res = curl_post($url, '', $header); 
        echo "<pre>";
        var_dump($res, $url);
        echo "</pre>";
    }
}
