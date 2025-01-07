## 相关基础扩展

### jwt
该扩展存在多语言的问题
#### 安装
```Shell
composer require tinywan/jwt

```
### 多语言
#### 安装
```shell
composer require symfony/translation
```
#### 使用
webman默认将语言包放在`resource/translations`目录下
```
resource/
└── translations
├── en
│   └── messages.php
└── zh_CN
└── messages.php
```
### Redis
#### 安装
```shell
composer require -W illuminate/redis illuminate/events
```
#### 配置
```php
return [
    'default' => [
        'host'     => '127.0.0.1',
        'password' => null,
        'port'     => 6379,
        'database' => 0,
    ]
];
```
### Redis队列
基于Redis的消息队列，支持消息延迟处理。
#### 安装
```shell
composer require webman/redis-queue
```
#### 配置
```php
return [
    'default' => [
        'host' => 'redis://127.0.0.1:6379',
        'options' => [
            'auth' => '',         // 密码，可选参数
            'db' => 0,            // 数据库
            'max_attempts'  => 5, // 消费失败后，重试次数
            'retry_seconds' => 5, // 重试间隔，单位秒
        ]
    ],
];
```

### Stomp队列
Stomp是简单(流)文本定向消息协议，它提供了一个可互操作的连接格式，允许STOMP客户端与任意STOMP消息代理（Broker）进行交互。workerman/stomp实现了Stomp客户端，主要用于 RabbitMQ、Apollo、ActiveMQ 等消息队列场景。
#### 安装
```shell
composer require workerman/stomp
```

### Env环境变量组件
#### 安装
```shell
composer require vlucas/phpdotenv
```
#### 使用
项目根目录新建`.env`文件
```dotenv
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=test
DB_USER=foo
DB_PASSWORD=123456
```
一般在`config`目录下的配置文件中使用,尽量避免在程序中直接使用
```php
return [
    'driver'      => 'mysql',
    'host'        => getenv('DB_HOST'),
];
```

### Crontab定时任务
类似linux的crontab，不同的是该库支持秒级定时。
#### 安装
```shell
composer require workerman/crontab
```
### 时间说明
```
0   1   2   3   4   5
|   |   |   |   |   |
|   |   |   |   |   +------ day of week (0 - 6) (Sunday=0)
|   |   |   |   +------ month (1 - 12)
|   |   |   +-------- day of month (1 - 31)
|   |   +---------- hour (0 - 23)
|   +------------ min (0 - 59)
+-------------- sec (0-59)[可省略，如果没有0位,则最小时间粒度是分钟]
```

### 单元测试
#### 安装
```shell
composer require --dev phpunit/phpunit
```
### 使用
新建文件 `tests/TestConfig.php`，用于测试数据库配置
```php
<?php
use PHPUnit\Framework\TestCase;

class TestConfig extends TestCase
{
    public function testAppConfig()
    {
        $config = config('app');
        self::assertIsArray($config);
        self::assertArrayHasKey('debug', $config);
        self::assertIsBool($config['debug']);
        self::assertArrayHasKey('default_timezone', $config);
        self::assertIsString($config['default_timezone']);
    }
}
```
### 运行
```shell
./vendor/bin/phpunit --bootstrap support/bootstrap.php tests/TestConfig.php --filter testAppConfig
```

### 
#### 安装 think-orm
```shell
composer require -W webman/think-orm
```