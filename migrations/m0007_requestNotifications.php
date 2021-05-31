<?php


    
class m0007_requestNotifications {

    public function up() {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE requestNotifications(
            id INT AUTO_INCREMENT PRIMARY KEY,
            sender_id INT NOT NULL,
            receiver_id INT NOT NULL,
            sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            message VARCHAR(255),
            isSeen BOOLEAN  DEFAULT 0,
            swap_id INT NOT NULL,
            CONSTRAINT sender_reqNotifs_fk FOREIGN KEY (sender_id) REFERENCES User(id) ON DELETE CASCADE,
            CONSTRAINT receiver_reqNotifs_fk FOREIGN KEY (receiver_id) REFERENCES User(id) ON DELETE CASCADE,
            CONSTRAINT swap_fk FOREIGN KEY (swap_id) REFERENCES Swaps(id)
            ) ENGINE = INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down() {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE requestNotifications;";
        $db->pdo->exec($SQL);
    }
}