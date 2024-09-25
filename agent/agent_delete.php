<?php
include 'db.php';
// Récupère l'identifiant de l'agent à supprimer depuis l'URL
$idagent = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($idagent > 0) {
    // Requête pour supprimer l'agent
    $sql = "DELETE FROM agent WHERE idagent = ?";

    // Préparer et exécuter la requête
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $idagent);
        $stmt->execute();
        $stmt->close();
    }
}
header("Location: index.php");
exit;
$conn->close();
?>
