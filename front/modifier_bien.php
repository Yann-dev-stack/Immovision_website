<?php
require_once __DIR__ . '/../back/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id    = (int) $_POST['id'];
    $titre = $_POST['titre'];
    $ville = $_POST['ville'];
    $prix  = $_POST['prix'];

    // Image existante (venant du formulaire)
    $imageFinale = $_POST['ancienne_image'] ?? null;



    // Récupération des images du bien
    $stmtImages = $pdo->prepare("
    SELECT id, image_path 
    FROM biens_images 
    WHERE bien_id = ?
");
    $stmtImages->execute([$id]);
    $imagesBien = $stmtImages->fetchAll(PDO::FETCH_ASSOC);



    if (!empty($_FILES['images']['name'][0])) {

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp) {

            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {

                $filename = time() . '_' . $_FILES['images']['name'][$key];
                $path = 'uploads/biens/' . $filename;

                move_uploaded_file($tmp, __DIR__ . '/../' . $path);

                $stmt = $pdo->prepare("
                INSERT INTO biens_images (bien_id, image_path)
                VALUES (?, ?)
            ");
                $stmt->execute([$id, $path]);
            }
        }
    }





    /* ================================
       2️⃣ Nouvelle image uploadée
    ================================= */
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $uploadDir = __DIR__ . '/../uploads/biens/';

        if (!is_dir($uploadDir)) {
            die("Dossier d’upload introuvable");
        }

        $nouvelleImage = time() . '_' . basename($_FILES['image']['name']);
        $destination   = $uploadDir . $nouvelleImage;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            $imageFinale = $nouvelleImage;
        }
    }

    /* ================================
       3️⃣ UPDATE — SANS PERDRE L’IMAGE
    ================================= */
    $stmt = $pdo->prepare("
        UPDATE biens SET
            titre = :titre,
            ville = :ville,
            prix  = :prix,
            image = :image
        WHERE id = :id
    ");

    $stmt->execute([
        ':titre' => $titre,
        ':ville' => $ville,
        ':prix'  => $prix,
        ':image' => $imageFinale,
        ':id'    => $id
    ]);

    header('Location: dashboard.php');
    exit;
}
