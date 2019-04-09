<?php

namespace Admin\Controller;

use Think\Controller;

class OrderController extends RootController {

    protected $_page_size = 20;
    
    public function order_list()
    {
        $Order = M('Order');
        $order_list = $Order->where(['uid' => $this->_curren_user['id'], 'status' => 1])->order(['id' => 'desc'])->select();
        $this->order_list = $order_list;
        $this->display();
    }
}
