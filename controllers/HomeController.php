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
            $product->user = User::findOne(["id" => $product->user_id]);
            
            return $this->render('ProductPage', [
                "model" => $product
            ]);
        } else {
            $resp->redirect("");
        }
        
    }

    public function postHomeProducts(Request $request, Response $reponse) {
        // Here we deal with the data from the request
        $body = $request->getBody();

        // Do whatever we want with the data
    }
}
