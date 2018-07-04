<?php

final class Database
{

    protected static $pdo = null;

    /**
     * Only for educational purpose!!! Config file MUST not be accessible via browser
     */
    const DB_HOST = '127.0.0.1';
    const DB_NAME = 'gallery';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_CHARSET = 'utf8mb4';

    /**
     * private visibility to prevent from initialization 
     */
    private function __construct()
    {
        
    }

    /**
     * private visibility to prevent from initialization 
     */
    private function __clone()
    {
        
    }

    /**
     * 
     * @return PDO connection of false
     */
    public static function connection()
    {
        if (null === self::$pdo) {
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

    /**
     * 
     * @param type $sql query
     * @param type array $args
     * @return PDOstatement
     */
    public static function run($sql, $args = [])
    {
        $smtm = self::connection()->prepare($sql);
        $smtm->execute($args);
        return $smtm;
    }

}
