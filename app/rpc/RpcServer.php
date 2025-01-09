<?php
/**
 * @desc RpcServer.php
 * @auhtor Wayne
 * @time 2025/1/9 下午6:39
 */
namespace app\rpc;

use app\service\RpcEnum;
use support\Log;

/**
 * @desc RpcServer
 * Webman text rpc server
 * @package app\rpc
 */
class RpcServer{

    protected string $rpcToken = 'rpcToken';

    /**
     * @throws \Exception
     */
    public function __construct($rpcToken = ''){
        if(!empty($this->rpcToken) && $rpcToken != $this->rpcToken){
            throw new \Exception('rpcToken error');
        }
    }

    public function __call($name, $arguments){
        Log::info('BaseService __call',[$name, $arguments]);
    }

    public function success($data): string
    {
        return json_encode(['code'=>RpcEnum::CODE_SUCCESS,'data'=>$data, 'msg'=>'success']);
    }

    public function error($msg='fail', $data=[]): string
    {
        return json_encode(['code'=>RpcEnum::CODE_ERROR,'data'=>$data, 'msg'=>$msg]);
    }

}