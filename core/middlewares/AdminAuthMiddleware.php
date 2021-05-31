<?php

/**
 * @author swapGroup
 * @package app\core\middleware;
 */

namespace app\core\middlewares;
use app\core\Application;
use app\core\exception\ForbiddenException;

class AdminAuthMiddleware extends BaseMiddleware{

    public array $actions = [];

    public function __construct(array $actions = []) {
        $this->actions = $actions;
    }

    public function execute() {
        if(!Application::isAdmin() || Application::isGuest()) {
            if(empty($this->actions) 
            || in_array(Application::$app->controller->action, $this->actions))
            {
                throw new ForbiddenException();
            }
        }
    }
}