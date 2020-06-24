<?php
namespace EasySwoole\RabbitMQPool\Connection;

use EasySwoole\Pool\ObjectInterface;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * Class AMQPConnection
 *
 * Kept for BC
 *
 * @deprecated
 */
class AMQPConnection extends AMQPStreamConnection implements ObjectInterface
{
    public function __construct($host, $port, $user, $password, $vhost = '/', $insist = false, $login_method = 'AMQPLAIN', $login_response = null, $locale = 'en_US', $connection_timeout = 3.0, $read_write_timeout = 3.0, $context = null, $keepalive = false, $heartbeat = 0, $channel_rpc_timeout = 0.0, $ssl_protocol = null)
    {
        parent::__construct($host, $port, $user, $password, $vhost, $insist, $login_method, $login_response, $locale, $connection_timeout, $read_write_timeout, $context, $keepalive, $heartbeat, $channel_rpc_timeout, $ssl_protocol);
    }

    //unset 的时候执行
    public function gc()
    {
        // TODO: Implement gc() method.
        $this->close();
    }
    //使用后,free的时候会执行
    public function objectRestore()
    {
        // TODO: Implement objectRestore() method.
    }
    //使用前调用,当返回true，表示该对象可用。返回false，该对象失效，需要回收
    public function beforeUse(): ?bool
    {
        // TODO: Implement beforeUse() method.
        if ($this->isConnected()) {
            return true;
        } else {
            return false;
        }
    }
}
