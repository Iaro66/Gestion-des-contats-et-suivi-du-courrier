<?php
// Vérifier si l'ID est passé en paramètre
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Récupérer les détails de l'agent pour pré-remplir le formulaire
    $stmt = $conn->prepare("SELECT nomservice, portebatiment, matriculeagent,  nomdivision, nom_ministere, nomagent, prenomagent, telagent, mailagent FROM agent WHERE idagent = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($idservice, $portebatiment, $matriculeagent, $nomdivision, $nomministere, $nomagent, $prenomagent, $telagent, $mailagent);
    $stmt->fetch();
    $stmt->close();
} else {
    die("ID de l'agent non spécifié.");
}

// Vérifier si le formulaire de modification est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $idagent = intval($_POST['idagent']);
    $idservice = $_POST['nomservice'];
    $portebatiment = $_POST['portebatiment'];
    $matriculeagent = $_POST['matriculeagent'];
    $nomdivision = $_POST['nomdivision'];
    $nomministere = $_POST['nom_ministere'];
    $nomagent = $_POST['nomagent'];
    $prenomagent = $_POST['prenomagent'];
    $telagent = $_POST['telagent'];
    $mailagent = $_POST['mailagent'];


    $stmt = $conn->prepare("UPDATE agent SET nomservice = ?, portebatiment = ?, matriculeagent = ?, nomdivision = ?, nom_ministere = ?, nomagent = ?, prenomagent = ?, telagent = ?, mailagent = ? WHERE idagent = ?");
    $stmt->bind_param("sssssssssi", $idservice, $portebatiment, $matriculeagent, $nomdivision, $nomministere, $nomagent, $prenomagent, $telagent, $mailagent, $idagent);

    if ($stmt->execute()) {
        header("Location: index.php"); 
        exit();
    } else {
        echo "Erreur lors de la modification de l'agent : " . $conn->error;
    }

    $stmt->close();
}
?>