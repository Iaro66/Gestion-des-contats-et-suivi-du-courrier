<?php
session_start();
require_once 'db.php'; // Assurez-vous que le fichier de connexion à la base de données est correctement référencé
header('Content-Type: application/json');

$response = ['error' => '', 'success' => false];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['nomutilisateur']);
    $password = trim($_POST['motdepasse']);
    $confirmpassword = trim($_POST['confirmer_motdepasse']);

    if (empty($username) || empty($password) || empty($confirmpassword)) {
        $response['error'] = "Veuillez remplir tous les champs.";
    } elseif ($password !== $confirmpassword) {
        $response['error'] = "Les mots de passe ne correspondent pas.";
    } else {
        // Hashage du mot de passe
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        // Préparation de la requête SQL avec des paramètres pour éviter les injections SQL
        if ($stmt = $conn->prepare("INSERT INTO utilisateur (nomutilisateur, motdepasseutilisateur) VALUES (?, ?)")) {
            $stmt->bind_param("ss", $username, $password_hashed);

            if ($stmt->execute()) {
                $_SESSION['user_id'] = $conn->insert_id; // Stocke l'ID de l'utilisateur dans la session
                $response['success'] = true;
            } else {
                $response['error'] = "Erreur lors de l'exécution de la requête : " . $stmt->error;
            }

            $stmt->close();
        } else {
            $response['error'] = "Erreur lors de la préparation de la requête : " . $conn->error;
        }
    }
}

$conn->close();
echo json_encode($response);
?>
