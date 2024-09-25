<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php'); 
    exit();
}

include 'db.php';

if (isset($_GET['idbatiment'])) {
    $id = $_GET['idvatiment'];

    $stmt = $conn->prepare("DELETE FROM batiment WHERE idbatiment = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Bâtiment supprimé avec succès.";
        $_SESSION['message_type'] = "confirmation-box";
    } else {
        $_SESSION['message'] = "Erreur lors de la suppression du bâtiment : " . $conn->error;
        $_SESSION['message_type'] = "error-box";
    }

    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
}
?>
