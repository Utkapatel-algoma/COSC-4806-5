<?php

class Reminder {

    public function __construct() {

    }

    public function get_all_reminders () {
        $db = db_connect();
        $statement = $db->prepare("select * from reminders;");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function get_reminder_by_id ($id) {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM reminders WHERE id = :id");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function add_reminder ($user_id, $subject) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO reminders (user_id, subject, created_at) VALUES (:user_id, :subject, NOW())");
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':subject', $subject, PDO::PARAM_STR);
        $statement->execute();
        return $db->lastInsertId();
    }

    public function update_reminder ($id, $subject) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE reminders SET subject = :subject WHERE id = :id");
        $statement->bindValue(':subject', $subject, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->rowCount();
    }

    public function delete_reminder ($id) {
        $db = db_connect();
        $statement = $db->prepare("DELETE FROM reminders WHERE id = :id");
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->rowCount();
    }
}