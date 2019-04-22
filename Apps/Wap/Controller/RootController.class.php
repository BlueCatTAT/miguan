<?php

namespace Wap\Controller;

use Think\Controller;

class RootController extends Controller {

    protected $_current_user;

    protected function _initialize() 
    {
        //define('UID', is_login());

        //$this->_curren_user = M('Member')->where(['id' => UID])->find();

        if ( ! UID) {
            //$this->redirect('/wap/public/login');
        }
    }
}

?>
