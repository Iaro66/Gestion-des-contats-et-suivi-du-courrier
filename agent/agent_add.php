<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_contact";

//connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Fonction pour ajouter une nouvelle valeur à une table spécifique
function addValueToTable($conn, $table, $column, $value) {
    $stmt = $conn->prepare("INSERT INTO $table ($column) VALUES (?)");
    if (!$stmt) {
        die("Erreur de préparation de la requête pour $table : " . $conn->error);
    }
    $stmt->bind_param("s", $value);
    if (!$stmt->execute()) {
        die("Erreur lors de l'exécution de la requête pour $table : " . $stmt->error);
    }
    $stmt->close();
}

// Vérification si l'agent existe déjà
function agentExists($conn, $matricule) {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM agent WHERE matriculeagent = ?");
    if (!$stmt) {
        die("Erreur de préparation de la requête pour vérification d'agent : " . $conn->error);
    }
    $stmt->bind_param("s", $matricule);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    return $count > 0;
}

// Vérification et insertion des agents
if (!empty($_POST['matriculeagent']) && !empty($_POST['nomagent']) && !empty($_POST['prenomagent'])) {
    
    $matricule = $_POST['matriculeagent'];
    $nom = $_POST['nomagent'];
    $prenom = $_POST['prenomagent'];
    $tel = $_POST['telagent'];
    $mail = $_POST['mailagent'];
    $porte = $_POST['portebatiment'];
    $service = $_POST['nomservice'];
    $division = $_POST['nomdivision'];
    $nomministere = $_POST['nom_ministere'];

    if (agentExists($conn, $matricule)) {
        $_SESSION['error_message'] = "L'agent avec ce matricule existe déjà.";
        header("Location: index.php");
        exit;
    }

    if (!empty($_POST['new-portebatiment'])) {
        $newPorte = $_POST['new-portebatiment'];
        addValueToTable($conn, 'batiment', 'porte', $newPorte);
        $porte = $newPorte;
    }

    if (!empty($_POST['new-nomdivision'])) {
        $newDivision = $_POST['new-nomdivision'];
        addValueToTable($conn, 'division', 'nomdivision', $newDivision);
        $division = $newDivision;
    }

    if (!empty($_POST['new-nomservice'])) {
        $service = $_POST['new-nomservice'];
        $newService = $_POST['new-nomservice'];
        addValueToTable($conn, 'services', 'nomservice', $newService);
    }

    if (!empty($_POST['new-nomministere'])) {
        $newnomministere = $_POST['new-nomministere'];
        $stmt = $conn->prepare("INSERT INTO ministere (nom_ministere) VALUES (?)");
        if (!$stmt) {
            die("Erreur de préparation de la requête pour le ministère : " . $conn->error);
        }
        $stmt->bind_param("s", $newnomministere);
        if (!$stmt->execute()) {
            die("Erreur lors de l'exécution de la requête pour le ministère : " . $stmt->error);
        }
        $stmt->close();
        $nomministere = $newnomministere;
    }

    $stmt = $conn->prepare("INSERT INTO agent (matriculeagent, nomagent, prenomagent, telagent, mailagent, portebatiment, nomservice, nomdivision, nom_ministere) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }
    $stmt->bind_param("sssssssss", $matricule, $nom, $prenom, $tel, $mail, $porte, $service, $division, $nomministere);
    if (!$stmt->execute()) {
        die("Erreur lors de l'exécution de la requête : " . $stmt->error);
    }
    $stmt->close();
}


header("Location: index.php");
$conn->close();
?>
