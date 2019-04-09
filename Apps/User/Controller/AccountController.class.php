<?php

namespace Admin\Controller;

use Think\Controller;

class AccountController extends RootController {

    public function account_add()
    {
        if (IS_POST) {
            $post_data = [
                'username' => I('post.username'),
                'password' => md5(I('post.password')),
                'trade'    => (int) I('post.trade'),
                'return_url' => I('post.return_url'),
                'notify_url' => I('post.notify_url')
            ];
            $Account = M('Account');
            $Account->add($post_data);

            $this->redirect('/admin/account/account_list');
        } else {
            $this->display();
        }
    }

    public function account_edit()
    {
        $this->display();
    }

    public function account_list()
    {
        $Account = M('Account');
        $list = $Account->select();
        $this->list = $list;
        $this->display();
    }
}
