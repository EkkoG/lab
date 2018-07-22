<?php
require_once __DIR__ . '/vendor/autoload.php';

function get_param($key) {
    $ret = getopt('', [$key.':']);
    if (empty($ret)) {
        return null;
    }
    return reset($ret);
}

function get_conn() {
    $connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('rabbitmq.lab.net', 5672, 'guest', 'guest');
    return $connection;
}