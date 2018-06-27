<?php

final class Database
{

    protected static $pdo = null;
    
    // Only for educational purpose!!! Config file MUST not be accesseble via browser
    const DB_HOST = '127.0.0.1';
    const DB_NAME = 'gallery';
    const DB_USER = 'root';
    const DB_PASS = '123456';
    const DB_CHARSET = 'utf8mb4';

    private function __construct()
    {
        
    }

    private function __clone()
    {
        
    }

    public static function connection()
    {
        if (self::$pdo == 0) {
            $opt = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $dns = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=' . self::DB_CHARSET;
            self::$pdo = new PDO($dns, self::DB_USER, self::DB_PASS, $opt);
        }
        return self::$pdo;
    }

    public static function run($sql, $args = [])
    {
        $smtm = self::connection()->prepare($sql);
        $smtm->execute($args);
        return $smtm;
    }

}
