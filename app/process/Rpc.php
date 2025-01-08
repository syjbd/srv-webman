<?php
/**
 * @desc Rpc.php
 * @auhtor Wayne
 * @time 2025/1/8 上午10:54
 */
namespace app\process;
use Workerman\Connection\TcpConnection;
class Rpc
{
    public function onMessage(TcpConnection $connection, $data)
    {
        static $instances = [];
        $data = json_decode($data, true);
        $class = $data['class'];
        $method = $data['method'];
        $args = $data['args'];
        if (!isset($instances[$class])) {
            $instances[$class] = new $class; // 缓存类实例，避免重复初始化
        }
        $connection->send(call_user_func_array([$instances[$class], $method], $args));
    }
}