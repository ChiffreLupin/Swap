<?php

/**
    Class AdminController
    @package app\controllers
 */

namespace app\controllers;
use app\core\Controller;
use app\core\middlewares\AdminAuthMiddleware;
use app\core\middlewares\BlockedMiddleware;


class AdminController extends Controller {
    public function __construct() {
        $this->registerMiddleware(new AdminAuthMiddleware());
        $this->registerMiddleware(new BlockedMiddleware());
    }

    public function getAdminUsers() {
        $this->setLayout("admin");
        $this->setCurrent("Users");

        return $this->render("admin/admin_user");
    }
    
}
