<?php

/**
    Class ProductsController
    @package app\controllers
 */

namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;
use app\models\Product;
use app\models\Swap;
use app\models\RequestNotification;
use \PDO;

class HomeController extends Controller {
    public function getProductDetails(Request $req, Response $resp) {
        $this->setLayout("navigation");
        $this->setCurrent("Product Details");

        $product_id = $req->getParam("productId") ?? false;

        if($product_id) {
            $product = Product::findOne(["id" => $product_id]);

            if($product) {
                $user = User::findOne(["id" => $product->user_id]);
                $product->user = $user ? $user : null;
                
                if($product->user) {
                    return $this->render('ProductPage', [
                        "model" => $product
                    ]);
                }
            }
        } 
            
        $resp->redirect("/");
    }

    public function getUserProducts(Request $req, Response $resp) {

        $sql = "SELECT * FROM product WHERE user_id = ?";
        $stmt = Application::$app->db->pdo->prepare($sql);
        $stmt->bindValue(1, $_GET["id"]);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();


        return json_encode($rows);
    }

    public function createSwap(Request $req, Response $resp) {
        $body = $req->getBody();

        // Create swap model and save it to the database
        $swap = new Swap();
        $sender = User::findOne(["id" => $body["sender_id"]]);

        $swap->loadData($body);


        // Create user_notification about the swap that has been created
        if($sender && $swap->save()) {
            $request = new RequestNotification();
            $request->sender_id = $body["sender_id"];
            $request->receiver_id = $body["receiver_id"];
            $sender_name = $sender->displayName();
            $request->message = "$sender_name has sent you a SWAP request.";
            $swap = Swap::findOne(["sender_id" => $swap->sender_id, "receiver_id" => $swap->receiver_id]);
            $request->swap_id = $swap->id;
            $request->save();
        } 
        else $resp->redirect("/home");


        // Set flash message that swap has been created
        Application::$app->session->setFlash("swap_sent_success","Your SWAP request has been sent successfully!");
    
        // Redirect user to current page where swap success message will be displayed
        $resp->redirect("/productDetails?productId=$swap->product_sent_id");
    }

    public function getNotifications(Request $req, Response $res) {
        $this->setLayout("navigation");
        $this->setCurrent("Notifications");

        // $id = Application::$app->user->id;
        // $stmt = Application::$app->db->pdo->prepare("SELECT * FROM requestNotifications WHERE receiver_id = $id");
        // $stmt->execute();

        // $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // $notifications = $stmt->fetchAll();
        $notifications = RequestNotification::find(["receiver_id" => Application::$app->user->id]);
        
        return $this->render("notifications",[
            "notifications" => $notifications
        ]
        );
    }
}
