<?php

namespace Web\Controller;

use Think\Controller;

class ProductController extends RootController {
    protected $_notify   = 'http://www.baidu.com/wap/pay/notify';
    
    protected function _initialize() 
    {
        parent::_initialize();
        $this->action = 'product';
    }
    
    function info() {
        $id = I('get.id');
        $product_info = M('Product')->where(['id' => $id])->find(); 

        $this->product_info = $product_info;
        
        $this->display();
    }

    function buy_info()
    {
        $id = I('get.id');
        $product_info = M('Product')->where(['id' => $id])->find(); 

        $this->product_info = $product_info;
        
        $this->display();
    }

    function category()
    {
        $category_list = M('Category')->select();

        $this->category_list = $category_list;
        $this->display();
    }
    
    function ajax_create_order()
    {
        $uid = is_login();
        
        $product_id  = I('post.product_id');
        $pay_type = I('post.pay_type');

        $Member = M('Member');
        $Product = M('Product');

        $user_info = $Member->where(['id' => $uid])->find();
        $product_info = $Product->where(['id' => $product_id])->find();
        $tradeno = date('YmdHis', time()) . rand(1000, 9999);
        list($tradeno, $total_fee) = $this->_make_order($product_id, $uid, 1);

        import("Web.Util.pay.RequestHandler");
        import("Web.Util.pay.ClientResponseHandler");
        import("Web.Util.pay.PayHttpClient");
        import("Web.Util.pay.Utils");

        $this->resHandler = new \ClientResponseHandler();
        $this->reqHandler = new \RequestHandler();
        $this->pay = new \PayHttpClient();
        $uitls = new \Utils();

        $this->reqHandler->setKey('2c4b25becf270bbc377a79ab7cde3b52');
        $this->reqHandler->setReqParams($_POST,array('method'));
        if ($pay_type == 1) {
            //$this->reqHandler->setParameter('service','pay.weixin.jspay');
        } else {
            $this->reqHandler->setParameter('service','pay.alipay.native');
        }
        //$this->reqHandler->setParameter('is_raw','1');
        //$this->reqHandler->setParameter('sub_openid', $user_info['openid']);
        $this->reqHandler->setParameter('mch_id', 105500109418);
        $this->reqHandler->setParameter('version', '1.0');
        $this->reqHandler->setParameter('sign_type', 'MD5');
        $this->reqHandler->setParameter('notify_url', $this->_notify);
        $this->reqHandler->setParameter('nonce_str',mt_rand(time(),time()+rand()));
        $this->reqHandler->setParameter('body', $product_info['title']);
        $this->reqHandler->setParameter('mch_create_ip', get_client_ip());
        $this->reqHandler->setParameter('total_fee', $total_fee);
        $this->reqHandler->setParameter('out_trade_no', $tradeno);
        $this->reqHandler->createSign();
        $data = $uitls::toXml($this->reqHandler->getAllParameters());
        $this->pay->setReqContent($this->reqHandler->getGateURL(),$data);
        if($this->pay->call()){
            $this->resHandler->setContent($this->pay->getResContent());
            $this->resHandler->setKey($this->reqHandler->getKey());
            if($this->resHandler->isTenpaySign()){
                if($this->resHandler->getParameter('status') == 0 && $this->resHandler->getParameter('result_code') == 0){
                    if ($pay_type == 1) {
                        $token_id = $this->resHandler->getParameter('token_id');
                        $pay_info = $this->resHandler->getParameter('pay_info');
                        $res = [
                            'token_id' => $token_id,
                            'pay_info' => $pay_info
                        ];
                        echo json_encode($res);
                        exit;
                    } else {
                        $code_img_url = $this->resHandler->getParameter('code_img_url');
                        $code_url = $this->resHandler->getParameter('code_url');
                        $res = [
                            'status' => 1,
                            'code_img_url' => $code_img_url,
                            'code_url' => $code_url
                        ];
                        echo json_encode($res);
                        exit;
                    }
                }else{
                    $res = [
                        'status' => -2,
                        'msg'    => '系统错误 -1',
                        'err_code' => $this->resHandler->getParameter('err_code'),
                        'err_msg'  => $this->resHandler->getParameter('err_msg') 
                    ];
                    echo json_encode($res);
                    exit;
                }
            }
            $res = [
                'status' => -2,
                'msg'    => '系统错误 -2',
                'err_code' => $this->resHandler->getParameter('status'),
                'err_msg'  => $this->resHandler->getParameter('message') 
            ];
            echo json_encode($res);
            exit;
        }else{
            $res = [
                'status' => -2,
                'msg'    => '系统错误 -3',
                'err_code' => $this->pay->getResponseCode(),
                'err_msg'  => $this->pay->getErrInfo() 
            ];
            echo json_encode($res);
            exit;
        }
    }

    private function _make_order($product_id, $uid, $num)
    {
        $Order = M('Order');
        $tradeno = date('YmdHis', time()) . rand(1000, 9999);

        $total_price = $num * 1;
        //$total_price = $num * 50;

        $time = time();
        $data = [
            'tradeno'  => $tradeno,
            'uid'      => $uid,
            'product_id'  => $product_id,
            'num'         => $num,
            'total_price' => $total_price,
            'addtime'     => $time,
            'updtime'     => $time
        ];
        if ($Order->add($data)) {
            return [$tradeno, $total_price];
        } else {
            return false;
        }
    }
}
