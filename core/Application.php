<?php
/**
    Class Application
    @package app\core
 */

 namespace app\core;

 class Application {

    public static string $ROOT_DIR;
    public static Application $app;

    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    
    // Store controller inside application so we can access it anywhere
    public Controller $controller;

    // Take dirname of public folder
    public function __construct($rootPath,array $config){
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
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
 }