<?php
/**
 * @desc BaseService.php
 * RPC 服务基类
 * @auhtor Wayne
 * @time 2025/1/8 上午11:30
 */
namespace app\service;

use support\Log;

class RpcService{

    public function __call($name, $arguments){
        Log::info('BaseService __call',[$name, $arguments]);
    }

    public function success($data)
    {
        return json_encode(['code'=>RpcEnum::CODE_SUCCESS,'data'=>$data, 'msg'=>'success']);
    }

    public function error($msg='fail', $data=[]){
        return json_encode(['code'=>RpcEnum::CODE_ERROR,'data'=>$data, 'msg'=>$msg]);
    }
}