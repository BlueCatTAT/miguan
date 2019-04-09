<?php

namespace Admin\Controller;

use Think\Controller;

class ChannelController extends RootController {
    
    public function channel_list()
    {
        $Channel = M('Channel');
        $list = $Channel->select();
        $this->list = $list;
        $this->display();
    }

    public function channel_add()
    {
        $Channel = M('Channel');
        if (IS_POST) {
            $time = time();
            $post_data = [
                'name' => I('post.name'),
                'type' => I('post.type'),
                'desc' => I('post.desc'),
                'trade' => I('post.trade'),
                'return_url' => I('post.return_url'),
                'notify_url' => I('post.notify_url'),
                'created_time' => $time,
                'updated_time' => $time
            ];
            $Channel->add($post_data);
            $this->redirect('/admin/channel/channel_list');
        } else {
            $this->display();
        }
    }

    public function channel_edit()
    {
        $Channel = M('Channel');

        if (IS_POST) {
            $id = I('post.id');
            $post_data = [
                'name' => I('post.name'),
                'desc' => I('post.desc'),
                'trade' => I('post.trade'),
                'return_url' => I('post.return_url'),
                'notify_url' => I('post.notify_url'),
                'updated_time' => time()
            ];
            $Channel->where(['id' => $id])->save($post_data);
            $this->redirect('/admin/channel/channel_list');
        } else {
            $id = I('get.id');
            $info = $Channel->where(['id' => $id])->find();
            $this->info = $info;
            $this->display();
        }
    }

    public function channel_del()
    {
        $Channel = M('Channel');
        $id = I('get.id'); 
        $Channel->where(['id' => $id])->save(['status' => 0]);
        $this->redirect('/admin/channel/channel_list');
    }

    public function account_list()
    {
        $Channel = M('Channel'); 
        $ChannelAccount = M('ChannelAccount');

        $channel_info = $Channel->where(['id' => I('get.id')])->find();
        $list = $ChannelAccount->where(['type' => $channel_info['type']])->select();
        $this->list = $list;

        $this->display();
    }

    public function account_add()
    {
        $ChannelAccount = M('ChannelAccount');
        if (IS_POST) {
            $time = time();
            $post_data = [
                'type'         => I('post.type'),
                'mch_id'       => I('post.mch_id'),
                'secret_key'   => I('post.secret_key'),
                'created_time' => $time,
                'updated_time' => $time
            ];
            $ChannelAccount->add($post_data);
            $this->redirect('/admin/channel/channel_list');
        } else {
            $type = I('get.type');
            $this->type = $type;
            
            $this->display();
        }
    }

    public function account_edit()
    {
        $ChannelAccount = M('ChannelAccount');
        if (IS_POST) {
            $id = I('post.id');
            $post_data = [
                'mch_id'       => I('post.mch_id'),
                'secret_key'   => I('post.secret_key'),
                'updated_time' => time()
            ];
            $ChannelAccount->where(['id' => $id])->save($post_data);
            $this->redirect('/admin/channel/account_list');
        } else {
            $id = I('get.id');
            $info = $ChannelAccount->where(['id' => $id])->find();
            $this->info = $info;
            $this->display();
        }
    }

    public function account_del()
    {
        $id = I('get.id');
        $ChannelAccount = M('ChannelAccount');
        $ChannelAccount->where(['id' => $id])->save(['status' => 0]);
        $this->redirect('/admin/channel/channel_list');
    }
}
