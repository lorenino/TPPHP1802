<?php

class UserController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = $user;
                header("Location: ?page=tasks");
                exit;
            } else {
                $error = "Identifiants invalides";
            }
        }
        include_once __DIR__ . '/../Views/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([$name, $email, $password])) {
                header("Location: ?page=login");
                exit;
            } else {
                $error = "Erreur lors de l'inscription";
            }
        }
        include_once __DIR__ . '/../Views/register.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: ?page=login");
        exit;
    }
}
?>
