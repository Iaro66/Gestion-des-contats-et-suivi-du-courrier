<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_contact";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}
?>
