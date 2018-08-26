<?php

$redis = new Redis();
$redis->connect('redis.lab.net', 6379);

$key = 'mykey20180826';

var_dump($redis->get($key));
var_dump($redis->decrBy($key, 10));