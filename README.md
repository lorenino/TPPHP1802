# Gestion de tâches collaborative

## Présentation du projet

Ce projet est une application web de gestion de tâches développée en PHP .

## Technologies utilisées

- **PHP** (programmation orientée objet)
- **MySQL** (gestion de la base de données)
- **HTML/CSS** (interface utilisateur)
- **Git** (versionning)
- **WAMP** (environnement de développement sous Windows)


## Installation

1. **Cloner le dépôt :**

   ```bash
   git clone https://github.com/lorenino/TPPHP1802.git
   ```

2. **Installation de l'environnement :**

   - Installez WAMP et assurez-vous que les services Apache et MySQL sont démarrés.
   - Placez le projet dans le répertoire `C:\wamp64\www\` (par exemple, dans un dossier nommé `TPPHP1802`).

3. **Configuration de la base de données :**

   - Ouvrez phpMyAdmin via `http://localhost/phpmyadmin`.
   - Créez une base de données nommée `gestion_taches`.
   - Exécutez les requêtes SQL suivantes pour créer les tables :

     ```sql
     CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL,
       email VARCHAR(150) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );

     CREATE TABLE tasks (
       id INT AUTO_INCREMENT PRIMARY KEY,
       title VARCHAR(255) NOT NULL,
       description TEXT,
       status ENUM('À faire', 'En cours', 'Terminé') NOT NULL DEFAULT 'À faire',
       priority ENUM('Basse', 'Normale', 'Haute') NOT NULL DEFAULT 'Normale',
       user_id INT NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (user_id) REFERENCES users(id)
     );
     ```

   - Modifiez le fichier `config/database.php` si nécessaire pour correspondre à vos identifiants MySQL.

4. **Lancement de l'application :**

   - Accédez à l'application via l'URL : `http://localhost/TPPHP1802/public/index.php`

## Fonctionnalités

- **Gestion des utilisateurs :**
  - **Inscription** : Création d'un compte avec nom, email et mot de passe.
  - **Connexion** : Authentification sécurisée avec vérification du mot de passe.
  - **Déconnexion**

- **Gestion des tâches :**
  - **Affichage** : Visualisation de toutes les tâches de l'utilisateur connecté.
  - **Ajout** : Création d'une tâche avec titre, description, statut et priorité.
  - **Modification** : Édition des informations d'une tâche existante.
  - **Suppression** : Suppression d'une tâche.
  - **Priorisation** : Chaque tâche est associée à une priorité (Basse, Normale, Haute).

## Structure du code

- **Modèles (app/Models)** : Gèrent l'accès aux données et la logique métier (interactions avec la base de données).
- **Contrôleurs (app/Controllers)** : Coordonnent la logique applicative et la communication entre les modèles et les vues.
- **Vues (app/Views)** : Présentent les informations et formulaires à l'utilisateur.
