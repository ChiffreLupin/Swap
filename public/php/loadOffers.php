<?php

require_once __DIR__.'/../../vendor/autoload.php';

echo $_POST["method"]();


function loadOffers() {
    if(isset($_POST["id"])) {

// The _ENV stuff come from the .env file
// There we store data related to database connection
        $pdo = new \PDO("mysql:host=localhost;port=3306;dbname=Swap", "root", "Frenkli1");
      
        $sql = "SELECT * FROM product WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $_POST["id"]);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();

        return json_encode($rows);
    }
    else return "";
}