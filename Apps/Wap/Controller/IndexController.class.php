<?php

namespace Wap\Controller;

use Think\Controller;

class IndexController extends Controller {

    public function _empty() {
        $this->index();
    }

    function index() {
        $this->display();
    }
}
