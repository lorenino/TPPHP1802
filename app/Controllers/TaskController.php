<?php

class TaskController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function list() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }
        $userId = $_SESSION['user']['id'];
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->execute([$userId]);
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include_once __DIR__ . '/../Views/tasks.php';
    }

    public function create() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $userId = $_SESSION['user']['id'];
            $stmt = $this->pdo->prepare("INSERT INTO tasks (title, description, status, user_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $description, $status, $userId]);
            header("Location: ?page=tasks");
            exit;
        }
    }

}
