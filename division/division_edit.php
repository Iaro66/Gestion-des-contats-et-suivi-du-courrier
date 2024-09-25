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

$iddivision = $_GET['id'] ?? ''; 
$iddivision = $conn->real_escape_string($iddivision); 

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomdivision = $_POST['nom_division'] ?? '';

    // Mettre à jour la division dans la base de données
    $sql = "UPDATE division SET nomdivision=? WHERE iddivision=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nomdivision, $iddivision);

    if ($stmt->execute()) {
        echo "<script>alert('Division modifiée avec succès.'); window.location.href='index.php';</script>";
    } else {
        echo "Erreur lors de la modification de la division : " . $conn->error;
    }
    $stmt->close();
}

// Récupérer les informations actuelles de la division
$sql = "SELECT iddivision, nomdivision FROM division WHERE iddivision=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $iddivision);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Division introuvable.");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Division</title>
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
    <form class="crud-form" id="division-form" action="division_edit.php?id=<?php echo urlencode($iddivision); ?>" method="post">
        <h3>Modifier la Division</h3>
        <div class="form-group">
            <label for="nom_division">Nom de la Division :</label>
            <input type="text" id="nom_division" name="nom_division" value="<?php echo htmlspecialchars($row['nomdivision'] ?? ''); ?>" required>
        </div>
        <button type="submit" id="submit-button" class="ajouter">Enregistrer les modifications</button>
        <a href="index.php" class="supprimer">Annuler</a>
    </form>
</div>
<script>
document.getElementById('submit-button').addEventListener('click', function(event) {
    var form = document.getElementById('division-form');
    var confirmMessage = "Êtes-vous sûr de vouloir enregistrer les modifications ?";
    if (!confirm(confirmMessage)) {
        event.preventDefault(); 
    }
});
</script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
