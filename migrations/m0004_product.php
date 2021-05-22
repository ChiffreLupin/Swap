<?php

class m0004_product{

    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE product(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(60) NOT NULL,
            amount INT NOT NULL,
            image BLOB,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            description VARCHAR(300),
            category_id INT, 
            CONSTRAINT fk_product_cat_id FOREIGN KEY (category_id) REFERENCES category(category_id)
            ON DELETE CASCADE
            ON UPDATE CASCADE
            )  ENGINE = INNODB;";     
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE product;";     
        $db->pdo->exec($SQL);
    }
}