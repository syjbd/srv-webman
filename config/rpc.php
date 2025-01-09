<?php
/**
 * @desc rpc.php
 * @auhtor Wayne
 * @time 2025/1/8 下午2:58
 */
return [
    'connections' => [
        'default' => [
            'host'      => 'tcp://127.0.0.1:8888',
            'length'    => 10240000,
            'token'     => 'rpcToken'
        ],
        'wallet' => [
            'host'      => 'tcp://127.0.0.1:8880',
            'length'    => 10240000,
            'token'     => ''
        ],
        'level' => [
            'host' => 'tcp://127.0.0.1:8881',
            'length'    => 10240000,
            'token'     => ''
        ],
        'user' => [
            'host' => 'tcp://127.0.0.1:8882',
            'length'    => 10240000,
            'token'     => ''
        ],
        'activity' => [
            'host'      => 'tcp://127.0.0.1:8883',
            'length'    => 10240000,
            'token'     => ''
        ],
        'order' => [
            'host' => 'tcp://127.0.0.1:8884',
            'length'    => 10240000,
            'token'     => ''
        ],
        'game' => [
            'host' => 'tcp://127.0.0.1:8885',
            'length'    => 10240000,
            'token'     => ''
        ],
    ]
];