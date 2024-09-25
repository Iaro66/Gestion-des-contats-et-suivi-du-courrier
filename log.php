<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'authentifier</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="login-container">
            <h2>Connexion</h2>
            <form id="loginForm" action="login.php" method="POST">
                <input type="text" id="nomutilisateur" name="nomutilisateur" placeholder="Nom d'utilisateur" required>
                <div id="loginUsernameError" class="error-message"></div>
                <input type="password" id="motdepasse" name="motdepasse" placeholder="Mot de passe" required>
                <div id="loginPasswordError" class="error-message"></div>
                <button type="submit">Se connecter</button>
                <div id="loginError" class="error-message"></div>
            </form>
            <p>Vous n'avez pas de compte ? <a href="#" id="openSignup">Inscrivez-vous</a></p>
        </div>
    </div>

    <div id="signupPopup" class="popup" action="signup.php" method="POST">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Inscription</h2>
            <form id="signupForm">
                <input type="text" id="nomutilisateur" name="nomutilisateur" placeholder="Nom d'utilisateur" required>
                <div id="signupUsernameError" class="error-message"></div>
                <input type="password"  id="motdepasse" name="motdepasse" placeholder="Mot de passe" required>
                <div id="signupPasswordError" class="error-message"></div>
                <input type="password" id="confirmer_motdepasse" name="confirmer_motdepasse" placeholder="Confirmez le mot de passe" required>
                <div id="signupConfirmPasswordError" class="error-message"></div>
                <button type="submit">S'inscrire</button>
                <div id="signupError" class="error-message"></div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>
