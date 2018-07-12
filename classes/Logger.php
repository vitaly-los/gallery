<?php

class Logger
{

    const PHP_ERROR = 'logs/php_errors.log';
    const ACTION_LOG = 'logs/action.log';

    public function __construct()
    {
        set_error_handler(array($this, 'logPHPError'), -1);
    }

    /**
     * Log user's action on site like register new user. Also we can use mail function to message site's owner
     * @param type $message
     * @param type $user
     */
    public static function logAction($message, $user)
    {
        $logtime = strftime("%Y-%m-%d %H:%M:%S", time());
        $content = "{$logtime} |{$message} : {$user}\n";
        file_put_contents(self::ACTION_LOG, $content, FILE_APPEND);
    }

    /**
     * Write errors to logs/php_errors.log
     * @param type $errno
     * @param type $errstr
     * @param type $errfile
     * @param type $errline
     */
    public function logPHPError($errno, $errstr, $errfile, $errline)
    {
        $content = "$errno  $errstr  $errfile $errline";
        file_put_contents(self::PHP_ERROR, "$content\n", FILE_APPEND);
    }

}
