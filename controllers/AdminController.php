<?php

/**
    Class AdminController
    @package app\controllers
 */

namespace app\controllers;
use app\core\Controller;
use app\core\middlewares\AdminAuthMiddleware;
use app\core\middlewares\BlockedMiddleware;
use app\models\User;
use app\core\Application;
use \PDO;


class AdminController extends Controller {
    public function __construct() {
        $this->registerMiddleware(new AdminAuthMiddleware());
        $this->registerMiddleware(new BlockedMiddleware());
    }

    public function getAdminUsers() {
        $this->setLayout("admin");
        $this->setCurrent("Users");
        $id = Application::$app->user->id;
        
        if(isset($_GET["searchValue"])) {
            $regex ="'^.*".$_GET["searchValue"].".*$'";

            $statement = Application::$app->db->pdo->prepare("SELECT *
                FROM user  WHERE id <> $id AND username REGEXP $regex");
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, User::class);

            $users = $statement->fetchAll();
            $noOfUsers = count($users)-1;
        }
        else {
            $users = User::findAll();
            $noOfUsers = count($users)-1;
            $users = array_filter($users, function($user) {
                return $user->id != Application::$app->user->id;
            });

            $users = array_slice($users,0 , 5);
        }


        return $this->render("admin/admin_user", [
            "users" => $users,
            "noOfUsers" => $noOfUsers
        ]);
    }

  

    public function loadMoreUsers() {

        if(isset($_GET["totalDisplayed"]) && isset($_GET['limit'])) {
            $totalDisplayed = $_GET["totalDisplayed"];
            $limit =  $_GET['limit'];


            $u_id = Application::$app->user->id;

            $stmnt = Application::$app->db->pdo->prepare("SELECT * FROM user WHERE id != $u_id LIMIT $totalDisplayed,$limit");
            $stmnt->execute();

            $stmnt->setFetchMode(PDO::FETCH_CLASS, User::class);
            $users = $stmnt->fetchAll();
            
            return json_encode($users);
        }
        return false;
    }

    public function toggleBlockedUser() {
        if(isset($_POST["block_val"]) && isset($_POST["user_id"])) {
            $val = $_POST["block_val"];
            $id = $_POST["user_id"];

            User::updateOne(["id" => $id], ["blocked" => $val]);
            return true;
        }

        return false;
    }

    public function deleteUser() {
        if( isset($_POST["user_id"])) {
            $id = $_POST["user_id"];

            $h = User::deleteOne(["id" => $id]);
            return true;
        }

        return false;
    }
    
}
