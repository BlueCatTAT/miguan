<?php

namespace Api\Controller;

use Think\Controller;

class TestController extends RootController {

    protected function _initialize() 
    {
        parent::_initialize();
    }

    public function check()
    {
        $res = [
            'status' => 0,
            'msg' => 'success',
            'data' => [
            ]
        ];
        $post = $_POST;
        $post_token = $post['token'];
        $res['data']['source_post'] = $post;
        unset($post['token']);
        ksort($post);
        $res['data']['sort_post'] = $post;
        $get_str = http_build_query($post); 
        $res['data']['post_str'] = $get_str;
        $token = md5($get_str);
        $res['data']['token'] = $token;
        if ($token != $post_token) {
            $res['status'] = 9999;
            $res['msg'] = 'auth check false';
        }
        echo json_encode($res);
    }
}
