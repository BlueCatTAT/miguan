<?php

namespace Admin\Controller;

use Think\Controller;
use Org\Util\String;

class EbpController extends RootController {

    protected $host = 'http://www.tnwls.top';
    protected $mchId = '210314';
    protected $merAcctNo = '2103140014';

    protected $key = 'DXhYWTFJStEXKpVFFWq526jL';
    protected $iv = 'Hdp1A0St';

    protected $deskey = "DXhYWTFJStEXKpVFFWq526jL";
    protected $desiv ="Hdp1A0St";
    protected $MerCret="Cj2qxxoMqmeWD4sg9lgxjeuX7s8cTH8P669Tou4yom00jWJ1OhPQeO2l1tyyWDno9V5BkZ9tOowyVm75WMlLdzQ3d5bNmrWgjRh2FcGzB7qgdTFQxyNt7gG2dXOQUSw1";

    protected $url = 'https://ebp.ips.com.cn/fpms-access/action/user/open';

    protected $collectionItemName = 'sss';


    public function account_set()
    {
        $AccountEbp = M('AccountEbp');
        $list = $AccountEbp->select();
        foreach ($list as $k => $v) {
            $s = $this->_get_customerCode();
            $AccountEbp->where(['id' => $v['id']])->save(['SecretKey' => md5($s)]);
        }
    }

    public function account_list()
    {
        $AccountEbp = M('AccountEbp');
        $OrderEbp = M('OrderEbp');

        $list = $AccountEbp->where(['status' => 1])->select();

        $today_str = date('Y-m-d', time());
        $today_time = strtotime($today_str);

        $yesterday_time = $today_time - 3600 * 24;

        foreach ($list as $k => $v) {
            $account_info = $this->_get_account_info($v['customerCode']);
            $list[$k]['balance'] = $account_info['body']['balance'];

            $cond_1 = [
                'Attach' => $v['customerCode'],
                'status' => 1,
                'create_time' => [
                    ['gt', $today_time],
                ]
            ];
            $list[$k]['today_amout'] = $OrderEbp->where($cond_1)->sum('ValidAmount');

            $cond_2 = [
                'Attach' => $v['customerCode'],
                'status' => 1,
                'create_time' => [
                    ['gt', $yesterday_time],
                    ['lt', $today_time],
                ]
            ];
            
            $list[$k]['yesterday_amout'] = $OrderEbp->where($cond_2)->sum('ValidAmount');
        }
        $this->list = $list;
        $this->display();
    }

    public function account_del()
    {
        $id = I('post.id');
        $AccountEbp = M('AccountEbp');
        $AccountEbp->where(['id' => $id])->save(['status' => 0]);
        
        $data = [
            'status' => 0,
            'msg' => 'success'
        ];
        $this->ajaxReturn($data);
    }

    public function account_info()
    {
        $id = I('post.id');
        $info = M('AccountEbp')->where(['id' => $id])->find();
        $this->info = $info;
        $this->display();
    }

    public function account_add()
    {
        if ($_POST) {
            $merAcctNo = $this->merAcctNo; //* 商户账户号 10位纯数字
            $userType = 2; //*用户类型 1企业 2个人
            $customerCode = I('post.customerCode'); //*客户号
            $identityType = '1'; //证件类型 1身份证 证件类型 :1: 身份证 身份证 ;2 营业 执照 直销用户 可不用填写
            $identityNo = I('post.identityNo'); //证件号码 直销用户 可不用填写
            $userName = I('post.userName'); //* 个人用户名 为个人姓名 , 企业为企业名
            $legalName = ''; //法人姓名
            $legalCardNo = ''; //法人身份 证
            $mobiePhoneNo = I('post.mobiePhoneNo'); //* 手机
            $telPhoneNo = ''; //固定电话
            $email = ''; //邮箱
            $contactAddress = ''; //联系地址
            $remark = ''; //备注
            $pageUrl = 'http://www.tnwls.top/api/ips/account_add_callback.html'; //* 同步返回地址
            $s2sUrl = 'http://www.tnwls.top/api/ips/account_add_notify.html'; //* 异步返回地址
            $directSell = ''; //开户类型 直销用户开户必须传1（默认为非直销开户不用填写）
            $stmsAcctNo = ''; // 结算通交易账户 如果为直销用户开户必须传入
            $ipsUserName = ''; // 用户 登录名 直销 用户为 : 字母 、数或字母 、数或字母 、数或字母 、数或字母 、数或字母 、数或字母 、数或字母 、数或字母 、数或+数字组合 ,且长度不 能大于 12 非直销 用户为 : 字母 、数或字母 、数或字母 、数或字母 、数或字母 、数或字母 、数或字母 、数或字母 、数或字母 、数或+数字组合 ,且不能大于 30
            $body = [
                'merAcctNo' => $merAcctNo,
                'userType' => $userType,
                'customerCode' => $customerCode,
                'identityType' => $identityType,
                'identityNo' => $identityNo,
                'userName' => $userName,
                'legalName' => $legalName,
                'legalCardNo' => $legalCardNo,
                'mobiePhoneNo' => $mobiePhoneNo,
                'telPhoneNo' => $telPhoneNo,
                'email' => $email,
                'contactAddress' => $contactAddress,
                'remark' => $remark,
                'pageUrl' => $pageUrl,
                's2sUrl' => $s2sUrl,
                'directSell' => $directSell,
                'stmsAcctNo' => $stmsAcctNo,
                'ipsUserName' => $ipsUserName
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

            $openUserReqXml = "<openUserReqXml>" . $head_xml . $body_xml . "</openUserReqXml>"; 

            $transferReq=$this->encrypt($openUserReqXml);

            $ipsRequest = "<ipsRequest><argMerCode>".$this->mchId."</argMerCode><arg3DesXmlPara>".$transferReq."</arg3DesXmlPara></ipsRequest>";


            $post_data['ipsRequest']  = $ipsRequest;

            $this->ipsRequest = $ipsRequest;

            $account_data = [
                'customerCode' => I('post.customerCode'),
                'password' => md5('888888'),
                'identityNo' => I('post.identityNo'),
                'userName' => I('post.userName'),
                'mobiePhoneNo' => I('post.mobiePhoneNo'),
                'company' => I('post.company'),
                'rate' => I('post.rate'),
                'created_time' => time(),
                'updated_time' => time()
            ];
            M('AccountEbp')->add($account_data);
            $this->display();
        } else {
            $this->customerCode = $this->_get_customerCode();
            $this->display('account_add_pre');
        }

    }

    public function account_view()
    {
        $id = I('get.id');
        $account_info = M('AccountEbp')->find(['id' => $id]);
        $body = [
            'customerCode' => $account_info['customerCode']
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

        $openUserReqXml = "<queryUserReqXml>" . $head_xml . $body_xml . "</queryUserReqXml>"; 
        //echo $openUserReqXml;exit;

        $transferReq=$this->encrypt($openUserReqXml);

        $ipsRequest = "<ipsRequest><argMerCode>".$this->mchId."</argMerCode><arg3DesXmlPara>".$transferReq."</arg3DesXmlPara></ipsRequest>";

        $this->ipsRequest = $ipsRequest;
        $this->display();
    }


    public function transfer()
    {
        if (IS_POST) {
            
            $id = I('post.id');
            $withdraw_info = M('WithdrawEbp')->where(['id' => $id])->find();

            $body = [
                'merBillNo'          => date('YmdHis', time()) . rand(1000, 9999),
                'transferType'       => '2',
                'merAcctNo'          => $this->merAcctNo,
                'customerCode'       => $withdraw_info['customerCode'],
                'transferAmount'     => I('post.transferAmount'),
                'collectionItemName' => $this->collectionItemName,
                'remark'             => $withdraw_info['customerCode'] 
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
            $openUserReqXml = "<transferReqXml>" . $head_xml . $body_xml . "</transferReqXml>"; 

            $transferReq=$this->encrypt($openUserReqXml);

            $ipsRequest = "<ipsRequest><argMerCode>".$this->mchId."</argMerCode><arg3DesXmlPara>".$transferReq."</arg3DesXmlPara></ipsRequest>";

            $post_data = [
                'ipsRequest' => $ipsRequest
            ];
            $url = 'https://ebp.ips.com.cn/fpms-access/action/trade/transfer.do';

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
                $this->error("调用转账接口失败");
            }
            $para = $res['p3DesXmlPara'];
            $para = $this->decrypt($para);

            $para = simplexml_load_string($para, 'SimpleXMLElement', LIBXML_NOCDATA);
            $para = json_encode($para);
            $para = json_decode($para, true);

            if ($para['body']['tradeState'] != 10) {
                $this->error('接口返回：转账失败');
            }
            $update_data = [
                'ipsBillNo'  => $para['body']['ipsBillNo'],
                'tradeId'    => $para['body']['tradeId'],
                'ipsFee'     => $para['body']['ipsFee'],
                'tradeState' => $para['body']['tradeState'],
                'status'     => 1
            ];
            if (M('WithdrawEbp')->where(['id' => $id])->save($update_data)) {
                $this->success("转账成功");
            }
        } else {
            $id = I('get.id');
            $withdraw_info = M('WithdrawEbp')->where(['id' => $id])->find();
            $this->withdraw_info = $withdraw_info;
            $this->bank_list = $this->_bank_list();
            $this->display();        
        }
    }

    public function withdraw_list()
    {
        $list = M('WithdrawEbp')->select();
        $this->list = $list;
        $this->display();
    }

    public function withdraw_do_list()
    {
        $list = M('WithdrawEbpLog')->select();
        $this->list = $list;
        $this->display();
    }

    public function order_list()
    {
        $OrderEbp = M('OrderEbp'); 
        $list = $OrderEbp->where(['status' => 1])->select();
        $this->list = $list;
        $this->display();
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

    public function account_add_callback()
    {
        var_dump($_POST, $_GET);
    }
    
    public function _bank_list()
    {
        return [['code' => '1100', 'name' => '工商银行'],
            ['code' => '1101', 'name' => '农业银行'],
            ['code' => '1102', 'name' => '招商银行'],
            ['code' => '1103', 'name' => '兴业银行'],
            ['code' => '1104', 'name' => '中信银行'],
            ['code' => '1107', 'name' => '中国银行'],
            ['code' => '1108', 'name' => '交通银行'],
            ['code' => '1109', 'name' => '浦发银行'],
            ['code' => '1110', 'name' => '民生银行'],
            ['code' => '1111', 'name' => '华夏银行'],
            ['code' => '1112', 'name' => '光大银行'],
            ['code' => '1113', 'name' => '北京银行'],
            ['code' => '1114', 'name' => '广发银行'],
            ['code' => '1115', 'name' => '南京银行'],
            ['code' => '1116', 'name' => '上海银行'],
            ['code' => '1117', 'name' => '杭州银行'],
            ['code' => '1118', 'name' => '宁波银行'],
            ['code' => '1119', 'name' => '邮储银行'],
            ['code' => '1120', 'name' => '浙商银行'],
            ['code' => '1121', 'name' => '平安银行'],
            ['code' => '1122', 'name' => '东亚银行'],
            ['code' => '1123', 'name' => '渤海银行'],
            ['code' => '1124', 'name' => '北京农商行'],
            ['code' => '1127', 'name' => '浙江泰隆商业银行'],
            ['code' => '1106', 'name' => '中国建设银行'],
        ];
    }

    private function _get_customerCode()
    {
        $arr = [0,1,2,3,4,5,6,7,8,9];
        $str = '';
        for ($i = 0; $i < 8; $i++)
        {
            $str .= $arr[rand(0, 9)];
        }
        return $str;
    }
    
    private function _get_account_info($customerCode)
    {
        $body = [
            'customerCode' => $customerCode,
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
            //$this->error("调用查询账户信息接口失败");
        }
        $para = $res['p3DesXmlPara'];
        $para = $this->decrypt($para);
        
        $para = simplexml_load_string($para, 'SimpleXMLElement', LIBXML_NOCDATA);
        $para = json_encode($para);
        $para = json_decode($para, true);
        return $para;
    }

}
