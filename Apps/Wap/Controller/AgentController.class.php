<?php

namespace Wap\Controller;

use Think\Controller;

class AgentController extends Controller {

    public function index()
    {
        $uid = $this->_check_login();
        
        $Admin = M('Admin');
        $agent_info = $Admin->where(['id' => $uid])->find();

        $this->agent_info = $agent_info;
        $this->display();
    }

    public function reset_password()
    {
        $uid = $this->_check_login();
        $Admin = M('Admin');

        if ( ! $_POST) {
            $this->display();
        } else {
            $password = I('password');
            $repassword = I('repassword');
            if ($password != $repassword) {
                $this->error('两次密码不一致');
            }
            $Admin->where(['id' => $uid])->save(['password' => md5($password)]);
            $this->logout();
        }
    }

    public function order_list()
    {
        $uid = $this->_check_login();
        $Member = M('Member');
        $Order = M('Order');

        $user_list = $Member->where(['aid' => $uid])->select();
        if ($user_list) {
            $uid_list = array_column($user_list, 'id');

            $p = $_GET['p'] ? $_GET['p'] : 1;
            $order_list = $Order->where(['uid' => ['in', $uid_list], 'status' => 2])->order(['id' => 'desc'])->page($p . ',10')->select();
            $count = $Order->where(['uid' => ['in', $uid_list], 'status' => 2])->count();
            $Page = new \Think\Page($count, 10);
            $this->pager = $Page->show();
        }

        $this->order_list = $order_list;
        $this->display();
    }

    public function user_list()
    {
        $uid = $this->_check_login();
        $Member = M('Member');

        $p = $_GET['p'] ? $_GET['p'] : 1;
        $user_list = $Member->where(['aid' => $uid])->order(['id' => 'desc'])->page($p. ',10')->select();
        $count = $Member->where(['aid' => $uid])->count();
        $Page = new \Think\Page($count, 10);
        $this->pager = $Page->show();
        $this->user_list = $user_list;
        $this->display();
    }

    public function card_info()
    {
        $uid = $this->_check_login();
        
        $Card = M('Card');
        $card_info = $Card->where(['uid' => $uid])->find();
        
        if ($_POST) {
            $name = I('post.name');
            $bank_name = I('post.bank_name');
            $card_no = I('post.card_no');
            $address = I('post.address');
            $branch_name = I('branch_name');

            if ($card_info) {
                $save_data = [
                    'name'         => $name,
                    'bank_name'    => $bank_name,
                    'card_no'      => $card_no,
                    'address'      => $address,
                    'branch_name'  => $branch_name,
                    'updated_time' => time()
                ];
                $Card->where(['id' => $card_info['id']])->save($save_data);
                $this->redirect('/agent/card_info');
            } else {
                $card_data = [
                    'uid'          => $uid,
                    'name'         => $name,
                    'bank_name'    => $bank_name,
                    'card_no'      => $card_no,
                    'address'      => $address,
                    'branch_name'  => $branch_name,
                    'status'       => 1,
                    'created_time' => time(),
                    'updated_time' => time()
                ];
                $Card->add($card_data);
            }
        }
        $card_info = $Card->where(['uid' => $uid])->find();

        $this->card_info = $card_info;
        $this->display();
    }

    function login()
    {
        if ( ! $_POST) {
            $this->display();
        } else {
            $uid = agent_login();
            if ($uid) {
                $this->redirect('/agent/index');
            }
            
            $Admin = M('Admin');
            
            $mobile = I('post.mobile');
            $password = I('post.password');

            $admin_info = $Admin->where(['mobile' => $mobile])->find();

            if ( ! $admin_info) {
                $this->error('账户不存在');
            }
            if ($admin_info['password'] !== md5($password)) {
                $this->error('密码错误');
            }
            
            $expire = 3600 * 24 * 365;
            $auth = array(
                'uid'      => $admin_info['id'],
                'username' => $admin_info['username'],
            );

            session('agent_auth', $auth);
            session('agent_auth_sign', data_auth_sign($auth));
            cookie('agent_LOGGED', jiami($auth['uid']), $expire);

            $this->redirect('/agent/index');
        } 
    }
    
    function logout()
    {
        cookie('agent_LOGGED', null);
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
        $this->redirect('/agent/index');
    }

    private function _check_login()
    {
        $uid = agent_login();
        if ( ! $uid) {
            $this->redirect('/agent/login');
        }
        return $uid;
    }
}
