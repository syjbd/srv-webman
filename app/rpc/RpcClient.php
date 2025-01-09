<?php
/**
 * @desc RpcClient.php
 * @auhtor Wayne
 * @time 2025/1/9 下午6:39
 */
namespace app\rpc;

/**
 * @desc RpcClient
 * webman text rpc client
 * @package app\rpc
 */
class RpcClient{

    /**
     * @desc 连接池
     * @var array
     */
    protected $connect = [];

    /**
     * @desc 服务名
     * @var string
     */
    protected $service;

    /**
     * @desc 方法名
     * @var string
     */
    protected $method;

    /**
     * @desc 参数
     * @var array
     */
    protected $args;

    public function __construct(){
        $this->connect = config("rpc.connections.default");
    }

    public function setConnect($connect=""): RpcClient
    {
        $this->connect = config("rpc.connections.$connect");
        return $this;
    }

    public function setService($service=""): RpcClient
    {
        $this->service = $service;
        return $this;
    }

    public function setMethod($method=""): RpcClient{
        $this->method = $method;
        return $this;
    }

    public function __call($name, $arguments){
        $this->service = $arguments[0]['service'];
        $this->method = $name;
        $this->args = !empty($arguments[0]['args']) ? $arguments[0]['args'] : [];
        return $this->getResult();
    }

    public function getResult($args=[]): array
    {
        if(!empty($args)) $this->args = $args;
        $service = 'app\\service\\'.str_replace('/', '\\', $this->service);
        $client = stream_socket_client($this->connect['host']);
        $request = [
            'class'   => $service,
            'method'  => $this->method,
            'token'   => $this->connect['token'],
            'args'    => [$this->args],
        ];
        fwrite($client, json_encode($request)."\n"); // text协议末尾有个换行符"\n"
        $res = fgets($client, $this->connect['length']);
        return json_decode($res, true);
    }
}