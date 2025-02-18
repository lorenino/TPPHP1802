<?php
// public/index.php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';

// Récupérer la page demandée (par défaut, on affiche la page de connexion)
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

// Instancier le contrôleur utilisateur en lui passant la connexion PDO
$userController = new UserController($pdo);

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
    // On pourra ajouter d'autres routes ici (ex : gestion des tâches)
    default:
        echo "Page non trouvée";
        break;
}
?>
