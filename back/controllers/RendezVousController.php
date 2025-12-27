<?php
class RendezVousController {
    public static function prendreRendezVous() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'bien_id' => (int)$_POST['bien_id'],
                'nom' => htmlspecialchars($_POST['nom']),
                'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                'telephone' => htmlspecialchars($_POST['telephone']),
                'date_heure' => $_POST['date'] . ' ' . $_POST['heure'],
                'agent_id' => (int)$_POST['agent_id']
            ];

            if (RendezVous::creer($data)) {
                // Envoyer email de confirmation
                Mailer::envoyerConfirmationRdv($data);
                return ['success' => true];
            }
        }
        return ['error' => 'Erreur lors de la prise de rendez-vous'];
    }
}
?>