<?php
/**
    Class Router
    @package app\core
 */

namespace app\core;
use app\core\Controller;
use app\core\exception\ForbiddenException;

class Router {
    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request,Response $response) {
        $this->request = $request;
        $this->response = $response;
    }
    
    public function get($path, $callback) {

        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve() {
        $path = $this->request->getPath();  
        $method = $this->request->getMethod();
        // Even in case of error this is managed by null op
        
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false) {
            Application::$app->response->setStatusCode(404);
            return $this->displayView('_404');
        }
        if(is_string($callback)) {
            return $this->displayView($callback);
        }
        if(is_array($callback)) {
            /**
             * @var \app\core\Controller $controller
             */
            $controller =new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach($controller->middlewares as $middleware) {
                $middleware->execute();
            }
        }

        // Array works same way as function callbacl
        return call_user_func($callback, $this->request, $this->response);
    }

    public function displayView($view, $params = []) {

        $include = $this->onlyIncludes('head.php');
        $view = $this->onlyView($view, $params);

        return str_replace('{{content}}', $view, $include);
    }

    public function onlyView($view, $params) {
        foreach($params as $key => $value) {
            // Use key value as variable name
            $$key = $value;
        }
        // Now the include can see the variables
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }

    public function onlyIncludes() {
        // Cache instead of return
        $layout = Application::$app->controller->layout ?? "head";
        $current = Application::$app->controller->current ?? "404";
        ob_start();
        include_once Application::$ROOT_DIR."/views/includes/$layout.php";
        return ob_get_clean();
    }
    
}