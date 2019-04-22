<?php

namespace Admin\Controller;

use Think\Controller;

class AgentController extends RootController {


    public function agent_list()
    {
        $Admin = M('Admin');
        $agent_list = $Admin->where(['type' => 2, 'status' => 1])->select();
        $this->agent_list = $agent_list;
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
        if ( ! $_POST) {
            $id = I('get.id');
            $agent_info = $
            $this->agent_info = $agent_info;
            $this->display();
        } else {
            $update_data = [
                'lv'           => I('post.lv'),
                'username'     => I('post.username'),
                'mobile'       => I('post.mobile'),
                'email'        => I('post.email'),
                'qq'           => I('post.qq'),
                'wx'           => I('post.wx'),
                'updated_time' => time()
            ];
            $Admin->where(['id' => I('post.id')])->save($update_data);
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
