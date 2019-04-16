<?php

namespace Wap\Controller;

use Think\Controller;

class UserController extends RootController {

    public function _empty() {
        $this->index();
    }

    function index() {
        $this->display();
    }

    function logout()
    {
        cookie('user_LOGGED', null);
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
        $this->redirect('/wap/user/index');
    }

    function msg()
    {
        $this->display();
    }
}
