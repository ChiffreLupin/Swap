<?php

/**
    Class Controller
    @package app\controllers
 */

namespace app\core;
use app\core\middlewares\BaseMiddleware;

class Controller {
    public string $layout = 'head';
    public string $current = 'Login';
    public string $action = '';
    /**
     * @var app\core\middlewares\BaseMiddleware[]
     */
    public array $middlewares = [];

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function setCurrent($current) {
        $this->current = $current;
    }

    public function render($view, $params = []) {
        return Application::$app->router->displayView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware) {
        $this->middlewares[] = $middleware;
    }
}
