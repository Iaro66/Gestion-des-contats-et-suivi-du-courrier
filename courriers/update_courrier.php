<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $date_courrier = $_POST['date_courrier'];
    $num = $_POST['num'];
    $ref = $_POST['ref'];
    $description = $_POST['description'];
    $remarque = $_POST['remarque'];

    $conn = new mysqli("localhost", "root", "", "gestion_contact");
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE courrier SET date_courrier = ?, numero = ?, ref = ?, description = ?, remark= ? WHERE idcourrier = ?");
    $stmt->bind_param("sisssi", $date_courrier, $num, $ref, $description, $remarque, $id);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
    $conn->close();
}
?>
