<?php

namespace Wap\Controller;

use Think\Controller;

class IndexController extends Controller {

    public function _empty() {
        $this->index();
    }

    function index() {
        $uid = is_login();
        if ( ! $uid) {
            $this->redirect('/user/index');
        }

        $Member = M('Member');
        $member_info = $Member->where(['id' => $uid])->find();
        if ($member_info['mobile']) {
            $this->redirect('/index/product');
        } else {
            if ($_POST) {
                $mobile = I('post.mobile');
                $code = I('post.code');
                $Vcode = M('Vcode');
                $vcode_info = $Vcode->where(['mobile' => $mobile, 'status' => 1])->order(['id' => 'desc'])->find();
                if (!$vcode_info) {
                    $this->error('验证码无效');
                }
                if ($vcode_info['code'] != $code) {
                    $this->error('验证码错误');
                }
                $Member->where(['id' => $uid])->save(['mobile' => $mobile]);
                $Vcode->where(['id' => $vcode_info['id']])->save(['status' => 2]);
                $this->redirect('/index/product');
            } else {
                $this->display();
            }
        }
    }

    function home() 
    {
        $this->display();
    }

    function product()
    {
        $this->display();
    }

}
