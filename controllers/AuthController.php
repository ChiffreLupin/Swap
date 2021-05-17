<?php

/**
    Class AuthController
    @package app\controllers
 */

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\RegisterModel;


class AuthController extends Controller {
   public function getLogin(Request $req,Response $resp) {
    $this->setLayout('auth');
    $this->setCurrent('Login');

    return $this->render('login');
   }

   public function postLogin(Request $req, Response $resp) {
       $body = $req->getBody();
       return "Handle submitted data from login form!";

    }

    public function getRegister(Request $req,Response $resp) {
        $registerModel = new RegisterModel();

        $this->setLayout('auth');
        $this->setCurrent('Register');

        return $this->render('register', [
            'model' => $registerModel
        ]);
    }

    public function postRegister(Request $req,Response $resp) {
        $registerModel = new RegisterModel();
        $registerModel->loadData($req->getBody());
      
        // If the data is valid and we successfully stored it inside the database
        // We return success page
        if($registerModel->validate() && $registerModel->register()) {
            return "Success";
        }

       // Else we return to the current page 
       // This time we pass the model with all the errors
        return  $this->render('register', [
            'model' => $registerModel
        ]);
    }
}