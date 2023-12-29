<?php

$pathDatabase = __DIR__ . '/../database.sqlite';
$pdo = new PDO('sqlite:' . $pathDatabase);


$pdo->exec('DROP TABLE IF EXISTS users;');
$pdo->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT NOT NULL , username TEXT NOT NULL UNIQUE , email TEXT NOT NULL UNIQUE , password TEXT NOT NULL , created_at TIMESTAMP, updated_at TIMESTAMP);');

echo 'database created successfully ✌️😉' . PHP_EOL;
