<?php

namespace Api\Controller;

use Think\Controller;

class IpsController extends RootController {
    
    protected $mchId = '210314';
    protected $merAcctNo = '2103140014';

    protected $key = 'DXhYWTFJStEXKpVFFWq526jL';
    protected $iv = 'Hdp1A0St';

    protected $deskey = "DXhYWTFJStEXKpVFFWq526jL";
    protected $desiv ="Hdp1A0St";
    protected $MerCret="Cj2qxxoMqmeWD4sg9lgxjeuX7s8cTH8P669Tou4yom00jWJ1OhPQeO2l1tyyWDno9V5BkZ9tOowyVm75WMlLdzQ3d5bNmrWgjRh2FcGzB7qgdTFQxyNt7gG2dXOQUSw1";
    
    protected function _initialize() 
    {
        parent::_initialize();
    }

    public function payment()
    {
        $res = [
            'errno' => 0,
            'msg'   => ''
        ];
        if (empty($_POST)) {
            $res['errno'] = 1001;
            $res['msg'] = 'post data empty error';
            echo json_encode($res);exit;
        }
        if ( ! I('post.MerBillNo')) {
            $res['errno'] = 1002;
            $res['msg'] = 'MerbillNo error';
            echo json_encode($res);exit;
        }
        if ( ! I('post.Amount')) {
            $res['errno'] = 1003;
            $res['msg'] = 'Amount error';
            echo json_encode($res);exit;
        }
        if ( ! I('post.CMerchanturl')) {
            $res['errno'] = 1004;
            $res['msg'] = 'CMerchanturl error';
            echo json_encode($res);exit;
        }
        if ( ! I('post.CFailUrl')) {
            $res['errno'] = 1005;
            $res['msg'] = 'CFailUrl error';
            echo json_encode($res);exit;
        }
        if ( ! I('post.Attach')) {
            $res['errno'] = 1006;
            $res['msg'] = 'Attach error';
            echo json_encode($res);exit;
        }
        if ( ! I('post.CServerUrl')) {
            $res['errno'] = 1007;
            $res['msg'] = 'CServerUrl error';
            echo json_encode($res);exit;
        }
        if ( ! I('post.GoodsName')) {
            $res['errno'] = 1008;
            $res['msg'] = 'GoodsName error';
            echo json_encode($res);exit;
        }
        $Account = M('AccountEbp');
        if ( ! $account_info = $Account->where(['customerCode' => I('post.Attach')])->find()) {
            $res['errno'] = 1009;
            $res['msg'] = 'Attach not exist';
            echo json_encode($res);exit;
        }
        
        $Cost = I('post.Amount') / 1000 * $account_info['rate'];
        if (I('post.Amount') < 5) {
            $res['errno'] = 1010;
            $res['msg'] = 'Amount 低于最低金额';
            echo json_encode($res);exit;
        }

        $body = [
            'MerBillNo' => I('post.MerBillNo'),
            'GatewayType' => '01',
            'Date' => date('Ymd'),
            'CurrencyType' => '156',
            'Amount' => I('post.Amount'),
            'Merchanturl' => 'http://www.tnwls.top/api/ips/callback',
            'FailUrl' => 'http://www.tnwls.top/api/ips/failback',
            'Attach' => I('post.Attach'),
            'OrderEncodeType' => '5',
            'RetEncodeType' => '17',
            'RetType' => '1',
            'ServerUrl' => 'http://www.tnwls.top/api/ips/notify',
            'GoodsName' => I('post.GoodsName'),
            //'IsCredit' => '1',
            //'BankCode' => '',
            //'ProductType' => '1',
        ];

        $order_info = $body;
        $order_info['MainMerbillNo'] = date('YmdHis', time()) . rand(1000, 9999);
        $order_info['CMerchanturl'] = I('post.CMerchanturl'); 
        $order_info['CFailUrl'] = I('post.CFailUrl');
        $order_info['CServerUrl'] = I('post.CServerUrl');
        $order_info['status'] = 0;
        $order_info['create_time'] = time();
        $order_info['pay_time'] = 0;
        $order_info['Rate'] = $account_info['rate'];
        $order_info['Cost'] = round($Cost, 2);
        $order_info['ValidAmount'] = I('post.Amount') - round($Cost, 2); 

        $OrderEbp = M('OrderEbp');
        $OrderEbp->add($order_info);
        
        $body_xml = $this->_toXml($body);
        $body_xml = '<body>' . $body_xml . '</body>';
        $signature = md5($body_xml.$this->mchId.$this->MerCret);
        $head = [
            'Version' => 'V1.0.1',
            'MerCode' => $this->mchId,
            'Account' => $this->merAcctNo, 
            'ReqDate' => date('YmdHis'),
            'Signature' => $signature
        ];
        $head_xml = $this->_toXml($head); 
        $head_xml = '<head>' . $head_xml . '</head>';

        $post_data = '<Ips><GateWayReq>' . $head_xml . $body_xml . '</GateWayReq></Ips>';

        $this->post_data = $post_data;
        $this->display();
    }
    
    private function _toXml($array){
        $xml = '';
        foreach($array as $k=>$v){
            //$xml.='<'.$k.'><![CDATA['.$v.']]></'.$k.'>';
            $xml.='<'.$k.'>'.$v.'</'.$k.'>';
        }
        return $xml;
    }

    public function _bank_list()
    {
        return [['code' => '1100', 'name' => '工商银行'],
            ['code' => '1101', 'name' => '农业银行'],
            ['code' => '1102', 'name' => '招商银行'],
            ['code' => '1103', 'name' => '兴业银行'],
            ['code' => '1104', 'name' => '中信银行'],
            ['code' => '1107', 'name' => '中国银行'],
            ['code' => '1108', 'name' => '交通银行'],
            ['code' => '1109', 'name' => '浦发银行'],
            ['code' => '1110', 'name' => '民生银行'],
            ['code' => '1111', 'name' => '华夏银行'],
            ['code' => '1112', 'name' => '光大银行'],
            ['code' => '1113', 'name' => '北京银行'],
            ['code' => '1114', 'name' => '广发银行'],
            ['code' => '1115', 'name' => '南京银行'],
            ['code' => '1116', 'name' => '上海银行'],
            ['code' => '1117', 'name' => '杭州银行'],
            ['code' => '1118', 'name' => '宁波银行'],
            ['code' => '1119', 'name' => '邮储银行'],
            ['code' => '1120', 'name' => '浙商银行'],
            ['code' => '1121', 'name' => '平安银行'],
            ['code' => '1122', 'name' => '东亚银行'],
            ['code' => '1123', 'name' => '渤海银行'],
            ['code' => '1124', 'name' => '北京农商行'],
            ['code' => '1127', 'name' => '浙江泰隆商业银行'],
            ['code' => '1106', 'name' => '中国建设银行'],
        ];
    }

    public function callback()
    {
        $post = json_encode($_POST);
        $get = json_encode($_GET);
        file_put_contents('callback_post.log', $post, FILE_APPEND);
        file_put_contents('callback_get.log', $get, FILE_APPEND);
        
        $paymentResult = $_POST['paymentResult'];

        $source_data = $paymentResult;

        libxml_disable_entity_loader(true);
        $paymentResult = simplexml_load_string($paymentResult, 'SimpleXMLElement', LIBXML_NOCDATA);
        $paymentResult = json_encode($paymentResult);
        $paymentResult = json_decode($paymentResult, true);

        $MerBillNo = $paymentResult['GateWayRsp']['body']['MerBillNo'];
        $Attach = $paymentResult['GateWayRsp']['body']['Attach'];

        $OrderEbp = M('OrderEbp')->where(['Attach' => $Attach, 'MerBillNo' => $MerBillNo])->find();

        $status = $paymentResult['GateWayRsp']['body']['Status'];
        if ($status == 'Y' && $OrderEbp['status'] == 0) {
            M('OrderEbp')->where(['Attach' => $Attach, 'MerBillNo' => $MerBillNo])->save(['status' => 1, 'pay_time' => time()]);
        }

        $url = $OrderEbp['CMerchanturl'];

        $sHtml = "<form id='submit' name='submit' action='".$url."' method='post'>";
        $sHtml.= "<input type='hidden' name='paymentResult' value='".$source_data."'/>";
        $sHtml.= "</form>";
        $sHtml.= "<script>document.forms['submit'].submit();</script>";

        echo $sHtml;
    }

    public function failback()
    {
        $post = json_encode($_POST).PHP_EOL;
        $get = json_encode($_GET).PHP_EOL;
        file_put_contents('failback.log', $post, FILE_APPEND);
        file_put_contents('failback.log', $get, FILE_APPEND);
        
        $paymentResult = $_POST['paymentResult'];
        libxml_disable_entity_loader(true);
        $paymentResult = simplexml_load_string($paymentResult, 'SimpleXMLElement', LIBXML_NOCDATA);
        $paymentResult = json_encode($paymentResult);
        $paymentResult = json_decode($paymentResult, true);

        $MerBillNo = $paymentResult['GateWayRsp']['body']['MerBillNo'];
        $Attach = $paymentResult['GateWayRsp']['body']['Attach'];

        $OrderEbp = M('OrderEbp')->where(['Attach' => $Attach, 'MerBillNo' => $MerBillNo])->find();


        $url = $OrderEbp['CFailUrl'];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        $log_info = [ 
            'url'        => $url,
            'post_data'  => $_POST,
            'res'        => $res,
            'errno'      => curl_errno($ch), 
            'res_info'   => curl_getinfo($ch)
        ];
        curl_close($ch);
        
        file_put_contents('failback_rpc.log', json_encode($log_info).PHP_EOL, FILE_APPEND);
    }

    public function notify()
    {
        $post = json_encode($_POST).PHP_EOL;
        $get = json_encode($_GET).PHP_EOL;
        file_put_contents('notify_post.log', $post, FILE_APPEND);
        file_put_contents('notify_get.log', $get, FILE_APPEND);
        
        $paymentResult = $_POST['paymentResult'];
        libxml_disable_entity_loader(true);
        $paymentResult = simplexml_load_string($paymentResult, 'SimpleXMLElement', LIBXML_NOCDATA);
        $paymentResult = json_encode($paymentResult);
        $paymentResult = json_decode($paymentResult, true);

        $MerBillNo = $paymentResult['GateWayRsp']['body']['MerBillNo'];
        $Attach = $paymentResult['GateWayRsp']['body']['Attach'];

        $OrderEbp = M('OrderEbp')->where(['Attach' => $Attach, 'MerBillNo' => $MerBillNo])->find();
        
        $status = $paymentResult['GateWayRsp']['body']['Status'];
        if ($status == 'Y' && $OrderEbp['status'] == 0) {
            M('OrderEbp')->where(['Attach' => $Attach, 'MerBillNo' => $MerBillNo])->save(['status' => 1, 'pay_time' => time()]);
        }

        $url = $OrderEbp['CServerUrl'];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        $log_info = [ 
            'url'        => $url,
            'post_data'  => $_POST,
            'res'        => $res,
            'errno'      => curl_errno($ch), 
            'res_info'   => curl_getinfo($ch)
        ];
        curl_close($ch);
        file_put_contents('notify_rpc.log', json_encode($log_info) . PHP_EOL, FILE_APPEND);
    }

    public function withdraw_callback()
    {
        $post = json_encode($_POST).PHP_EOL;
        $get = json_encode($_GET).PHP_EOL;
        file_put_contents('withdraw_callback_post.log', $post, FILE_APPEND);
        file_put_contents('withdraw_callback_get.log', $get, FILE_APPEND);

        $res = $_POST['ipsResponse'];
        libxml_disable_entity_loader(true);
        $res = simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA);
        $res = json_encode($res);
        $res = json_decode($res, true);
        
        $para = $res['p3DesXmlPara'];
        $para = $this->decrypt($para);
        
        $para = simplexml_load_string($para, 'SimpleXMLElement', LIBXML_NOCDATA);
        $para = json_encode($para);
        $para = json_decode($para, true);

        $log = [
            'ipsBillNo'    => $para['body']['ipsBillNo'],
            'merBillNo'    => $para['body']['merBillNo'],
            'customerCode' => $para['body']['customerCode'],
            'amount'       => $para['body']['amount'],
            'tradeState'   => $para['body']['tradeState'],
            'create_time'  => time()
        ];

        M('WithdrawEbpLog')->add($log);
    }

    public function withdraw_notify()
    {
        $post = json_encode($_POST).PHP_EOL;
        $get = json_encode($_GET).PHP_EOL;
        file_put_contents('withdraw_notify_post.log', $post, FILE_APPEND);
        file_put_contents('withdraw_notify_get.log', $get, FILE_APPEND);
        
        $res = $_POST['ipsResponse'];
        libxml_disable_entity_loader(true);
        $res = simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA);
        $res = json_encode($res);
        $res = json_decode($res, true);
        
        $para = $res['p3DesXmlPara'];
        $para = $this->decrypt($para);
        
        $para = simplexml_load_string($para, 'SimpleXMLElement', LIBXML_NOCDATA);
        $para = json_encode($para);
        $para = json_decode($para, true);

        if ($log_info = M('WithdrawEbpLog')->where(['merBillNo' => $para['body']['merBillNo']])->find()) {
            if ($log_info['tradeState'] != $para['body']['tradeState']) {
                $update_data = [
                    'tradeState' => $para['body']['tradeState']
                ]; 
                M('WithdrawEbpLog')->where(['merBillNo' => $para['body']['merBillNo']])->save($update_data);
            } 
        }
    }

    public function account_add_callback()
    {
        echo "<pre>";
        var_dump($_POST, $_GET);
        echo "</pre>";
    }

    public function account_add_notify()
    {
        file_put_contents('open_notify_post.log', $post . PHP_EOL, FILE_APPEND);
        file_put_contents('open_notify_get.log', $get . PHP_EOL, FILE_APPEND);

        $res = $_POST['ipsResponse'];
        libxml_disable_entity_loader(true);
        $res = simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA);
        $res = json_encode($res);
        $res = json_decode($res, true);

        $para = $res['p3DesXmlPara'];
        $para = $this->decrypt($para);
        
        $para = simplexml_load_string($para, 'SimpleXMLElement', LIBXML_NOCDATA);
        $para = json_encode($para);
        $para = json_decode($para, true);
    }

    function decrypt($encrypted){//Êý¾Ý½âÃÜ
        $encrypted = base64_decode($encrypted);
        $key = str_pad($this->key,24,'0');
        $td = mcrypt_module_open(MCRYPT_3DES,'',MCRYPT_MODE_CBC,'');
        $iv = $this->iv;
        $ks = mcrypt_enc_get_key_size($td);
        @mcrypt_generic_init($td, $key, $iv);
        $decrypted = mdecrypt_generic($td, $encrypted);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $y=$this->pkcs5_unpad($decrypted);
        return $y;
    }
    function pkcs5_unpad($text){
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad){
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }
}
