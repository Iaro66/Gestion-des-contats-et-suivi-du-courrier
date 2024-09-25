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

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomdivision = trim($_POST['nom_division']);

    if (empty($nomdivision)) {
        echo "Veuillez remplir tous les champs obligatoires.";
    } else {
        // ID unique pour la division
        $iddivision = uniqid('div_');

        // Préparer et exécuter la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO division (iddivision, nomdivision) VALUES (?, ?)");
        $stmt->bind_param("ss", $iddivision, $nomdivision);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout de la division : " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
