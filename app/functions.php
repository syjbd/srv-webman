<?php
/**
 * Here is your custom functions.
 */

/**
 * @desc rpc获取数据
 * @param string $url 请求URL 'tcp://127.0.0.1:8888'
 * @param string $service 服务名
 * @param string $method 请求方法
 * @param array $args 请求参数
 * @return mixed
 */
function rpcGet(string $url, string $service, string $method='get', array $args = []){
    $service = str_replace('/', '\\', $service);
    $client = stream_socket_client($url);
    $request = [
        'class'   => $service,
        'method'  => $method,
        'args'    => $args,
    ];
    fwrite($client, json_encode($request)."\n"); // text协议末尾有个换行符"\n"
    $result = fgets($client, 10240000);
    $result = json_decode($result, true);
    if($result['code'] === \app\service\RpcEnum::CODE_SUCCESS){
        return $result['data'];
    }else{
        return false;
    }
}