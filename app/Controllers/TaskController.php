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

    public function edit() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }
        if (!isset($_GET['id'])) {
            echo "ID de tâche manquant.";
            exit;
        }
        $id = $_GET['id'];
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $_SESSION['user']['id']]);
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$task) {
            echo "Tâche non trouvée ou accès non autorisé.";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $stmt = $this->pdo->prepare("UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$title, $description, $status, $id, $_SESSION['user']['id']]);
            header("Location: ?page=tasks");
            exit;
        }
        include_once __DIR__ . '/../Views/edit_task.php';
    }

    public function delete() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }
        if (!isset($_GET['id'])) {
            echo "ID de tâche manquant.";
            exit;
        }
        $id = $_GET['id'];
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $_SESSION['user']['id']]);
        header("Location: ?page=tasks");
        exit;
    }
}
