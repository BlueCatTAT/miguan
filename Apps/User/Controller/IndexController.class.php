<?php

namespace User\Controller;

use Think\Controller;

class IndexController extends RootController {
    
    protected function _initialize() 
    {
        parent::_initialize();
        $this->action = 'home';
        
        $Account = M('AccountEbp');

        $account_info = $Account->where(['id' => UID])->find();
        $this->current_account = $account_info;
    }
    
    function index() {
        $this->display();
    }

    public function info()
    {
        $this->display();
    }
}
