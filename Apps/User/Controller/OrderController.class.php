<?php

namespace User\Controller;

use Think\Controller;

class OrderController extends RootController {
    
    protected $host = 'http://www.tnwls.top';
    
    protected $mchId = '210314';
    protected $merAcctNo = '2103140014';

    protected $key = 'DXhYWTFJStEXKpVFFWq526jL';
    protected $iv = 'Hdp1A0St';

    protected $deskey = "DXhYWTFJStEXKpVFFWq526jL";
    protected $desiv ="Hdp1A0St";
    protected $MerCret="Cj2qxxoMqmeWD4sg9lgxjeuX7s8cTH8P669Tou4yom00jWJ1OhPQeO2l1tyyWDno9V5BkZ9tOowyVm75WMlLdzQ3d5bNmrWgjRh2FcGzB7qgdTFQxyNt7gG2dXOQUSw1";

    protected $url = 'https://ebp.ips.com.cn/fpms-access/action/user/open';
    
    public function order_list()
    {
        $Account = M('AccountEbp');
        $current_account = $Account->where(['id' => UID])->find();
        $where = [
            'Attach' => $current_account['customerCode'],
        ];
        $p = 1;
        $status = -1;

        if (IS_POST) {
            if (I('post.MerBillNo')) {
                $where['MerBillNo'] = I('post.MerBillNo');
                $this->MerBillNo = I('post.MerBillNo');
            } else {
                $this->MerBillNo = '';
            }
            if (I('post.MainMerbillNo')) {
                $where['MainMerbillNo'] = I('post.MainMerbillNo');
                $this->MainMerbillNo = I('post.MainMerbillNo');
            } else {
                $this->MainMerbillNo = '';
            }
            if (isset($_POST['status']) && $_POST['status'] != -1) {
                $where['status'] = I('post.status');
                $status = $_POST['status'];
                $this->status = $status;
            } else {
                $this->status = -1;
            }
            if (I('post.start_time') && I('post.end_time')) {
                $start_time = strtotime(I('post.start_time'));
                $end_time = strtotime(I('post.end_time')) + 3600 * 24;

                if ($end_time < $start_time) {
                    $this->error("开始时间必须小于结束时间");
                }

                if ($end_time > ($start_time + 3600 * 24 * 30)) {
                    $this->error("时间范围必须小于30天");
                }

                $where['create_time'] = [
                    ['gt', $start_time],
                    ['lt', $end_time]
                ];
                $this->start_time = I('post.start_time');
                $this->end_time = I('post.end_time');
            }
        } else {
            if (I('get.MerBillNo')) {
                $where['MerBillNo'] = I('get.MerBillNo');
                $this->MerBillNo = I('get.MerBillNo');
            }
            if (I('get.MainMerbillNo')) {
                $where['MainMerbillNo'] = I('get.MainMerbillNo');
                $this->MainMerbillNo = I('get.MainMerbillNo');
            }
            if (isset($_GET['status'])) {
                $where['status'] = I('get.status');
                $this->status = I('get.status'); 
            }
            if (I('get.start_time') && I('get.end_time')) {
                $start_time = strtotime(I('get.start_time'));
                $end_time = strtotime(I('get.end_time')) + 3600 * 24;

                if ($end_time < $start_time) {
                    $this->error("开始时间必须小于结束时间");
                }

                if ($end_time > ($start_time + 3600 * 24 * 30)) {
                    $this->error("时间范围必须小于30天");
                }

                $where['create_time'] = [
                    ['gt', $start_time],
                    ['lt', $end_time]
                ];
                $this->start_time = I('get.start_time');
                $this->end_time = I('get.end_time');
            }
            $p = $_GET['p'] ? $_GET['p'] : 1;
        }
        
        $count = M('OrderEbp')->where($where)->count();
        $Page       = new \Think\Page($count, 10);

        $order_list = M('OrderEbp')->where($where)->order('id desc')->page($p.',10')->select();

        if ($this->MerBillNo) {
            $Page->parameter['MerBillNo'] = urlencode($this->MerBillNo);
        }
        if ($this->MainMerbillNo) {
            $Page->parameter['MainMerbillNo'] = urlencode($this->MainMerbillNo);
        }
        if ($this->status != -1) {
            $Page->parameter['status'] = urlencode($this->status);
        }
        if ($this->start_time) {
            $Page->parameter['start_time'] = urlencode($this->start_time);
        }
        if ($this->end_time) {
            $Page->parameter['end_time'] = urlencode($this->end_time);
        }
        
        $this->pager = $Page->show();

        $this->order_list = $order_list;
        $this->display();
    }

    public function withdraw_list()
    {
        if (I('post.start_time')) {
            $start_time = strtotime(I('post.start_time'));
        } else {
            $start_time = time() - 3600 * 24 * 7;
        }
        
        if (I('post.end_time')) {
            $end_time = strtotime(I('post.end_time'));
        } else {
            $end_time = time();
        }

        if (($end_time - $start_time) < 0) {
            $this->error("开始时间不能大于结束时间");
        }
        
        if (($end_time - $start_time) > 3600 * 24 * 30) {
            $this->error("开始时间和结束时间跨度不能超过30天");
        }
        
        $Account = M('AccountEbp');
        $current_account = $Account->where(['id' => UID])->find();
        
        $where = [
            'customerCode' => $current_account['customerCode'],
            'create_time' => [
                ['gt', $start_time],
                ['lt', $end_time]
            ]
        ];
        $withdraw_list = M('WithdrawEbp')->where($where)->order('id desc')->select();

        $this->start_time = date('Y-m-d', $start_time);
        $this->end_time = date('Y-m-d', $end_time);

        $this->withdraw_list = $withdraw_list;

        $this->bank_list = $this->_bank_list();

        
        $account_info = $this->_get_account_info(UID);
        $this->account_info = $account_info;
        $this->display();
    }
    
    public function withdraw_res_list()
    {
        $Account = M('AccountEbp');
        $current_account = $Account->where(['id' => UID])->find();

        $this->list = M('WithdrawEbpLog')->where(['customerCode' => $current_account['customerCode']])->select();
        $this->display();
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
    
    public function _post_data($url, $post_data)
    {
        //启动一个CURL会话
        $ch = curl_init();
        // 设置curl允许执行的最长秒数
        // 获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        //发送一个常规的POST请求。
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        //要传送的所有数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        // 执行操作
        $res = curl_exec($ch);
        curl_close($ch);
        
        return $res;
    }
    
    public function withdraw_add()
    {
        if (IS_POST) {
            $Account = M('AccountEbp');

            $account_info = $Account->where(['id' => UID])->find();
            
            $data = [
                'customerCode' => $account_info['customerCode'],
                'transferAmount' => I('post.transferAmount'),
                'bankCard' => I('post.bankCard'), 
                'bankCode' => I('post.bankCode'),
                'create_time' => time()
            ];
            M('WithdrawEbp')->add($data);
            $this->success('提交申请成功');
        } else {
            $account_info = $this->_get_account_info(UID);

            $this->account_info = $account_info;
            $this->bank_list = $this->_bank_list();
            $this->display();
        }
    }

    public function withdraw_do()
    {
        $id = I('get.id');
        $withdraw_info = M('WithdrawEbp')->where(['id' => $id])->find();
        if (!$withdraw_info) {
            $this->error('获取转账信息失败');
        }
        $body = [
            'merBillNo'          => date('YmdHis', time()) . rand(1000, 9999),
            'customerCode'       => $withdraw_info['customerCode'],
            'pageUrl'            => 'http://www.tnwls.top/api/ips/withdraw_callback',
            's2sUrl'             => 'http://www.tnwls.top/api/ips/withdraw_notify',
            'bankCard'           => $withdraw_info['bankCard'],
            'bankCode'           => $withdraw_info['bankCode']
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
        $openUserReqXml = "<withdrawalReqXml>" . $head_xml . $body_xml . "</withdrawalReqXml>"; 
        $transferReq=$this->encrypt($openUserReqXml);
        $ipsRequest = "<ipsRequest><argMerCode>".$this->mchId."</argMerCode><arg3DesXmlPara>".$transferReq."</arg3DesXmlPara></ipsRequest>";
        $this->ipsRequest = $ipsRequest;
        $this->display();
    }

    public function order_list_2()
    {
        $body = [
            'Status' => 'A',
            'TradeType' => '1001',
            'StartTime' => '20180601000000',
            'EndTime' => '20180605000000',
            'Page' => '1',
            'PageSize' => '20'
        ];
        $body_xml = $this->_toXml($body);
        $body_xml = '<body>' . $body_xml . '</body>';
        $signature = md5($body_xml.$this->mchId.$this->MerCret);
        
        $head = [
            'Version' => 'V1.0.1',
            'MerCode' => $this->mchId,
            'MerName' => '恩施市天倪网络科技有限责任公司',
            'Account' => $this->merAcctNo, 
            'ReqDate' => date('YmdHis'),
            'Signature' => $signature
        ];
        $head_xml = $this->_toXml($head); 
        $head_xml = '<head>' . $head_xml . '</head>';

        $post_data = '<Ips><GateWayReq>' . $head_xml . $body_xml . '</GateWayReq></Ips>';

        $this->post_data = $post_data;
        $this->display('order_list_pre');
    }
    
    private function _toXml($array){
        $xml = '';
        foreach($array as $k=>$v){
            //$xml.='<'.$k.'><![CDATA['.$v.']]></'.$k.'>';
            $xml.='<'.$k.'>'.$v.'</'.$k.'>';
        }
        return $xml;
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
