<?php
/**
 * @desc Config.php
 * @auhtor Wayne
 * @time 2025/1/9 下午7:52
 */
namespace app\service\index;

use app\rpc\RpcServer;

class Config extends RpcServer{

    public function get(array $request=[])
    {
        $app = !empty($request['app']) ? $request['app'] : 'app';
        return $this->success(config($app));
    }

    public function set(array $request=[])
    {
        if(empty($request['app'])) return $this->error('app is empty');
        if(empty($request['data'])) return $this->error('config data is empty');
        return $this->success(config($request['app']));
    }
}