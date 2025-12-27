<?php
require_once __DIR__ . '/../models/Contact.php';

class ContactController {
    public static function handleForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => htmlspecialchars($_POST['nom']),
                'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                'message' => htmlspecialchars($_POST['message'])
            ];

            if (Contact::create($data)) {
                header('Location: /contact.php?success=1');
            } else {
                header('Location: /contact.php?error=1');
            }
        }
    }
}
?>
