<?php

namespace Api\Controller;

use Think\Controller;

class DemoController extends RootController {

    public function payment()
    {
        $this->display();
    }
    
    public function res()
    {
        $this->display();
    }

    public function callback()
    {
        $post = json_encode($_POST);
        $get = json_encode($_GET);
        file_put_contents('callback_post_demo.log', $post, FILE_APPEND);
        file_put_contents('callback_get_demo.log', $get, FILE_APPEND);
    }

    public function failback()
    {
        $post = json_encode($_POST);
        $get = json_encode($_GET);
        file_put_contents('failback_post_demo.log', $post, FILE_APPEND);
        file_put_contents('failback_get_demo.log', $get, FILE_APPEND);
    }

    public function notify()
    {
        $post = json_encode($_POST);
        $get = json_encode($_GET);
        file_put_contents('notify_post_demo.log', $post, FILE_APPEND);
        file_put_contents('notify_get_demo.log', $get, FILE_APPEND);
    }
}
