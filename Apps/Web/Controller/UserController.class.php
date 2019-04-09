<?php

namespace Web\Controller;

use Think\Controller;

class UserController extends RootController {

    protected function _initialize() 
    {
        parent::_initialize();
        $this->action = 'user';
        define('UID', is_login());
        //if ( ! UID) {// 还没登录 跳转到登录页面
            //$this->redirect('wap/public/login');
        //}
    }

    function index()
    {
        if (UID) {
            $Order = M('Order');

            $user_info = M('Member')->where(['id' => UID])->find();
            $this->user_info = $user_info;
            $this->display(); 
        } else {
            $this->redirect('/user/login');
        }
    }

    function yq()
    {
        $this->action = 'yq';
        $this->display();
    }

    function reg()
    {
        if (IS_POST) {
            $Member = M('Member');
            $data = [
                'username'  => I('post.username'),
                'email'     => I('post.email'),
                'password'  => I('post.password'),
            ];
            if ($Member->add($data)) {
                $this->_auto_login($mobile);
                $this->redirect('/user/index');
            }
        } else {
            $this->display();
        }
    }
    
    function login()
    {
        if (IS_POST) {
            $Member = M('Member');
            $username = I('post.username');
            $password = I('post.password');
            if ($this->_auto_login($username, $password)) {
                $this->redirect('/user/index');
            } else {
                echo '密码错误';
            }
        } else {
            $this->display();
        }
    }

    private function _auto_login($username, $password)
    {
        $Member = M('Member');
        $user = $Member->where(['username' => $username, 'password' => $password, 'status' => 1])->order('id desc')->find();

        if ( ! $user) {
            return false;
        }

        $expire = 3600 * 24 * 365;
        $auth = array(
            'uid'      => $user['id'],
            'nickname' => $user['nickname'],
        );
        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));
        cookie('user_LOGGED', jiami($user['id']), $expire);
        return true;
    }

    public function logout() {
        //session('user_auth', null);
        //session('user_auth_sign', null);
        cookie('user_LOGGED', null);
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
        $this->redirect('/user/index');
    }

    public function order_list()
    {
        $Order = M('Order');
        $order_list = $Order->where(['uid' => UID])->select();
        $this->display();
    } 

    public function score()
    {
        $this->display();
    } 

    public function collect()
    {
        $this->display();
    } 

    public function yhq()
    {
        $this->display();
    } 

    public function notice()
    {
        $this->display();
    }

    public function info()
    {
        $this->display();
    }

    public function reset_password()
    {
        $this->display();
    } 

}
