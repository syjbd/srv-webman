<?php

namespace app\command;

use app\service\RpcClients;
use app\service\RpcService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
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
        $obj = new RpcClients();
        $result = $obj->setHost('tcp://127.0.0.1:8888')
        ->setService('app/service/sms/Send')
        ->setMethod('status')
        ->getResult(['arr'=>[120,'wayne']]);
        var_dump($result);
        if($result === false){
            var_dump($obj->getError());
        }
        return self::SUCCESS;
    }

}
