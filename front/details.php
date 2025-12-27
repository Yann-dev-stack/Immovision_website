<?php
require_once __DIR__ . '/../back/config/database.php';

// Récupération de l'ID du bien depuis l'URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Préparation et exécution de la requête
$stmt = $pdo->prepare("SELECT * FROM biens WHERE id = ?");
$stmt->execute([$id]);
$bien = $stmt->fetch(PDO::FETCH_ASSOC);

// Image principale
$images = [];
if (!empty($bien['image'])) {
    $images[] = $bien['image'];
}

// Images supplémentaires depuis la table biens_images
$stmtImages = $pdo->prepare("SELECT image_path FROM biens_images WHERE bien_id = ?");
$stmtImages->execute([$bien['id']]);
$additionalImages = $stmtImages->fetchAll(PDO::FETCH_COLUMN);

if ($additionalImages) {
    $images = array_merge($images, $additionalImages);
}

// Vérification si le bien existe
if (!$bien) {
    header("Location: 404.php");
    exit;
}

$images = [];

if (!empty($bien['image'])) {
    $images[] = $bien['image']; // image principale
}

// récupérer les images supplémentaires depuis biens_images
$stmtImg = $pdo->prepare("SELECT image_path FROM biens_images WHERE bien_id = ?");
$stmtImg->execute([$id]);
$additionalImages = $stmtImg->fetchAll(PDO::FETCH_COLUMN);

if ($additionalImages) {
    $images = array_merge($images, $additionalImages);
}


define('UPLOAD_PATH', '../uploads/biens/');
$images = !empty($bien['image']) ? explode(',', $bien['image']) : [];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($bien['titre']) ?> | ImmoVision</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFA500',
                        secondary: '#FFD700',
                        dark: '#1a1a1a',
                        light: '#f8f8f8'
                    }
                }
            }
        }
    </script>
    <style>
        .text-bloc {
            width: 100%;
            justify-content: center;
            display: flex;
        }

        .text-ini {
            width: 65%;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .text-ini h2 {
            font-family: Arial, sans-serif;
            font-weight: 600;
            text-align: center;
            font-size: 2.5rem;
            color: black;
        }

        .text-ini p {
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            font-size: 1.4rem;
            margin-top: 1.7rem;
            margin-bottom: 2rem;
        }

        /* Container global avec padding horizontal de 8rem */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 8rem;
            padding-right: 8rem;
        }

        /* Hero */
        .property-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1473&q=80');
            background-size: cover;
            background-position: center;
            height: 50vh;
            display: flex;
            align-items: flex-end;
            color: #fff;
            padding-left: 8rem;
            padding-right: 8rem;
        }

        /* Sections principales */
        .property-section {
            margin-bottom: 40px;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        /* Slider d’images */
        .splide__slide img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
        }

        /* Vidéo */
        .video-container {
            max-width: 900px;
            margin: 30px auto;
            padding: 15px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .video-container iframe {
            width: 100%;
            height: 500px;
            border-radius: 10px;
            border: none;
        }

        /* Contact card */
        .contact-card {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        /* Icônes et titres */
        .feature-icon {
            margin-right: 10px;
            color: #FFA500;
        }

        @media (max-width: 1024px) {
            .container {
                padding-left: 3rem;
                padding-right: 3rem;
            }

            .property-hero {
                padding-left: 3rem;
                padding-right: 3rem;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            .property-hero {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            .splide__slide img {
                height: 250px;
            }

            .video-container iframe {
                height: 250px;
            }
        }

        .video-container {
            max-width: 900px;
            margin: 40px auto;
            /* centrage horizontal */
            padding: 15px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .video-container iframe {
            width: 100%;
            height: 500px;
            border-radius: 10px;
            border: none;
        }

        /* Responsive mobile */
        @media (max-width: 768px) {
            .video-container iframe {
                height: 250px;
            }
        }

        .video-container {
            animation: fadeInUp 0.6s ease-in-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

</head>

<body class="bg-gray-50 font-sans">
    <?php include 'header.html'; ?>

    <!-- Hero avec titre et prix -->
    <section class="property-hero flex items-end pb-12">
        <div class="container mx-auto px-6 text-white">
            <div class="flex justify-between items-end">
                <div>
                    <a href="biens.php" class="back-button mb-4">
                        <i class="fas fa-arrow-left mr-2"></i> Retour aux biens
                    </a>
                    <h1 class="text-4xl md:text-5xl font-bold mb-2"><?= htmlspecialchars($bien['titre']) ?></h1>
                    <p class="text-xl">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <?= htmlspecialchars($bien['ville']) ?>, <?= htmlspecialchars($bien['arrondissement']) ?>
                    </p>
                </div>
                <div class="text-right">
                    <span class="property-badge"><?= ucfirst($bien['statut']) ?></span>
                    <p class="text-3xl md:text-4xl font-bold mt-2"><?= number_format($bien['prix'], 0, ',', ' ') ?> FCFA</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Galerie d'images -->
    <section class="py-12">
        <div class="text-bloc">
            <div class="text-ini">
                <h2> <b style="color: #FFA500;">Nos biens</b> en images</h2>
                <p>Ayant un aperçu des différentes aspects de ce bien immobilier sans vous déplacer. Visiter votre bien immobilier et faite votre choix. Nous restons à votre disposition pour vous accompagner dans votre processus </p>
            </div>
        </div>
        <div class="container mx-auto px-6" style="width: 80%;">
            <?php
            // Préparer le tableau d'images
            $images = [];
            if (!empty($bien['image'])) {
                $images[] = $bien['image']; // image principale
            }

            // Récupérer les images supplémentaires depuis biens_images
            $stmtImg = $pdo->prepare("SELECT image_path FROM biens_images WHERE bien_id = ?");
            $stmtImg->execute([$id]);
            $additionalImages = $stmtImg->fetchAll(PDO::FETCH_COLUMN);

            if ($additionalImages) {
                $images = array_merge($images, $additionalImages);
            }
            ?>

            <?php if (!empty($images)): ?>
                <div class="splide mb-6 rounded-xl overflow-hidden shadow-xl">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php foreach ($images as $imageName): ?>
                                <?php
                                $imagePath = UPLOAD_PATH . trim($imageName);
                                if (file_exists($imagePath)):
                                ?>
                                    <li class="splide__slide">
                                        <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($bien['titre']) ?>">
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-gray-100 rounded-xl h-96 flex items-center justify-center">
                    <div class="text-center text-gray-400">
                        <i class="fas fa-image fa-5x mb-4"></i>
                        <p class="text-xl">Aucune photo disponible</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <div class="text-bloc">
        <div class="text-ini">
            <h2> Visitez <b style="color: #FFA500;">nos biens</b> sans vous déplacer</h2>
            <p>Ayant un aperçu des différentes aspects de ce bien immobilier sans vous déplacer. Visiter votre bien immobilier et faite votre choix. Nous restons à votre disposition pour vous accompagner dans votre processus </p>
        </div>
    </div>
    <?php if (!empty($bien['video_path'])): ?>
        <div class="video-container">
            <iframe
                src="https://www.youtube.com/embed/<?= htmlspecialchars($bien['video_path']) ?>"
                allowfullscreen>
            </iframe>
        </div>
    <?php endif; ?>



    <!-- Contenu principal -->
    <section class="pb-12" style=" align-items:center; display:flex; justify-content:center;">
        <div class="container mx-auto px-6" style="width: 80%;">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Colonne gauche -->
                <div class="lg:w-2/3">
                    <!-- Description -->
                    <div class="property-section">
                        <h2 class="text-2xl font-bold mb-4 flex items-center" style="color: #FFA500;">
                            <i class="fas fa-align-left feature-icon mr-3" style="color: #FFA500;"></i>
                            Description
                        </h2>
                        <p class="text-gray-700 leading-relaxed">
                            <?= nl2br(htmlspecialchars($bien['description'] ?? 'Aucune description disponible')) ?>
                        </p>
                    </div>

                    <!-- Caractéristiques -->
                    <div class="property-section">
                        <h2 class="text-2xl font-bold mb-6 flex items-center" style="color: #FFA500;">
                            <i class="fas fa-list-alt feature-icon mr-3" style="color: #FFA500;"></i>
                            Détails du bien
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <i class="fas fa-home feature-icon mr-3" style="color: #FFA500;"></i>
                                    <div>
                                        <p class="text-gray-500">Type</p>
                                        <p class="font-semibold"><?= htmlspecialchars($bien['type']) ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-ruler-combined feature-icon mr-3" style="color: #FFA500;"></i>
                                    <div>
                                        <p class="text-gray-500">Surface</p>
                                        <p class="font-semibold"><?= htmlspecialchars($bien['surface']) ?> m²</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-door-open feature-icon mr-3" style="color: #FFA500;"></i>
                                    <div>
                                        <p class="text-gray-500">Pièces</p>
                                        <p class="font-semibold"><?= htmlspecialchars($bien['pieces']) ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <i class="fas fa-bed feature-icon mr-3" style="color: #FFA500;"></i>
                                    <div>
                                        <p class="text-gray-500">Nombre de chambres</p>
                                        <p class="font-semibold"><?= htmlspecialchars($bien['chambres']) ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-bath feature-icon mr-3" style="color: #FFA500;"></i>
                                    <div>
                                        <p class="text-gray-500">Salles de bain</p>
                                        <p class="font-semibold"><?= htmlspecialchars($bien['sdb']) ?></p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt feature-icon mr-3" style="color: #FFA500;"></i>
                                    <div>
                                        <p class="text-gray-500">Disponibilité</p>
                                        <p class="font-semibold">Immédiate</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($bien['visite_virtuelle_url'])): ?>
                            <a href="<?= htmlspecialchars($bien['visite_virtuelle_url']) ?>"
                                target="_blank"
                                class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-full hover:bg-secondary transition">
                                <i class="fas fa-vr-cardboard mr-2"></i> Visite virtuelle 360°
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Localisation -->
                    <div class="property-section">
                        <h2 class="text-2xl font-bold mb-4 flex items-center">
                            <i class="fas fa-map-marked-alt feature-icon mr-3"></i>
                            Localisation
                        </h2>
                        <div class="rounded-xl overflow-hidden">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3629.677699205508!2d2.3689831745379806!3d6.357675325069091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023568879c4a29d%3A0xae82ab1adae076ea!2sAgence%20immobili%C3%A8re%20BENIN-IMMO!5e1!3m2!1sfr!2sbj!4v1747412536444!5m2!1sfr!2sbj"
                                width="100%"
                                height="450"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                class="rounded-lg">
                            </iframe>
                        </div>
                        <p class="mt-4 text-gray-600">
                            <i class="fas fa-info-circle mr-2 text-primary"></i>
                            Localisation exacte fournie après prise de contact
                        </p>
                    </div>
                </div>

                <!-- Colonne droite (contact) -->
                <div class="lg:w-1/3">
                    <div class="contact-card sticky top-6">
                        <h3 class="text-2xl font-bold mb-4">Ce bien vous intéresse ?</h3>
                        <p class="text-gray-600 mb-6">Contactez notre équipe pour une visite ou plus d'informations sur cette propriété.</p>

                        <div class="space-y-4">
                            <a href="contact.php?id=<?= $id ?>"
                                class="block w-full text-center bg-primary hover:bg-secondary text-white font-semibold py-3 px-4 rounded-lg transition flex items-center justify-center">
                                <i class="fas fa-phone-alt mr-2"></i> Nous contacter
                            </a>

                            <a href="biens.php"
                                class="block w-full text-center border border-primary text-primary hover:bg-primary/10 font-semibold py-3 px-4 rounded-lg transition flex items-center justify-center">
                                <i class="fas fa-search mr-2"></i> Voir d'autres biens
                            </a>
                        </div>

                        <div class="mt-8">
                            <h4 class="font-semibold mb-3">Partager ce bien</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-primary hover:text-white transition">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-green-500 hover:text-white transition">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-blue-400 hover:text-white transition">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-600 hover:text-white transition">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex items-center">
                                <div class="bg-primary/10 p-3 rounded-full mr-4">
                                    <i class="fas fa-headset text-primary text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500">Service client</p>
                                    <p class="font-semibold">+229 XX XX XX XX</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.html'; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const splide = new Splide('.splide', {
                type: 'loop', // bouclage infini
                perPage: <?= count($images) > 1 ? 2 : 1 ?>, // 2 images si plusieurs, 1 sinon
                perMove: 1,
                autoplay: true, // slide automatique
                interval: 4500, // intervalle entre slides en ms
                pauseOnHover: true, // pause si souris dessus
                arrows: <?= count($images) > 1 ? 'true' : 'false' ?>, // flèches seulement si >1 image
                pagination: <?= count($images) > 1 ? 'true' : 'false' ?>, // pagination seulement si >1 image
                gap: '1rem', // espace entre images
                breakpoints: {
                    768: {
                        perPage: 1, // 1 image par page sur mobile
                    }
                }
            });

            splide.mount();
        });
    </script>

</body>

</html>