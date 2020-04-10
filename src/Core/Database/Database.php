<?php

namespace Core\Database;

use Exception;
use PDO;

class Database extends PDO
{
    /**
     * @var Database $_instance
     */
    private static $_instance;

    /**
     * @return Database
     * @throws Exception
     */
    public static function get(): Database
    {
        if (self::$_instance instanceof Database) {
            return self::$_instance;
        }

        $dbConfig = require_once self::config();

        return new self(
            $dbConfig['dsn'],
            $dbConfig['username'],
            $dbConfig['password']
        );
    }

    /**
     * @return string
     * @throws Exception
     */
    private static function config(): string
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/src/App/Config/db.php';

        if (!file_exists($file)) {
            throw new Exception(
                sprintf(
                    'Database configuration file cannot be found. Please create it via console script %s',
                    'init_db_config.php'
                )
            );
        }

        return $file;
    }
}