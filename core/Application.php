<?php
/**
    Class Application
    @package app\core
 */

namespace app\core;
use \PDO;


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
            $user = $this->userClass::findOne([$primaryKey => $primaryValue]);
            $this->user = $user ? $user : null;
        } else {
            $this->user = null;
        }
    }

    // Check if user is logged in
    public static function isGuest() {
        return !self::$app->user;
    }

    public static function isAdmin() {
        if(!self::isGuest()) {
            if(self::$app->user->type === 'admin') {
                return true;
            }
        }
        return false;
    }

    public static function isBlocked() {
        if(!self::isGuest()) {
            if(self::$app->user->blocked === 1)
                return true;
        }

        return false;
    }

    public function getController(): \app\core\Controller {
        return $this->controller;
    }

    public function setController( \app\core\Controller $controller ): void {
        $this->controller = $controller;
    }

    public function run() {
        try {
        echo $this->router->resolve();
        }
        catch(\Exception $e) {
            echo $this->router->displayView("_error", [
                "exception" => $e
            ]);
        }
    }

    public function login(DbModel $user) {
        $this->user = $user;
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