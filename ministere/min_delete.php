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

$idministere = $_GET['id_ministere'] ?? ''; // Récupérer l'ID du service depuis l'URL
$idministere = $conn->real_escape_string($idministere); // Échapper l'ID pour éviter les injections SQL

// Supprimer le service de la base de données
$sql = "DELETE FROM ministere WHERE id_ministere=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $idministere);

if ($stmt->execute()) {
    echo "<script>alert('Ministère supprimé avec succès.'); window.location.href='index.php';</script>";
} else {
    echo "Erreur lors de la suppression du Ministere : " . $conn->error;
}

$stmt->close();
$conn->close();
?>
