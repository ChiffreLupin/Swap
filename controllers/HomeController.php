<?php

/**
    Class ProductsController
    @package app\controllers
 */

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;
use app\models\Product;

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

   
}
