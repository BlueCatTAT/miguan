<?php

namespace User\Controller;

use Think\Controller;

class UserController extends RootController {
    
    protected $host = 'http://www.tnwls.top';
    
    protected $mchId = '210314';
    protected $merAcctNo = '2103140014';

    protected $key = 'DXhYWTFJStEXKpVFFWq526jL';
    protected $iv = 'Hdp1A0St';

    protected $deskey = "DXhYWTFJStEXKpVFFWq526jL";
    protected $desiv ="Hdp1A0St";
    protected $MerCret="Cj2qxxoMqmeWD4sg9lgxjeuX7s8cTH8P669Tou4yom00jWJ1OhPQeO2l1tyyWDno9V5BkZ9tOowyVm75WMlLdzQ3d5bNmrWgjRh2FcGzB7qgdTFQxyNt7gG2dXOQUSw1";

    protected $url = 'https://ebp.ips.com.cn/fpms-access/action/user/open';

    public function main_info()
    {
        $Account = M('AccountEbp');

        $account_info = $Account->where(['id' => UID])->find();
        $this->account_info = $account_info;

        $OrderEbp = M('OrderEbp');
        $today_str = date('Y-m-d', time());
        $today_time = strtotime($today_str);
        $cond = [
            'Attach' => $account_info['customerCode'], 
            'status' => 1, 
            'create_time' => [
                ['gt', $today_time]
            ]

        ];
        $today_sum = (float) $OrderEbp->where($cond)->sum('ValidAmount');
        $this->today_sum = $today_sum;
        
        $b_account_info = $this->_get_account_info(UID);
        $this->b_account_info = $b_account_info;

        //可转账
        $cond_1 = [
            'customerCode' => $account_info['customerCode'],
            'tradeState' => 10
        ];
        $withdraw_count = (float) M('WithdrawEbpLog')->where($cond_1)->sum('amount');
        $cond_2 = [
            'Attach' => $account_info['customerCode'], 
            'status' => 1, 
        ];
        $total_sum = (float) $OrderEbp->where($cond_2)->sum('ValidAmount');

        $this->valid_amount = $total_sum - $withdraw_count;

        $this->display();
    }

    public function info()
    {
        $Account = M('AccountEbp');

        $account_info = $Account->where(['id' => UID])->find();
        $this->account_info = $account_info;
        
        $b_account_info = $this->_get_account_info(UID);
        $this->b_account_info = $b_account_info;
        $this->display();
    }

    public function logout()
    {
        session('user_auth', null);
        session('user_auth_sign', null);
        cookie('user_LOGGED', null);
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();
        $this->redirect('user/public/login');
    }

    public function resetpwd()
    {
        if ($_POST) {
            $password = I('post.password');
            $re_password = I('post.re_password');
            if ($password != $re_password) {
                $this->error('两次密码输入不一致');
            }
            $password = md5($password); 
            if (M('AccountEbp')->where(['id' => UID])->save(['password' => $password])) {
                $this->success('修改成功');
            }
        } else {
            $this->display();
        }
    }
    
    private function _get_account_info($id)
    {
        $Account = M('AccountEbp');
        $account_info = $Account->where(['id' => $id])->find();
        $body = [
            'customerCode' => $account_info['customerCode'],
            'merAcctNo'    => $this->merAcctNo,
            'accountType'  => '1',
        ];
        $body_xml = $this->_toXml($body);
        $body_xml = '<body>' . $body_xml . '</body>';
        $signature = md5($body_xml.$this->MerCret);
        $head = [
            'version' => 'V1.0.1',
            'reqIp' => get_client_ip(),
            'reqDate' => date('Y-m-d H:i:s', time()),
            'signature' => $signature 
        ];
        $head_xml = $this->_toXml($head); 
        $head_xml = '<head>' . $head_xml . '</head>';
        $openUserReqXml = "<accountBalanceReqXml>" . $head_xml . $body_xml . "</accountBalanceReqXml>"; 
        $transferReq=$this->encrypt($openUserReqXml);
        $ipsRequest = "<ipsRequest><argMerCode>".$this->mchId."</argMerCode><arg3DesXmlPara>".$transferReq."</arg3DesXmlPara></ipsRequest>";
        $post_data = [
            'ipsRequest' => $ipsRequest
        ];
        $url = 'https://ebp.ips.com.cn/fpms-access/action/query/balanceQuery';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        ob_start();
        curl_exec($ch);
        curl_close($ch);
        $res = ob_get_contents(); //$rs就是返回的内容
        ob_clean();
        
        libxml_disable_entity_loader(true);
        $res = simplexml_load_string($res, 'SimpleXMLElement', LIBXML_NOCDATA);
        $res = json_encode($res);
        $res = json_decode($res, true);

        if ($res['rspCode'] != 'M000000') {
            $this->error("调用查询账户信息接口失败");
        }
        $para = $res['p3DesXmlPara'];
        $para = $this->decrypt($para);
        
        $para = simplexml_load_string($para, 'SimpleXMLElement', LIBXML_NOCDATA);
        $para = json_encode($para);
        $para = json_decode($para, true);
        return $para;
    }
    
    private function _toXml($array){
        $xml = '';
        foreach($array as $k=>$v){
            //$xml.='<'.$k.'><![CDATA['.$v.']]></'.$k.'>';
            $xml.='<'.$k.'>'.$v.'</'.$k.'>';
        }
        return $xml;
    }
    
    function encrypt($input)
    {
        $size = mcrypt_get_block_size(MCRYPT_3DES,MCRYPT_MODE_CBC);
        $input = $this->pkcs5_pad($input, $size);
        $key = str_pad($this->key,24,'0');
        $td = mcrypt_module_open(MCRYPT_3DES, '', MCRYPT_MODE_CBC, '');
        $iv = $this->iv;
        @mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        //    $data = base64_encode($this->PaddingPKCS7($data));
        $data = base64_encode($data);
        return $data;
    }
    function pkcs5_pad($text, $blocksize) 
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    function decrypt($encrypted)
    {
        $encrypted = base64_decode($encrypted);
        $key = str_pad($this->key,24,'0');
        $td = mcrypt_module_open(MCRYPT_3DES,'',MCRYPT_MODE_CBC,'');
        $iv = $this->iv;
        $ks = mcrypt_enc_get_key_size($td);
        @mcrypt_generic_init($td, $key, $iv);
        $decrypted = mdecrypt_generic($td, $encrypted);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $y=$this->pkcs5_unpad($decrypted);
        return $y;
    }

    function pkcs5_unpad($text){
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text)) {
            return false;
        }
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad){
            return false;
        }
        return substr($text, 0, -1 * $pad);
    }

    function PaddingPKCS7($data) {
        $block_size = mcrypt_get_block_size(MCRYPT_3DES, MCRYPT_MODE_CBC);
        $padding_char = $block_size - (strlen($data) % $block_size);
        $data .= str_repeat(chr($padding_char),$padding_char);
        return $data;
    }
}
