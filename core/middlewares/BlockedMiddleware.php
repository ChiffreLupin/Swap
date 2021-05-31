<?php

/**
 * @author swapGroup
 * @package app\core\middleware;
 */

namespace app\core\middlewares;
use app\core\Application;
use app\core\exception\BlockedException;

class BlockedMiddleware extends BaseMiddleware{

    public array $actions = [];

    public function __construct(array $actions = []) {
        $this->actions = $actions;
    }

    public function execute() {
        if(!Application::isGuest() && Application::isBlocked()) {
            if(empty($this->actions) 
            || in_array(Application::$app->controller->action, $this->actions))
            {
                throw new BlockedException();
            }
        }
    }
}