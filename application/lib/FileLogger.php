<?php
namespace application\lib;

class FileLogger
{
    const FILE_PATH = DIR . 'public/log.log';


    static public function log($message)
    {
        $date = date("Y-m-d H:i:s");
        $msg = $date . ';'. $message . "\n";
        file_put_contents(self::FILE_PATH, $msg, FILE_APPEND);
    }

}