<?php
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

$idservice = $_GET['id'] ?? '';
$idservice = $conn->real_escape_string($idservice);

// Supprimer le service de la base de données
$sql = "DELETE FROM services WHERE idservice=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $idservice);

if ($stmt->execute()) {
    echo "<script>alert('Service supprimé avec succès.'); window.location.href='index.php';</script>";
} else {
    echo "Erreur lors de la suppression du service : " . $conn->error;
}

$stmt->close();
$conn->close();
?>
