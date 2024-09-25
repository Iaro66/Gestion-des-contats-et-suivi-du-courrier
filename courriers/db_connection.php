<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "gestion_contact"; 

// Création de la connexion avec PDO
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // Définition du mode d'erreur de PDO pour lancer des exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Échec de la connexion à la base de données : " . $e->getMessage();
    die();  
}
