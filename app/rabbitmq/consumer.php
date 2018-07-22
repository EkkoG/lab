<?php
include __DIR__.'/inc.php';
$connection = get_conn();
$channel = $connection->channel();


$queueName = get_param('queue');
$isAck = get_param('ack');
if (is_null($isAck)) {
    $isAck = 1;
}

$retryCount = intval(get_param('retry_count'));

echo " [*] 等待消息. 输入 CTRL+C 退出\n";

$callback = function ($msg) use ($isAck, $retryCount) {
    echo " [x] 收到了 \n";
    echo " [x] ".$msg->body."\n";
    sleep(substr_count($msg->body, '.'));
    if ($isAck) {
        echo " [x] 确认收到消息\n";
        $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
    } else {
        // $msg->delivery_info['channel']->basic_nack($msg->delivery_info['delivery_tag'], false, true);
    }
    echo " [x] 处理完毕\n";
};

$prefetchCount = get_param('prefetch_count');
if ($prefetchCount) {
    $channel->basic_qos(null, $prefetchCount, null);
}
$nowait = false;
$channel->basic_consume($queueName, '', false, false, false, $nowait, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();