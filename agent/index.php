<?php
session_start();
require_once '../db.php';
include '../admin/admin.php';
include 'db.php';
include 'listes_donnees_fetch.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des agents</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="select.css">
    </head>
<body>
<?php
include '../header/header_agent.php';
?>
<div class="crud-container">
    <form class="crud-form" action="agent_add.php" method="post">
        <div class="formul">
            <h3>Ajouter un agent</h3>

            <div class="form-group">
                <label for="portebatiment">Porte Bâtiment :</label>
                <div class="custom-select" id="portebatiment-select" aria-expanded="false">
                    <div class="select-selected" id="portebatiment-selected">Sélectionner une Porte</div>
                    <div class="select-items" id="portebatiment-items">
                        <input type="text" id="portebatiment-search" placeholder="Rechercher..." aria-label="Rechercher porte bâtiment">
                        <?php
                        while ($row = $batimentsResult->fetch_assoc()) {
                            if (!empty($row['porte'])) {
                                echo "<div class='select-item' data-value=\"{$row['porte']}\">{$row['porte']}</div>";
                            }
                        }
                        ?>
                    </div>
                </div>
                <input type="hidden" id="portebatiment" name="portebatiment">
                <button type="button"  class="secondary" id="show-porte-button">+Nouvelle Porte</button>
                <div class="form-group" id="new-porte-container" style="display: none; margin-top: 10px;">
                    <label for="new-portebatiment">Nouvelle Porte :</label>
                    <input type="text" id="new-portebatiment" name="new-portebatiment" placeholder="Ajouter un nouveau bâtiment">
                </div>
            </div>

            <div class="form-group">
                <label for="nomservice">Nom de la Service :</label>
                <select id="nomservice" name="nomservice">
                    <option value="">Sélectionner une Service</option>
                    <?php
                    while ($row = $servicesResult->fetch_assoc()) {
                        if (!empty($row['nomservice'])) {
                            echo "<option value=\"" . htmlspecialchars($row['nomservice']) . "\">" . htmlspecialchars($row['nomservice']) . "</option>";
                        }
                    }
                    ?>
                </select>
                <button type="button" id="show-service-button" class="secondary">+Nouvelle Service</button>
                <div class="form-group" id="new-service-container" style="display: none; margin-top: 10px;">
                    <label for="new-nomservice">Nouveau Nom de la Service :</label>
                    <input type="text" id="new-nomservice" name="new-nomservice" placeholder="Ajouter un nouveau nom">
                </div>
            </div>

            <div class="form-group">
                <label for="matriculeagent">Matricule :</label>
                <input type="text" name="matriculeagent" id="matriculeagent">
            </div>

            <div class="form-group">
                <label for="nomagent">Nom :</label>
                <input type="text" name="nomagent" id="nomagent">
            </div>

            <div class="form-group">
                <label for="prenomagent">Prénom :</label>
                <input type="text" name="prenomagent" id="prenomagent">
            </div>

            <div class="form-group">
                <label for="nomdivision">Division :</label>
                <select name="nomdivision" id="nomdivision">
                    <option value="">Sélectionner une Division</option>
                    <?php
                    $affichees = []; 

                    while ($row = $divisionsResult->fetch_assoc()) {
                        $nomdivision = $row['nomdivision'];

                        if (!empty($nomdivision) && !in_array($nomdivision, $affichees)) {
                            $nomdivisionHtml = htmlspecialchars($nomdivision); 
                            ?>
                            <option value="<?php echo $nomdivisionHtml; ?>"><?php echo $nomdivisionHtml; ?></option>
                            <?php
                            $affichees[] = $nomdivision; 
                        }
                    }
                    ?>
                </select>
                <button type="button" id="show-division-button" class="secondary">+Nouvelle Division</button>
                <div class="form-group" id="new-division-container" style="display: none; margin-top: 10px;">
                    <label for="new-nomdivision">Nouveau Nom de Division :</label>
                    <input type="text" id="new-nomdivision" name="new-nomdivision" placeholder="Ajouter un nouveau nom">
                </div>
            </div>

            <div class="form-group">
                <label for="nom_ministere">Responsable Ministère :</label>
                <select id="nom_ministere" name="nom_ministere">
                    <option value="">Sélectionner un Ministère</option>
                    <?php
                    $affichees = []; 

                    while ($row = $nomministereResult->fetch_assoc()) {
                        $nomministere = $row['nom_ministere'];

                        if (!empty($nomministere) && !in_array($nomministere, $affichees)) {
                            $nomministereHtml = htmlspecialchars($nomministere); // Sécuriser la valeur affichée
                            ?>
                            <option value="<?php echo $nomministereHtml; ?>"><?php echo $nomministereHtml; ?></option>
                            <?php
                            $affichees[] = $nomministere; 
                        }
                    }
                    ?>
                </select>
                <button type="button" id="show-ministere-button" class="secondary">+Nouvelle Ministère</button>
                <div class="form-group" id="new-ministere-container" style="display: none; margin-top: 10px;">
                    <label for="new-nomministere">Nouveau Ministère :</label>
                    <input type="text" id="new-nomministere" name="new-nomministere" placeholder="Ajouter un nouveau nom">
                </div>
            </div>

            <div class="form-group">
                <label for="telagent">Téléphone :</label>
                <input type="text" name="telagent" id="telagent">
            </div>

            <div class="form-group">
                <label for="mailagent">Email :</label>
                <input type="email" name="mailagent" id="mailagent">
            </div>

            <button type="submit" class="ajouter">Ajouter</button>
        </div>
    </form>

    <div class="search-container">
    <input type="text" id="search-input" placeholder="Rechercher des informations." onkeyup="searchTable()">
    <br>
    <button class="primary" id="toggle-table-btn" >Afficher le tableau</button>
</div>

<table class="crud-table" id="crud-table" style="display: none;"> 
    <thead>
        <tr>
            <th>PORTE</th>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Service</th>
            <th>Division</th>
            <th>Responsable</th>
            <th>Email</th>
            <th>Téléphone</th>
            <?php if ($is_admin): ?>
                    <th>Action</th>
                <?php endif; ?>
        </tr>
    </thead>
    <tbody id="service-table-body">
        <?php include 'agent_fetch.php'; ?>
    </tbody>
</table>
<div>
<script src="../js/ajout_option.js"></script>
<script src="../js/porte_action.js"></script>
<script src="../js/dynamic_actions.js"></script>
<script src="../js/affiche_agent.js"></script>
</body>
</html>
