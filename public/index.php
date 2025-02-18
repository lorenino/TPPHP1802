<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';
require_once __DIR__ . '/../app/Controllers/TaskController.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'login';

$userController = new UserController($pdo);
$taskController = new TaskController($pdo);

switch ($page) {
    case 'login':
        $userController->login();
        break;
    case 'register':
        $userController->register();
        break;
    case 'logout':
        $userController->logout();
        break;
    case 'tasks':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taskController->create();
        }
        $taskController->list();
        break;
    default:
        echo "Page non trouvée";
        break;
}
?>
