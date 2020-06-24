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
use EasySwoole\RabbitMQPool\Config\RabbitMQConfig;
use EasySwoole\RabbitMQPool\Connection\AMQPConnection;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQPool extends MagicPool
{
    function __construct(RabbitMQConfig $rabbitConfig,?string $cask = null)
    {
        parent::__construct(function ()use($rabbitConfig, $cask){
            if($cask){
                return new $cask($rabbitConfig);
            }
            $rabbitObj = new AMQPConnection(
                $rabbitConfig->getHost(),
                $rabbitConfig->getPort(),
                $rabbitConfig->getUser(),
                $rabbitConfig->getPasswd(),
                $rabbitConfig->getVhost(),
                $rabbitConfig->getInsist(),
                $rabbitConfig->getLoginMethod(),
                $rabbitConfig->getLoginResponse(),
                $rabbitConfig->getLocale(),
                $rabbitConfig->getConnectionTimeout(),
                $rabbitConfig->getReadWriteTimeout(),
                $rabbitConfig->getContext(),
                $rabbitConfig->getKeepalive(),
                $rabbitConfig->getHeartbeat(),
                $rabbitConfig->getChannelRpcTimeout(),
                $rabbitConfig->getSslProtocol()
            );
            return $rabbitObj;
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