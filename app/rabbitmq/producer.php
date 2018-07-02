<?php
include __DIR__.'/inc.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq.work.net', 5672, 'guest', 'guest');
$channel = $connection->channel();


$queues = (array)get_param('queue');
$exchange = get_param('exchange');
if (empty($exchange)) {
    $exchange = '';
}
$exchangeType = get_param('exchange_type');
if (empty($exchangeType)) {
    $exchangeType = 'direct';
}

$routingKey = get_param('routing_key');
if (empty($routingKey)) {
    $routingKey = reset($queues);
}

$passive = boolval(get_param('passive'));
$durable = boolval(get_param('durable'));
$exclusive = boolval(get_param('exclusive'));
$autoDelete = boolval(get_param('auto_delete'));
$nowait = boolval(get_param('nowait'));


$data = sprintf('Hello World! Order Id (%s), Exchange (%s), Routing Key (%s)', md5(uniqid(rand())), $exchange, $routingKey);

$msg = new AMQPMessage(
    $data,
    array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
);



foreach ($queues as $key => $queueName) {
    $channel->queue_declare($queueName, $passive, $durable, $exclusive, $autoDelete, $nowait);
}

if ($exchange) {
    $channel->exchange_declare($exchange, $exchangeType);
    foreach ($queues as $key => $queueName) {
        $channel->queue_bind($queueName, $exchange);
    }
}


$channel->basic_publish($msg, $exchange, $routingKey);

echo ' [x] 已发送内容：', $data, "\n";

$channel->close();
$connection->close();