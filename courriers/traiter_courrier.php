<?php
session_start();

$conn = new mysqli("localhost", "root", "", "gestion_contact");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courrierId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $agentTraitantId = isset($_POST['agent']) ? intval($_POST['agent']) : 0;

    // Validation des entrées
    if ($courrierId > 0 && $agentTraitantId > 0) {
        // Mettre à jour le courrier pour le marquer comme traité par l'agent sélectionné
        $query = "UPDATE courrier SET statut = 'Vérifié et en cours de traitement', agent_traitant = ?, date_verification = NOW() WHERE idcourrier = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $agentTraitantId, $courrierId);

        if ($stmt->execute()) {
            // Récupère les détails du courrier pour les afficher dans le tableau de vérification
            $result = $conn->query("SELECT numero, date_courrier, ref, description FROM courrier WHERE idcourrier = $courrierId");
            $courrier = $result->fetch_assoc();
            echo json_encode(['success' => true, 'courrier' => $courrier]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erreur lors de la mise à jour du courrier.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'ID du courrier ou de l\'agent invalide.']);
    }
}

$conn->close();
?>
