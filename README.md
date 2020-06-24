easyswoole rabbitmq pool

第一步-配置：
```php
    'RABBITMQ_1' => [
        'host' => '192.168.199.217',
        'port' => 5672,
        'user' => 'jddtest',
        'passwd' => 'jddtest',
        'vhost' => '/'
    ],
    'RABBITMQ_CHANNEL_1' => [
        'exchange' => 'router',
        'queue' => 'msgs',
        'routekey' => '',
        'connectionPoolName' => 'rabbitmq-pool-1'
    ],
```

第二步-EasySwooleEvent.php文件中initialize方法中注册：
```php
class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
        // rabbitmq-pool
        $rabbitmqPoolConfig = RabbitMQ::getInstance()->register('rabbitmq-pool-1', new RabbitMQConfig(Config::getInstance()->getConf('RABBITMQ_1')));
        $rabbitmqPoolConfig->setMinObjectNum(1);
        $rabbitmqPoolConfig->getMaxObjectNum(2);
        $rabbitmqPoolConfig->setIntervalCheckTime(30);
        $rabbitmqPoolConfig->setMaxIdleTime(30000000);
        $rabbitmqChannelPoolConfig = RabbitMQChannel::getInstance()->register('rabbitmq-channel-pool', new RabbitMQChannelConfig(Config::getInstance()->getConf('RABBITMQ_CHANNEL_1')));
        $rabbitmqChannelPoolConfig->setMaxIdleTime(3000000);
    }
```
第三步-使用：
```php
    public function rabbitmq()
    {
        $request = $this->request();
        $params = $request->getRequestParam();
        //rabbitmq-pool
        go(function () use ($params) {

            //直接初始化channel 如果连接重启EasySwoole\RabbitMQPool\RabbitMQChannelPool pool is empty
            $times = 3;
            while ($times > 0) {
                $res = $this->channelInvoke($params);
                if ($res === true) {
                    break;
                }
                var_dump($res, $times);
                $times --;
            }


//            // 初始化connection
//            \EasySwoole\RabbitMQPool\RabbitMQ::invoke('rabbitmq-pool', function (AMQPStreamConnection $rabbitmq) use ($params) {
//                $channel = $rabbitmq->channel();
//                $exchange = 'router';
//                $exchange = $params['exchange'];
//                $queue = 'msgs';
//                $queue = $params['queue'];
//                $msg = $params['msg'];
//                $channel->queue_declare($queue, false, true, false, false);
//                $channel->exchange_declare($exchange, AMQPExchangeType::DIRECT, false, true, false);
//                $channel->queue_bind($queue, $exchange);
//                $messageBody = "{'name'=>'jsk', 'age' => 12, 'msg'=> '失败的请求数量。因网络原因或服务器性能原因，发起的请求并不一定全部成功，通过'}";
//                $messageBody = $msg;
//                $message = new AMQPMessage($messageBody, array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
//                $channel->basic_publish($message, $exchange);
//                $channel->close();
//            });
        });
        $this->writeJson(200, $params);


    }

    private function channelInvoke($params)
    {
        try {
            $res = RabbitMQChannel::invoke('rabbitmq-channel-pool', function (AMQPChannel $channel) use ($params) {
                $exchange = 'router';
                $exchange = $params['exchange'];
                $queue = 'msgs';
                $queue = $params['queue'];
                $msg = $params['msg'];
                $messageBody = $msg;
                $message = new AMQPMessage($messageBody, array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
                // 如果connection关闭了，channel-pool不会一并回收。
                try {
                    $channel->basic_publish($message, $exchange);
                    return true;
                } catch (\Exception $exception) {
                    var_dump($exception->getMessage());
                    return false;
                }
            });
            return $res;
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            return false;
        }
    }
```