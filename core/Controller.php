<?php

/**
    Class Controller
    @package app\controllers
 */

namespace app\core;

class Controller {
    public string $layout = 'head';
    public string $current = 'Login';

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function setCurrent($current) {
        $this->current = $current;
    }

    public function render($view, $params = []) {
        return Application::$app->router->displayView($view, $params);
    }

}