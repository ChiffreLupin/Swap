<?php

/**
    Class Router
    @package app\core
 */

namespace app\core;

class Router {
    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request,Response $response) {
        $this->request = $request;
        $this->response = $response;

    }

    public function get($path, $callback) {
        $this->routes[$this->request->getMethod()][$path] = $callback;
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
            $callback[0] = new $callback[0]();
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

    public function onlyIncludes($layout) {
        // Cache instead of return
        ob_start();
        include_once Application::$ROOT_DIR."/views/includes/head.php";
        return ob_get_clean();
    }
} 