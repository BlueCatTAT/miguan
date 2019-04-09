<?php

namespace Api\Controller;

use Think\Controller;

class OrderController extends RootController {

    protected function _initialize() 
    {
        parent::_initialize();
    }

    public function add_order()
    {
        //每周一到周五上午时段9:30-11:30，下午时段13:00-15:00。周六、周日上海证券交易所、深圳证券交易所公告的休市日不交易。
        if ( ! $this->_check_time()) {
            $res = [
                'status' => 1001,
                'msg'    => '非交易时间段'
            ];
            echo json_encode($res);
            exit;
        }

        $code = I('post.code');
        $fee = I('post.fee');
        $volume = I('post.volume');
        $o = strpos($code,'300',0);

        if ($o == false) {
            $secondboard  = 0; 
        } else {
            $secondboard  = 1; 
        }

        if ($secondboard == 1) {
            $total_fee = $fee * 5;
        } else {
            $total_fee = $fee * 8; 
        }
    
        $socket_price = (int) $this->_get_price($code); 
        if ($socket_price == 0) {
            $res = [
                'status' => 1002,
                'msg' => '获取股票信息失败'
            ];
            echo json_encode($res); 
            exit;
        }
        if ($total_fee < $socket_price * $volume) {
            $res = [
                'status' => 1003,
                'msg' => '获取股票信息失败'
            ];
            echo json_encode($res);
            exit;
        }

        $total_price = round($socket_price * $volume, 2);
        $servicecharge = round($total_price * 46.774 / 10000, 2);

        if ($total_fee < ($total_price + $servicecharge)) {
            $res = [
                'status' => 1004,
                'msg' => '保证金不足支付股票价格'
            ];
            echo json_encode($res);
            exit;
        }

        $order_data = [
            'uid'           => UID,
            'order_sn'      => date('YmdHis', time()) . rand(1000, 9999),
            'code'          => $code,
            'secondboard'   => $secondboard
            'fee'           => $fee,
            'total_price'   => $total_price,
            'servicecharge' => $servicecharge,
            'volume'        => $volume,
            'buy_price'     => $socket_price,
            'endprofit'     => abs(I('post.endprofit')),
            'endloss'       => abs(I('post.endloss')),
            'created_time'  => time(),
            'updated_time'  => time()
        ];
        $Order = M('Order');
    }

    private function _check_time()
    {
        if (date('w') == 6 || date('w') == 0) {
            return false;
        }
        $checkDayStr = date('Y-m-d ', time());
        $time_1 = strtotime($checkDayStr.'09:30:00');
        $time_2 = strtotime($checkDayStr.'11:30:00');
        $time_3 = strtotime($checkDayStr.'13:00:00');
        $time_4 = strtotime($checkDayStr.'15:00:00');
        if (time() < $time_1) {
            return false;
        }
        if (time() > $time_2 && time() < $time_3) {
            return false;
        }
        if (time() > $time_4) {
            return false;
        }
        return true;
    }

    private function _get_price($code)
    {
        $url = 'https://gupiao.baidu.com/api/rails/stockbasicbatch?from=pc&os_ver=1&cuid=xxx&vv=100&format=json&stock_code='.$code.'&timestamp=' . time();
        $res = curl_get($url);
        $res = json_decode($res, true);
        $res = $res['data'][0];
    
        return $res['close'];
    }

    private function _get_expenses($fee)
    {
        return $fee / 10000 * 46.774; 
    }


}
