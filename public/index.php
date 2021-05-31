<?php
// $app = new \app\core\Application();
// Replace with this to tell app we will use this 
// class on the file
use app\core\Application;
use app\controllers\HomeController;
use app\controllers\AuthController;
use app\controllers\AboutController;
use app\models\User;

// Any class can be autoloaded using \app\core\
require_once __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// The _ENV stuff come from the .env file
// There we store data related to database connection
$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];


// Proj rootcd
// dirname gives directory of current directory specified as arg
$app = new Application(dirname(__DIR__), $config);

$app->router->get('/login', [AuthController::class, 'getLogin']);
$app->router->post('/login', [AuthController::class, 'postLogin']);

$app->router->get('/register', [AuthController::class, 'getRegister']);
$app->router->post('/register', [AuthController::class, 'postRegister']);

$app->router->get('/resetPassword', [AuthController::class, 'getResetPassword']);
$app->router->post('/resetPassword', [AuthController::class, 'postResetPassword']);

$app->router->get('/forgotPassword', [AuthController::class, 'getForgotPassword']);
$app->router->post('/forgotPassword', [AuthController::class, 'postForgotPassword']);

$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/', [AboutController::class, 'getAbout']);
$app->router->get('/userProducts', [HomeController::class, 'getUserProducts']);

$app->router->get('/home', [HomeController::class, 'getHomepage']);
// $app->router->post('/category', [HomeController::class, 'postCategories']);
$app->router->get('/loadProducts', [HomeController::class, 'loadProducts']);


$app->router->get('/productDetails', [HomeController::class, 'getProductDetails']);
$app->router->post('/createSwap', [HomeController::class, 'createSwap']);
$app->router->post('/acceptSwap', [HomeController::class, 'acceptSwap']);


$app->router->get('/notifications', [HomeController::class, 'getNotifications']);
$app->router->post('/deleteNotification', [HomeController::class, 'deleteRequestNotification']);

$app->router->get('/myProfile', [HomeController::class, 'getMyProfile']);
$app->router->post('/myProfile', [HomeController::class, 'postMyProfile']);

$app->router->post('/deleteProduct', [HomeController::class, 'postDeleteProduct']);


// Should allow passing controllers or views to
// the router
// $app->router->get('/home', 'home');
// $app->router->get('/home', [HomeController::class, 'getHomeProducts']);
// $admin = new User();
// $admin->firstname="Lorem";
// $admin->lastname="Ipsum";
// $admin->username="admini1";
// $admin->email="admin1@gmail.com";
// $admin->password="12345678";
// $admin->confirmPassword="12345678";
// $admin->type="admin";
// $admin->save();
$app->run();


