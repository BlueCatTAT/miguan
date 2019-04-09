<?php

namespace Wap\Controller;

use Think\Controller;

class UserController extends RootController {

    public function _empty() {
        $this->index();
    }

    function index() {
        $this->current = 'user';


        $this->user_info = $this->_curren_user;
        $this->display();
    }

    function share()
    {
        $this->user_info = $this->_curren_user;
        $this->display();
    }

    function income()
    {
        $this->display();
    }

    function follow()
    {
        $this->display();
    }

    //问题反馈
    function qa()
    {
        if (IS_POST) {
            $data = [
                'uid' => $this->_curren_user['id'],
                'desc' => I('post.desc')
            ];
            $Qa = M('Qa');
            $Qa->add($data);
            $res = [
                'status' => 0
            ];
            echo json_encode($res);
            exit;
        }
        $this->display();
    }

    function paper()
    {
        $this->display();
    }

    function about()
    {
        $this->display();
    }

    function staff()
    {
        $this->display();
    }

    function help()
    {
        $this->display();
    }

    function collect_add()
    {
        $code = I('post.code');
        $this->user_info = $this->_curren_user;
        $Collect = M('Collect');
        if ($collect_info = $Collect->where(['uid' => $this->_curren_user['id'], 'code' => $code, 'status' => 1])->find()) {
            $Collect->where(['id' => $collect_info['id']])->save(['updated_time' => time()]); 
        } else {
            $collect_data = [
                'uid' => $this->_curren_user['id'],
                'code' => $code,
                'created_time' => time(),
                'updated_time' => time()
            ];
            $Collect->add($collect_data);
        }
        $res = [
            'status' => 0,
        ];
        echo json_encode($res);
    }
    
    function collect_del()
    {
        $code = I('post.code');
        $this->user_info = $this->_curren_user;
        $Collect = M('Collect');
        if ($collect_info = $Collect->where(['uid' => $this->_curren_user['id'], 'code' => $code, 'status' => 1])->find()) {
            $Collect->where(['id' => $collect_info['id']])->save(['updated_time' => time()]); 
        } else {
            $collect_data = [
                'uid' => $this->_curren_user['id'],
                'code' => $code,
                'created_time' => time(),
                'updated_time' => time()
            ];
            $Collect->add($collect_data);
        }
        $res = [
            'status' => 0,
        ];
        echo json_encode($res);
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
