<?php

class Reminder {
    private $conn;

    public function __construct() {
        $this->conn = db_connect(); // Assuming db_connect() is defined in database.php and returns a PDO object
    }

    public function get_all_reminders() {
        // Fetch all reminders, ordered by creation date
        $query = "SELECT id, subject, created_at FROM reminders ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function add_reminder($user_id, $subject) {
        $query = "INSERT INTO reminders (user_id, subject, created_at) VALUES (:user_id, :subject, NOW())";
        $stmt = $this->conn->prepare($query);
        // Assuming user_id is always 1 for now, as per your controller's add_reminder(1, $subject) call
        return $stmt->execute([':user_id' => $user_id, ':subject' => $subject]);
    }

    public function get_reminder_by_id($id) {
        $query = "SELECT id, subject, created_at FROM reminders WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(); // Fetch single row
    }

    public function update_reminder($id, $subject) {
        $query = "UPDATE reminders SET subject = :subject WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':subject' => $subject, ':id' => $id]);
    }

    public function delete_reminder($id) {
        $query = "DELETE FROM reminders WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}