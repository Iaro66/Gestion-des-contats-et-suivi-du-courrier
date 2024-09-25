<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php'); 
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_contact";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$idservice = $_GET['id'] ?? ''; // Récupérer l'ID du service depuis l'URL
$idservice = $conn->real_escape_string($idservice); // Échapper l'ID pour éviter les injections SQL

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomservice = $_POST['nom_service'] ?? '';
    $acronymeservice = $_POST['acronyme_service'] ?? '';

    // Mettre à jour le service dans la base de données
    $sql = "UPDATE services SET nomservice=?, acronymeservice=? WHERE idservice=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nomservice, $acronymeservice, $idservice);

    if ($stmt->execute()) {
        echo "<script>alert('Service modifié avec succès.'); window.location.href='index.php';</script>";
    } else {
        echo "Erreur lors de la modification du service : " . $conn->error;
    }
    $stmt->close();
}

// Récupérer les informations actuelles du service
$sql = "SELECT idservice, nomservice, acronymeservice FROM services WHERE idservice=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $idservice);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Service introuvable.");
}

$row = $result->fetch_assoc();

// Assurez-vous que les valeurs récupérées ne sont pas nulles
$nomservice = $row['nomservice'] ?? '';
$acronymeservice = $row['acronymeservice'] ?? ''; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Service</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="main-header">
    <div class="header-content">
        <!-- Logo -->
        <div class="logo">
            <img src="../img/I.png" alt="Logo de l'application">
        </div>
        <h2>Gestion des Services</h2>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
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
    <form class="crud-form" action="service_edit.php?id=<?php echo urlencode($idservice); ?>" method="post">
        <h3>Modifier le Service</h3>
        <div class="form-group">
            <label for="nom_service">Nom du Service :</label>
            <input type="text" id="nom_service" name="nom_service" value="<?php echo htmlspecialchars($nomservice); ?>" required>
        </div>
        <div class="form-group">
            <label for="acronyme_service">Acronyme du Service :</label>
            <input type="text" id="acronyme_service" name="acronyme_service" value="<?php echo htmlspecialchars($acronymeservice); ?>" required>
        </div>
        <button type="submit" class="ajouter">Enregistrer les modifications</button>
        <a href="index.php" class="supprimer">Annuler</a>
    </form>
</div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
