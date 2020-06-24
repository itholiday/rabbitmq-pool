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

class RabbitMQConfig extends SplBean
{
    protected $host = '127.0.0.1';
    protected $port = '5672';
    protected $user;
    protected $passwd;
    protected $vhost = '/';
    protected $insist = false;
    protected $loginMethod = 'AMQPLAIN';
    protected $loginResponse = null;
    protected $locale = 'en_US';
    protected $connectionTimeout = 3.0;
    protected $readWriteTimeout = 3.0;
    protected $context = null;
    protected $keepalive = false;
    protected $heartbeat = 0;
    protected $channelRpcTimeout = 0.0;
    protected $sslProtocol = null;
    protected $reconnectTimes = 3;
    protected $conn = null;

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }
    /**
     * @param mixed $host
     */
    public function setHost($host): void
    {
        $this->host = $host;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }
    /**
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }
    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }
    /**
     * @return mixed
     */
    public function getPasswd()
    {
        return $this->passwd;
    }
    /**
     * @param mixed $passwd
     */
    public function setPasswd($passwd): void
    {
        $this->passwd = $passwd;
    }
    /**
     * @return mixed
     */
    public function getVhost()
    {
        return $this->vhost;
    }
    /**
     * @param mixed $user
     */
    public function setVhost($vhost): void
    {
        $this->vhost = $vhost;
    }
    /**
     * @return mixed
     */
    public function getInsist()
    {
        return $this->insist;
    }
    /**
     * @param mixed $insist
     */
    public function setInsist($insist): void
    {
        $this->insist = $insist;
    }
    /**
     * @return mixed
     */
    public function getLoginMethod()
    {
        return $this->loginMethod;
    }
    /**
     * @param mixed $loginMethod
     */
    public function setLoginMethod($loginMethod): void
    {
        $this->loginMethod = $loginMethod;
    }
    /**
     * @return mixed
     */
    public function getLoginResponse()
    {
        return $this->loginResponse;
    }
    /**
     * @param mixed $loginResponse
     */
    public function setLoginResponse($loginResponse): void
    {
        $this->loginResponse = $loginResponse;
    }
    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }
    /**
     * @param mixed $locale
     */
    public function setLocale($locale): void
    {
        $this->locale = $locale;
    }
    /**
     * @return mixed
     */
    public function getConnectionTimeout(): float
    {
        return $this->connectionTimeout;
    }
    /**
     * @param mixed $connectionTimeout
     */
    public function setConnectionTimeout(float $connectionTimeout): void
    {
        $this->connectionTimeout = $connectionTimeout;
    }
    /**
     * @return mixed
     */
    public function getReadWriteTimeout(): float
    {
        return $this->readWriteTimeout;
    }
    /**
     * @param mixed $readWriteTimeout
     */
    public function setReadWriteTimeout(float $readWriteTimeout): void
    {
        $this->readWriteTimeout = $readWriteTimeout;
    }
    /**
     * @return mixed
     */
    public function getContext()
    {
        return $this->context;
    }
    /**
     * @param mixed $context
     */
    public function setContext($context): void
    {
        $this->context = $context;
    }
    /**
     * @return mixed
     */
    public function getKeepalive()
    {
        return $this->keepalive;
    }
    /**
     * @param mixed $keepalive
     */
    public function setKeepalive($keepalive): void
    {
        $this->keepalive = $keepalive;
    }
    /**
     * @return int
     */
    public function getHeartbeat(): int
    {
        return $this->heartbeat;
    }

    /**
     * @param int $heartbeat
     */
    public function setHeartbeat(int $heartbeat): void
    {
        $this->heartbeat = $heartbeat;
    }

    /**
     * @return mixed
     */
    public function getChannelRpcTimeout(): float
    {
        return $this->channelRpcTimeout;
    }
    /**
     * @param mixed $channelRpcTimeout
     */
    public function setChannelRpcTimeout(float $channelRpcTimeout): void
    {
        $this->channelRpcTimeout = $channelRpcTimeout;
    }

    /**
     * @return mixed
     */
    public function getSslProtocol()
    {
        return $this->sslProtocol;
    }
    /**
     * @param mixed $sslProtocol
     */
    public function setSslProtocol($sslProtocol): void
    {
        $this->sslProtocol = $sslProtocol;
    }
    /**
     * @return int
     */
    public function getReconnectTimes(): int
    {
        return $this->reconnectTimes;
    }

    /**
     * @param int $reconnectTimes
     */
    public function setReconnectTimes(int $reconnectTimes): void
    {
        $this->reconnectTimes = $reconnectTimes;
    }
    /**
     * @return int
     */
    public function getConn(): ?int
    {
        return $this->conn;
    }

    /**
     * @param int $conn
     */
    public function setConn(?int $conn): void
    {
        $this->conn = $conn;
    }

}