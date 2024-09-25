<?php
session_start();
require_once '../db.php';
include '../admin/admin.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Bâtiments</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="close.css">
</head>
<body>
<?php 
include '../header/header_batiment.php'; 
include 'message.php'
?>

<div class="crud-container">
    <form class="crud-form" action="batiment_add.php" method="post">
        <div class="formul">
            <h3>Ajouter un Bâtiment</h3>
            <div class="form-group">
                <label for="porte_batiment">Porte du bâtiment :</label>
                <input type="text" id="porte_batiment" name="porte_batiment" required>
            </div>
            <div class="form-group">
                <label for="etage_batiment">Étage du Bâtiment :</label>
                <input type="text" id="etage_batiment" name="etage_batiment" required>
            </div>
            <button type="submit" class="ajouter">Ajouter</button>
        </div>
    </form>
    
    <div class="search-container">
    <input type="text" id="search-input" placeholder="Rechercher des informations." onkeyup="searchTable()">
    <button class="primary" id="toggle-table-btn" >Afficher le tableau</button>
</div>
    <h3>Liste des Bâtiments</h3>
    <table class="crud-table" id="crud-table" style="display: none;">
        <thead>
            <tr>
                <th>Porte</th>
                <th>Étage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="service-table-body">
            <?php include 'batiment_fetch.php'; ?>
        </tbody>
    </table>
</div>
<div id="not-authorized" style="<?php echo $is_admin ? 'display: none;' : ''; ?>">
    <p>Vous n'êtes pas autorisé à accéder à cette page.</p>
</div>

<script src="../js/script_batiment.js"></script>
<script src="../js/affiche_batiment.js"></script>
</body>
</html>
