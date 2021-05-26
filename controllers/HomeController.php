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

        $swap->loadData($body);
        


        // Create user_notification about the swap that has been created
        if($swap->save()) {

        }


        // Set flash message that swap has been created
    
        // Redirect user to current page where swap success message will be displayed
        
    }
}
