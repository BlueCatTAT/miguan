<?php

namespace Admin\Controller;

use Think\Controller;

class UserController extends RootController {

    public function resetpwd()
    {
        $this->display();
    }

    public function msg()
    {
        $this->display();
    }

    public function index()
    {
        $user_info = $this->_current_user;
        $this->user_info = $user_info;
        $this->display();
    }

    public function safe()
    {
        $this->display();
    }

    public function agent()
    {
        $this->display();
    }

    public function agent_list()
    {
        $this->display();
    }

    public function recharge_list()
    {
        $this->display();
    }

    public function withdraw()
    {
        $this->display();
    }
}
