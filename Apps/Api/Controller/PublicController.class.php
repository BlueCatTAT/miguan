<?php

namespace Api\Controller;

use Think\Controller;

class PublicController extends Controller {
    
    function check_user()
    {
        if (IS_POST) {
            $Member = M('Member');
            $mobile = I('post.mobile'); 
            if ($uid = $Member->where(['mobile' => $mobile])->find()) {
                $res = [
                    'status' => 0,
                    'msg'    => '已注册',
                    'data'   => [
                        'reg' => 1 
                    ]
                ];
                echo json_encode($res);exit;
            } else {
                $res = [
                    'status' => 0,
                    'msg'    => '未注册',
                    'data'   => [
                        'reg' => 0 
                    ]
                ];
                echo json_encode($res);exit;
            }
        } 
    }

    function reg()
    {
        if (IS_POST) {
           //$code = I('post.code');
           //$mobile = I('post.mobile');
           //if ( ! $this->_check_code($mobile, $code)) {
           //    $res = [
           //        'status' => 9991,
           //        'msg'    => '验证码错误';
           //    ];
           //    echo json_encode($res);
           //    exit;
           //}
            
            $Member = M('Member');
            $mobile = I('post.mobile');
            if ($uid = $Member->where(['mobile' => $mobile])->find()) {
                $res = [
                    'status' => 0,
                    'msg'    => '注册成功',
                    'data'   => [
                        'uid' => $uid
                    ]
                ];
                echo json_encode($res);exit;
            }
            if ( ! I('post.mobile')) {
                $res = [
                    'status' => 1001,
                    'msg'    => '手机号错误',
                    'data'   => ''
                ];
                echo json_encode($res);exit;
            }
            if ( ! I('post.password')) {
                $res = [
                    'status' => 1002,
                    'msg'    => '密码错误',
                    'data'   => ''
                ];
                echo json_encode($res);exit;
            }
            $data = [
                'mobile'  => I('post.mobile'),
                'password' => md5(I('post.password'))
            ];
            if ($uid = $Member->add($data)) {
                $res = [
                    'status' => 0,
                    'msg'    => '注册成功',
                    'data'   => [
                        'uid' => $uid
                    ]
                ];
                echo json_encode($res);exit;
            }
        }
    }
    
    function login()
    {
        if (IS_POST) {
            $Member = M('Member');

            $mobile = I('post.mobile');
            $password = I('post.password');
            
            $user = $Member->where(['username' => $username, 'password' => md5($password), 'status' => 1])->find();

            $res = [
                'status' => 0,
                'msg' => '',
                'data' => $user
            ];
            echo json_encode($res);
        }
    }

    function resetpassword()
    {
        $data = [
            'password' => md5(I('post.password'))
        ];
        $Member = M('Member');
        if ($Member->where(['mobile' => I('post.mobile')])->save($data)) {
            $res = [
                'status' => 0,
                'msg' => '修改成功',
                'data' => ''
            ];
            echo json_encode($res);
        } else {
            $res = [
                'status' => 9965,
                'msg' => '修改失败',
                'data' => ''
            ];
            echo json_encode($res);
        }
    }

    function sendsms()
    {
        if (IS_POST) {
            $mobile = I('post.mobile'); 
            $Code = M('Code');
            $code_data = [
                'mobile' => $mobile,
                'code'   => '123456',
            ];
            $Code->add($code_data);
            $res = [
                'status' => 0,
                'msg' => '',
                'data' => ''
            ];
            echo json_encode($res);exit;
        } 
    }

    private function _check_code($mobile, $code)
    {
        $Code = M('Code');
        if ($id = $Code->where(['mobile' => $mobile, 'code' => $code, 'status' => 1])->find()) {
            $Code->where(['id' => $id])->save(['status' => 0]);
            return true;
        } else {
            return false;
        }
    }
    
    public function upload_img(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件 
        $info   =   $upload->upload();

        $name = $info['file']['name'];
        $type = $info['file']['type'];
        $size = $info['file']['size'];
        $key  = $info['file']['key'];
        $ext  = $info['file']['ext'];
        $md5  = $info['file']['md5'];
        $sha1 = $info['file']['sha1'];
        $savename = $info['file']['savename'];
        $savepath = $info['file']['savepath'];

        if(!$info) {// 上传错误提示错误信息
            $err = $upload->getError();
            $res = [
                'status' => 9987,
                'msg'    => $err
            ];
            echo json_encode($res);exit;
        }else{
            $file = '/Uploads/' . $savepath . $savename;
            $res = [
                'status' => 0,
                'msg' => '',
                'data' => [
                    'file' => $file
                ]
            ];
            echo json_encode($res);
        }
    }
}
