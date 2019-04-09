<?php

namespace Api\Controller;

use Think\Controller;

class UserController extends RootController {

    protected function _initialize() 
    {
        parent::_initialize();
    }

    public function get_userinfo()
    {
        $uid = I('post.uid');
        $Member = M('Member');
        $info = $Member->where(['id' => $uid])->find();
        $res = [
            'status' => 0,
            'msg' => '',
            'data' => [
                'user_info' => $info
            ]
        ];
        echo json_encode($res);
    }

    public function set_userinfo()
    {
        if (isset($_POST['avatar'])) {
            $data['avatar'] = I('post.avatar');
        }
        if (isset($_POST['username'])) {
            $data['username'] = I('post.username');
        }
        if (isset($_POST['age'])) {
            $data['age'] = I('post.age');
        }
        if (isset($_POST['sex'])) {
            $data['sex'] = I('post.sex');
        }
        if (isset($_POST['height'])) {
            $data['height'] = I('post.height');
        }
        if (isset($_POST['marriage'])) {
            $data['marriage'] = I('post.marriage');
        }
        if (isset($_POST['origin'])) {
            $data['origin'] = I('post.origin');
        }
        if (isset($_POST['occupation'])) {
            $data['occupation'] = I('post.occupation');
        }
        if (isset($_POST['constellation'])) {
            $data['constellation'] = I('post.constellation');
        }
        if (isset($_POST['signature'])) {
            $data['signature'] = I('post.signature');
        }
        $Member = M('Member');
        $Member->where(['id' => I('post.uid')])->save($data);
        $res = [
            'status' => 0,
            'msg'    => '',
            'data'   => ''
        ];
        echo json_encode($res);
        exit;
    }

    public function video_add()
    {
        $data = [
            'uid'       => I('post.uid'),
            'pic_url'   => I('post.pic_url'),
            'video_url' => I('post.video_url'),
            'desc'      => I('post.desc'),
            'sort'      => I('post.sort'),
            'created_time' => time(),
            'updated_time' => time()
        ]; 
        $UserVideo = M('UserVideo');
        if ($UserVideo->add($data)) {

            $video_count = $UserVideo->where(['uid' => I('post.uid'), 'status' => 1])->count();
            $Member = M('Member');
            $Member->where(['id' => I('post.uid')])->save(['video_count' => $video_count]);

            $res = [
                'status' => 0,
                'msg' => 'success',
                'data' => '',
            ];
            echo json_encode($res);
        } else {
            $res = [
                'status' => 2003,
                'msg' => '添加失败' 
            ];
            echo json_encode($res);
        }
    }

    public function follow_add()
    {
        $uid = I('post.uid');
        $to_uid = I('post.to_uid');
        $status = I('post.status');
        $Follow = M('Follow'); 
        if ($info = $Follow->where(['uid' => $uid, 'to_uid' => $to_uid])->find()) {
            if ($status != $info['status']) {
                $Follow->where(['id' => $info['id']])->save(['status' => $status, 'updated_time' => time()]);
            }
        } else {
            $data = [
                'uid' => $uid,
                'to_uid' => $to_uid,
                'status' => 1,
                'created_time' => time(),
                'updated_time' => time()
            ];
            $Follow->add($data);
        }
        $res = [
            'status' => 0,
            'msg' => 'success',
            'data' => [
                'status' => $status
            ]
        ];
        echo json_encode($res);
    }

    public function favourite_add()
    {
        $uid = I('post.uid');
        $to_uid = I('post.to_uid');
        $status = I('post.status');
        $Favourite = M('Favourite'); 
        if ($info = $Favourite->where(['uid' => $uid, 'to_uid' => $to_uid])->find()) {
            if ($status != $info['status']) {
                $Favourite->where(['id' => $info['id']])->save(['status' => $status, 'updated_time' => time()]);
            }
        } else {
            $data = [
                'uid' => $uid,
                'to_uid' => $to_uid,
                'status' => 1,
                'created_time' => time(),
                'updated_time' => time()
            ];
            $Favourite->add($data);
        }
        $res = [
            'status' => 0,
            'msg' => 'success',
            'data' => [
                'status' => $status
            ]
        ];
        echo json_encode($res);
    }
}
