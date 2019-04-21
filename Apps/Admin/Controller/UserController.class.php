<?php

namespace Admin\Controller;

use Think\Controller;

class UserController extends RootController {

    public function user_list()
    {
        $Member = M('Meber');
        $member_list = $Member->order(['id' => 'desc'])->select();
        $this->member_list = $member_list;
        $this->display();
    }
}
