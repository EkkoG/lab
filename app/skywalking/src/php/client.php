<?php
include __DIR__.'/SkyWalking.php';

SkyWalking::getInstance("api")->setRegisterUrl('http://apm.api:12800')->setSamplingRate(100);
//LOG_PATH is skywalking's logfile path
// SkyWalking::getInstance("api")->setSamplingRate(5);
// $r = SkyWalking::getInstance("api")->getLogPath();
// var_dump($r);
// exit;

SkyWalking::getInstance()->startSpanOfCurl("www.api.com", $headers);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.baidu.com/");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$rs = curl_exec($ch);

SkyWalking::getInstance()->endSpanOfcurl($ch);