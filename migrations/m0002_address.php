<?php 

class m0002_address{

    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE address(
            state VARCHAR(25),
            city VARCHAR(30),
            street VARCHAR(50),
            user_id INT,            
            PRIMARY KEY(state, city, street, user_id),            
            CONSTRAINT fk_address_user FOREIGN KEY (user_id) REFERENCES user(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE
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