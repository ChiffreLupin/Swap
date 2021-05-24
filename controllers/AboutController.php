<?php

/**
    Class AboutController
    @package app\controllers
 */

namespace app\controllers;
use app\core\Controller;

class AboutController extends Controller {
    public function getAbout() {
        $this->setLayout("head");
        $this->setCurrent("Swap Home Page");

        return $this->render('About');
    }
    
}
