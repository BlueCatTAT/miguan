<?php

namespace Admin\Controller;

use Think\Controller;

class PublicController extends Controller {

    public function login()
    {
        if (IS_POST) {
            if (is_login()) {
                $this->redirect('/admin/index/index');
            } 
            $Admin = M('Admin');
            
            $username = I('post.username');
            $password = I('post.password');

            $admin_info = $Admin->where(['username' => $username])->find();

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

            session('admin_auth', $auth);
            session('admin_auth_sign', data_auth_sign($auth));
            cookie('admin_LOGGED', jiami($auth['uid']), $expire);

            $this->redirect('/admin/index/index');
        } else {
            $this->display();
        }
    }
    
    public function logout()
    {
        session('admin_auth', null);
        session('admin_auth_sign', null);
        cookie('admin_LOGGED', null);
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
        $this->redirect('admin/public/login');
    }
}

?>
