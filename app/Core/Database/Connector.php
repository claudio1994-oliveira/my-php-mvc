<?php

namespace App\Core\Database;

use App\Config\Config;
use App\Core\Container;
use PDO;
use PDOException;
use PDOStatement;

class Connector
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {

        if (is_null(self::$instance)) {
            match (env('DB_CONNECTION')) {
                'mysql' => self::mysql(),
                'sqlite' => self::sqlite(),
                default => die('Database driver not supported'),
            };
        }

        return self::$instance;
    }

    protected static function mysql(): void
    {
        if (is_null(self::$instance)) {
            try {
                self::$instance = new PDO(
                    'mysql:host=' . self::getConfig()->get('database.mysql.host') . ';dbname=' . self::getConfig()->get('database.mysql.database'),
                    self::getConfig()->get('database.mysql.username'),
                    self::getConfig()->get('database.mysql.password')
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
    }

    protected static function sqlite(): void
    {
        if (is_null(self::$instance)) {
            try {
                self::$instance = new PDO(
                    'sqlite:' . self::getConfig()->get('database.sqlite.database')
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
    }

    protected static function getConfig(): Config
    {
        return Container::getInstance()->get(Config::class);
    }


}
