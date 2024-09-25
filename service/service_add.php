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

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nomservice = trim($_POST['nom_service']);
    $acronymeservice = trim($_POST['acronyme_service']);

    if (empty($nomservice) || empty($acronymeservice)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        // Générer un ID unique pour le service
        $idservice = uniqid('srv_');

        // Préparer et exécuter la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO services (idservice, nomservice, acronymeservice) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $idservice, $nomservice, $acronymeservice);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout du service : " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
