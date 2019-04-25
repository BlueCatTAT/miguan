<?php

namespace Admin\Controller;

use Think\Controller;

class AgentController extends RootController {


    public function agent_list()
    {
        $page = $_GET['page'] ? $_GET['page'] : 1;
        $Admin = M('Admin');
        $agent_list = $Admin->where(['type' => 2, 'status' => 1])->order(['id' => 'desc'])->page($page . ',10')->select();
        $this->agent_list = $agent_list;
        
        $count = $Admin->where(['type' => 2, 'status' => 1])->count();
        $this->count = $count;
        $this->page_count = ceil($count / 10);
        $this->page = $page;
        $this->display();
    }

    public function agent_info()
    {
        $Admin = M('Admin');
        $id = I('get.id');
        $agent_info = $Admin->where(['id' => $id])->find();
        $this->agent_info = $agent_info;
        $this->display();
    }

    public function agent_add()
    {
        if ( ! $_POST) {
            $this->display();
        } else {
            $lv = I('post.lv');
            $mobile = I('post.mobile');
            $email = I('post.email');
            $username = I('post.username');
            $qq = I('post.qq');
            $wx = I('post.wx');
            
            $Admin = M('Admin');
            if ($Admin->where(['mobile' => $mobile])->find()) {
                $this->error("手机号重复");
            }
            if ($Admin->where(['username' => $username])->find()) {
                $this->error("用户名重复");
            }
            $agent_data = [
                'type' => 2,
                'lv' => $lv,
                'username' => $username,
                'mobile' => $mobile,
                'password' => md5('888888'),
                'email' => $email,
                'qq' => $qq,
                'wx' => $wx,
                'created_time' => time(),
                'updated_time' => time()
            ];
            $Admin->add($agent_data);
            $this->redirect('/admin/agent/agent_list');
        }
    }

    public function agent_edit()
    {
        $Admin = M('Admin');
        $Product = M('Product');
        $AgentSet = M('AgentSet');
        $product_list = $Product->where(['status' => 1])->select();
        if ( ! $_POST) {
            $id = I('get.id');
            $agent_info = $Admin->where(['id' => $id])->find();
            foreach ($product_list as $k => $v) {
                if ($agent_set_info = $AgentSet->where(['aid' => $id, 'product_id' => $v['id'], 'status' => 1])->find()) {
                    $product_list[$k]['fr'] = $agent_set_info['price'];
                }
            }
            $this->agent_info = $agent_info;
            $this->product_list = $product_list;
            $this->display();
        } else {
            foreach ($product_list as $k => $v) {
                $ks = 'p' . $v['id'];
                if (isset($_POST[$ks]) && $_POST[$ks]) {
                    if ($agent_set_info = $AgentSet->where(['aid' => I('post.id'), 'product_id' => $v['id']])->find()) {
                        $AgentSet->where(['id' => $agent_set_info['id']])->save(['price' => $_POST[$ks]]);
                    } else {
                        $agent_set_data = [
                            'aid' => I('post.id'),
                            'product_id' => $v['id'],
                            'price' => $_POST[$ks],
                            'created_time' => time(),
                            'updated_time' => time()
                        ];
                        $AgentSet->add($agent_set_data);
                    }
                }
            }
            $update_data = [
                'username'     => I('post.username'),
                'mobile'       => I('post.mobile'),
                'email'        => I('post.email'),
                'qq'           => I('post.qq'),
                'wx'           => I('post.wx'),
                'updated_time' => time()
            ];
            $Admin->where(['id' => I('post.id')])->save($update_data);
            $this->redirect('/admin/agent/agent_list');
        }
    }

    public function agent_del()
    {
        $Admin = M('Admin');
        $id = I('get.id');
        $Admin->where(['id' => $id])->save(['status' => 0]);
        $this->redirect('/admin/agent/agent_list');
    }
}
