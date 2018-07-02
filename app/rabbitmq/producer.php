<?php
include __DIR__.'/inc.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq.work.net', 5672, 'guest', 'guest');
$channel = $connection->channel();


$queueName = get_param('queue');
var_dump($queueName);exit();
$exchange = get_param('exchange');
if (empty($exchange)) {
    $exchange = '';
}

$routingKey = get_param('routing_key');
if (empty($routingKey)) {
    $routingKey = $queueName;
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

$channel->queue_declare($queueName, $passive, $durable, $exclusive, $autoDelete, $nowait);

$channel->basic_publish($msg, $exchange, $routingKey);

echo ' [x] 已发送内容：', $data, "\n";

$channel->close();
$connection->close();