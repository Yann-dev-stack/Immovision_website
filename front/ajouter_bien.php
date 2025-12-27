<?php
// ajouter_bien.php
session_start();
require_once __DIR__ . '/../back/config/database.php';

define('UPLOAD_DIR', __DIR__ . '/../uploads/biens/');
define('MAX_FILE_SIZE', 50 * 1024 * 1024); // 50MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png']);

function extractYoutubeId(string $url): ?string
{
    if (empty($url)) {
        return null;
    }

    // Format youtu.be/ID
    if (preg_match('~youtu\.be/([^\?&]+)~', $url, $matches)) {
        return $matches[1];
    }

    // Format youtube.com/watch?v=ID
    if (preg_match('~v=([^\?&]+)~', $url, $matches)) {
        return $matches[1];
    }

    // Format youtube.com/embed/ID
    if (preg_match('~/embed/([^\?&]+)~', $url, $matches)) {
        return $matches[1];
    }

    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        // Validation des champs requis
        $requiredFields = ['titre', 'ville', 'surface', 'pieces', 'chambres', 'sdb', 'prix', 'statut', 'type'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Le champ '$field' est requis.");
            }
        }

        // Vérification des images
        if (empty($_FILES['images']['name'][0])) {
            throw new Exception("Au moins une image est requise.");
        }

        //Extraction de l'ID du lien Youtube
        $youtubeId = null;

        if (!empty($_POST['youtube_url'])) {
            $youtubeId = extractYoutubeId($_POST['youtube_url']);

            if ($youtubeId === null) {
                throw new Exception("Lien YouTube invalide.");
            }
        }


        // Création du dossier du bien
        $uniqueId = uniqid();
        $bienDirName = 'bien_' . $uniqueId;
        $bienDir = UPLOAD_DIR . $bienDirName . '/';

        if (!is_dir($bienDir)) {
            mkdir($bienDir, 0755, true);
        }

        $mainImage = null;
        $imagePaths = [];

        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            if (!is_uploaded_file($tmpName)) {
                continue;
            }

            $fileType = mime_content_type($tmpName);
            if (!in_array($fileType, ALLOWED_IMAGE_TYPES)) {
                continue; // Fichier non autorisé
            }

            $extension = pathinfo($_FILES['images']['name'][$key], PATHINFO_EXTENSION);
            $filename = 'img_' . uniqid() . '.' . $extension;
            $targetPath = $bienDir . $filename;

            if (move_uploaded_file($tmpName, $targetPath)) {
                $imagePaths[] = $filename;
                if ($mainImage === null) {
                    $mainImage = $filename; // Première image = image principale
                }
            }
        }

        define('ALLOWED_VIDEO_TYPES', ['video/mp4', 'video/webm']);
        define('MAX_VIDEO_SIZE', 200 * 1024 * 1024); // 200MB

        $videoPath = null;

        if (empty($imagePaths)) {
            throw new Exception("Aucune image valide n'a été uploadée.");
        }

        //Sécurité vidéo youtube
        $youtubeId = null;

        if (!empty($_POST['youtube_url'])) {
            $youtubeId = extractYoutubeId($_POST['youtube_url']);

            if ($youtubeId === null) {
                throw new Exception("Lien YouTube invalide.");
            }
        }


        $pdo->beginTransaction();

        $videoPath = null;

        if (!empty($_POST['video_path'])) {
            $videoPath = filter_var($_POST['video_path'], FILTER_SANITIZE_URL);
        }
        $nature = $_POST['nature'] ?? 'vente';
        try {
            $stmt = $pdo->prepare("INSERT INTO biens 
                (titre, ville, arrondissement, surface, pieces, chambres, sdb, prix, description, statut, type, nature, image, video_path, visite_virtuelle_url) 
                VALUES 
                (:titre, :ville, :arrondissement, :surface, :pieces, :chambres, :sdb, :prix, :description, :statut, :type, :nature, :image, :youtube_id, :visite_url)");

            $stmt->execute([
                ':titre' => htmlspecialchars($_POST['titre']),
                ':ville' => htmlspecialchars($_POST['ville']),
                ':arrondissement' => !empty($_POST['arrondissement']) ? htmlspecialchars($_POST['arrondissement']) : null,
                ':surface' => (int) $_POST['surface'],
                ':pieces' => (int) $_POST['pieces'],
                ':chambres' => (int) $_POST['chambres'],
                ':sdb' => (int) $_POST['sdb'],
                ':prix' => (float) $_POST['prix'],
                ':description' => htmlspecialchars($_POST['description']),
                ':statut' => $_POST['statut'],
                ':type' => $_POST['type'],
                ':nature' => $_POST['nature'],
                ':image' => $bienDirName . '/' . $mainImage,
                ':youtube_id' => $youtubeId,
                ':visite_url' => !empty($_POST['visite_virtuelle_url']) ? filter_var($_POST['visite_virtuelle_url'], FILTER_SANITIZE_URL) : null
            ]);

            $bienId = $pdo->lastInsertId();

            $imgStmt = $pdo->prepare("INSERT INTO biens_images (bien_id, image_path) VALUES (?, ?)");
            foreach (array_slice($imagePaths, 1) as $image) {
                $relativePath = $bienDirName . '/' . $image; // ex: bien_abc123/img_xyz.jpg
                $imgStmt->execute([$bienId, $relativePath]);
            }


            $pdo->commit();
            $_SESSION['success'] = "Le bien a été ajouté avec succès !";
            header('Location: dashboard.php');
            exit;
        } catch (Exception $e) {
            $pdo->rollBack();
            foreach (glob($bienDir . "*") as $file) {
                unlink($file);
            }
            rmdir($bienDir);
            throw $e;
        }
        $nature = in_array($_POST['nature'], ['vente', 'location'])
            ? $_POST['nature']
            : 'vente';
    } catch (Exception $e) {
        $_SESSION['erreur'] = $e->getMessage();
        header('Location: ajouter_bien.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un bien immobilier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .container-form {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .erreur {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .btn-ajouter {
            background-color: #28a745;
            color: white;
        }

        .btn-ajouter:hover {
            background-color: #218838;
        }

        .btn-annuler {
            background-color: #6c757d;
            color: white;
        }

        .btn-annuler:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body style="background: url();">
    <div class="container">
        <h1>Ajouter un bien immobilier</h1>

        <!-- Affichage des messages -->
        <?php if (isset($_SESSION['erreur'])) : ?>
            <div class="message erreur">
                <?php echo htmlspecialchars($_SESSION['erreur']); ?>
                <?php unset($_SESSION['erreur']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])) : ?>
            <div class="message success">
                <?php echo htmlspecialchars($_SESSION['success']); ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <div class="container-form">
            <form method="POST" action="ajouter_bien.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="titre" class="form-label">Titre*</label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ville" class="form-label">Ville*</label>
                        <input type="text" class="form-control" id="ville" name="ville" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="arrondissement" class="form-label">Arrondissement</label>
                        <input type="text" class="form-control" id="arrondissement" name="arrondissement">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="surface" class="form-label">Surface (m²)*</label>
                        <input type="number" class="form-control" id="surface" name="surface" required min="1">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pieces" class="form-label">Pièces*</label>
                        <input type="number" class="form-control" id="pieces" name="pieces" required min="1">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="chambres" class="form-label">Chambres*</label>
                        <input type="number" class="form-control" id="chambres" name="chambres" required min="0">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sdb" class="form-label">Salles de bain*</label>
                        <input type="number" class="form-control" id="sdb" name="sdb" required min="0">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="prix" class="form-label">Prix (€)*</label>
                        <input type="number" class="form-control" id="prix" name="prix" required min="0" step="0.01">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="statut" class="form-label">Statut*</label>
                        <select class="form-select" id="statut" name="statut" required>
                            <option value="normal">Normal</option>
                            <option value="nouveau">Nouveau</option>
                            <option value="coup_de_coeur">Coup de cœur</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Type*</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="appartements">Appartements</option>
                            <option value="maisons">Maisons</option>
                            <option value="terrains">Terrains</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="nature" class="form-label">Nature du bien*</label>
                        <select class="form-select" id="nature" name="nature" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="vente">À vendre</option>
                            <option value="location">À louer</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Description du bien*</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Décrivez en quelques lignes le bien immobilier" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label">Images*</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*" required>
                    <small class="text-muted">Formats acceptés: JPEG, PNG</small>
                </div>

                <div class="mb-3">
                    <label for="youtube_url" class="form-label">Vidéo YouTube du bien</label>
                    <input
                        type="url"
                        class="form-control"
                        id="youtube_url"
                        name="youtube_url"
                        placeholder="https://www.youtube.com/watch?v=ABC123">

                    <small class="text-muted">
                        Collez un lien YouTube (watch, youtu.be, embed)
                    </small>
                </div>

                <div id="youtubePreview" class="video-container" style="display:none;">
                    <iframe id="youtubeIframe" allowfullscreen></iframe>
                </div>


                <div class="mb-3">
                    <label for="visite_virtuelle_url" class="form-label">Visite Virtuelle (URL)</label>
                    <input type="url" class="form-control" id="visite_virtuelle_url" name="visite_virtuelle_url" placeholder="https://...">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="dashboard.php" class="btn btn-annuler">Annuler</a>
                    <button type="submit" class="btn btn-ajouter">Ajouter le bien</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function extractYoutubeId(url) {
            if (!url) return null;

            const patterns = [
                /youtu\.be\/([^\?&]+)/,
                /v=([^\?&]+)/,
                /embed\/([^\?&]+)/
            ];

            for (const pattern of patterns) {
                const match = url.match(pattern);
                if (match && match[1]) {
                    return match[1];
                }
            }
            return null;
        }

        const input = document.getElementById('youtube_url');
        const preview = document.getElementById('youtubePreview');
        const iframe = document.getElementById('youtubeIframe');

        input.addEventListener('input', () => {
            const youtubeId = extractYoutubeId(input.value);

            if (youtubeId) {
                iframe.src = `https://www.youtube.com/embed/${youtubeId}`;
                preview.style.display = 'block';
            } else {
                iframe.src = '';
                preview.style.display = 'none';
            }
        });
    </script>

</body>

</html>