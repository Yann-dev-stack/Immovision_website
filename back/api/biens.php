<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../models/Bien.php';

$type = $_GET['type'] ?? null;
$ville = $_GET['ville'] ?? null;

$biens = $type ? Bien::getByType($type) : Bien::getAll();

if ($ville) {
    $biens = array_filter($biens, fn($b) => strtolower($b['ville']) === strtolower($ville));
}

echo json_encode($biens);
?>