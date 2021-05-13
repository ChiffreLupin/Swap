<?php

// Any class can be autoloaded using \app\core\
require_once __DIR__.'/../vendor/autoload.php';

// $app = new \app\core\Application();
// Replace with this to tell app we will use this 
// class on the file
use app\core\Application;
use app\controllers\HomeController;

// Proj root
$app = new Application(dirname(__DIR__));

$app->router->get('/', function() {
    return "Hello World!";
});

// Should allow passing controllers or views to
// the router
// $app->router->get('/home', 'home');
$app->router->get('/home', [HomeController::class, 'getHomeProducts']);
$app->run();