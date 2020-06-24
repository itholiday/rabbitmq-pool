<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2019/10/15 0015
 * Time: 14:46
 */

namespace  EasySwoole\RabbitMQPool;

use EasySwoole\Pool\MagicPool;
use EasySwoole\Pool\ObjectInterface;
use EasySwoole\RabbitMQPool\Config\RabbitMQChannelConfig;
use EasySwoole\RabbitMQPool\Config\RabbitMQConfig;
use EasySwoole\RabbitMQPool\Connection\AMQPConnection;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQChannelPool extends MagicPool
{
    function __construct(RabbitMQChannelConfig $channelConfig)
    {
        parent::__construct(function ()use($channelConfig) {
            /**
             * 测试直接返回channel，QPS会有多大变化
             * 翻3倍，达到2000以上。
             */
            $rabbitMQ = RabbitMQ::getInstance()->get($channelConfig->getConnectionPoolName());
            $rabbitObj = $rabbitMQ->getObj();
            /**
             * @param AMQPConnection $rabbitObj
             */
            $channel = new \EasySwoole\RabbitMQPool\Connection\AMQPChannel($rabbitObj);
            $exchange = $channelConfig->getExchange();
            $queue = $channelConfig->getQueue();
            $routekey = $channelConfig->getRoutekey();
            $channel->queue_declare($queue, false, true, false, false);
            $channel->exchange_declare($exchange, AMQPExchangeType::DIRECT, false, true, false);
            if (!empty($routekey)) {
                $channel->queue_bind($queue, $exchange, $routekey);
            } else {
                $channel->queue_bind($queue, $exchange);
            }
            $rabbitMQ->recycleObj($rabbitObj);
            return $channel;
        }, new PoolConfig());
    }


    /**
     * @param RabbitMQ $rabbitmq
     * @return bool
     */
    public function itemIntervalCheck($rabbitmq): bool
    {
        try{
            if ($rabbitmq instanceof AMQPStreamConnection) {
                // 检查连接是否可用
                return $rabbitmq->isConnected();
            }
            if ($rabbitmq instanceof AMQPChannel) {
                return $rabbitmq->is_open();
            }
            return false;
        } catch (\Throwable $throwable){
            //异常说明该连接出错了，return 进行回收
            return false;
        }
    }
}