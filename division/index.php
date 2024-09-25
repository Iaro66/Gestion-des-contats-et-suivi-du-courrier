<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['user_id'])) {
    $is_admin = false;
} else {
    // Vérificqtion du rôle de l'utilisateur
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT role FROM utilisateur WHERE idutilisateur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $is_admin = false;
    } else {
        $stmt->bind_result($role);
        $stmt->fetch();
        $is_admin = ($role === 'admin');
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Divisions</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="main-header">
        <div class="header-content">
            <!-- Logo -->
            <div class="logo">
                <img src="../img/I.png" alt="Logo de l'application">
            </div>
            <h2>Gestion des Divisions</h2>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="../agent/index.php">Agent</a></li>
                    <li><a href="../courriers/index.php">Courriers</a></li>
                    <li><a href="../batiment/index.php">Bâtiments</a></li>
                    <li><a href="../service/index.php">Services</a></li>
                    <li><a href="../division/index.php">Divisions</a></li>
                    <li><a href="../logout.php">Déconnexion</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="crud-container">
        <div class="form-container">
            <form class="crud-form" action="division_add.php" method="post">
                <h3>Ajouter une Division</h3>
                <div class="form-group">
                    <label for="nom_division">Nom de la Division :</label>
                    <input type="text" id="nom_division" name="nom_division" required>
                    <button type="submit" id="submit-button" class="ajouter">Ajouter Division</button>
            </form>
        </div>

        <div class="search-container">
    <input type="text" id="search-input" placeholder="Rechercher des informations." onkeyup="searchTable()">
    <button class="primary" id="toggle-table-btn" >Afficher le tableau</button>
</div>
        
        <div class="table-container">
            <h3>Liste des Divisions</h3>
            <table class="crud-table" id="crud-table" style="display: none;">
                <thead>
                    <tr>
                        <th>Nom de la Division</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'division_fetch.php'; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="not-authorized" style="<?php echo $is_admin ? 'display: none;' : ''; ?>">
    <p>Vous n'êtes pas autorisé à accéder à cette page.</p>
</div>

    <script src="../js/script_div.js"></script>
    <script src="../affiche_div.js"></script>
</body>
</html>
