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
use app\models\Category;
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

            // Get last inserted swap
            $stmnt = Application::$app->db->pdo->prepare("SELECT LAST_INSERT_ID()");
            $stmnt->execute();
            $last_inserted_id = $stmnt->fetchAll()[0][0];
           
            $swap = Swap::findOne(["id" => $last_inserted_id]);


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
        foreach($notifications as $key => $notif) {
            $notif->swap = Swap::findOne(["id" => $notif->swap_id]);
        }
        
        return $this->render("notifications",[
            "notifications" => $notifications
        ]
        );
    }

    public function acceptSwap(Request $req, Response $resp) {
        if(isset($_POST["swap_id"]) && isset($_POST["notif_id"])) {
            $swap_id = $_POST["swap_id"];
            $notification_id = $_POST["notif_id"];

            // $stmnt = Application::$app->db->pdo->prepare("UPDATE swaps SET isApprovedByReceiver = 1 WHERE id=$swap_id");
            // $stmnt->execute();
            $st =Swap::updateOne(["id" => $swap_id], ["isApprovedByReceiver" => 1]);
            $notification  = RequestNotification::findOne(["id" => $notification_id]);
            $approver = User::findOne(["id" => $notification->receiver_id]);
            $approverName = $approver->displayName();
         

            $newRequest = new RequestNotification();
            $newRequest->sender_id = $notification->receiver_id;
            $newRequest->receiver_id = $notification->sender_id;
            $newRequest->message = "$approverName has accepted your SWAP request";
            $newRequest->swap_id = $notification->swap_id;
            $newRequest->save();

            return $st;
        }
        else $resp->redirect("/notifications");
    } 

    public function getHomepage(Request $req,Response $resp) {
        $this->setLayout('auth');
        $this->setCurrent('Category');    
        $kategorite = Category::findAll();           
        $products = "";

        if(!isset($_GET["categoryId"])) {
            $products = Product::findAll();
        } else {
            $cat_id = $_GET["categoryId"];
            $products = Product::find(["category_id" => $cat_id]);
            $products = array_slice($products,0, 7);
        }
        
        
        // $products = new Product();
        // $products = $products->getProducts(['category_id' => 1]);
        
        // $name = [];
        // $name['cid'] = 1;
        //     $j = 0;

        //     foreach($products as $key => $value)
        //     {
        //         $name['product'][$j] = $value;                
        //     $j++; 
        //     }
        
        
        // $i = 0;
        // foreach($kategoria as $key =>$value)
        // {
        //     $name['name'][$i] = $value;
        //     $i++;
        // }

        $selected = $_GET["categoryId"];
        if($selected)
            $selected -= 1;
                
        return $this->render('logged_user', [
            "categories" => $kategorite,
            "products" => $products,
            "selectedCategory" => $selected ?? 0
        ]);
    }

    public function loadProducts(Request $req,Response $resp) {
        if(isset($_GET["categoryId"]) && isset($_GET["limit"])) {
            $categoryId = $_GET["categoryId"];
            $limit = $_GET["limit"];


            $stmnt = Application::$app->db->pdo->prepare("SELECT * FROM product WHERE category_id = $categoryId LIMIT $limit");
            $stmnt->bindValue(":$categoryId", $categoryId);
            $stmnt->execute();

            $stmnt->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $stmnt->fetchAll();

            return json_encode($rows);
        }
        else return false;
    }

    public function deleteRequestNotification(Request $req, Response $resp) {
        if(isset($_POST["notif_id"])) {
            $request_id = $_POST["notif_id"];
            RequestNotification::deleteOne(["id" => $request_id]);

            return "Request notification successfully deleted!";
        }
    }
}
