<?php
session_start();
$conn = new mysqli("localhost", "root", "", "gestion_contact");

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courrierId = $_POST['id'];
    $dateArchivage = $_POST['date_archivage'];
    $lieuArchivage = $_POST['lieu_archivage'];

    if (empty($courrierId) || empty($dateArchivage) || empty($lieuArchivage)) {
        echo 'error: Missing required fields';
        exit;
    }

    // Mise à jour des champs
    $stmt = $conn->prepare("UPDATE courrier SET date_archivage = ?, lieu_archivage = ?, statut = 'Archivé' WHERE idcourrier = ?");
    if ($stmt === false) {
        die('Error in SQL prepare statement: ' . htmlspecialchars($conn->error));
    }

    if (!$stmt->bind_param("ssi", $dateArchivage, $lieuArchivage, $courrierId)) {
        die('Error in binding parameters: ' . htmlspecialchars($stmt->error));
    }

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error: ' . htmlspecialchars($stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>
