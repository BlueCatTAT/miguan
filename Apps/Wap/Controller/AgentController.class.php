<?php

namespace Wap\Controller;

use Think\Controller;

class AgentController extends Controller {
    
    protected $_base_url = 'http://zx.dfx8.com/';
    protected $_appid = 'wx1e21ad441e4e2576';
    protected $_appsecret = 'a26010468f9791b8d5939b3728600e52';
    
    protected function _initialize() 
    {
        $this->_Admin = M('Admin');
        $this->_Product = M('Product');
        $this->_AgentSet = M('AgentSet');
    }

    public function index()
    {
        $uid = $this->_check_login();
        
        $Admin = M('Admin');
        $agent_info = $Admin->where(['id' => $uid])->find();

        $this->agent_info = $agent_info;
        $this->display();
    }

    public function agent_list()
    {
        $uid = $this->_check_login();

        $Admin = M('Admin');
        
        $agent_list = $Admin->where(['pid' => $uid])->select();
        $this->agent_list = $agent_list;
        $this->display();
    }

    public function agent_set()
    {
        $uid = $this->_check_login();
        
        $product_list = $this->_Product->where(['status' => 1])->select();
        
        if ( ! $_POST) {
            $id = I('get.id');
            $agent_info = $this->_Admin->where(['id' => $id])->find();
            if ($agent_info['pid'] != $uid) {
                $this->error('信息错误');
            }
            $p_agent_info = $this->_Admin->where(['id' => $uid])->find();
            foreach ($product_list as $k => $v) {
                if ($agent_set_info = $this->_AgentSet->where(['aid' => $id, 'product_id' => $v['id'], 'status' => 1])->find()) {
                    $product_list[$k]['fr'] = $agent_set_info['price'];
                } else {
                    $product_list[$k]['fr'] = 1;
                }
                
                if ($p_agent_set_info = $this->_AgentSet->where(['aid' => $p_agent_info['id'], 'product_id' => $v['id'], 'status' => 1])->find()) {
                    $product_list[$k]['fr_max'] = $p_agent_set_info['price'];
                } else {
                    $product_list[$k]['fr_max'] = 1;
                }
            }
            $this->agent_info = $agent_info;
            $this->product_list = $product_list;
            $this->display();
        } else {
            $id = I('post.id');
            $agent_info = $this->_Admin->where(['id' => $id])->find();
            if ($agent_info['pid'] != $uid) {
                $this->error('信息错误');
            }
            $p_agent_info = $this->_Admin->where(['id' => $uid])->find();
            foreach ($product_list as $k => $v) {
                $ks = 'p' . $v['id'];
                if (isset($_POST[$ks]) && $_POST[$ks]) {
                    if ($p_agent_set_info = $this->_AgentSet->where(['aid' => $p_agent_info['id'], 'product_id' => $v['id'], 'status' => 1])->find()) {
                        $fr_max = $p_agent_set_info['price'];
                    } else {
                        $fr_max = 1;
                    }
                    if ($fr_max < $_POST[$ks]) {
                        $this->error('分润不能超过' . $fr_max);
                    }
                    if ($agent_set_info = $this->_AgentSet->where(['aid' => I('post.id'), 'product_id' => $v['id']])->find()) {
                        $this->_AgentSet->where(['id' => $agent_set_info['id']])->save(['price' => $_POST[$ks]]);
                    } else {
                        $agent_set_data = [
                            'aid'          => I('post.id'),
                            'product_id'   => $v['id'],
                            'price'        => $_POST[$ks],
                            'created_time' => time(),
                            'updated_time' => time()
                        ];
                        $this->_AgentSet->add($agent_set_data);
                    }
                }
            }
            $this->redirect('/agent/agent_list');
        }
    }

    public function info()
    {
        $uid = $this->_check_login();
        
        $Admin = M('Admin');
        $agent_info = $Admin->where(['id' => $uid])->find();
        
        $this->agent_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->_appid . '&redirect_uri=' . $this->_base_url . 'user/callback/aid/' . $uid . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        $this->agent_info = $agent_info;
        if ($agent_info['lv'] == 1) {
            $this->c_url = U('/agent/reg@zx.dfx8.com', ['pid' => $uid], true, true, true);
        }
        $this->display();
    }

    public function reset_password()
    {
        $uid = $this->_check_login();
        $Admin = M('Admin');

        if ( ! $_POST) {
            $this->display();
        } else {
            $password = I('password');
            $repassword = I('repassword');
            if ($password != $repassword) {
                $this->error('两次密码不一致');
            }
            $Admin->where(['id' => $uid])->save(['password' => md5($password)]);
            $this->logout();
        }
    }

    public function order_list()
    {
        $uid = $this->_check_login();
        $Member = M('Member');
        $Order = M('Order');
        $Admin = M('Admin');
        
        $agent_info = $Admin->where(['id' => $uid])->find();
        if ($agent_info['lv'] == 1) {
            $agent_list = $Admin->where(['pid' => $uid])->select();
            if ($agent_list) {
                $aid_list = array_column($agent_list, 'id');
                array_push($aid_list, $uid);
                $user_list = $Member->where(['aid' => ['in', $aid_list]])->select();
            } else {
                $user_list = $Member->where(['aid' => $uid])->select();
            }
        } else {
            $user_list = $Member->where(['aid' => $uid])->select();
        }
        if ($user_list) {
            $uid_list = array_column($user_list, 'id');

            $p = $_GET['p'] ? $_GET['p'] : 1;
            $order_list = $Order->where(['uid' => ['in', $uid_list], 'status' => 2])->order(['id' => 'desc'])->page($p . ',10')->select();
            $count = $Order->where(['uid' => ['in', $uid_list], 'status' => 2])->count();
            $Page = new \Think\Page($count, 10);
            $this->pager = $Page->show();
        }

        $this->order_list = $order_list;
        $this->display();
    }

    public function user_list()
    {
        $uid = $this->_check_login();
        $Member = M('Member');

        $p = $_GET['p'] ? $_GET['p'] : 1;
        $user_list = $Member->where(['aid' => $uid])->order(['id' => 'desc'])->page($p. ',10')->select();
        $count = $Member->where(['aid' => $uid])->count();
        $Page = new \Think\Page($count, 10);
        $this->pager = $Page->show();
        $this->user_list = $user_list;
        $this->display();
    }

    public function card_info()
    {
        $uid = $this->_check_login();
        
        $Card = M('Card');
        $card_info = $Card->where(['uid' => $uid])->find();
        
        if ($_POST) {
            $name = I('post.name');
            $bank_name = I('post.bank_name');
            $card_no = I('post.card_no');
            $address = I('post.address');
            $branch_name = I('branch_name');

            if ($card_info) {
                $save_data = [
                    'name'         => $name,
                    'bank_name'    => $bank_name,
                    'card_no'      => $card_no,
                    'address'      => $address,
                    'branch_name'  => $branch_name,
                    'updated_time' => time()
                ];
                $Card->where(['id' => $card_info['id']])->save($save_data);
                $this->redirect('/agent/card_info');
            } else {
                $card_data = [
                    'uid'          => $uid,
                    'name'         => $name,
                    'bank_name'    => $bank_name,
                    'card_no'      => $card_no,
                    'address'      => $address,
                    'branch_name'  => $branch_name,
                    'status'       => 1,
                    'created_time' => time(),
                    'updated_time' => time()
                ];
                $Card->add($card_data);
            }
        }
        $card_info = $Card->where(['uid' => $uid])->find();

        $this->card_info = $card_info;
        $this->display();
    }

    function reg()
    {
        $uid = agent_login();
        if ($uid) {
            cookie('agent_LOGGED', null);
            if (isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() - 42000, '/');
            }
            session_destroy();
        }

        $pid = I('get.pid'); 
        if ( ! $pid) {
            $this->error('链接不合法');
        }
        if ( ! $_POST) {
            $this->pid = $pid;
            $this->display();
        } else {
            $pid = I('post.pid');
            $username = I('post.username');
            $mobile = I('post.mobile');
            $password = I('post.password');
            $repassword = I('post.repassword');
            $email = I('post.email');
            $qq = I('post.qq');
            $wx = I('post.wx');
            $code = I('post.code');

            if (!$pid) {
                $this->error('链接不合法');
            }
            if (!$username) {
                $this->error('姓名不能为空');
            }
            if (!$mobile) {
                $this->error('电话不能为空');
            }
            if (!$password) {
                $this->error('密码不能为空');
            }
            if (!$repassword) {
                $this->error('重复免密不能为空');
            }
            if ($password != $repassword) {
                $this->error('两次免密不一致');
            }
            if (!$email) {
                $this->error('邮箱不能为空');
            }
            if (!$qq) {
                $this->error('QQ不能为空');
            }
            if (!$wx) {
                $this->error('微信不能为空');
            }

            $Admin = M('Admin');
            if ($admin_info = $Admin->where(['mobile' => $mobile])->find()) {
                $this->error('手机已经注册, 请勿重复注册');
            }

            $Vcode = M('Vcode');
            $vcode_info = $Vcode->where(['mobile' => $mobile, 'status' => 1])->order(['id' => 'desc'])->find();
            if (!$vcode_info) {
                $this->error('验证码无效');
            }
            if ($vcode_info['code'] != $code) {
                $this->error('验证码错误');
            }
            $Vcode->where(['id' => $vcode_info['id']])->save(['status' => 2]);

            $p_admin_info = $Admin->where(['id' => $pid])->find();
            $admin_data = [
                'pid' => $pid,
                'lv'  => $p_admin_info['lv'] + 1,
                'username' => $username,
                'mobile'   => $mobile,
                'password' => md5($password),
                'email'    => $email,
                'qq'       => $qq,
                'wx'       => $wx,
                'created_time' => time(),
                'updated_time' => time()
            ];
            $Admin->add($admin_data);
            $this->redirect('/agent/login');
        }
    }

    function login()
    {
        if ( ! $_POST) {
            $this->display();
        } else {
            $uid = agent_login();
            if ($uid) {
                $this->redirect('/agent/index');
            }
            
            $Admin = M('Admin');
            
            $mobile = I('post.mobile');
            $password = I('post.password');

            $admin_info = $Admin->where(['mobile' => $mobile])->find();

            if ( ! $admin_info) {
                $this->error('账户不存在');
            }
            if ($admin_info['password'] !== md5($password)) {
                $this->error('密码错误');
            }
            
            $expire = 3600 * 24 * 365;
            $auth = array(
                'uid'      => $admin_info['id'],
                'username' => $admin_info['username'],
            );

            session('agent_auth', $auth);
            session('agent_auth_sign', data_auth_sign($auth));
            cookie('agent_LOGGED', jiami($auth['uid']), $expire);

            $this->redirect('/agent/index');
        } 
    }
    
    function logout()
    {
        cookie('agent_LOGGED', null);
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
        $this->redirect('/agent/index');
    }

    private function _check_login()
    {
        $uid = agent_login();
        if ( ! $uid) {
            $this->redirect('/agent/login');
        }
        return $uid;
    }
}
