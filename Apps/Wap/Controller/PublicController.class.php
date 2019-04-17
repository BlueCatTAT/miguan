<?php

namespace Wap\Controller;

use Think\Controller;

class PublicController extends Controller {
    
    protected $_msm_url = 'https://openapis.7moor.com/v20160818/sms/sendInterfaceTemplateSms/T00000001267';
    protected $_accountid = 'T00000001267';
    protected $_apisecret = 'c97dcb10-602d-11e9-898d-7708a1f6d461';

    function send_vcode()
    {
        $mobile = I('post.mobile');
        $type   = I('post.type');
        $code   = randString(6, 1);

        $code_data = [
            'type'   => $type,
            'mobile' => $mobile,
            'code'   => $code,
            'created_time' => time(),
            'updated_time' => time()
        ];
        $Vcode = M('Vcode');
        $Vcode->add($code_data);

        $res = $this->_send_msm($mobile, $code);
        if ($res['success'] == true) {
            echo json_encode(['status' => 1]);
        } else {
            echo json_encode(['status' => 0, 'message' => $res['message']]);
        }
    }

    private function _send_msm($mobile, $code)
    {
        $time = date('YmdHis');
        $authorization = base64_encode($this->_accountid.':'.$time);
        $sig=strtoupper(md5($this->_accountid.$this->_apisecret.$time)); 
        
        $data = [
            "num" => $mobile,
            "templateNum" => "5",
            "var1" => $code 
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
        $return = json_decode($return, true);
        return $return;
    }
}
