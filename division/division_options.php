<?php
$host = 'localhost';
$dbname = 'gestion_contact';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT nomdivision FROM division");
    $divisions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($divisions as $division) {
        $nomdivision = $division['nomdivision'] ?? ''; // Gérer les valeurs nulles
        echo "<option value=\"" . htmlspecialchars($nomdivision, ENT_QUOTES, 'UTF-8') . "\">" . htmlspecialchars($nomdivision, ENT_QUOTES, 'UTF-8') . "</option>";
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}
?>
