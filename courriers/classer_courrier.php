<?php
session_start();


$conn = new mysqli("localhost", "root", "", "gestion_contact");
if ($conn->connect_error) {
    die("Connexion échouée: " . htmlspecialchars($conn->connect_error));
}

// Vérification des données envoyées par le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $dateClassement = $_POST['date_classement'];

    // Validation des données
    if (empty($id) || empty($dateClassement)) {
        echo 'error: Missing required fields';
        exit;
    }

    // Préparation et exécution de la requête SQL
    $stmt = $conn->prepare("UPDATE courrier SET statut = 'Classé', date_classement = ? WHERE idcourrier = ?");
    if ($stmt === false) {
        die('Error in SQL prepare statement: ' . htmlspecialchars($conn->error));
    }

    if (!$stmt->bind_param("si", $dateClassement, $id)) {
        die('Error in binding parameters: ' . htmlspecialchars($stmt->error));
    }

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error: ' . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo 'error: Invalid request method';
}

$conn->close();
?>
