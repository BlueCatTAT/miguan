<?php

namespace Wap\Controller;

use Think\Controller;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

class PublicController extends Controller {
    
    protected $_msm_url = 'https://openapis.7moor.com/v20160818/sms/sendInterfaceTemplateSms/T00000001267';
    protected $_accountid = 'T00000001267';
    protected $_apisecret = 'c97dcb10-602d-11e9-898d-7708a1f6d461';
    protected $_miguan_token_url = 'https://mi.juxinli.com/api/access_token';
    protected $_miguan_search_url = 'https://mi.juxinli.com/api/search';

    function get_report()
    {
        $Search = M('Search');
        $search_list = $Search->where(['status' => 3])->select();
        if ($search_list) {
            foreach ($search_list as $k => $v) {
                $get_data = [
                    'name'          => $v['name'],
                    'id_card'       => $v['id_card'],
                    'phone'         => $v['phone'],
                    'client_secret' => $v['client_secret'],
                    'access_token'  => $v['access_token'],
                    'version'       => 'v3'
                ];
                $url = $this->_miguan_search_url . '?' . http_build_query($get_data);
                $data = curl_get($url);
                $update_info = [
                    'data'   => $data,
                    'status' => 2
                ];
                $Search->where(['id' => $v['id']])->save($update_info);
            }
        }
    }

    function send_vcode()
    {
        $mobile = I('post.mobile');
        $type   = I('post.type');
        $code   = randString(6, 1);

        $code_data = [
            'type'   => $type,
            'mobile' => $mobile,
            'code'   => $code,
            'created_time' => time(),
            'updated_time' => time()
        ];
        $Vcode = M('Vcode');
        $Vcode->add($code_data);

        $res = $this->_send_msm($mobile, $code);
        if ($res == true) {
            echo json_encode(['status' => 1]);
        } else {
            echo json_encode(['status' => 0, 'message' => $res['message']]);
        }
    }

    public function test_msm()
    {
        $mobile = '13683582516';
        $code = '888888';
        $res = $this->_send_msm($mobile, $code);
        echo "<pre>";
        var_dump($res);
        echo "</pre>";
    }
    
    private function _send_msm($mobile, $code)
    {
        AlibabaCloud::accessKeyClient('LTAIwyCTxUIipkdQ', 'ZVeu8i1voV23lHMNPJWZdQ8ttvKFCc')
            ->regionId('cn-hangzhou') // replace regionId as you need
            ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
            // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->options([
                    'query' => [
                        'PhoneNumbers' => $mobile,
                        'SignName' => "全网资信",
                        'TemplateCode' => "SMS_71065055",
                        'TemplateParam' => json_encode(['code' => $code]),
                    ],
                ])
                ->request();
                return true;
        } catch (ClientException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        }
    }

    private function _send_msm_bak($mobile, $code)
    {
        $time = date('YmdHis');
        $authorization = base64_encode($this->_accountid.':'.$time);
        $sig=strtoupper(md5($this->_accountid.$this->_apisecret.$time)); 
        
        $data = [
            "num" => $mobile,
            "templateNum" => "5",
            "var1" => $code 
        ];

        $header[] = "Accept: application/json";
        $header[] = "Content-type: application/json;charset='utf-8'";
        $header[] = "Content-Length: ".strlen( json_encode($data) );
        $header[] = "Authorization: ".$authorization;

        //帐号Id + 帐号APISecret +时间戳
        $url = $this->_msm_url . '?sig=' . $sig;

        $ch = curl_init ();
        curl_setopt($ch, CURLOPT_URL, ($url));//地址
        curl_setopt($ch, CURLOPT_POST, 1);   //请求方式为post
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data)); //post传输的数据。
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        
        $errno = curl_errno($ch);
        $info  = curl_getinfo($ch);

        $return = curl_exec($ch);
        $return = json_decode($return, true);
        return $return;
    }
}
