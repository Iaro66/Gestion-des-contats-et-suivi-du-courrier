<?php

date_default_timezone_set('Indian/Antananarivo');


$conn = new mysqli("localhost", "root", "", "gestion_contact");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$user_id = $_SESSION['user_id'] ?? null; 
if ($user_id) {
    $stmt = $conn->prepare("SELECT nomagent101 FROM agent101 WHERE idagent101 = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user_result = $stmt->get_result();
    $user_row = $user_result->fetch_assoc();
    $agent_utilisateur = $user_row['nomagent101'] ?? ''; 
    $stmt->close();
} else {
    $agent_utilisateur = '';
}


$courriers_result = $conn->query("SELECT * FROM courrier WHERE statut = 'Non-traité'");
$courriers_non_traites = [];
if ($courriers_result->num_rows > 0) {
    while ($row = $courriers_result->fetch_assoc()) {
        $courriers_non_traites[] = $row;
    }
}


$courriers_autres_result = $conn->query("SELECT * FROM courrier WHERE statut != 'Vérifié et en cours de traitement'");
$courriers_autres = [];
if ($courriers_autres_result->num_rows > 0) {
    while ($row = $courriers_autres_result->fetch_assoc()) {
        $courriers_autres[] = $row;
    }
} 

$courriers_verifies_result = $conn->query("SELECT * FROM courrier WHERE statut = 'Vérifié et en cours de traitement'");
$courriers_verifies = [];
if ($courriers_verifies_result->num_rows > 0) {
    while ($row = $courriers_verifies_result->fetch_assoc()) {
        $courriers_verifies[] = $row;
    }
}

$courriers_transferes_result = $conn->query("SELECT * FROM courrier WHERE statut = 'Transféré'");
$courriers_transferes = [];
if ($courriers_transferes_result->num_rows > 0) {
    while ($row = $courriers_transferes_result->fetch_assoc()) {
        $courriers_transferes[] = $row;
    }
}
$courriers_archives_result = $conn->query("SELECT * FROM courrier WHERE statut = 'Archivé'");
$courriers_archives = [];
if ($courriers_archives_result->num_rows > 0) {
    while ($row = $courriers_archives_result->fetch_assoc()) {
        $courriers_archives[] = $row;
    }
}

$sql_classifies = "SELECT * FROM courrier WHERE statut = 'Classé'";
$result_classifies = $conn->query($sql_classifies);
$courriers_classifies = [];
if ($result_classifies->num_rows > 0) {
    while ($row = $result_classifies->fetch_assoc()) {
        $courriers_classifies[] = $row;
    }
}

$query = "
    SELECT c.*, a.nomagent101 AS nom_agent_recepteur
    FROM courrier c
    JOIN agent101 a ON c.agent_recepteur = a.idagent101
    WHERE c.statut = 'non traité'
";
$result = $conn->query($query);

$courriers_non_traite = [];
if ($result->num_rows > 0) {
    while ($courrier = $result->fetch_assoc()) {
        $courriers_non_traite[] = $courrier;
    }
}

// Récupère les courriers vérifiés avec les noms d'agents
$query_verification = "
    SELECT c.*, a.nomagent101 AS nom_agent_traitant
    FROM courrier c
    JOIN agent101 a ON c.agent_recepteur = a.idagent101
    WHERE c.statut = 'vérifié et en cours de traitement'
";
$result_verification = $conn->query($query_verification);

$courriers_verifies = [];
if ($result_verification->num_rows > 0) {
    while ($courrier_verifie = $result_verification->fetch_assoc()) {
        $courriers_verifies[] = $courrier_verifie;
    }
}
?>
