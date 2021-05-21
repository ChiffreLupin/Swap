<?php

class m0009_comments {

public function up() {
    $db = \app\core\Application::$app->db;
    $SQL = "CREATE TABLE Comments(
        user_id INT,
        commenter_id INT,
        comment VARCHAR(255),
        CONSTRAINT comment_user_fk FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE,
        CONSTRAINT commenter FOREIGN KEY (commenter_id)  REFERENCES User(id) ON DELETE CASCADE
        ) ENGINE = INNODB;";
    $db->pdo->exec($SQL);
}

public function down() {
    $db = \app\core\Application::$app->db;
    $SQL = "DROP TABLE comments;";
    $db->pdo->exec($SQL);
}
}


