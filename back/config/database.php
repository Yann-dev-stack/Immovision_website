<?php
$host = 'localhost'; // ou l'adresse du serveur de base de données
$dbname = 'immovision_db';
$username = 'root';  // ton nom d'utilisateur MySQL
$password = '';      // ton mot de passe MySQL

try {
    // Créer la connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    die();
}
?>
