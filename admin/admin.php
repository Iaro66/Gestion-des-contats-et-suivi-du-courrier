<?php
require_once '../db.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    $is_admin = false;
} else {
    // Vérifie le rôle de l'utilisateur
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT role FROM utilisateur WHERE idutilisateur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $is_admin = false;
    } else {
        $stmt->bind_result($role);
        $stmt->fetch();
        $is_admin = ($role === 'admin');
    }

    $stmt->close();
}
$conn->close();
?>
