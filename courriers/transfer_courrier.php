<?php
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', 1);

try {
    $pdo = new PDO("mysql:host=localhost;dbname=gestion_contact", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $response = ['success' => false];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $courrierId = $_POST['courrier_id'] ?? null;
        $dateTransfert = $_POST['date_transfert'] ?? null;
        $agentExpediteurId = $_POST['agent_expediteur'] ?? null;
        $agentDestinataireId = $_POST['agent_destinataire'] ?? null;

        if ($courrierId && $dateTransfert && $agentExpediteurId && $agentDestinataireId) {
            $stmt = $pdo->prepare("UPDATE courrier SET date_transfert = ?, agent_expediteur = ?, agent_destinataire = ?, statut = 'transféré' WHERE idcourrier = ?");
            $stmt->execute([$dateTransfert, $agentExpediteurId, $agentDestinataireId, $courrierId]);

            $stmt = $pdo->prepare("SELECT nom FROM agents WHERE id = ?");
            $stmt->execute([$agentExpediteurId]);
            $agentExpediteur = $stmt->fetchColumn();

            $stmt->execute([$agentDestinataireId]);
            $agentDestinataire = $stmt->fetchColumn();

            $stmt = $pdo->prepare("SELECT * FROM courrier WHERE idcourrier = ?");
            $stmt->execute([$courrierId]);
            $courrier = $stmt->fetch(PDO::FETCH_ASSOC);

            $response['success'] = true;
            $response['date_transfert'] = $courrier['date_transfert'];
            $response['numero'] = $courrier['numero'];
            $response['date_courrier'] = $courrier['date_courrier'];
            $response['ref'] = $courrier['ref'];
            $response['description'] = $courrier['description'];
            $response['statut'] = $courrier['statut'];
            $response['agent_expediteur'] = $agentExpediteur;
            $response['agent_destinataire'] = $agentDestinataire;
            $response['idcourrier'] = $courrierId;
        }
    } else {
        $response['message'] = 'Méthode non autorisée';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erreur de connexion à la base de données : ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>
