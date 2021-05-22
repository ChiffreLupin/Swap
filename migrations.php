<?php
// Purpose of migrations is creating all the tables
// when someone uses this code
// Migrations are stored in specific order 
// and are stored in specific file(this one)

// The _ENV stuff come from the .env file
// There we store data related to database connection

use app\core\Application;

require_once __DIR__.'/vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(__DIR__, $config);

$app->db->applyMigrations();