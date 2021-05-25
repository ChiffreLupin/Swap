<?php 

class m0003_category{

    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE category(
            category_id INT PRIMARY KEY,
            category_name VARCHAR(70) NOT NULL,
            description VARCHAR(140) NOT NULL
            )  ENGINE = INNODB;";        
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE address;";        
        $db->pdo->exec($SQL);
    }

}