<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT porte, etage FROM batiment WHERE idbatiment = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($porte, $etage);
    $stmt->fetch();
    $stmt->close();

    $porte = $porte ?? '';
    $etage = $etage ?? '';
} else {
    die("ID du bâtiment non spécifié.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $porte = $_POST['porte_batiment'];
    $etage = $_POST['etage_batiment'];

    $stmt = $conn->prepare("UPDATE batiment SET porte = ?, etage = ? WHERE idbatiment = ?");
    $stmt->bind_param("ssi", $porte, $etage, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Bâtiment mis à jour avec succès.";
        $_SESSION['message_type'] = "confirmation-box";
    } else {
        $_SESSION['message'] = "Erreur lors de la modification du bâtiment : " . $conn->error;
        $_SESSION['message_type'] = "error-box";
    }

    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
}
?>