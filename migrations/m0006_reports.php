<?php


    
class m0006_reports {

    public function up() {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE reports(
            report_id INT AUTO_INCREMENT PRIMARY KEY,
            sender_id INT NOT NULL,
            receiver_id INT NOT NULL,
            description VARCHAR(255),
            CONSTRAINT sender_fk FOREIGN KEY (sender_id) REFERENCES User(id) ON DELETE CASCADE,
            CONSTRAINT receiver_fk FOREIGN KEY (receiver_id) REFERENCES User(id) ON DELETE CASCADE
            ) ENGINE = INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down() {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE reports;";
        $db->pdo->exec($SQL);
    }
}

