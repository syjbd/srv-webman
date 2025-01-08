<?php
/**
 * @desc Send.php
 * @auhtor Wayne
 * @time 2025/1/8 上午10:56
 */
namespace app\service\sms;

use app\service\RpcService;

class Send extends RpcService {

    public function get($arr)
    {
        return $this->success($arr);
    }

    public function status()
    {
        return $this->error('status error');
    }


}