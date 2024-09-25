<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_contact";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $porte = $_POST['porte_batiment'];
    $etage = $_POST['etage_batiment'];

    $stmt = $conn->prepare("INSERT INTO batiment (porte, etage) VALUES (?, ?)");
    $stmt->bind_param("ss", $porte, $etage);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Bâtiment ajouté avec succès.";
        $_SESSION['message_type'] = "confirmation-box";  
    } else {
        $_SESSION['message'] = "Erreur lors de l'ajout du bâtiment : " . $conn->error;
        $_SESSION['message_type'] = "error-box";  
    }

    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
}
?>
