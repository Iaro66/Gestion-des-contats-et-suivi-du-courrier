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

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$idministere = $_GET['id'] ?? ''; 
$idministere = $conn->real_escape_string($idministere); 

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomministere = trim($_POST['nom_ministere']);
    $codeministere = trim($_POST['code_ministere']);

    if (empty($nomministere) || empty($codeministere)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        // Mettre à jour le ministère dans la base de données
        $sql = "UPDATE ministere SET nom_ministere = ?, code_ministere = ? WHERE id_ministere = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nomministere, $codeministere, $idministere); // Changed parameter types

        if ($stmt->execute()) {
            echo "<script>alert('Ministère modifié avec succès.'); window.location.href='index.php';</script>";
        } else {
            echo "Erreur lors de la modification du Ministère : " . $stmt->error;
        }
        $stmt->close();
    }
}

// Récupère les informations actuelles du ministère
$sql = "SELECT id_ministere, nom_ministere, code_ministere FROM ministere WHERE id_ministere = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idministere);  
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Ministère introuvable.");
}

$row = $result->fetch_assoc();

$nomministere = $row['nom_ministere'] ?? ''; 
$codeministere = $row['code_ministere'] ?? ''; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Ministère</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="main-header">
    <div class="header-content">
        <!-- Logo -->
        <div class="logo">
            <img src="../img/I.png" alt="Logo de l'application">
        </div>
        <h2>Gestion des Ministères</h2>
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
    <form class="crud-form" action="min_edit.php?id=<?php echo urlencode($idministere); ?>" method="post">
        <h3>Modifier le Ministère</h3>
        <div class="form-group">
            <label for="nom_ministere">Nom du Ministère:</label>
            <input type="text" id="nom_ministere" name="nom_ministere" value="<?php echo htmlspecialchars($nomministere); ?>" required>
        </div>
        <div class="form-group">
            <label for="code_ministere">Code du Ministère:</label>
            <input type="text" id="code_ministere" name="code_ministere" value="<?php echo htmlspecialchars($codeministere); ?>" required>
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
