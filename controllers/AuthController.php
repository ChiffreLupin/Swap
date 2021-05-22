<?php

/**
    Class AuthController
    @package app\controllers
 */

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;
use app\core\Application;
use app\models\LoginUser;


class AuthController extends Controller {
   public function getLogin(Request $req,Response $resp) {
    $this->setLayout('auth');
    $this->setCurrent('Login');

    $loginUser = new LoginUser();

    return $this->render('login', [
        'model' => $loginUser
    ]);
   }

   public function postLogin(Request $req, Response $resp) {
    $this->setLayout('auth');
    $this->setCurrent('Login');

    $loginUser = new LoginUser();
    $loginUser->loadData($req->getBody());
    if($loginUser->validate() && $loginUser->login()) {
        $resp->redirect('/home');
        return;
    }

    return $this->render('login', [
        'model' => $loginUser
    ]);
   }


    public function getRegister(Request $req,Response $resp) {
        $registerModel = new User();

        $this->setLayout('auth');
        $this->setCurrent('Register');

        return $this->render('register', [
            'model' => $registerModel
        ]);
    }
    //register action??
    public function postRegister(Request $req,Response $resp) {
        $registerModel = new User();
        $registerModel->loadData($req->getBody());
      
        // If the data is valid and we successfully stored it inside the database
        // We return success page
        if($registerModel->validate() && $registerModel->save()) {     
            Application::$app->session->setFlash('success','Thanks for registering');
            Application::$app->response->redirect('/');
            exit;
        }

       // Else we return to the current page 
       // This time we pass the model with all the errors
        return  $this->render('register', [
            'model' => $registerModel
        ]);
    }

    public function logout(Request $req, Response $res) {
        Application::$app->logout();
        $res->redirect('/');
    }
}