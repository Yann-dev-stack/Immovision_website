<?php
// Inclure la configuration de la base de données
require_once __DIR__ . '/../back/config/database.php';

// Vérification de session (à décommenter et adapter)
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Requête SQL pour récupérer tous les biens
$query = "SELECT * FROM biens";
$stmt = $pdo->query($query);
$biens = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si un bien est sélectionné pour modification
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $query = "SELECT * FROM biens WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $edit_id, PDO::PARAM_INT);
    $stmt->execute();
    $bienToEdit = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Mapping des types pour l'affichage
$typeMapping = [
    'appartements' => 'Appartement',
    'appartement' => 'Appartement', // Ajouté
    'maisons' => 'Maison',
    'maison' => 'Maison', // Ajouté
    'terrains' => 'Terrain',
    'terrain' => 'Terrain', // Ajouté
    'luxe' => 'Luxe' // Ajouté au cas où
];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Biens Immobilier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #nav {
            padding-left: 7rem;
            padding-right: 7rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .img-thumbnail {
            max-width: 100px;
            height: auto;
        }

        button a {
            text-decoration: none;
            color: white;
        }

        .images-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .image-box {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        }

        .image-box img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .delete-image {
            position: absolute;
            top: 6px;
            right: 6px;
            background: rgba(0, 0, 0, .7);
            color: #fff;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            text-align: center;
            line-height: 22px;
            cursor: pointer;
            font-size: 16px;
        }

        .badge-main {
            position: absolute;
            bottom: 6px;
            left: 6px;
            background: orange;
            color: #000;
            padding: 2px 6px;
            font-size: 11px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" id="nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Immovision Admin</a>
            <div class="navbar-nav">
                <a class="nav-link text-white" href="logout.php">Déconnexion</a>
            </div>
        </div>
    </nav>

    <!-- Section principale -->
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col">
                <h1>Gestion des Biens</h1>
            </div>
            <div class="col text-end">
                <button type="button" class="btn btn-success" data-bs-toggle="modal">
                    <a href="ajouter_bien.php">Ajouter un bien</a>
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Ville</th>
                        <th>Prix</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($biens as $bien): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($bien['id']); ?></td>
                            <td><?php echo htmlspecialchars($bien['titre']); ?></td>
                            <td><?php echo htmlspecialchars($bien['ville']); ?></td>
                            <td><?php echo number_format(htmlspecialchars($bien['prix']), 0, ',', ' ') . '€'; ?></td>
                            <td>
                                <?php
                                $typeDisplay = 'N/A';
                                if (!empty($bien['type'])) {
                                    $typeDisplay = $typeMapping[strtolower($bien['type'])] ?? $bien['type'];
                                }
                                echo htmlspecialchars($typeDisplay);
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($bien['statut'] ?? 'N/A'); ?></td>
                            <td>
                                <a href="?edit_id=<?php echo $bien['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="supprimer_bien.php?id=<?php echo $bien['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bien ? Cette action est irréversible.');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal pour Modifier un Bien -->
        <?php if (isset($bienToEdit)): ?>
            <div class="modal fade" id="modifierBien" tabindex="-1" aria-labelledby="modifierBienLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifierBienLabel">Modifier le Bien</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php
                            $stmtImg = $pdo->prepare("
                            SELECT id, image_path, is_main
                            FROM biens_images
                            WHERE bien_id = ?
                            ");
                            $stmtImg->execute([$bien['id']]);
                            $imagesBien = $stmtImg->fetchAll(PDO::FETCH_ASSOC);

                            ?>
                            <form action="modifier_bien.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($bienToEdit['id']); ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="titre" class="form-label">Titre*</label>
                                            <input type="text" class="form-control" id="titre" name="titre" value="<?php echo htmlspecialchars($bienToEdit['titre']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ville" class="form-label">Ville*</label>
                                            <input type="text" class="form-control" id="ville" name="ville" value="<?php echo htmlspecialchars($bienToEdit['ville']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="arrondissement" class="form-label">Arrondissement</label>
                                            <input type="text" class="form-control" id="arrondissement" name="arrondissement" value="<?php echo htmlspecialchars($bienToEdit['arrondissement'] ?? ''); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="surface" class="form-label">Surface (m²)*</label>
                                            <input type="number" class="form-control" id="surface" name="surface" value="<?php echo htmlspecialchars($bienToEdit['surface']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="prix" class="form-label">Prix (€)*</label>
                                            <input type="number" class="form-control" id="prix" name="prix" value="<?php echo htmlspecialchars($bienToEdit['prix']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pieces" class="form-label">Pièces*</label>
                                            <input type="number" class="form-control" id="pieces" name="pieces" value="<?php echo htmlspecialchars($bienToEdit['pieces']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="statut" class="form-label">Statut*</label>
                                            <select class="form-control" id="statut" name="statut" required>
                                                <option value="normal" <?php echo ($bienToEdit['statut'] ?? '') === 'normal' ? 'selected' : ''; ?>>Normal</option>
                                                <option value="nouveau" <?php echo ($bienToEdit['statut'] ?? '') === 'nouveau' ? 'selected' : ''; ?>>Nouveau</option>
                                                <option value="coup_de_coeur" <?php echo ($bienToEdit['statut'] ?? '') === 'coup_de_coeur' ? 'selected' : ''; ?>>Coup de cœur</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="type" class="form-label">Type*</label>
                                            <select class="form-control" id="type" name="type" required>
                                                <option value="appartements" <?php echo ($bienToEdit['type'] ?? '') === 'appartements' ? 'selected' : ''; ?>>Appartement</option>
                                                <option value="maisons" <?php echo ($bienToEdit['type'] ?? '') === 'maisons' ? 'selected' : ''; ?>>Maison</option>
                                                <option value="terrains" <?php echo ($bienToEdit['type'] ?? '') === 'terrains' ? 'selected' : ''; ?>>Terrain</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Image principale du bien</label>

                                    <!-- Upload nouvelle image -->
                                    <input type="file" class="form-control" id="image" name="image">

                                    <!-- On conserve l'image actuelle si aucune nouvelle image -->
                                    <div class="images-preview">
                                        <?php foreach ($imagesBien as $img): ?>
                                            <div class="image-box" data-id="<?= $img['id'] ?>">

                                                <span class="delete-image">&times;</span>

                                                <img src="../<?= htmlspecialchars($img['image_path']) ?>" alt="Image du bien">

                                                <?php if ($img['is_main']): ?>
                                                    <span class="badge-main">Principale</span>
                                                <?php endif; ?>

                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                </div>


                                <div class="mb-3">
                                    <label for="visite_virtuelle_url" class="form-label">Visite Virtuelle (URL)</label>
                                    <input type="url" class="form-control" id="visite_virtuelle_url" name="visite_virtuelle_url" value="<?php echo htmlspecialchars($bienToEdit['visite_virtuelle_url'] ?? ''); ?>">
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Ouvrir la modal de modification si besoin
            <?php if (isset($bienToEdit)): ?>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = new bootstrap.Modal(document.getElementById('modifierBien'));
                    modal.show();

                    // Fermer la modal quand on clique sur le bouton close
                    document.querySelector('#modifierBien .btn-close').addEventListener('click', function() {
                        window.location.href = window.location.pathname;
                    });
                });
            <?php endif; ?>
        </script>
        <script>
            document.querySelectorAll('.delete-image').forEach(btn => {
                btn.addEventListener('click', function() {

                    if (!confirm('Supprimer cette image ?')) return;

                    const box = this.closest('.image-box');
                    const id = box.dataset.id;

                    fetch('supprimer_image.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'id=' + id
                        })
                        .then(r => r.json())
                        .then(res => {
                            if (res.success) {
                                box.remove();
                            }
                        });
                });
            });
        </script>
        <script>
            function supprimerImage(imageId, btn) {
                if (!confirm("Supprimer cette image ?")) return;

                fetch('supprimer_image.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'image_id=' + imageId
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            btn.closest('div').remove(); // retire le thumbnail
                        } else {
                            alert("Erreur lors de la suppression");
                        }
                    });
            }
        </script>


</body>

</html>