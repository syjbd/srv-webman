<?php

namespace app\command;

use app\rpc\RpcClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class TestRun extends Command
{
    protected static $defaultName = 'test:run';
    protected static $defaultDescription = 'test run';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('name', InputArgument::OPTIONAL, 'Name description');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $output->writeln('Hello test:run');
//        $result = rpcGet('tcp://127.0.0.1:8888','app/service/sms/Send','get',['arr'=>[120,'wayne']]);


//        $obj = new RpcClients();
//        $result = $obj->setService('app/service/sms/Send')
//        ->setMethod('get')
//        ->getResult(['arr'=>[120,'wayne']]);
//        var_dump($result);
//        if($result === false){
//            var_dump($obj->getError());
//        }

        $obj = new RpcClient();
        $result = $obj->setConnect('user')
            ->setService('index/Config')
            ->setMethod('set')
            ->getResult(['app' => 'log']);
        $output->writeln(json_encode($result));
//        $queue = 'queue_sms';
//        // 数据，可以直接传数组，无需序列化
//        $data = ['mobile' => '8825555255', 'type' => 'register', 'ip' => '127.0.0.1'];
//        // 投递消息
//        Redis::send($queue, $data);
        // 投递延迟消息，消息会在60秒后处理
//        Client::send($queue, $data, 60);

        return self::SUCCESS;
    }

}
