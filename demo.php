<?php

require "./vendor/autoload.php";

use Cao\Plog\LogUtil;

$log = LogUtil::getLogFilePath('test', 'test', __DIR__);
LogUtil::log2File($log, 'info');

var_dump('aaa');
