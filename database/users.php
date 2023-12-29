<?php

$pathDatabase = __DIR__ . '/../database.sqlite';
$pdo = new PDO('sqlite:' . $pathDatabase);


$pdo->exec('DROP TABLE IF EXISTS users;');
$pdo->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT, username TEXT, email TEXT, password TEXT, created_at TIMESTAMP, updated_at TIMESTAMP);');

echo 'database created successfully ✌️😉' . PHP_EOL;
