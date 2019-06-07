<?php

namespace Admin\Controller;

use Think\Controller;

class RootController extends Controller {

    protected function _initialize() 
    {
        define('UID', admin_login());
        if ( ! UID) {
            $this->redirect('/admin/public/login');
        }
    }
}

?>
