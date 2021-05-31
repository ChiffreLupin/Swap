<?php

/**
    Class AboutController
    @package app\controllers
 */

namespace app\controllers;
use app\core\Controller;
use app\core\middlewares\AdminAuthMiddleware;
use app\core\middlewares\BlockedMiddleware;


class AboutController extends Controller {
    public function __construct() {
        $this->registerMiddleware(new AdminAuthMiddleware());
        $this->registerMiddleware(new BlockedMiddleware());
    }

    
}
