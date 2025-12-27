<?php
// Inclure la configuration de la base de données
require_once __DIR__ . '/../back/config/database.php';

// Vérifier si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparer la requête de suppression
    $query = "DELETE FROM biens WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Exécuter la requête de suppression
    if ($stmt->execute()) {
        // Rediriger vers le dashboard avec un message de succès
        header('Location: dashboard.php');
        exit(); 
    } else {
        echo "Erreur lors de la suppression.";
    }
} else {
    echo "ID manquant.";
}
?>
