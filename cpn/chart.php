<?php
$servername = "localhost";
include './../conn.php';
session_start();

// Vérifier la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Obtenir l'année et le mois en cours
$currentYear = date('Y');
$currentMonth = date('m');

// Requête SQL pour obtenir le nombre de patients créés chaque mois jusqu'au mois en cours de l'année en cours
$sql = "
SELECT DATE_FORMAT(date, '%Y') AS year, LPAD(DATE_FORMAT(date, '%m'), 2, '0') AS month, COUNT(*) AS count
FROM patient
WHERE (DATE_FORMAT(date, '%Y') < $currentYear)
   OR (DATE_FORMAT(date, '%Y') = $currentYear AND DATE_FORMAT(date, '%m') <= $currentMonth)
GROUP BY year, month
ORDER BY year, month
";

$result = mysqli_query($conn, $sql);

// Initialiser un tableau pour stocker les données
$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $year = $row['year'];
    $month = $row['month'];
    $count = $row['count'];

    if (!isset($data[$year])) {
        $data[$year] = array_fill(1, 12, 0); // Initialiser les mois avec 0
    }
    $data[$year][(int)$month] = $count;
}

// Fermer la connexion
mysqli_close($conn);

// Retourner les données en JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
