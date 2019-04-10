<?php

namespace Wap\Controller;

use Think\Controller;

class DataPlatformController extends Controller {
   
    protected $_account = 'shaoyang';
    protected $_app_id  = '780bbf7c7d094461b9d2982e66f803d7';
    protected $_app_key = '74b0a11a86a044a5b30bdade08218a50';

    protected $_auth_url = 'https://vip.juxinli.com/h5/authorize/';
    protected $_api_url  = 'https://vip.juxinli.com/data_platform_api';

    function index()
    {
        $this->display(); 
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
        return json_encode($res);
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
