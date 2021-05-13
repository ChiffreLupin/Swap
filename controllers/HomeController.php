<?php

/**
    Class ProductsController
    @package app\controllers
 */

namespace app\controllers;

class HomeController extends Controller {
    public function getHomeProducts() {
        $params = [
            'title' => "Home Page"
        ];
        return $this->render('home', $params);
    }

    public function postHomeProducts(Request $request, Response $reponse) {
        // Here we deal with the data from the request
        $body = $request->getBody();

        // Do whatever we want with the data
    }
}
