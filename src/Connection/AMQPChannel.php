<?php
/**
 * Created KISS - Keep It Simple, Stupid!
 * Author : JSK
 * Date : 2020/4/30 16:16
 * Email : jiaoshengkang@163.com
 * Notice : As clear as possible
 */

namespace EasySwoole\RabbitMQPool\Connection;


use EasySwoole\Pool\ObjectInterface;

class AMQPChannel extends \PhpAmqpLib\Channel\AMQPChannel implements ObjectInterface
{
    public function __construct($connection, $channel_id = null, $auto_decode = true, $channel_rpc_timeout = 0)
    {
        parent::__construct($connection, $channel_id, $auto_decode, $channel_rpc_timeout);
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
        if ($this->is_open) {
            return true;
        } else {
            return false;
        }
    }
}