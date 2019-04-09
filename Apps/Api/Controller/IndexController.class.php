<?php

namespace Api\Controller;

use Think\Controller;

class IndexController extends RootController {
    
    protected function _initialize() 
    {
        parent::_initialize();
    }
    
    function index() {
        $uid = (int) I('post.uid');
        if ( ! $uid) {
            $res = [
                'status' => 1400,
                'msg' => '未登录',
                'data' => ''
            ];
            echo json_encode($res);
            exit;
        }
        $UserVideo = M('UserVideo');
        
        $video_list = $UserVideo->where(['uid' => $uid])->select();
        if (empty($video_list)) {
            $res = [
                'status' => 1401,
                'msg' => '未上传视频',
                'data' => ''
            ];
            echo json_encode($res);
            exit;
        }

        $age = I('post.age');
        $height = I('post.height');
        $sex = I('post.sex');
        $origin = I('post.origin');
        $constellation = I('post.constellation');

        $member_list = M('Member')->where(['id' => ['neq', $uid], 'video_count' => ['gt', 0]])->select();
        if (empty($member_list)) {
            $res = [
                'status' => 1402,
                'msg' => '未匹配到用户信息',
                'data' => ''
            ];
            echo json_encode($res);
            exit;
        }

        $random_keys=array_rand($member_list, 1);
        $member_info = $member_list[$random_keys];

        $member_info['video_list'] = $UserVideo->where(['uid' => $member_info['id']])->select();
        $res = [
            'status' => 0,
            'msg'    => '',
            'data'   => $member_info
        ];
        echo json_encode($res);
        exit;
    }
}
