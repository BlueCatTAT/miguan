<?php

namespace Wap\Controller;

use Think\Controller;

class DataPlatformController extends Controller {
   
    protected $_account = 'shaoyang';
    protected $_app_id  = '780bbf7c7d094461b9d2982e66f803d7';
    protected $_app_key = '74b0a11a86a044a5b30bdade08218a50';

    protected $_auth_url = 'https://vip.juxinli.com/h5/authorize/';
    protected $_api_url  = 'https://vip.juxinli.com/data_platform_api';

    protected $_access_token_url = 'https://www.juxinli.com/api/v2/access_report_token';
    protected $_access_report_url = 'https://www.juxinli.com/api/access_report_data';
    protected $_token_status_url = 'https://www.juxinli.com/api/token_status';

    protected $_callback = 'http://www.zhixinrenapp.com/data_platform/callback.html';

    function index()
    {
        $this->product_list = [
            ['type' => 'telecom', 'name' => '运营商', 'icon' => 'fa-mobile-phone'],
            ['type' => 'taobao', 'name' => '淘宝', 'icon' => 'fa-shopping-cart'],
            ['type' => 'jingdong', 'name' => '京东', 'icon' => 'fa-truck'],
            ['type' => 'fund_list', 'name' => '公积金', 'icon' => 'fa-home'],
            ['type' => 'insurance_list', 'name' => '社保', 'icon' => 'fa-id-card'],
            ['type' => 'education', 'name' => '学信网', 'icon' => 'fa-newspaper-o'],
            ['type' => 'credit_card_list', 'name' => '信用卡', 'icon' => 'fa-credit-card'],
            ['type' => 'life_insurance_list', 'name' => '寿险', 'icon' => 'fa-google-wallet'],
            ['type' => 'car_insurance_list', 'name' => '车险', 'icon' => 'fa-car'],
            ['type' => 'zm_score', 'name' => '芝麻信用', 'icon' => 'fa-calendar-o'],
            ['type' => 'borrowing_list', 'name' => '借条', 'icon' => 'fa-map'],
            ['type' => 'borrowing_credit_list', 'name' => '借条信用', 'icon' => 'fa-newspaper-o'],
            ['type' => 'tax_list', 'name' => '个税详单', 'icon' => 'fa-file-archive-o'],
            ['type' => 'takeaway_list', 'name' => '外卖', 'icon' => 'fa-phone'],
            ['type' => 'music_list', 'name' => '音乐', 'icon' => 'fa-music'],
            ['type' => 'travel_list', 'name' => '出行', 'icon' => 'fa-tree'],
            ['type' => 'personal_tax', 'name' => '个税申报', 'icon' => 'fa-money'],
            ['type' => 'court_list', 'name' => '法院', 'icon' => 'fa-university'],
            ['type' => 'maimai', 'name' => '社交', 'icon' => 'fa-wifi'],
        ];
        $this->display(); 
    }

    function _get_access_token()
    {
        $get_data = [
            'org_name' => $this->_account,
            'client_secret' => $this->_app_key,
            'hours' => 1
        ];
        $url = $this->_access_token_url . '?' . http_build_query($get_data); 
        $res = curl_get($url);
        $res = '{"access_token":"80453718b0e64baf8cab93f6fbe87f2b","note":"获取access_token成功","update_time":"2019-04-11 13:56:21","code":200,"create_time":"2019-04-11 13:56:21","success":"true","expire_time":"2019-04-11 14:56:21","expires_in":"1"}';
        $res = json_decode($res, true);
        $token = $res['access_token'];
        return $token;
    }
    
    function report() {
        $type = I('get.type');
        $string = $this->_callback;
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        $get_data = [
            'api_key' => $this->_app_key,
            'callback_url' => $data
        ];
        $url = $this->_auth_url . $type . '?' . http_build_query($get_data);
        header("Location: " . $url);            
    }

    function callback()
    {
        $token = I('get.token');

        $this->token = $token;
        $this->display();
    }

    function get_api_data()
    {
        $token = I('post.token');
        
        $header[] = "Authorization: " . $this->_app_id . "," . $this->_app_key;
        $url = $this->_api_url . '/raw_data/' . $token;
        $res = curl_get($url, $header); 

        $res = json_decode($res, true);
        if ($res['code'] != 'API_DATA_PLATFORM_INVOKE_SUCCESS') {
            $result = [
                'status' => -1,
                'msg'    => $res['message']
            ];
            echo json_encode($result);
        } else {
            if ($res['data']['status'] != 'SUCCESS') {
                $result = [
                    'status' => 0,
                    'msg'    => '<p>数据采集中...请稍后</p>',
                    'res'    => $res
                ];
                echo json_encode($result);
            } else {
                $result = [
                    'status' => 1,
                    'msg'    => '采集成功',
                    'html'   => $this->_format_html($res)
                ]; 
                echo json_encode($result);
            }
        }
    }

    private function _format_html($res)
    {
        $this->data = $res['data'];
        $html = $this->fetch($res['data']['category']);
        return $html;
    }

    function _get_data($token)
    {
        $header[] = "Authorization: " . $this->_app_id . "," . $this->_app_key;
        $url = $this->_api_url . '/raw_data/' . $token;
        $res = curl_get($url, $header); 
        $res = json_decode($res, true);
        switch ($res['data']['status']) {
        case 'SUCCESS':
            // TODO 数据存储等业务逻辑
            return $res['data'];
            break;
        case 'PENDING':
            // 休眠五秒后再次调用接口
            sleep(3000);
            $this->_get_data($token);
            break;
        default:
            // TODO 数据采集失败，如果为解析异常可联系运营人员进行修复
            $this->error("获取数据失败");
        }
    }
}
