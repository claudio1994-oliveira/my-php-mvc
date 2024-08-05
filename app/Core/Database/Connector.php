<?php

namespace App\Core\Database;

use App\Config\Config;
use PDO;
use PDOException;


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
                    'mysql:host=' . app(Config::class)->get('database.mysql.host') . ';dbname=' . app(Config::class)->get('database.mysql.database'),
                    app(Config::class)->get('database.mysql.username'),
                    app(Config::class)->get('database.mysql.password')
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
                    'sqlite:' . app(Config::class)->get('database.sqlite.path') . app(Config::class)->get('database.sqlite.database')
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
    }
}
