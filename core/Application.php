<?php
/**
    Class Application
    @package app\core
 */

namespace app\core;

 class Application {

    public static string $ROOT_DIR;
    public static Application $app;

    public string  $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    // Allows null
    public ?DbModel $user;
    
    // Store controller inside application so we can access it anywhere
    public Controller $controller;

    // Take dirname of public folder
    public function __construct($rootPath,array $config){
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
    
        $this->userClass = $config['userClass'];
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);

        // Allows us to select user on every request
        $primaryValue = $this->session->get('user');
        if($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    // Check if user is logged in
    public static function isGuest() {
        return !self::$app->user;
    }

    public function getController(): \app\core\Controller {
        return $this->controller;
    }

    public function setController( \app\core\Controller $controller ): void {
        $this->controller = $controller;
    }

    public function run() {
        echo $this->router->resolve();
    }

    public function login(DbModel $user) {
        $this->user = $user;

        var_dump($this->user);
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout() {
        $this->user = null;
        $this->session->remove('user');
    }
 }