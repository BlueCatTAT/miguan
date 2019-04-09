<?php

namespace User\Controller;

use Think\Controller;

class RootController extends Controller {

    protected function _initialize() 
    {
        define('UID', is_login());
        
        if ( ! UID) {
            $this->redirect('user/public/login');
        }
    }
}

?>
