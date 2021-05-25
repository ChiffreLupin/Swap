<?php 

class m0002_pwdReset{

    public function up(){
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE pwdReset(
            pwdResetId INT AUTO_INCREMENT PRIMARY KEY,
            pwdResetEmail TEXT NOT NULL,
            pwdResetSelector TEXT NOT NULL,
            pwdResetToken LONGTEXT NOT NULL,
            pwdResetExpires TEXT NOT NULL
        )   ENGINE = INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE pwdReset;";
        $db->pdo->exec($SQL);
    }
}