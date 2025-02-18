<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la tâche</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
    <h1>Modifier la tâche</h1>
    <form method="post" action="">
        <label>Titre :</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required><br><br>
        
        <label>Description :</label>
        <textarea name="description" required><?php echo htmlspecialchars($task['description']); ?></textarea><br><br>
        
        <label>Statut :</label>
        <select name="status">
            <option value="À faire" <?php echo ($task['status'] == 'À faire') ? 'selected' : ''; ?>>À faire</option>
            <option value="En cours" <?php echo ($task['status'] == 'En cours') ? 'selected' : ''; ?>>En cours</option>
            <option value="Terminé" <?php echo ($task['status'] == 'Terminé') ? 'selected' : ''; ?>>Terminé</option>
        </select><br><br>
        
        <label>Priorité :</label>
        <select name="priority">
            <option value="Basse" <?php echo ($task['priority'] == 'Basse') ? 'selected' : ''; ?>>Basse</option>
            <option value="Normale" <?php echo ($task['priority'] == 'Normale') ? 'selected' : ''; ?>>Normale</option>
            <option value="Haute" <?php echo ($task['priority'] == 'Haute') ? 'selected' : ''; ?>>Haute</option>
        </select><br><br>
        
        <button type="submit">Mettre à jour</button>
    </form>
    <p><a href="?page=tasks">Retour à la liste des tâches</a></p>
</body>
</html>
