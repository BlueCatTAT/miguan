<?php

// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Wap\Model;

use Think\Model;

/**
 * 用户模型
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class MemberModel extends Model {

    protected $_validate = array(
        array('username', '1,16', '昵称长度为1-16个字符', self::EXISTS_VALIDATE, 'length'),
        array('username', '', '昵称被占用', self::EXISTS_VALIDATE, 'unique'), //用户名被占用
    );

    public function lists($status = 1, $order = 'uid DESC', $field = true) {
        $map = array('status' => $status);
        return $this->field($field)->where($map)->order($order)->select();
    }

    /**
     * 登录指定用户
     * @param  integer $uid 用户ID
     * @return boolean      ture-登录成功，false-登录失败
     */
    public function login($uid, $remember) {
        /* 检测是否在当前应用注册 */
        $user = $this->field(true)->find($uid);
        if (!$user || 2 == $user['status']) {
            $this->error = '用户不存在或已被禁用！'; //应用级别禁用
            return false;
        }

        //记录行为
        action_log('user_login', 'member', $uid, $uid);

        /* 登录用户 */
        $this->autoLogin($user, $remember);
        return true;
    }

    /**
     * 注销当前用户
     * @return void
     */
    public function logout() {
        //session('user_auth', null);
        //session('user_auth_sign', null);
        cookie('user_LOGGED', null);
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
    }

    /**
     * 自动登录用户
     * @param  integer $user 用户信息数组
     */
    public function autoLogin($uid) {

        $user = $this->where(['mobile' => $mobile])->find();
        $expire = 3600 * 24 * 365;

        /* 记录登录SESSION和COOKIES */
        $auth = array(
            'uid' => $user['id'],
            'username' => $user['username'],
        );

        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));

        cookie('user_LOGGED', jiami($user['id']), $expire);
    }

    public function getNickName($uid) {
        return $this->where(array('uid' => (int) $uid))->getField('nickname');
    }

}
