<?php
session_start();
require_once '../db.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    $is_admin = false;
} else {
    // Vérifiez le rôle de l'utilisateur
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
    <title>Gestion des Ministères</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include '../header/header_min.php'; ?>

<div class="crud-container" style="<?php echo $is_admin ? '' : 'display: none;'; ?>">
    <form class="crud-form" action="min_add.php" method="post">
        <div class="formul">
            <h3>Ajouter un Ministère</h3>
            <div class="form-group">
                <label for="nom_ministere">Nom du ministere :</label>
                <input type="text" id="nom_ministere" name="nom_ministere" required>
            </div>
            <div class="form-group">
                <label for="code_ministere">Code du Ministere :</label>
                <input type="number" id="code_ministere" name="code_ministere" required>
            </div>
            <button type="submit" class="ajouter">Ajouter</button>
        </div>
    </form>
    <div class="search-container">
        <input type="text" id="search-input" placeholder="Rechercher des informations." onkeyup="searchTable()">
        <button class="primary" id="toggle-table-btn">Afficher le tableau</button>
    </div>
    <h3>Liste des Ministères</h3>
    <table class="crud-table" id="crud-table" style="display: none;">
        <thead>
            <tr>
                <th>Nom Ministère</th>
                <th>Code Ministère</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tbody id="service-table-body">
                <?php include 'min_fetch.php'; ?>
            </tbody>
        </tbody>
    </table>
</div>

<div id="not-authorized" style="<?php echo $is_admin ? 'display: none;' : ''; ?>">
    <p>Vous n'êtes pas autorisé à accéder à cette page.</p>
</div>

<script src="../js/script_min.js"></script>
<script src="../js/affiche_min.js"></script>
</body>
</html>
