<?php
// index.php – Einstiegspunkt für API-Anfragen
header("Content-Type: application/json");

$status = [
    "status" => "OK",
    "message" => "Master-Server API läuft",
    "version" => "1.0.0.1"
];

echo json_encode($status);
?>
