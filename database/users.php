<?php


use App\Core\Database\Connector;


include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../bootstrap/app.php';

$pdo = Connector::getInstance();

$pdo->exec('DROP TABLE IF EXISTS users;');

if (env('DB_CONNECTION') == 'mysql') {
    $pdo->exec('
        CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            username VARCHAR(255) NOT NULL UNIQUE,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );
    ');
} else {
    $pdo->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT NOT NULL , username TEXT NOT NULL UNIQUE , email TEXT NOT NULL UNIQUE , password TEXT NOT NULL , created_at TIMESTAMP, updated_at TIMESTAMP);');
}

echo 'database created successfully ✌️😉' . PHP_EOL;
