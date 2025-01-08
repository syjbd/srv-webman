<?php
/**
 * @desc BaseService.php
 * RPC 服务基类
 * @auhtor Wayne
 * @time 2025/1/8 上午11:30
 */
namespace app\service;

class RpcClients{

    protected $error;

    protected $host;
    protected $service;
    protected $method;

    public function getError()
    {
        return $this->error;
    }

    public function __call($name, $arguments)
    {
        $this->host = $arguments[0]['host'];
        $this->service = $arguments[0]['service'];
        $this->method = $name;
        return $this->getResult($arguments[0]['args']);
    }

    public function setHost($host): RpcClients
    {
        $this->host = $host;
        return $this;
    }

    public function setService($service): RpcClients{
        $this->service = $service;
        return $this;
    }

    public function setMethod($method): RpcClients
    {
        $this->method = $method;
        return $this;
    }

    public function getResult($arguments)
    {
        $service = str_replace('/', '\\', $this->service);
        $client = stream_socket_client($this->host);
        $request = [
            'class'   => $service,
            'method'  => $this->method,
            'args'    => $arguments,
        ];
        fwrite($client, json_encode($request)."\n"); // text协议末尾有个换行符"\n"
        $result = fgets($client, 10240000);
        $result = json_decode($result, true);
        if($result['code'] === \app\service\RpcEnum::CODE_SUCCESS){
            return $result['data'];
        }else{
            $this->error = $result['msg'];
            return false;
        }
    }
}