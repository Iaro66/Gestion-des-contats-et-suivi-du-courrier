<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php'); 
    exit();
}
include 'db.php';
include 'verif_fetch_edit.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Agent</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="main-header">
    <div class="header-content">
        <!-- Logo -->
        <div class="logo">
            <img src="../img/I.png" alt="Logo de l'application">
        </div>
        <h2>Gestion des Agents</h2>
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
    <form id="edit-form" class="crud-form" action="agent_edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post" onsubmit="return confirmUpdate();">
        <div class="formul">
            <h3>Modifier l'Agent</h3>
            <input type="hidden" name="idagent" value="<?php echo htmlspecialchars($id); ?>">

            <!-- Récupération des données liste déroulantes -->
            <?php
            $servicesQuery = "SELECT nomservice, nomservice FROM services";
            $servicesResult = $conn->query($servicesQuery);

            $divisionsQuery = "SELECT nomdivision FROM division";
            $divisionsResult = $conn->query($divisionsQuery);

            $batimentsQuery = "SELECT porte FROM batiment";
            $batimentsResult = $conn->query($batimentsQuery);

            $nomministereQuery = "SELECT nom_ministere FROM ministere";
            $nomministereResult = $conn->query($nomministereQuery);
            ?>

            <div class="form-group">
                <label for="nomservice">Service:</label>
                <select name="nomservice" id="nomservice">
                    <?php while ($row = $servicesResult->fetch_assoc()) { ?>
                        <option value="<?php echo $row['nomservice']; ?>" <?php if ($row['nomservice'] == $idservice) echo 'selected'; ?>>
                            <?php echo $row['nomservice']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="portebatiment">Porte du bâtiment:</label>
                <select name="portebatiment" id="portebatiment">
                    <?php while ($row = $batimentsResult->fetch_assoc()) { ?>
                        <option value="<?php echo $row['porte']; ?>" <?php if ($row['porte'] == $portebatiment) echo 'selected'; ?>>
                            <?php echo $row['porte']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="matriculeagent">Matricule:</label>
                <input type="text" name="matriculeagent" id="matriculeagent" value="<?php echo htmlspecialchars($matriculeagent); ?>">
            </div>

            <div class="form-group">
                <label for="nomdivision">Division:</label>
                <select name="nomdivision" id="nomdivision">
                    <?php while ($row = $divisionsResult->fetch_assoc()) { ?>
                        <option value="<?php echo $row['nomdivision']; ?>" <?php if ($row['nomdivision'] == $nomdivision) echo 'selected'; ?>>
                            <?php echo $row['nomdivision']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nom_ministere">Responsable du Ministère:</label>
                <select name="nom_ministere" id="nom_ministere">
                    <?php while ($row = $nomministereResult->fetch_assoc()) { ?>
                        <option value="<?php echo $row['nom_ministere']; ?>" <?php if ($row['nom_ministere'] == $nomministere) echo 'selected'; ?>>
                            <?php echo $row['nom_ministere']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nomagent">Nom:</label>
                <input type="text" name="nomagent" id="nomagent" value="<?php echo htmlspecialchars($nomagent); ?>">
            </div>

            <div class="form-group">
                <label for="prenomagent">Prénom:</label>
                <input type="text" name="prenomagent" id="prenomagent" value="<?php echo htmlspecialchars($prenomagent); ?>">
            </div>

            <div class="form-group">
                <label for="telagent">Téléphone:</label>
                <input type="text" name="telagent" id="telagent" value="<?php echo htmlspecialchars($telagent); ?>">
            </div>

            <div class="form-group">
                <label for="mailagent">E-mail:</label>
                <input type="email" name="mailagent" id="mailagent" value="<?php echo htmlspecialchars($mailagent); ?>">
            </div>

            <div class="form-group">
                <input type="submit" name="update" value="Modifier">
            </div>
        </div>
    </form>
</div>
<script src="../js/confirmation_modification.js"></script>
</body>
</html>

<?php $conn->close(); ?>
