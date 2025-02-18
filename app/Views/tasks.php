<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes tâches</title>
</head>
<body>
    <h1>Mes tâches</h1>
    <p><a href="?page=logout">Déconnexion</a></p>

    <h2>Ajouter une tâche</h2>
    <form method="post" action="?page=tasks">
         <label>Titre :</label>
         <input type="text" name="title" required><br><br>

         <label>Description :</label>
         <textarea name="description" required></textarea><br><br>

         <label>Statut :</label>
         <select name="status">
              <option value="À faire">À faire</option>
              <option value="En cours">En cours</option>
              <option value="Terminé">Terminé</option>
         </select><br><br>

         <button type="submit">Ajouter la tâche</button>
    </form>

    <h2>Liste des tâches</h2>
    <?php if(empty($tasks)): ?>
         <p>Aucune tâche pour le moment.</p>
    <?php else: ?>
         <ul>
         <?php foreach ($tasks as $task): ?>
              <li>
                 <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                 <br>
                 <?php echo htmlspecialchars($task['description']); ?>
                 <br>
                 Statut : <?php echo htmlspecialchars($task['status']); ?>
              </li>
         <?php endforeach; ?>
         </ul>
    <?php endif; ?>
</body>
</html>
