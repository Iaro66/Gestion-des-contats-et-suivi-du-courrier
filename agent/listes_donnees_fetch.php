<?php
$servicesQuery = "SELECT idservice, nomservice FROM services ORDER BY nomservice ASC";
$servicesResult = $conn->query($servicesQuery);

if (!$servicesResult) {
    die("Erreur de requête : " . $conn->error);
}

$divisionsQuery = "SELECT nomdivision FROM division ORDER BY nomdivision ASC";
$divisionsResult = $conn->query($divisionsQuery);

if (!$divisionsResult) {
    die("Erreur de requête : " . $conn->error);
}

$batimentsQuery = "SELECT porte FROM batiment ORDER BY porte ASC";
$batimentsResult = $conn->query($batimentsQuery);

if (!$batimentsResult) {
    die("Erreur de requête : " . $conn->error);
}

$nomministereQuery = "SELECT DISTINCT nom_ministere FROM ministere WHERE nom_ministere IS NOT NULL ORDER BY nom_ministere ASC";
$nomministereResult = $conn->query($nomministereQuery);

if (!$nomministereResult) {
    die("Erreur de requête : " . $conn->error);
}
?>