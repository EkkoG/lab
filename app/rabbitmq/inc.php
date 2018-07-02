<?php
require_once __DIR__ . '/vendor/autoload.php';
function get_param($key) {
    $ret = getopt('', [$key.':']);
    if (empty($ret)) {
        return null;
    }
    return reset($ret);
}