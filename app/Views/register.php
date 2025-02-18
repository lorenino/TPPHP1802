<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <?php if(isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="?page=register">
        <label>Nom :</label>
        <input type="text" name="name" required><br>
        <label>Email :</label>
        <input type="email" name="email" required><br>
        <label>Mot de passe :</label>
        <input type="password" name="password" required><br>
        <button type="submit">S'inscrire</button>
    </form>
    <p>Déjà inscrit ? <a href="?page=login">Se connecter</a></p>
</body>
</html>
