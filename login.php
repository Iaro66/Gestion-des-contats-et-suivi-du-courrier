<?php
session_start();
require_once 'db.php';

header('Content-Type: application/json');

$response = ['error' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nomutilisateur']) && !empty($_POST['motdepasse'])) {
        $username = trim($_POST['nomutilisateur']);
        $password = trim($_POST['motdepasse']);
        
        $sql = "SELECT idutilisateur, motdepasseutilisateur FROM utilisateur WHERE nomutilisateur = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $hashed_password);
                $stmt->fetch();
                
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['user_id'] = $id;
                    echo json_encode(['success' => true]);
                    exit();
                } else {
                    $response['error'] = "Identifiant ou mot de passe incorrect.";
                }
            } else {
                $response['error'] = "Identifiant ou mot de passe incorrect.";
            }
            
            $stmt->close();
        } else {
            $response['error'] = "Erreur lors de la préparation de la requête.";
        }
    } else {
        $response['error'] = "Veuillez remplir tous les champs.";
    }
}

$conn->close();
echo json_encode($response);
?>
