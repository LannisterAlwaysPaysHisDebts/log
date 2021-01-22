<?php

namespace Cao\Plog;

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class LogUtil
{
    /**
     * 将日志写入到指定的日志文件
     * 对monolog的简单封装
     * @param $file
     * @param $info
     * @param string $tag
     * @param int $level
     * @return bool
     */
    public static function log2File($file, $info, $tag = 'default', $level = Logger::DEBUG)
    {
        if (is_array($info)) {
            $info = json_encode($info, JSON_UNESCAPED_UNICODE) . PHP_EOL;
        }

        try {
            $stream = new StreamHandler($file, $level);
            $logger = new Logger($tag);
            $logger->pushHandler($stream);
            $logger->info($info);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * 根据命名空间和文件名快速获取类对应的日志文件路径
     * @param string $namespace 调用该方法的类所在命名空间
     * @param string $file 调用该方法的文件名称
     * @param string $logRootPath
     * @return string     日志文件路径
     */
    public static function getLogFilePath($namespace, $file, $logRootPath)
    {
        $logPath = $logRootPath . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $namespace);
        if (!file_exists($logPath) || !is_dir($logPath)) {
            mkdir($logPath, 0755, true);
        }
        $currentDay = date("Y-m-d");
        return $logPath . DIRECTORY_SEPARATOR . basename($file) . "_" . $currentDay . ".log";
    }
}