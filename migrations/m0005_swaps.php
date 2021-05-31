<?php

class m0005_swaps{

    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE swaps(
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_received_id INT,
            product_sent_id INT,
            sender_id INTEGER,
            receiver_id INTEGER,
            isApprovedByReceiver BOOLEAN,
            isDeclineddByReceiver BOOLEAN,
            CONSTRAINT fk_swaps_prod_rec_id FOREIGN KEY (product_received_id) REFERENCES product(id),
            CONSTRAINT fk_swaps_prod_sent_id FOREIGN KEY (product_sent_id) REFERENCES product(id),
            CONSTRAINT fk_swaps_receiver_id FOREIGN KEY (receiver_id) REFERENCES user(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
            CONSTRAINT fk_swaps_sender_id FOREIGN KEY (sender_id) REFERENCES user(id)
            ON DELETE CASCADE
            ON UPDATE CASCADE
            )  ENGINE = INNODB;";     
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE swaps;";     
        $db->pdo->exec($SQL);
    }
}