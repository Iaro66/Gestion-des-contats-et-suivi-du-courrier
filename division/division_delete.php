<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_contact";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$iddivision = $_GET['id'] ?? ''; 
$iddivision = $conn->real_escape_string($iddivision); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM division WHERE iddivision=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $iddivision);

    if ($stmt->execute()) {
        echo "<script>alert('Division supprimée avec succès.'); window.location.href='index.php';</script>";
    } else {
        echo "Erreur lors de la suppression de la division : " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    exit();
}

$sql = "SELECT nomdivision FROM division WHERE iddivision=?";
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
    <title>Supprimer la Division</title>
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
                <li><a href="../courrier/index.php">Courriers</a></li>
                <li><a href="../batiment/index.php">Bâtiments</a></li>
                <li><a href="../service/index.php">Services</a></li>
                <li><a href="../division/index.php">Divisions</a></li>
                <li><a href="../logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="crud-container">
    <form id="delete-form" action="division_delete.php?id=<?php echo urlencode($iddivision); ?>" method="post">
        <h3>Supprimer la Division</h3>
        <p>Êtes-vous sûr de vouloir supprimer la division "<?php echo htmlspecialchars($row['nomdivision']); ?>" ?</p>
        <button type="submit" id="delete-button" class="ajouter">Supprimer</button>
        <a href="index.php" class="annuler">Annuler</a>
    </form>
</div>
<script>
document.getElementById('delete-button').addEventListener('click', function(event) {
    var form = document.getElementById('delete-form');
    var confirmMessage = "Êtes-vous sûr de vouloir supprimer cette division ?";
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
