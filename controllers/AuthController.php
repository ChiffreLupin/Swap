<?php

/**
    Class AuthController
    @package app\controllers
 */

namespace app\controllers;
use app\core\Request;
use app\core\Response;


class AuthController extends Controller {
   public function getLogin(Request $req,Response $resp) {
    return $this->render('login');
   }

   public function postLogin(Request $req, Response $resp) {
       $body = $req->body();
       
   }
}