<?php
/**
 * Created KISS - Keep It Simple, Stupid!
 * Author : JSK
 * Date : 2020/4/29 14:48
 * Email : jiaoshengkang@163.com
 * Notice : As clear as possible
 */

namespace EasySwoole\RabbitMQPool\Config;


use EasySwoole\Spl\SplBean;

class RabbitMQChannelConfig extends SplBean
{
    protected $exchange;
    protected $queue;
    protected $routekey;
    protected $connectionPoolName = 'rabbitmq-pool-1';

    /**
     * @return mixed
     */
    public function getExchange()
    {
        return $this->exchange;
    }
    /**
     * @param mixed $exchange
     */
    public function setExchange($exchange): void
    {
        $this->exchange = $exchange;
    }
    /**
     * @return mixed
     */
    public function getQueue()
    {
        return $this->queue;
    }
    /**
     * @param mixed $queue
     */
    public function setQueue($queue): void
    {
        $this->queue = $queue;
    }
    /**
     * @return mixed
     */
    public function getRoutekey()
    {
        return $this->routekey;
    }
    /**
     * @param mixed $routekey
     */
    public function setRoutekey($routekey): void
    {
        $this->routekey = $routekey;
    }
    /**
     * @return mixed
     */
    public function getConnectionPoolName()
    {
        return $this->connectionPoolName;
    }
    /**
     * @param mixed $connectionPoolName
     */
    public function setConnectionPoolName($connectionPoolName): void
    {
        $this->connectionPoolName = $connectionPoolName;
    }
}