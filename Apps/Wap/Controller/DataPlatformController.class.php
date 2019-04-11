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

    function index()
    {
        $this->display(); 
    }

    function search()
    {
        $token = $this->_get_access_token();
        $get_data = [
            'client_secret' => $this->_app_key,
            'access_token'  => $token,
            'name'          => '晋京',
            'idcard'        => '410181198905104557',
            'phone'         => '13683582516' 
        ];
        $url = $this->_access_report_url . '?' . http_build_query($get_data);
        $res = curl_get($url);
        echo $url;
        echo "<pre>";
        var_dump($res);
        echo "</pre>";
    }

    function _get_token_status($token)
    {
        $get_data = [
            'client_secret' => '',
            'access_token'  => '',
            'token'         => '',
            'crawl_detail'  => ''
        ];
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
        $string = 'http://58.87.110.104/data_platform/callback.html';
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
                    'msg'    => '<p>数据采集中...请稍后</p>'
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
        if ($res['data']['category'] == 'mobile') {
            $html = $this->fetch('mobile_report');
        } elseif ($res['data']['category'] == 'e_business') {
            $html = $this->fetch('e_business_report');
        }
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
