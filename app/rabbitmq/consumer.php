<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('rabbitmq.work.net', 5672, 'guest', 'guest');
$channel = $connection->channel();

$longopt = array(
    'queue:',
    'ack:',
);

$params = getopt('', $longopt);
$queueName = $params['queue'];
$isAck = $params['ack'];

$channel->queue_declare($queueName, false, true, false, false);

echo " [*] 等待消息. 输入 CTRL+C 退出\n";

$callback = function ($msg) use ($isAck) {
    echo ' [x] 接受了 ', $msg->body, "\n";
    sleep(substr_count($msg->body, '.'));
    if ($isAck) {
        echo " [x] 回复Ack\n";
        $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
    }
    echo " [x] 处理完毕\n";
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume($queueName, '', false, false, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();