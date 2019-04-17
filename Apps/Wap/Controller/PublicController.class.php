<?php

namespace Wap\Controller;

use Think\Controller;

class PublicController extends Controller {

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
