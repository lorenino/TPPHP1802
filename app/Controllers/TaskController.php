<?php
require_once __DIR__ . '/../Models/Task.php';

class TaskController {
    private $taskModel;

    public function __construct($pdo) {
        $this->taskModel = new Task($pdo);
    }

    public function list() {
        if (!isset($_SESSION['user'])) {
            header("Location: ?page=login");
            exit;
        }
        $userId = $_SESSION['user']['id'];
        $tasks = $this->taskModel->getAllByUser($userId);
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
            $priority = $_POST['priority'];
            $userId = $_SESSION['user']['id'];
            $this->taskModel->create($title, $description, $status, $priority, $userId);
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
        $userId = $_SESSION['user']['id'];
        $task = $this->taskModel->getById($id, $userId);
        if (!$task) {
            echo "Tâche non trouvée ou accès non autorisé.";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $priority = $_POST['priority'];
            $this->taskModel->update($id, $title, $description, $status, $priority, $userId);
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
        $userId = $_SESSION['user']['id'];
        $this->taskModel->delete($id, $userId);
        header("Location: ?page=tasks");
        exit;
    }
}
?>
