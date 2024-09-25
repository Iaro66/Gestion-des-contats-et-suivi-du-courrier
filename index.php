<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form id="loginForm">
        <h2>Connexion</h2>
        <label for="nomutilisateur">Nom d'utilisateur :</label>
        <input type="text" id="nomutilisateur" name="nomutilisateur" required>

        <label for="motdepasse">Mot de passe :</label>
        <input type="password" id="motdepasse" name="motdepasse" required>

        <button type="submit">Se connecter</button>
        <p>Pas encore inscrit ? <a href="signup.php">S'inscrire ici</a></p>
    </form>

    <!-- Modal for error messages -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="errorMessage"></p>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
