<?php

class Task {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllByUser($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE user_id = :user_id");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($title, $description, $status, $priority, $userId) {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (title, description, status, priority, user_id) VALUES (:title, :description, :status, :priority, :user_id)");
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':priority', $priority);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getById($id, $userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = :id AND user_id = :user_id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $description, $status, $priority, $userId) {
        $stmt = $this->pdo->prepare("UPDATE tasks SET title = :title, description = :description, status = :status, priority = :priority WHERE id = :id AND user_id = :user_id");
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':priority', $priority);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id, $userId) {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
