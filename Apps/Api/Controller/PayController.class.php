<?php

namespace Api\Controller;

use Think\Controller;

class PayController extends RootController {
    //畅捷商户号
    protected $_chanpay_mch_id = '';
    protected $_chanpay_seller_id = '';
    protected $_chanpay_notify_url = 'http://www.payment.com/api/pay/notify';

    protected function _initialize() 
    {
        parent::_initialize();
    }

    public function gateway()
    {
        $post_data = file_get_contents('php://input');
        $post_data = json_decode($post_data, true);

        $this->_check_params($post_data); 
        $this->_check_sign($post_data);
        
        //验证渠道合法性 
        $Account = M('Account');  
        $mch_id = $post_data['mch_id'];
        $account_info = $Account->where(['mch_id' => $mch_id])->find();
        if ( ! $account_info) {
            echo json_encode(['status' => 1005, 'msg' => '商户号不存在']);
            exit;
        }
        $AccountTrade = M('AccountTrade');
        $account_trade_info = $AccountTrade->where(['aid' => $account_info['id'], 'type' => $post_data['service'], 'status' => 1])->find();
        if ( ! $account_trade_info) {
            echo json_encode(['status' => 1100, 'msg' => '该渠道未授权']);
            exit;
        }
        
        //通用字段
        $order_data = [
            'service'       => $post_data['service'],
            'mch_id'        => $post_data['mch_id'],
            'trade'         => $post_data['trade'],
            'trade_no'      => date('YmdHis', time()) . rand(1000, 9999),
            'out_trade_no'  => $post_data['out_trade_no'],
            'body'          => $post_data['body'],
            'total_fee'     => (int) $post_data['total_fee'],
            'notify_url'    => (int) $post_data['notify_url'],
            //'mch_create_ip' => I('post.mch_create_ip'),
            //'nonce_str'     => I('post.nonce_str'),
            //非必填    
            'version'     => (string) $post_data['version'],
            'charset'     => (string) $post_data['charset'],
            'sign_type'   => (string) $post_data['sign_type'],
            //'device_info' => I('post.device_info'),
            //'attach'      => I('post.attach'),
            //'time_start'  => I('post.time_start'),
            //'time_expire' => I('post.time_expire'),
        ];
        //chanpay银行卡
        $order_data['return_url'] = $post_data['return_url'];
        $order_data['user_id'] = $post_data['user_id'];
        $order_data['card_type'] = $post_data['card_type']; //卡类型 00 –银行贷记账户;01 –银行借记账户;
        $order_data['card_no'] = $post_data['card_no'];
        $order_data['id_type'] = $post_data['id_type']; //证件类型 01身份证
        $order_data['id_no'] = $post_data['id_no']; //证件号
        $order_data['card_user_name'] = $post_data['card_user_name']; //持卡人姓名
        $order_data['card_user_mobile'] = $post_data['card_user_mobile']; //持卡人手机号
        if ($order_data['card_type'] == '00') {
            $order_data['card_cvn2'] = (string) $post_data['card_cvn2']; //CVV2码，当卡类型为信用卡时必填
            $order_data['card_expire'] = (string) $post_data['card_expire']; //信用卡过期时间
        }

        $Order = M('Order');
        $order_id = $Order->add($order_data);
        //chanpay
        if ($order_data['service'] == 'chanpay.bank') {
            $this->_chanpay($order_data);
        }
    }

    private function _check_params()
    {
        return true; 
    }

    private function _check_sign($post_data)
    {
        $Account = M('Account');  
        $mch_id = $post_data['mch_id'];
        $account_info = $Account->where(['mch_id' => $mch_id])->find();
        if ( ! $account_info) {
            echo json_encode(['status' => 1005, 'msg' => '商户号不存在']);
            exit;
        }
        if ($account_info['status'] != 1) {
            echo json_encode(['status' => 1006, 'msg' => '商户号被封禁']);
            exit;
        }

        $post_sign = $post_data['sign'];
        unset($post_data['sign']);
        $sign = $this->createSign($post_data, $account_info['secret_key']);
        if ($sign !== $post_sign) {
            echo json_encode(['status' => 1100, 'msg' => '签名错误']);
            exit;
        }

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


    private function _chanpay($order_data)
    {
        $postData = array();
        // 基本参数
        $postData['Service'] = 'nmg_zft_api_quick_payment';
        $postData['Version'] = '1.0';
        $postData['PartnerId'] = $this->_chanpay_mch_id;//商户号
        $postData['InputCharset'] = 'UTF-8';
        $postData['TradeDate'] = date('Ymd').'';
        $postData['TradeTime'] = date('His').'';
        $postData['ReturnUrl'] = $order_data['return_url'];// 前台跳转url
        $postData['Memo'] = '备注';
        // 4.4.2.7. 直接支付请求接口（API） 业务参数
        $postData['TrxId'] = time(); //外部流水号
        $postData['SellerId'] =   $this->_chanpay_seller_id; //商户编号，调用畅捷子账户开通接口获取的子账户编号;该字段可以传入平台id或者平台id下的子账户号;作为收款方使用；与鉴权请求接口中MerchantNo保持一致
        $postData['SubMerchantNo'] =   ''; //子商户，在畅捷商户自助平台申请开通的子商户，用于自动结算
        $postData['ExpiredTime'] =   '90m'; //订单有效期，取值范围：1m～48h。单位为分，如1.5h，可转换为90m。用来标识本次鉴权订单有效时间，超过该期限则该笔订单作废
        $postData['MerUserId'] =   $order_data['user_id']; //用户标识
        $postData['BkAcctTp'] =   $order_data['card_type']; //卡类型（00 –银行贷记账户;01 –银行借记账户;）
        $postData['BkAcctNo'] =   $this->rsaEncrypt($order_data['card_no']); //卡号
        $postData['IDTp'] =   $order_data['id_type']; //证件类型，01：身份证
        $postData['IDNo'] =   $this->rsaEncrypt($order_data['id_no']); //证件号
        $postData['CstmrNm'] =   $this->rsaEncrypt($order_data['card_user_name']); //持卡人姓名
        $postData['MobNo'] =   $this->rsaEncrypt($order_data['card_user_mobile']); //银行预留手机号
        $postData['CardCvn2'] =   $this->rsaEncrypt($order_data['card_cvn2']); //CVV2码，当卡类型为信用卡时必填
        $postData['CardExprDt'] =   $this->rsaEncrypt($order_data['card_expire']); //有效期，当卡类型为信用卡时必填
        $postData['TradeType'] =   '11'; //交易类型（即时 11 担保 12）
        $postData['TrxAmt'] =   $order_data['total_fee']/100; //交易金额
        $postData['EnsureAmount'] =   ''; //担保金额
        $postData['OrdrName'] =   $order_data['body']; //商品名称
        $postData['OrdrDesc'] =   ''; //商品详情
        $postData['RoyaltyParameters'] = '';      //"[{'userId':'13890009900','PID':'2','account_type':'101','amount':'100.00'},{'userId':'13890009900','PID':'2','account_type':'101','amount':'100.00'}]"; //退款分润账号集
        $postData['NotifyUrl'] = $this->_chanpay_notify_url;//异步通知地址
        $postData['Extension'] = '';//扩展字段
        $postData['Sign'] = $this->rsaSign($postData);
        $postData['SignType'] = 'RSA'; //签名类型
        $query = http_build_query       ($postData);
        $url = 'https://pay.chanpay.com/mag-unify/gateway/receiveOrder.do?'. $query; //该url为生产环境url
        $jsonstr = $this->httpGet_a($url);
        echo "<pre>";
        var_dump($jsonstr);
        echo "</pre>";exit;
        $json = json_decode($jsonstr);
        echo $jsonstr; 
    }

    function rsaSign($args) {
        $args=array_filter($args);//过滤掉空值
        ksort($args);
        $query  =   '';
        foreach($args as $k=>$v){
            if($k=='SignType'){
                continue;
            }
            if($query){
                $query  .=  '&'.$k.'='.$v;
            }else{
                $query  =  $k.'='.$v;
            }
        }
        //这地方不能用 http_build_query  否则会urlencode
        //$query=http_build_query($args);
        $path   =   "./rsa_private_key.pem"; 
        $private_key= file_get_contents($path);
        $pkeyid = openssl_get_privatekey($private_key);
        openssl_sign($query, $sign, $pkeyid);
        openssl_free_key($pkeyid);
        $sign = base64_encode($sign);
        return $sign;
    }

    function rsaEncrypt($content){
        $public_key_path   =   "./rsa_public_key.pem";  //公钥地址 
        $pubKey = file_get_contents($public_key_path);
        $res = openssl_get_publickey($pubKey);
        //把需要加密的内容，按128位拆开解密
        $result  = '';
        for($i = 0; $i < strlen($content)/128; $i++  ) {
            $data = substr($content, $i * 128, 128);
            openssl_public_encrypt ($data, $encrypt, $res);
            $result .= $encrypt;
        }
        $result = base64_encode($result);
        openssl_free_key($res);
        return $result;
    }

    function httpGet_a($order_url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $order_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        return $json;
    }
}
