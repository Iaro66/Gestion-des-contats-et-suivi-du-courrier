<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .error {
            color: red;
            display: none;
        }
        .modal {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            z-index: 1000;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form id="signupForm" action="signups.php" method="POST">
        <h2>Inscription</h2>
        <label for="nomutilisateur">Nom d'utilisateur :</label>
        <input type="text" id="nomutilisateur" name="nomutilisateur" required>

        <label for="motdepasse">Mot de passe :</label>
        <input type="password" id="motdepasse" name="motdepasse" required>

        <label for="confirmer_motdepasse">Confirmer le mot de passe :</label>
        <input type="password" id="confirmer_motdepasse" name="confirmer_motdepasse" required>

        <button type="submit">S'inscrire</button>
        <br />
        <a href="index.php">Annuler</a></p>
    </form>

    <!-- Modal for error messages -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="errorMessage"></p>
        </div>
    </div>

     <!-- Modal for success messages -->
     <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="successMessage"></p>
        </div>
    </div>

    <script src="signup.js"></script>
</body>
</html>
