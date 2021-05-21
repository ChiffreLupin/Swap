<?php


    
class m0008_adminNotifications {

    public function up() {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE adminNotifications(
            id INT AUTO_INCREMENT PRIMARY KEY,
            sender_id INT NOT NULL,
            sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            message VARCHAR(255),
            isSeen BOOLEAN  DEFAULT 0,
            CONSTRAINT sender_adminNotifs_fk FOREIGN KEY (sender_id) REFERENCES User(id) ON DELETE CASCADE
            ) ENGINE = INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down() {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE adminNotifications;";
        $db->pdo->exec($SQL);
    }
}