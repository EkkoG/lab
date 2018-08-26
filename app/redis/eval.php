<?php

$redis = new Redis();
$redis->connect('redis.lab.net', 6379);

echo microtime(true)."\r\n";

$script=<<<LUA
local r=10
return {r}
LUA;

$r = $redis->eval($script);

var_dump($r);

echo microtime(true)."\r\n";