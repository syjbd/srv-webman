<?php
/**
 * @desc IndexRpc.php
 * @auhtor Wayne
 * @time 2025/1/9 下午7:01
 */
namespace app\service\index;

use app\rpc\RpcServer;

class Index extends RpcServer{

    public function config(array $request=[])
    {
        $app = !empty($request['app']) ? $request['app'] : 'app';
        return $this->success(config($app));
    }

}