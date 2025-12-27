<?php
require_once __DIR__ . '/../back/config/database.php';

if (!isset($_POST['image_id'])) {
    echo json_encode(['success' => false]);
    exit;
}

$imageId = (int) $_POST['image_id'];

// Récupérer le chemin de l’image
$stmt = $pdo->prepare("SELECT image_path FROM biens_images WHERE id = ?");
$stmt->execute([$imageId]);
$image = $stmt->fetch(PDO::FETCH_ASSOC);

if ($image) {

    // Supprimer le fichier
    $filePath = __DIR__ . '/../' . $image['image_path'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Supprimer en base
    $del = $pdo->prepare("DELETE FROM biens_images WHERE id = ?");
    $del->execute([$imageId]);

    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false]);
