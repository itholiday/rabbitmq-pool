<?php


namespace EasySwoole\RabbitMQPool;


use EasySwoole\Pool\Config;

class PoolConfig extends Config
{
    // 定义自己业务需要的参数

    protected $autoPing=5;

    /**
     * @return mixed
     */
    public function getAutoPing()
    {
        return $this->autoPing;
    }

    /**
     * @param mixed $autoPing
     */
    public function setAutoPing($autoPing): void
    {
        $this->autoPing = $autoPing;
    }

}