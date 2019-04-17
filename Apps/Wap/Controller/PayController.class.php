<?php

namespace Wap\Controller;

use Think\Controller;

class PayController extends Controller {

    function index() {
        $this->display();
    }

    function make_order()
    {
        $uid = is_login();
        if ( ! $uid) {
            $this->redirect('/user/index');
        }

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

        $this->display();
    }

    function callback()
    {
        $post = json_encode($_POST).PHP_EOL;
        $get = json_encode($_GET).PHP_EOL;
        file_put_contents('callback.log', $post, FILE_APPEND);
        file_put_contents('callback.log', $get, FILE_APPEND);
    }

    function notify_url()
    {
        $res = file_get_contents('php://input');
        file_put_contents('notify.log', $res, FILE_APPEND);
        
        libxml_disable_entity_loader(true);
        $res = simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA);
        $res = json_encode($res);
        $res = json_decode($res, true);

        if ($res['result_code'] == 'SUCCESS' && $res['return_code'] == 'SUCCESS') {
            $trade_no = $res['out_trade_no'];
            $Order = M('Order');
            $Member = M('Member');
            $order_info = $Order->where(['trade_no' => $trade_no])->find();
            if ($order_info['status'] == 1) {
                $Order->where(['id' => $order_info['id']])->save(['status' => 2]); 
                $Member->where(['id' => $order_info['uid']])->setInc('balance');
            }

            $return = [
                'return_code' => 'SUCCESS',
                'return_msg' => 'OK'
            ];
            echo $this->_toXml($return);
        }
    }
    
    private function _toXml($array){
        $xml = '';
        foreach($array as $k=>$v){
            //$xml.='<'.$k.'><![CDATA['.$v.']]></'.$k.'>';
            $xml.='<'.$k.'>'.$v.'</'.$k.'>';
        }
        return $xml;
    }
}
