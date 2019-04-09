<?PHP
require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/ThinkPHP/Library/Org/message_sdk/mns-autoloader.php');
use AliyunMNS\Client;
use AliyunMNS\Topic;
use AliyunMNS\Constants;
use AliyunMNS\Model\MailAttributes;
use AliyunMNS\Model\SmsAttributes;
use AliyunMNS\Model\BatchSmsAttributes;
use AliyunMNS\Model\MessageAttributes;
use AliyunMNS\Exception\MnsException;
use AliyunMNS\Requests\PublishMessageRequest;

class Send_sms
{
    public function run($mobile, $code)
    {
        $this->endPoint = "http://1570459510701042.mns.cn-hangzhou.aliyuncs.com/"; 
        $this->accessId = "LTAInnoIqPVUMNtK";
        $this->accessKey = "lemCBPO6vhyWYdTw2FKZ5GiC2yxu71";
        $this->client = new Client($this->endPoint, $this->accessId, $this->accessKey);

        $topicName = "sms.topic-cn-hangzhou";
        $topic = $this->client->getTopicRef($topicName);

        $batchSmsAttributes = new BatchSmsAttributes("惠卡联盟", "SMS_71065055");
        $batchSmsAttributes->addReceiver($mobile, array("code" => $code));
        $messageAttributes = new MessageAttributes(array($batchSmsAttributes));

        $messageBody = "smsmessage";
        $request = new PublishMessageRequest($messageBody, $messageAttributes);
        
        try
        {
            $res = $topic->publishMessage($request);
            $log_content = $res->isSucceed() . "\n";
            $log_content .= $res->getMessageId() . "\n";

            return true;
        }
        catch (MnsException $e)
        {
            $log_content = $e . "\n";
            
            $file = 'sms.log';
            $fp = fopen($file, "a");
            flock($p, LOCK_EX);
            fwrite($fp, "执行日期：" . date("Y-m-d H:i:s", time()) . "\n" . $log_content . "\n");
            flock($fp, LOCK_UN);
            fclose($fp);

            return false;
        }
        
    }
    
}
