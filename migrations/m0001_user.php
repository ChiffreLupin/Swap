<?php 

class m0001_user{

    public function up(){
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE user(
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            firstname VARCHAR(35) NOT NULL,
            lastname VARCHAR(35) NOT NULL,
            email VARCHAR(80) NOT NULL,
            password VARCHAR(100) NOT NULL,
            profile_picture VARCHAR(255) DEFAULT NULL,
            blocked BOOLEAN DEFAULT 0,
            state VARCHAR(25),
            city VARCHAR(30),
            street VARCHAR(150),
            zip VARCHAR(10),
            type ENUM('client','admin'),
            description VARCHAR(255) DEFAULT ''
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