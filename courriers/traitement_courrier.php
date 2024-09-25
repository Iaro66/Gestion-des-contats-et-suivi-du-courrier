<?php
session_start();


$conn = new mysqli("localhost", "root", "", "gestion_contact");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$numero = isset($_POST['num']) ? $_POST['num'] : null;
$date_courrier = isset($_POST['date_courrier']) ? $_POST['date_courrier'] : null;
$ref = isset($_POST['ref']) ? $_POST['ref'] : null;
$description = isset($_POST['description']) ? $_POST['description'] : null;
$remark = isset($_POST['remarque']) ? $_POST['remarque'] : null;
$agent_recepteur = isset($_POST['agent']) ? $_POST['agent'] : null;
$date_reception = date('Y-m-d'); // Assuming date_reception is the current date

if (empty($agent_recepteur)) {
    echo "<script>alert('Agent récepteur est obligatoire.'); window.location.href = 'index.php?success=0';</script>";
    exit;
}

$stmt = $conn->prepare("INSERT INTO courrier (numero, date_courrier, ref, description, remark, agent_recepteur, date_reception) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $numero, $date_courrier, $ref, $description, $remark, $agent_recepteur, $date_reception);

if ($stmt->execute()) {
    // Insertion réussie
    echo "<script>
            alert('Courrier ajouté avec succès!');
            setTimeout(function() {
                window.location.href = 'index.php?success=1';
            }, 2000); // Redirige après 2 secondes
          </script>";
    exit();
} else {
    // Erreur lors de l'insertion
    echo "<script>
            alert('Erreur lors de l\'ajout du courrier : " . $stmt->error . "');
            window.location.href = 'index.php?success=0';
          </script>";
    exit();
}

// Fermeture de la connexion
$stmt->close();
$conn->close();
?>
