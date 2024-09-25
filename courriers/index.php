<?php
session_start();
require_once '../db.php';
include '../admin/admin.php';
include 'php.php';

$success = isset($_GET['success']) ? $_GET['success'] : null;
$courriers_transferes = $courriers_transferes ?? [];
$courriers_archives = $courriers_archives ?? [];
$courriers_classifies = $courriers_classifies ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Suivi des Courriers</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="confirm.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="content">
        <?php include 'form_courrier.php'; ?>
        <?php include 'tables.php'; ?>
        <?php include 'popups.php'; ?>
    </div>

<!-- Tableau des courriers vérifiés -->
<div class="table-section" style="max-height: 400px; max-width: 100%; overflow-y: auto; overflow-x: hidden;">
    <input type="text" class="search-bar" placeholder="Rechercher un courrier">
    <table id="verification-table">
        <thead>
            <tr>
                <th>Date de vérification</th>
                <th>Numéro du courrier</th>
                <th>Date du courrier</th>
                <th>Référence</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Agent traitant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="verification-table-body">
        <?php
$query = "
    SELECT c.*, a.nomagent101 AS nom_agent_traitant
    FROM courrier c
    JOIN agent101 a ON c.agent_traitant = a.idagent101
    WHERE c.statut = 'Vérifié et en cours de traitement'
";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($courrier = $result->fetch_assoc()) {
        echo "<tr data-id='" . htmlspecialchars($courrier['idcourrier'], ENT_QUOTES, 'UTF-8') . "'>
                <td>" . (!empty($courrier['date_verification']) ? htmlspecialchars($courrier['date_verification'], ENT_QUOTES, 'UTF-8') : '') . "</td>
                <td>" . htmlspecialchars($courrier['numero'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . htmlspecialchars($courrier['date_courrier'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . htmlspecialchars($courrier['ref'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . htmlspecialchars($courrier['description'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . htmlspecialchars($courrier['statut'], ENT_QUOTES, 'UTF-8') . "</td>
                <td>" . htmlspecialchars($courrier['nom_agent_traitant'], ENT_QUOTES, 'UTF-8') . "</td> 
                <td>
                    <button class='transferer-btn' data-id='" . htmlspecialchars($courrier['idcourrier'], ENT_QUOTES, 'UTF-8') . "'>Transférer</button>
                    <button class='classer-btn' data-id='" . htmlspecialchars($courrier['idcourrier'], ENT_QUOTES, 'UTF-8') . "'>Classer</button>
                    <button class='archiver-btn' data-id='" . htmlspecialchars($courrier['idcourrier'], ENT_QUOTES, 'UTF-8') . "'>Archiver</button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='8'>Aucun courrier vérifié trouvé.</td></tr>";
}
?>
        </tbody>
    </table>
</div>
<!-- Table des courriers transférés -->
<div class="table-section" style="max-height: 400px; max-width: 100%; overflow-y: auto; overflow-x: hidden;">
    <input type="text" class="search-bar" placeholder="Rechercher un courrier">
    <table id="transfer-table">
        <thead>
            <tr>
                <th>Date de transfert</th>
                <th>Numéro du courrier</th>
                <th>Date du courrier</th>
                <th>Référence</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Agent Expéditeur</th>
                <th>Agent Destinataire</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="transfer-table-body">
        <?php
        $query = "
            SELECT c.*, a_expediteur.nomagent101 AS nom_agent_expediteur, a_destinataire.nomagent101 AS nom_agent_destinataire
            FROM courrier c
            LEFT JOIN agent101 a_expediteur ON c.agent_expediteur = a_expediteur.idagent101
            LEFT JOIN agent101 a_destinataire ON c.agent_destinataire = a_destinataire.idagent101
            WHERE c.statut = 'transféré'
        ";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($courrier_transfere = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($courrier_transfere['date_transfert'], ENT_QUOTES, 'UTF-8') . "</td>
                        <td>" . htmlspecialchars($courrier_transfere['numero'], ENT_QUOTES, 'UTF-8') . "</td>
                        <td>" . htmlspecialchars($courrier_transfere['date_courrier'], ENT_QUOTES, 'UTF-8') . "</td>
                        <td>" . htmlspecialchars($courrier_transfere['ref'], ENT_QUOTES, 'UTF-8') . "</td>
                        <td>" . htmlspecialchars($courrier_transfere['description'], ENT_QUOTES, 'UTF-8') . "</td>
                        <td>" . htmlspecialchars($courrier_transfere['statut'], ENT_QUOTES, 'UTF-8') . "</td>
                        <td>" . htmlspecialchars($courrier_transfere['nom_agent_expediteur'] ?? 'Non spécifié', ENT_QUOTES, 'UTF-8') . "</td>
                        <td>" . htmlspecialchars($courrier_transfere['nom_agent_destinataire'] ?? 'Non spécifié', ENT_QUOTES, 'UTF-8') . "</td>
                        <td>
                            <button class='classer-btn' data-id='" . htmlspecialchars($courrier_transfere['idcourrier'], ENT_QUOTES, 'UTF-8') . "'>Classer</button>
                            <button class='archiver-btn' data-id='" . htmlspecialchars($courrier_transfere['idcourrier'], ENT_QUOTES, 'UTF-8') . "'>Archiver</button>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Aucun courrier transféré trouvé.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Tableau des courriers archivés -->
<div class="table-section" style="max-height: 400px; max-width: 100%; overflow-y: auto; overflow-x: hidden;">
    <input type="text" class="search-bar" placeholder="Rechercher un courrier archivé">
    <table id="archive-table">
        <thead>
            <tr>
                <th>Date d'archivage</th>
                <th>Lieu d'Archivage</th>
                <th>Numéro du courrier</th>
                <th>Date du courrier</th>
                <th>Référence</th>
                <th>Description</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody id="archive-table-body">
            <?php foreach ($courriers_archives as $courrier_archive): ?>
            <tr>
                <td><?php echo htmlspecialchars($courrier_archive['date_archivage'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($courrier_archive['lieu_archivage'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($courrier_archive['numero'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($courrier_archive['date_courrier'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($courrier_archive['ref'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($courrier_archive['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($courrier_archive['statut'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
    <!-- Table des courriers classés -->
    <div class="table-section" style="max-height: 400px; max-width: 100%; overflow-y: auto; overflow-x: hidden;">
        <input type="text" class="search-bar" placeholder="Rechercher un courrier classé">
        <table id="classer-table">
            <thead>
                <tr>
                    <th>Date de classement</th>
                    <th>Numéro du courrier</th>
                    <th>Date du courrier</th>
                    <th>Référence</th>
                    <th>Description</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody id="classer-table-body">
                <?php foreach ($courriers_classifies as $courrier_classe): ?>
                <tr>
                    <td><?php echo htmlspecialchars($courrier_classe['date_classement'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($courrier_classe['numero'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($courrier_classe['date_courrier'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($courrier_classe['ref'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($courrier_classe['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($courrier_classe['statut'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
   
    <script src="../js/traiter.js"></script>
    <script src="../js/confirmation_courrier.js"></script>
    <script src="../js/classer.js"></script>
    <script src="../js/archiver.js"></script>
    <script src="../js/transferer.js"></script>
    <script src="../js/script_courrier.js"></script>
     <script>
        document.addEventListener('DOMContentLoaded', function () {
            const success = "<?php echo $success; ?>";
            if (success === "1") {
                alert("Opération réussie !");
            } else if (success === "0") {
                alert("Échec de l'opération.");
            }
        });
    </script>
    </body>
</html>
