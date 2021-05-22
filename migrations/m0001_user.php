<?php 

class m0001_user{

    public function up(){
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE user(
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            first_name VARCHAR(35) NOT NULL,
            last_name VARCHAR(35) NOT NULL,
            email VARCHAR(80) NOT NULL,
            password VARCHAR(100) NOT NULL,
            profile_picture BLOB,
            blocked BOOLEAN,
            type ENUM('client','admin') 
        )   ENGINE = INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE user;";
        $db->pdo->exec($SQL);
    }
}