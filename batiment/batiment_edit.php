<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}
include 'db.php';
include 'verif_edit.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Bâtiment</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="main-header">
    <div class="header-content">
        <div class="logo">
            <img src="../img/I.png" alt="Logo de l'application">
        </div>
        <h2>Gestion des bâtiments</h2>
        <nav class="main-nav">
            <ul>
                <li><a href="../agent/index.php">Agent</a></li>
                <li><a href="../courriers/index.php">Courriers</a></li>
                <li><a href="../batiment/index.php">Bâtiments</a></li>
                <li><a href="../ministere/index.php">Ministères</a></li>
                <li><a href="../service/index.php">Services</a></li>
                <li><a href="../division/index.php">Divisions</a></li>
                <li><a href="../logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="crud-container">
    <form class="crud-form" action="batiment_edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
        <div class="formul">
            <h3>Modifier le Bâtiment</h3>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <div class="form-group">
                <label for="porte_batiment">Porte du bâtiment :</label>
                <input type="text" id="porte_batiment" name="porte_batiment" value="<?php echo htmlspecialchars($porte); ?>" required>
            </div>
            <div class="form-group">
                <label for="etage_batiment">Étage du Bâtiment :</label>
                <input type="text" id="etage_batiment" name="etage_batiment" value="<?php echo htmlspecialchars($etage); ?>" required>
            </div>
            <button type="submit" name="update" class="ajouter">Mettre à jour</button>
            <a href="index.php" class="supprimer">Annuler</a>
        </div>
    </form>
</div>
</body>
</html>
