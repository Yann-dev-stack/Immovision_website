<?php
// back/controllers/contact.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO contacts (nom, email, sujet, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['nom'], $_POST['email'], $_POST['sujet'], $_POST['message']]);
    // Envoyer un email (avec PHPMailer)
}

?>