<?php

/**
    Class Controller
    @package app\controllers
 */

namespace app\controllers;
use app\core\Application;

class Controller {
    public function render($view, $params = []) {
        return Application::$app->router->displayView($view, $params);
    }

}