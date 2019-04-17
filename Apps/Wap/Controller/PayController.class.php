<?php

namespace Wap\Controller;

use Think\Controller;

class PayController extends Controller {

    function index() {
        $this->display();
    }

    function make_order()
    {
        $res = import("Wap.Util.weixin.tool.JsApiPay");
        $tools = new \JsApiPay();
        $openId = $tools->GetOpenid();
        echo "<pre>";
        var_dump($openId);
        echo "</pre>";
    }
}
