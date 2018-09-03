<?php
require_once __DIR__ . '/vendor/autoload.php';

function get_param($key) {
    $ret = getopt('', [$key.':']);
    if (empty($ret)) {
        return null;
    }
    return reset($ret);
}

function get_conn($host='rabbitmq.lab.net') {
    $connection = new \PhpAmqpLib\Connection\AMQPStreamConnection($host, 5672, 'guest', 'guest');
    // $connection = \PhpAmqpLib\Connection\AMQPStreamConnection::create_connection([
    //     ['host' => 'rabbitmq.lab.net', 'port' => 5672, 'user' => 'guest', 'password' => 'guest'],
    //     ['host' => 'rabbitmq2.lab.net', 'port' => 5672, 'user' => 'guest', 'password' => 'guest'],
    // ]);
    return $connection;
}