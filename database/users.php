<?php

$pathDatabase = __DIR__ . '/../database.sqlite';
$pdo = new PDO('sqlite:' . $pathDatabase);


$pdo->exec('DROP TABLE IF EXISTS users;');
$pdo->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, name TEXT, username TEXT);');

echo 'database created successfully ✌️😉' . PHP_EOL;
