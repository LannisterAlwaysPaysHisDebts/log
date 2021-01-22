<?php

require "./vendor/autoload.php";

use Plog\LogUtil;

$log = LogUtil::getLogFilePath('test', 'test', __DIR__);
LogUtil::log2File($log, 'info');

