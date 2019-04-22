<?php

namespace Admin\Controller;

use Think\Controller;

class UserController extends RootController {

    public function user_list()
    {
        $page = $_GET['page'] ? $_GET['page'] : 1;
        
        $Member = M('Meber');
        $member_list = $Member->order(['id' => 'desc'])->page($page . ',10')->select();
        $this->member_list = $member_list;
        
        $count = $Member->count();
        $this->count = $count;
        $this->page_count = ceil($count / 10);
        $this->page = $page;
        $this->display();
    }
}
