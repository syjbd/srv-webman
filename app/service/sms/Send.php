<?php
/**
 * @desc Send.php
 * @auhtor Wayne
 * @time 2025/1/8 上午10:56
 */
namespace app\service\sms;

use app\service\RpcService;

class Send extends RpcService {

    private $maxDailyLimit;
    private $sendInterval;
    private $storageFile;


    protected $mobile = '';
    protected $type = '';


    public function setMobile($mobile): Send
    {
        $this->mobile = $mobile;
        return $this;
    }

    public function setType($type): Send
    {
        $this->type = $type;
        return $this;
    }

    public function canSend($phoneNumber): bool
    {
        $today = date('Y-m-d');
        if (!isset($logs[$phoneNumber])) {
            $logs[$phoneNumber] = [];
        }
        // Filter out old entries
        $logs[$phoneNumber] = array_filter($logs[$phoneNumber], function($log) use ($today) {
            return strpos($log,$today) === 0;
        });
        // Count today's messages
        $todayLogs = array_filter($logs[$phoneNumber], function($log) use ($today) {
            return strpos($log, $today) === 0;
        });
        if (count($todayLogs) >= $this->maxDailyLimit) {
            return false; // Exceeded daily maximum
        }
        if (!empty($todayLogs)) {
            // Check the latest send time for interval checking
            $lastSendTime = end($todayLogs);
            if (time() - strtotime($lastSendTime) <$this->sendInterval) {
                return false; // Didn't meet the interval requirement
            }
        }
        return true;
    }

    public function sendSms($phoneNumber,$message): string
    {
        if (!$this->canSend($phoneNumber)) {
            return "Cannot send SMS: Limit exceeded or interval not met.";
        }

        // Assuming there's a function sendSmsViaApi($phoneNumber,$message) that sends the SMS
        // sendSmsViaApi($phoneNumber,$message);


        return "SMS sent successfully.";
    }

}