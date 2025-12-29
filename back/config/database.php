<?php
$host = 'b7ru1e4om70hszc3r7sq-mysql.services.clever-cloud.com'; // ou l'adresse du serveur de base de données
$dbname = 'b7ru1e4om70hszc3r7sq';
$username = 'u9mn5rcp0csqpt2f';  // ton nom d'utilisateur MySQL
$password = '0MCa85Ohn4aeKctMOHJS';      // ton mot de passe MySQL

try {
    // Créer la connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    die();
}
?>
