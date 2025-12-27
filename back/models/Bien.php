<?php
require_once __DIR__ . '/../config/database.php';

class Bien {
    public static function getAll() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM biens ORDER BY prix DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByType($type) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM biens WHERE type = ?");
        $stmt->execute([$type]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
