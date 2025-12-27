<?php
class RendezVous {
    public static function creer($data) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO rendez_vous 
            (bien_id, client_nom, client_email, client_tel, date_rdv, agent_id) 
            VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['bien_id'],
            $data['nom'],
            $data['email'],
            $data['telephone'],
            $data['date_heure'],
            $data['agent_id']
        ]);
    }

    public static function getDisponibilites($agent_id, $date) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT date_rdv FROM rendez_vous 
                              WHERE agent_id = ? AND DATE(date_rdv) = ?");
        $stmt->execute([$agent_id, $date]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>