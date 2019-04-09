<?php

namespace Web\Controller;

use Think\Controller;

class OrderController extends RootController {

    protected $_mch_id = '963125';
    protected $_secret_key = 'CBWMKAIazukqFBqZRFPbFbKYLFxomzkJ';

    protected $_service = 'chanpay.bank';

    protected $_notify_url = '';
        

    function create_order()
    {
        $post_data = [
            'service' => $this->_service,
            'mch_id'  => $this->_mch_id,
            'out_trade_no' => date('YmdHis', time()) . rand(1000, 9999),
            'body'         => 'body_c',
            'total_fee'    => 1,
            'notify_url'   => $this->_notify_url,
            'return_url'   => 'http://return',
            'user_id'      => 13,
            'card_type'    => '01',
            'card_no'      => '',
            'id_type'      => '01',
            'id_no'        => '',
            'card_user_name'   => '',
            'card_user_mobile' => '' 
        ]; 
        $post_data['sign'] = $this->createSign($post_data, $this->_secret_key);

        $gate_url = 'http://www.payment.com/api/pay/gateway.html';
        $res = $this->http_request($gate_url, json_encode($post_data));
        echo "<pre>";
        var_dump($gate_url, $res, $post_data, json_encode($post_data));
        echo "</pre>";
    }

    function createSign($post_data, $secret_key) {
        $signPars = "";
        ksort($post_data);
        foreach($post_data as $k => $v) {
            if("" != $v && "sign" != $k) {
                $signPars .= $k . "=" . $v . "&";
            }
        }
        $signPars .= "key=" . $secret_key;
        $sign = strtoupper(md5($signPars));
        return $sign;
    }


    function http_request($url, $data = null)  
    {  
        $curl = curl_init();  
        curl_setopt($curl, CURLOPT_URL, $url);  
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  
        if ( ! empty($data)) {  
            curl_setopt($curl, CURLOPT_POST, 1);  
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);  
        }  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);  
        $output = curl_exec($curl);  
        curl_close($curl);  
        return $output;  
    }
}
