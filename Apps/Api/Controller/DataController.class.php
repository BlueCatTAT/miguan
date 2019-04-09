<?php

namespace Api\Controller;

use Think\Controller;

class DataController extends RootController {

    public function get_detail()
    {
        $code = I('get.code');
        $url = 'https://gupiao.baidu.com/api/rails/stockbasicbatch?from=pc&os_ver=1&cuid=xxx&vv=100&format=json&stock_code='.$code.'&timestamp=' . time();
        $res = curl_get($url);
        $res = json_decode($res, true);
        $res = $res['data'][0];
    }
    
    public function get_price()
    {
        $code = I('post.code');
        $url = 'https://gupiao.baidu.com/api/rails/stockbasicbatch?from=pc&os_ver=1&cuid=xxx&vv=100&format=json&stock_code='.$code.'&timestamp=' . time();
        $res = curl_get($url);
        $res = json_decode($res, true);
        $res = $res['data'][0];

        $res['preClose'] = round($res['preClose'], 2);
        $res['close'] = round($res['close'], 2);
        $res['netChange'] = round($res['netChange'], 2);
        $res['netChangeRatio'] = round($res['netChangeRatio'], 2);
        $res['open'] = round($res['open'], 2);
        $res['preClose'] = round($res['preClose'], 2);
        $res['high'] = round($res['high'], 2);
        $res['low'] = round($res['low'], 2);
        $res['volume'] = round($res['volume']/1000000, 2);
        $res['turnoverRatio'] = round($res['turnoverRatio']*100 ,2);
        echo json_encode($res);
    }


    public function index()
    {
        $type = I('get.type');
        $code = I('get.code');
        $init = I('get.init');
        $time = time();
        $m_time = date('YmdHi', $time);
        //s
        if ($type == 1) {
            $data_list = $this->_get_timeline_data($code, $init);
        } elseif ($type == 2) {
        //五
            $url = 'https://gupiao.baidu.com/api/stocks/stocktimelinefive?from=pc&os_ver=1&cuid=xxx&vv=100&format=json&stock_code='.$code.'&step=3&timestamp=' . $time;
        } elseif ($type == 3) {
            //日 
            $data_list = $this->_get_day_data($code);
            //1 date 2 open 3 heigh 4 low 5 close 8 volume
        } elseif ($type == 3) {
            //周
            $url = 'https://gupiao.baidu.com/api/stocks/stockweekbar?from=pc&os_ver=1&cuid=xxx&vv=100&format=json&stock_code='.$code.'&step=3&start=&count=160&fq_type=no&timestamp=' . $time;
        } else {
            //月
            $url = 'https://gupiao.baidu.com/api/stocks/stockmonthbar?from=pc&os_ver=1&cuid=xxx&vv=100&format=json&stock_code='.$code.'&step=3&start=&count=160&fq_type=no&timestamp=' . $time;
        }

        $result = [
            'code' => 1,
            'data' => $data_list
        ];
        header("Content-Type:application/json");
        echo json_encode($result);
    }

    private function _get_timeline_data($code, $init)
    {
        $time = time();
        $m_time = date('YmdHi', $time);
        if ($init == 1) {
            $url = 'https://gupiao.baidu.com/api/stocks/stocktimeline?from=pc&os_ver=1&cuid=xxx&vv=100&format=json&stock_code='.$code.'&amp;timestamp=' . $time;
        } else {
            $url = 'https://gupiao.baidu.com/api/stocks/stocktimeline?from=pc&os_ver=1&cuid=xxx&vv=100&format=json&stock_code='.$code.'&local_timeline_timestamp='.$m_time.'00000&amp;timestamp=' . $time;
        }
        
        $res = curl_get($url);
        $res = json_decode($res, true);
        
        $data_list = $res['timeLine'];
        $tmp_list = [];
        foreach ($data_list as $k => $v) {
            $time = $v['time']/1000;
            if (strlen($time) == 5) {
                $time = '0'.$time;
            }
            $time_str = $v['date'].$time;
            $tmp_list[] = [
                (int) (strtotime($time_str) . '000'),
                round($v['price'], 2)
            ];
        }
        
        $ask = [];
        foreach ($res['ask'] as $k => $v) {
            $ask[] = [
                'price' => round($v['price'], 2),
                'volume' => round($v['volume']/100)
            ]; 
        }
        $bid = [];
        foreach ($res['bid'] as $k => $v) {
            $bid[] = [
                'price' => round($v['price'], 2),
                'volume' => round($v['volume']/100)
            ]; 
        }

        return ['list' => $tmp_list, 'ask' => $ask, 'bid' => $bid];
    }

    private function _get_day_data($code)
    {
        //1 date 2 open 3 heigh 4 low 5 close 8 volume
        $time = time();
        $url = 'https://gupiao.baidu.com/api/stocks/stockdaybar?from=h5&os_ver=0&cuid=xxx&vv=2.2&format=json&count=68&stock_code='.$code;
        $res = curl_get($url);
        $res = json_decode($res, true);
        
        $res = $res['mashData'];
        $tmp_list = [];
        foreach ($res as $k => $v) {
            $tmp_list[] = [
                (int) (strtotime($v['date']) . '000'),
                round($v['kline']['open'], 3),
                round($v['kline']['high'], 3),
                round($v['kline']['low'], 3),
                round($v['kline']['close'], 3),
                $v['kline']['volume']
            ];
        }
        $tmp_list = array_reverse($tmp_list);
        return $tmp_list;
    }

}
