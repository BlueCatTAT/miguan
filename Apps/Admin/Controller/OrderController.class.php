<?php

namespace Admin\Controller;

use Think\Controller;

class OrderController extends RootController {

    protected $_page_size = 20;
    
    public function order_list()
    {
        $Admin = M('Admin');
        $Member = M('Member');
        $Order = M('Order');
        
        $page = $_GET['page'] ? $_GET['page'] : 1;

        $where = ['a.status' => 2];
        if (I('start_time')) {
            $where[] = ['a.updated_time' => ['gt' => strtotime(I('start_time'))]];
            $this->start_time = I('start_time');
        }
        if (I('end_time')) {
            $where[] = ['a.updated_time' => ['lt' => strtotime(I('end_time')) + 3600 * 24]];
            $this->end_time = I('end_time');
        }
        if (I('trade_no')) {
            $where[] = ['a.trade_no' => I('trade_no')];
            $this->trade_no = I('trade_no');
        }
        if (I('aid')) {
            $agent_info = $Admin->where(['id' => I('aid')])->find();
            $agent_list = $Admin->where(['pid' => I('aid')])->select();
            if ($agent_list) {
                $aid_list = array_column($agent_list, 'id');
                $aid_list[] = I('aid');
                $user_list = $Member->where(['aid' => ['in', $aid_list]])->select();
            } else {
                $user_list = $Member->where(['aid' => I('aid')])->select();
            }
            $uid_list = array_column($user_list, 'id');
            $where[] = ['a.uid' => ['in' => $uid_list]];
            $this->aid = I('aid');
        }

        $agent_list = $Admin->where(['lv' => 1, 'status' => 1])->select();
        $this->agent_list = $agent_list;

        $total_fee = $Order->table('t_order a')
                    ->field('a.*, b.nickname')
                    ->join('t_member b on a.uid = b.id')
                    ->where($where)
                    ->sum('a.fee');
        $this->total_fee = $total_fee;

        $order_list = $Order->table('t_order a')
            ->field('a.*, b.nickname')
            ->join('t_member b on a.uid = b.id')
            ->where($where)
            ->order(['a.id' => 'desc'])
            ->page($page . ',10')
            ->select();
        $this->order_list = $order_list;

        $count = $Order->where($where)->count();

        $this->count = $count;
        $this->page_count = ceil($count / 10);
        $this->page = $page;

        $this->display();
    }
}
