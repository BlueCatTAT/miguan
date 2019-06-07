<?php

namespace Admin\Controller;

use Think\Controller;
use Org\Util\String;

class AccountController extends RootController {

    public function account_add()
    {
        if (IS_POST) {
            $post_data = [
                'username' => I('post.username'),
                'password' => md5(I('post.password')),
                'trade'    => (int) I('post.trade'),
                'mch_id'    => String::randString(6, 1), 
                'secret_key' => String::randString(32),
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
        $Account = M('Account');
        if (IS_POST) {
            $id = I('post.id');
            $post_data = [
                'username'   => I('post.username'),
                'trade'      => (int) I('post.trade'),
                'return_url' => I('post.return_url'),
                'notify_url' => I('post.notify_url')
            ];
            if (I('post.password')) {
                $post_data['password'] = md5(I('post.password'));
            }
            $Account = M('Account');
            $Account->where(['id' => $id])->save($post_data);

            $this->redirect('/admin/account/account_list');
        } else {
            $id = I('get.id');
            $info = $Account->where(['id' => $id])->find();
            $this->info = $info;
            $this->display();
        }
    }

    public function account_list()
    {
        $Account = M('Account');
        $list = $Account->select();
        $this->list = $list;
        $this->display();
    }

    public function account_trade_list()
    {
        $AccountTrade = M('AccountTrade');
        
        $aid = I('get.aid');
        $list = $AccountTrade->field('a.*, b.name')->table('t_account_trade a')
            ->join('t_channel b ON a.type = b.type')
            ->where(['a.aid' => $aid])
            ->select();
        $this->list = $list;
        $this->display();
    }

    public function account_trade_add()
    {
        $AccountTrade = M('AccountTrade');
        $Channel = M('Channel');
        if (IS_POST) {
            $aid = I('post.aid');

            if ($AccountTrade->where(['aid' => $aid, 'type' => I('post.type'), 'status' => 1])->find()) {
                $this->error('已添加过该渠道');
            }

            $time = time();
            $post_data = [
                'aid'          => I('post.aid'),
                'type'         => I('post.type'),
                'trade'        => I('post.trade'),
                'created_time' => $time,
                'updated_time' => $time
            ];
            $AccountTrade->add($post_data); 
            $this->redirect(U('/admin/account/account_trade_list', ['aid' => I('post.aid')]));
        } else {
            $list = $Channel->where(['status' => 1])->select();
            $this->aid = I('get.aid');
            $this->list = $list;
            $this->display();
        }
    }

    public function account_trade_edit()
    {
        $AccountTrade = M('AccountTrade'); 
        $Channel = M('Channel');
        if (IS_POST) {
            $id = I('post.id');
            $aid = I('post.aid');
            $post_data = [
                'type'   => I('post.type'),
                'trade'  => I('post.trade'),
                'updated_time' => time()
            ];
            $AccountTrade->where(['id' => $id])->save($post_data);
            $this->redirect('/admin/account/account_trade_list', array('aid' => $aid));
        } else {
            $id = I('get.id');
            $info = $AccountTrade->where(['id' => $id])->find();
            $list = $Channel->where(['status' => 1])->select();
            $this->info = $info;
            $this->list = $list;
            $this->display();
        }
    }

    public function account_trade_del()
    {
        $AccountTrade = M('AccountTrade');
        $id = I('post.id');
        $AccountTrade->where(['id' => $id])->save(['status' => 1]);
    }
}
