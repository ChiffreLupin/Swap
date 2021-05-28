
<?php    
    use app\core\DbModel;
        require_once __DIR__.'/../../vendor/autoload.php';        

        echo $_POST["method"]();

        function loadProducts()
        {
            if(isset($_POST["category_id"]))
            {
                $ci = json_decode($_POST["category_id"]);            
                echo '<pre>';
                var_dump($ci);
                echo '</pre>';
                exit;
            if(isset($_POST["limit"]))
            {
                $pc = json_decode($_POST["limit"]);
                $pdo = new \PDO("mysql:host=localhost;port=3306;dbname=mvc_framework", "root", "toor1.,1root");                        
                
            // SELECT * FROM $tableName WHERE email = :email AND firstname = :firstname
            $products = new Product();
            $products = $products->getProductsToAdd(['category_id' => $ci],$pc);            
            
            //$product->setFetchMode(PDO::FETCH_ASSOC);                                    
            //return json_encode($products);
            }
            
        }            
        //
        $return = new stdClass;
        $return->success = true;
        $return->errorMessage = "";
        $return->data["products"] = $products;
        $json = json_encode($return);
        echo $json;
        
        //else return "";

}
        