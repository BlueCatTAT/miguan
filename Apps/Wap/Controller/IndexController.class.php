<?php

namespace Wap\Controller;

use Think\Controller;

class IndexController extends Controller {

    public function _empty() {
        $this->index();
    }

    function index() {
        $this->current = 'home';
        $Order = M('Order');
        $order_list1 = $Order->table('t_order a')->field('a.*, b.username')->join('left join t_member b on a.uid = b.id')->where(['a.status' => 1])->order('a.id desc')->limit(10)->select();
        $order_list2 = $Order->table('t_order a')->field('a.*, b.username')->join('left join t_member b on a.uid = b.id')->where(['a.status' => 1])->order('a.volume desc')->limit(10)->select();
        $this->order_list1 = $order_list1;
        $this->order_list2 = $order_list2;
        $this->display();
    }
}
