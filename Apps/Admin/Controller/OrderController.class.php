<?php

namespace Admin\Controller;

use Think\Controller;

class OrderController extends RootController {

    protected $_page_size = 20;
    
    public function order_list()
    {
        $page = $_GET['page'] ? $_GET['page'] : 1;
        
        $Order = M('Order');
        $order_list = $Order->table('t_order a')
            ->field('a.*, b.nickname')
            ->join('t_member b on a.uid = b.id')
            ->where(['a.status' => 2])
            ->order(['a.id' => 'desc'])
            ->page($p . ',10')
            ->select();
        $this->order_list = $order_list;

        $count = $Order->where(['status' => 2])->count();

        $this->count = $count;
        $this->page_count = ceil($count / 10);
        $this->page = $page

        $this->display();
    }
}
