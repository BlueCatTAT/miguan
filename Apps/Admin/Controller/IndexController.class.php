<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends RootController {
    
    protected function _initialize() 
    {
        parent::_initialize();
        $this->action = 'home';
    }
    
    function index() {
        $this->display();
    }

    public function info()
    {
        $this->display();
    }
}
