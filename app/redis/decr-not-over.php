<?php

$redis = new Redis();
$redis->connect('redis.lab.net', 6379);

$key = 'mykey20180826204012';
$decrNum = 10;

// $redis->set($key, 12);

$script=<<<LUA

local val, decr_num = tonumber(redis.call('get', KEYS[1])), tonumber(ARGV[1])

if val == nil or val < decr_num then
    return 0
end

redis.call('decrby', KEYS[1], decr_num)

return 1
LUA;


$r = $redis->eval($script, [$key, $decrNum], 1);

var_dump($r);