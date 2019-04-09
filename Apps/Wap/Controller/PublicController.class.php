<?php

namespace Wap\Controller;

use Think\Controller;

class PublicController extends Controller {

    public function _empty() {
        $this->login();
    }

    function login() 
    {
        if (IS_POST) {
            $mobile = I('post.mobile');
            $Member = M('Member');
            if ($member_info = $Member->where(['mobile' => $mobile])->find()) {
                $this->redirect('/wap/public/login2', ['mobile' => $mobile]);
            } else {
                $this->redirect('/wap/public/reg', ['mobile' => $mobile]);
            }
        } else {
            $this->display();
        }
    }

    function login2()
    {
        if (IS_POST) {
            $Member = M('Member');
            $mobile = I('get.mobile');
            $password = I('post.password');
            $member_info = $Member->where(['mobile' => $mobile])->find(); 
            if ($member_info && $member_info['password'] == md5($password)) {
                
                $expire = 3600 * 24 * 365;
                $auth = array(
                    'uid'      => $member_info['id'],
                    'username' => $member_info['username'],
                );
                session('user_auth', $auth);
                session('user_auth_sign', data_auth_sign($auth));
                cookie('user_LOGGED', jiami($member_info['id']), $expire);
                $this->redirect('/wap/user/index');
            } else {
                $this->error = '密码错误';
                $this->display();
            }
        } else {
            $this->display();
        }
    }


    function reg()
    {
        if (IS_POST) {
            $mobile     = I('post.mobile');
            $username   = I('post.username');
            $vcode      = I('post.vcode');
            $password   = I('post.password');
            $repassword = I('post.repassword');
            $staff_code = I('post.staff_code');
            
            $Member = M('Member');
            if ( ! $mobile) {
                $this->error = '手机号不能为空';
                $this->display();
                return;
            } 
            if ( ! $username) {
                $this->error = '用户名不能为空';
                $this->display();
                return;
            } 
            if ( ! $vcode) {
                $this->error = '验证码不能为空';
                $this->display();
                return;
            } 
            if ( ! $password) {
                $this->error = '密码不能为空';
                $this->display();
                return;
            } 
            if ( ! $repassword) {
                $this->error = '重复密码不能为空';
                $this->display();
                return;
            } 
            if ( ! $staff_code) {
                $this->error = '推荐码不能为空';
                $this->display();
                return;
            } 
            if ($Member->where(['mobile' => $mobile, 'status' => 1])->find()) {
                $this->error = '手机号已被注册';
                $this->display();
                return;
            }
            if ($Member->where(['username' => $username, 'status' => 1])->find()) {
                $this->error = '用户名已被注册';
                $this->display();
                return;
            }
            if ( ! $p_user = $Member->where(['code' => $staff_code])->find()) {
                $this->error = '推荐码错误';
                $this->display();
                return;
            }
            $Vcode = M('Vcode');
            $code_info = $Vcode->where(['mobile' => $mobile, 'status' => 1])->order(['id' => 'desc'])->find();
            if ( ! $code_info) {
                $this->error = '验证码错误';
                $this->display();
                return;
            } else {
                if ($code_info['code'] != $vcode) {
                    $this->error = '验证码错误 ';
                    $this->display();
                    return;
                } else {
                    $Vcode->where(['id' => $code_info['id']])->save(['status' => 0]);
                }
            }

            $data = [
                'username' => $username,
                'mobile'   => $mobile,
                'password' => md5($password),
                'code'     => rand(1000, 9999),
                'pid'      => $p_user['id'],
                'created_time' => time(),
                'updated_time' => time()
            ];
            if ($uid = $Member->add($data)) {
                $expire = 3600 * 24 * 365;
                $auth = array(
                    'uid'      => $uid,
                    'username' => $username,
                );
                session('user_auth', $auth);
                session('user_auth_sign', data_auth_sign($auth));
                cookie('user_LOGGED', jiami($uid), $expire);
                $this->redirect('/wap/user/index');
            } else {
                $this->error = '注册失败';
                $this->display();
            }
        } else {
            $mobile = I('get.mobile');
            $this->mobile = $mobile;
            $this->display();
        }
    }

    function send_vcode()
    {
        $mobile = I('post.mobile');
        $sendUrl = 'http://v.juhe.cn/sms/send';
        $code    = randString(6, 1);

        $code_data = [
            'mobile' => $mobile,
            'code'   => $code,
            'created_time' => time(),
            'updated_time' => time()
        ];
        $Vcode = M('Vcode');
        $Vcode->add($code_data);

        $minute  = '10';
        $smsConf = array(
            'key'       => '245b3b48899c9186781ec7b24e72d3a1', //您申请的APPKEY
            'mobile'    => $mobile, //接受短信的用户手机号码
            'tpl_id'    => '93783', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' => urlencode('#code#=' . $code . '&#minute#=' . $minute), //您设置的模板变量，根据实际情况修改
        );

        $content = $this->juhecurl($sendUrl, $smsConf, 1); //请求发送短信
        if ($content) {
            $result     = json_decode($content, true);
            $error_code = $result['error_code'];
            if ($error_code == 0) {
                //状态为0，说明短信发送成功
                $data['status']  = 1;
                $data['message'] = '发送短信成功，' . $minute . '分钟内有效';
            } else {
                //状态非0，说明失败
                $data['message'] = '发送短信失败';
            }
        } else {
            $data['message'] = '发送短信失败';
        }
        echo json_encode($data);
    }

    private function juhecurl($url, $params = false, $ispost = 0) {
        $httpInfo = array();
        $ch       = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }

    public function sell_order()
    {
        $Order = M('Order'); 
        $order_list = $Order->where(['status' => 1])->select();
        if (empty($order_list)) {
            return;
        }
        $code_list = array_column($list, 'code'); 
        $code_str = implode(',', $code_list);
        $url = 'https://gupiao.baidu.com/api/rails/stockbasicbatch?from=pc&os_ver=1&cuid=xxx&vv=100&format=json&stock_code='.$code_str.'&timestamp='.time();
        $res = curl_get($url);
        $res = json_decode($res, true);

        foreach ($order_list as $k => $v) {
            $price = 0;
            foreach ($res as $k2 => $v2) {
                if ($v2['stockCode'] == $v['code']) {
                    $price = round($v2['close'], 2);
                    break;
                }
                if ($v['endloss'] >= $price || $v['endprofit'] <= $price) {
                    $this->_deal_order($v, $price); 
                }
            }
        }
    }

    private function _deal_order($order_info, $price)
    {
        $update_order = [
            'sell_price' => $price,
            'sell_time'  => time(),
            'status'     => 2
        ];
        $Order = M('Order');
        $Order->where(['id' => $order_info['id']])->save($update_order);
        //盈亏 
        $ploss = round(($price - $order_info['buy_price']) * $order_info['volume'], 2);
        //平仓日志
        if ($ploss > 0) {
            $type = 1;
            if ($order_info['secondboard'] == 0) {
                $income = round($ploss / 8 * 0.8, 2);
            } else {
                $income = round($ploss / 5 * 0.8, 2);
            }
        } else {
            $type = 0;
            if ($order_info['secondboard'] == 0) {
                $income = round($ploss / 8, 2);
            } else {
                $income = round($ploss / 5, 2);
            }
        }
        $income_log = [
            'order_sn' => $order_info['order_sn'],
            'uid'      => $order_info['uid'],
            'type'     => $type,
            'income'   => $income,
            'created_time' => time() 
        ];
        $IncomeLog = M('IncomeLog');
        $IncomeLog->add($income_log);

        $balance = $order_info['fee'] + $income;
        $Member = M('Member');
        $Member->where(['id' => $order_info['uid']])->setInc('balance', $balance);
    }
}
