<?php

namespace Admin\Controller;

use Think\Controller;

class RootController extends Controller {

    protected function _initialize() 
    {
        define('UID', is_login());
        $this->_current_user = M('Member')->where(['id' => UID])->find();
        if ( ! UID) {
            $this->redirect('/admin/public/login');
        }
    }
}

?>
