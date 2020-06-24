<?php

namespace EasySwoole\RabbitMQPool;

use EasySwoole\Component\Singleton;
use EasySwoole\RabbitMQ\RabbitMQPoolException;
use EasySwoole\Pool\Config as PoolConfig;
use EasySwoole\RabbitMQPool\Config\RabbitMQChannelConfig;
use EasySwoole\RabbitMQPool\Config\RabbitMQConfig;
use PhpAmqpLib\Exchange\AMQPExchangeType;

class RabbitMQChannel
{
    use Singleton;
    protected $container = [];

    function register(string $name, RabbitMQChannelConfig $config): PoolConfig
    {
        if(isset($this->container[$name])){
            //已经注册，则抛出异常
            throw new RabbitMQPoolException("rabbitmq channel pool:{$name} is already been register");
        }

        $pool = new RabbitMQChannelPool($config);
        $this->container[$name] = $pool;
        return $pool->getConfig();
    }

    function get(string $name): ?RabbitMQChannelPool
    {
        if (isset($this->container[$name])) {
            return $this->container[$name];
        }
        return null;
    }

    function pool(string $name): ?RabbitMQChannelPool
    {
        return $this->get($name);
    }

    static function defer(string $name,$timeout = null):?RabbitMQChannelPool
    {
        $pool = static::getInstance()->pool($name);
        if($pool){
            return $pool->defer($timeout);
        }else{
            return null;
        }
    }

    static function invoke(string $name,callable $call,float $timeout = null)
    {
        $pool = static::getInstance()->pool($name);
        if($pool){
            return $pool->invoke($call,$timeout);
        }else{
            return null;
        }
    }
}