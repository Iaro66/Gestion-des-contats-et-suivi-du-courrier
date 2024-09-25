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

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les entrées utilisateur
    $nomministere = trim($_POST['nom_ministere']);
    $codeministere = trim($_POST['code_ministere']);  

    if (empty($nomministere) || empty($codeministere)) { 
        echo "Veuillez remplir tous les champs.";
    } else {
        // Préparer et exécuter la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO ministere (nom_ministere, code_ministere) VALUES (?, ?)");
        $stmt->bind_param("ss", $nomministere, $codeministere);  

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout du ministère : " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
