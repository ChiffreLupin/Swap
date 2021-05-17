<?php
// $app = new \app\core\Application();
// Replace with this to tell app we will use this 
// class on the file
use app\core\Application;
use app\controllers\HomeController;
use app\controllers\AuthController;

// Any class can be autoloaded using \app\core\
require_once __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// The _ENV stuff come from the .env file
// There we store data related to database connection
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];


// Proj root
// dirname gives directory of current directory specified as arg
$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', function() {
    return "Hello world";
});
$app->router->get('/login', [AuthController::class, 'getLogin']);
$app->router->post('/login', [AuthController::class, 'postLogin']);

$app->router->get('/register', [AuthController::class, 'getRegister']);
$app->router->post('/register', [AuthController::class, 'postRegister']);
// Should allow passing controllers or views to
// the router
// $app->router->get('/home', 'home');
$app->router->get('/home', [HomeController::class, 'getHomeProducts']);

$app->run();