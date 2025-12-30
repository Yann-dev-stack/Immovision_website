<?php
require_once __DIR__ . '/../back/config/database.php';

try {
    $stmt = $pdo->query("SELECT * FROM biens ORDER BY id DESC LIMIT 3");
    $biens = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des biens : " . $e->getMessage());
}

define('UPLOAD_PATH', '../uploads/biens/');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImmoVision - Visites Immobilières Virtuelles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        #accueil {
            padding-left: 10rem;
            padding-right: 10rem;
        }

        #pourquoi {
            padding-left: 8rem;
            padding-right: 8rem;
        }

        #nos-biens {
            padding-left: 8rem;
            padding-right: 8rem;
        }

        #visites {
            padding-left: 5rem;
            padding-right: 5rem;
        }

        #how-it-marche {
            padding-left: 5rem;
            padding-right: 5rem;
        }

        #testimonials {
            padding-left: 5rem;
            padding-right: 5rem;
        }

        #agences {
            padding-left: 5rem;
            padding-right: 5rem;
        }

        #bg-four {
            background-color: black;
        }

        #bg-four:hover {
            background-color: #3e2800ff;
        }

        body {
            padding: 0;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1473&q=80');
            background-size: cover;
            background-position: center;
            height: 90vh;
        }

        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .virtual-tour-container {
            height: 500px;
            background-color: #eee;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            color: #FFA500 !important;
        }

        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: scale(1.03);
        }

        .contact-input:focus {
            outline: none;
            border-color: #FFA500;
        }

        .footer-link:hover {
            color: #FFA500 !important;
        }

        /* Animation for virtual tour button */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        .see-more {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
        }

        /* ===========================
   RESPONSIVE GLOBAL
=========================== */

        /* Tablette */
        @media (max-width: 1024px) {

            #accueil,
            #pourquoi,
            #nos-biens,
            #visites,
            #how-it-marche,
            #testimonials,
            #agences {
                padding-left: 3rem;
                padding-right: 3rem;
            }

            .hero-section {
                height: 70vh;
            }
        }

        /* Mobile */
        @media (max-width: 640px) {

            #accueil,
            #pourquoi,
            #nos-biens,
            #visites,
            #how-it-marche,
            #testimonials,
            #agences {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }

            .hero-section {
                height: auto;
                padding-top: 4rem;
                padding-bottom: 4rem;
            }

            h1 {
                font-size: 2.2rem !important;
                line-height: 1.2;
            }

            h2 {
                font-size: 1.8rem !important;
            }

            .virtual-tour-container {
                height: 300px;
            }

            .see-more {
                margin-top: 3rem;
            }

            #vv h3 {
                font-size: 10px;
            }
        }

        /* =========================
   TABLETTE (≤1024px)
   ========================= */
        @media (max-width: 1024px) {

            #visites {
                padding-top: 4rem;
                padding-bottom: 4rem;
            }

            #visites h2 {
                font-size: 2.5rem;
            }

            #visites p {
                font-size: 1.05rem;
            }

            /* Conteneur visite virtuelle */
            .virtual-tour-container {
                height: 380px;
            }

            #vv h3 {
                font-size: 2.2rem !important;
            }

            #vv p {
                font-size: 1rem !important;
            }

            /* Cartes avantages */
            #visites .grid {
                gap: 1.5rem;
            }
        }


        /* =========================
   MOBILE (≤640px)
   ========================= */
        @media (max-width: 640px) {

            #visites {
                padding-top: 3rem;
                padding-bottom: 3rem;
            }

            /* Titres */
            #visites h2 {
                font-size: 2rem;
                line-height: 1.25;
            }

            #visites p {
                font-size: 0.95rem;
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            /* Conteneur 360° */
            .virtual-tour-container {
                height: 260px;
                margin-bottom: 2rem;
            }

            #vv i {
                font-size: 3rem;
                margin-bottom: 1rem;
            }

            #vv h3 {
                font-size: 1.4rem !important;
                line-height: 1.3;
            }

            #vv p {
                font-size: 0.85rem !important;
                margin-top: 0.5rem;
            }

            #vv button {
                padding: 0.7rem 1.5rem;
                font-size: 0.95rem;
                width: 100%;
                max-width: 240px;
                margin: 1.2rem auto 0;
                display: block;
            }

            /* Grille avantages */
            #visites .grid {
                gap: 1.2rem;
                margin-top: 2rem;
            }

            #visites .grid>div {
                padding: 1.4rem;
                text-align: center;
            }

            #visites .grid i {
                font-size: 2.2rem;
            }

            #visites .grid h3 {
                font-size: 1.1rem;
            }

            #visites .grid p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body class="font-sans bg-gray-50">

    <?php include 'header.html'; ?>

    <!-- Hero Section (Accueil) -->
    <section id="accueil" class="hero-section flex items-center justify-center text-center text-white">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Découvrez votre futur chez-vous <span
                    class="text-primary">sans vous déplacer</span></h1>
            <p class="text-xl md:text-2xl mb-8">Visites virtuelles 360°, expertises détaillées et accompagnement
                personnalisé pour votre recherche immobilière.</p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="#nos-biens"
                    class="bg-primary hover:bg-secondary text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">Explorer
                    nos biens</a>
                <a href="#visites"
                    class="bg-transparent border-2 border-white hover:border-primary text-white hover:text-primary font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">Essayer
                    une visite virtuelle</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white" id="pourquoi">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-dark mb-16">Pourquoi choisir <span
                    class="text-primary">ImmoVision</span> ?</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="text-center px-6">
                    <div
                        class="bg-primary bg-opacity-10 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-vr-cardboard text-primary text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">Visites Immersives 360°</h3>
                    <p class="text-gray-600">Explorez chaque recoin de votre futur logement comme si vous y étiez, avec
                        nos technologies de réalité virtuelle avancées.</p>
                </div>

                <div class="text-center px-6">
                    <div
                        class="bg-primary bg-opacity-10 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-clock text-primary text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">Gain de Temps</h3>
                    <p class="text-gray-600">Éliminez les déplacements inutiles et visitez plusieurs biens en quelques
                        minutes depuis votre canapé.</p>
                </div>

                <div class="text-center px-6">
                    <div
                        class="bg-primary bg-opacity-10 w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-user-tie text-primary text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">Experts Disponibles</h3>
                    <p class="text-gray-600">Nos conseillers sont disponibles en visioconférence pour répondre à toutes
                        vos questions pendant votre visite virtuelle.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Property Listings (Nos Biens) -->
    <section class="py-12 bg-gray-100" id="nos-biens">
        <div class="container mx-auto px-6">
            <?php if (empty($biens)): ?>
                <div class="text-center py-12">
                    <i class="fas fa-home text-5xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-700">Aucun bien disponible actuellement</h3>
                    <p class="text-gray-500 mt-2">Nos équipes sont en train d'ajouter de nouvelles propriétés.</p>
                </div>
            <?php else: ?>
                <div id="biensContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-items-center">
                    <?php foreach ($biens as $bien): ?>
                        <?php
                        $images = !empty($bien['image']) ? explode(',', $bien['image']) : [];
                        $firstImagePath = !empty($images) ? trim($images[0]) : '';
                        $fullImagePath = UPLOAD_PATH . $firstImagePath;

                        $imageExists = !empty($firstImagePath) && file_exists($fullImagePath);
                        ?>

                        <div class="bien-card max-w-sm w-full bg-white rounded-xl overflow-hidden shadow-md transform transition hover:scale-105"
                            data-titre="<?= strtolower(htmlspecialchars($bien['titre'])) ?>"
                            data-ville="<?= strtolower(htmlspecialchars($bien['ville'])) ?>"
                            data-type="<?= htmlspecialchars($bien['type']) ?>"
                            data-prix="<?= $bien['prix'] ?>">

                            <?php if ($imageExists): ?>
                                <img src="<?= $fullImagePath ?>" alt="<?= htmlspecialchars($bien['titre']) ?>" class="w-full h-48 object-cover">
                            <?php else: ?>
                                <div class="w-full h-48 img-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            <?php endif; ?>

                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2"><?= htmlspecialchars($bien['titre']) ?></h3>
                                <p class="text-gray-600">
                                    <?= htmlspecialchars($bien['ville']) ?> -
                                    <?= htmlspecialchars($bien['surface']) ?>m² -
                                    <?= htmlspecialchars($bien['pieces']) ?> pièces
                                </p>
                                <div class="flex justify-between items-center mt-4">
                                    <span class="text-primary font-semibold">
                                        <?= number_format($bien['prix'], 0, ',', ' ') ?>€
                                    </span>
                                    <a href="details.php?id=<?= $bien['id'] ?>"
                                        class="text-white bg-primary hover:bg-secondary px-4 py-2 rounded-full transition">
                                        Détails
                                    </a>
                                </div>
                                <?php if (!empty($bien['visite_virtuelle_url'])): ?>
                                    <a href="<?= htmlspecialchars($bien['visite_virtuelle_url']) ?>" target="_blank"
                                        class="block mt-3 text-primary text-sm hover:underline">
                                        <i class="fas fa-vr-cardboard mr-1"></i> Visite Virtuelle
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="see-more">
                <a href="biens.php" class="bg-primary hover:bg-secondary text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">Voir plus</a>
            </div>
        </div>
    </section>

    <!-- Virtual Tour Demo (Visites Virtuelles) -->
    <section id="visites" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-dark mb-4">Expérience de <span
                    class="text-primary">Visite Virtuelle</span></h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Découvrez la puissance de nos visites
                immersives avec cette démonstration interactive.</p>

            <div class="virtual-tour-container rounded-xl shadow-xl mb-8">
                <!-- Placeholder for 360° virtual tour - in a real implementation you would use a library like Pannellum or Marzipano -->
                <div class="absolute inset-0 flex items-center justify-center" style="background-color:black">
                    <div class="text-center" id="vv">
                        <i class="fas fa-vr-cardboard text-6xl text-gray-400 mb-4"></i>
                        <h3 class="text-2xl font-bold text-gray-600" style="color: white; font-size:3rem">Visite Virtuelle 360° Interactive</h3>
                        <p class="text-gray-500 mt-2" style="color: #000000ff;">Tournez, zoomez et explorez comme si vous y étiez</p>
                        <button
                            class="mt-6 bg-primary hover:bg-secondary text-white font-bold py-3 px-8 rounded-full transition pulse-animation">
                            <i class="fas fa-play mr-2"></i> Lancer la démo
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div class="bg-gray-50 p-6 rounded-xl">
                    <div class="text-primary text-3xl mb-4">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">Accessible Partout</h3>
                    <p class="text-gray-600">Nos visites virtuelles sont optimisées pour tous vos appareils :
                        smartphone, tablette ou ordinateur.</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl">
                    <div class="text-primary text-3xl mb-4">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">Guidage Expert</h3>
                    <p class="text-gray-600">Un conseiller peut vous accompagner en direct pendant votre visite pour
                        répondre à toutes vos questions.</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl">
                    <div class="text-primary text-3xl mb-4">
                        <i class="fas fa-ruler-combined"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">Mesures Précises</h3>
                    <p class="text-gray-600">Obtenez des mesures exactes des pièces directement depuis la visite
                        virtuelle.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-16 bg-primary bg-opacity-10" id="how-it-marche">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-dark mb-16">Comment <span class="text-primary">ça
                    marche</span> ?</h2>

            <div class="flex flex-col md:flex-row items-center justify-between mb-12">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-10">
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <div class="flex items-center mb-4">
                            <div
                                class="bg-primary text-white rounded-full w-10 h-10 flex items-center justify-center mr-4 font-bold">
                                1</div>
                            <h3 class="text-xl font-bold text-dark">Trouvez votre bien</h3>
                        </div>
                        <p class="text-gray-600">Parcourez notre catalogue de biens immobiliers avec photos,
                            descriptions détaillées et localisation précise.</p>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                        alt="Recherche immobilière" class="rounded-xl shadow-md w-full">
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between mb-12">
                <div class="md:w-1/2 order-2 md:order-1 mt-8 md:mt-0">
                    <img src="https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1528&q=80"
                        alt="Visite virtuelle" class="rounded-xl shadow-md w-full">
                </div>
                <div class="md:w-1/2 order-1 md:order-2 mb-8 md:mb-0 md:pl-10">
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <div class="flex items-center mb-4">
                            <div
                                class="bg-primary text-white rounded-full w-10 h-10 flex items-center justify-center mr-4 font-bold">
                                2</div>
                            <h3 class="text-xl font-bold text-dark">Lancez la visite virtuelle</h3>
                        </div>
                        <p class="text-gray-600">Explorez le bien en 360° comme si vous y étiez, avec la possibilité de
                            zoomer sur les détails et de vous déplacer entre les pièces.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-10">
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <div class="flex items-center mb-4">
                            <div
                                class="bg-primary text-white rounded-full w-10 h-10 flex items-center justify-center mr-4 font-bold">
                                3</div>
                            <h3 class="text-xl font-bold text-dark">Prenez rendez-vous</h3>
                        </div>
                        <p class="text-gray-600">Si le bien vous plaît, planifiez une visite physique ou une
                            visioconférence avec un conseiller pour aller plus loin.</p>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                        alt="Rendez-vous" class="rounded-xl shadow-md w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-white" id="testimonials">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-dark mb-4">Ils ont trouvé leur bien avec <span
                    class="text-primary">ImmoVision</span></h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Découvrez les témoignages de nos clients
                satisfaits par notre approche innovante.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="testimonial-card bg-gray-50 p-8 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="flex items-center mb-6">
                        <img src="https://cdn.creazilla.com/icons/7914927/man-icon-md.png" alt="Client"
                            class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-dark">Samson Martin</h4>
                            <p class="text-gray-500">Acheté un appartement à Cotonou</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6">"Grâce aux visites virtuelles, j'ai pu visiter 10 appartements
                        en une soirée depuis mon canapé. J'ai économisé des semaines de déplacements !"</p>
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <div class="testimonial-card bg-gray-50 p-8 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="flex items-center mb-6">
                        <img src="https://cdn-icons-png.flaticon.com/512/201/201634.png" alt="Client"
                            class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-dark">Mathilda DADA</h4>
                            <p class="text-gray-500">Acheté une maison à Calavi</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6">"La visite virtuelle m'a permis de voir des détails que je
                        n'aurais pas remarqué lors d'une visite classique. Le conseiller en ligne était très
                        professionnel."</p>
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>

                <div class="testimonial-card bg-gray-50 p-8 rounded-xl shadow-sm hover:shadow-md transition">
                    <div class="flex items-center mb-6">
                        <img src="https://cdn-icons-png.flaticon.com/512/146/146037.png" alt="Client"
                            class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-dark">Camille Dubois</h4>
                            <p class="text-gray-500">Acheté un loft à Parakou</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6">"Je cherchais depuis des mois sans trouver. Avec ImmoVision,
                        j'ai découvert mon futur loft en une semaine. La technologie 360° est révolutionnaire !"</p>
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Agencies (Nos Agences) -->
    <section id="agences" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-dark mb-16">Nos <span
                    class="text-primary">Agences</span></h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl overflow-hidden shadow-md">
                    <img src="https://images.unsplash.com/photo-1560520031-3a4dc4e9de0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                        alt="Agence Paris" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-dark mb-2">ImmoVision Cotonou</h3>
                        <p class="text-gray-600 mb-4"><i class="fas fa-map-marker-alt text-primary mr-2"></i> 12 Rue de
                            la Paix, 75002 Cotonou</p>
                        <p class="text-gray-600 mb-4"><i class="fas fa-phone text-primary mr-2"></i> 01 23 45 67 89</p>
                        <p class="text-gray-600 mb-4"><i class="fas fa-envelope text-primary mr-2"></i>
                            cotonou@immovision.com</p>
                        <button
                            class="w-full bg-primary hover:bg-secondary text-white py-2 rounded-full transition">Contacter
                            cette agence</button>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden shadow-md">
                    <img src="https://www.stradim.fr/sites/stradim.fr/files/styles/slideshow/public/cle_maison_3.jpg?itok=RJdg7Dg0"
                        alt="Agence Lyon" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-dark mb-2">ImmoVision Calavi</h3>
                        <p class="text-gray-600 mb-4"><i class="fas fa-map-marker-alt text-primary mr-2"></i> 24 Rue de
                            la République, 69002 Calavi</p>
                        <p class="text-gray-600 mb-4"><i class="fas fa-phone text-primary mr-2"></i> 04 23 45 67 89</p>
                        <p class="text-gray-600 mb-4"><i class="fas fa-envelope text-primary mr-2"></i>
                            calavi@immovision.com</p>
                        <button
                            class="w-full bg-primary hover:bg-secondary text-white py-2 rounded-full transition">Contacter
                            cette agence</button>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden shadow-md">
                    <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                        alt="Agence Bordeaux" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-dark mb-2">ImmoVision Parakou</h3>
                        <p class="text-gray-600 mb-4"><i class="fas fa-map-marker-alt text-primary mr-2"></i> 8 Cours de
                            l'Intendance, 33000 Parakou</p>
                        <p class="text-gray-600 mb-4"><i class="fas fa-phone text-primary mr-2"></i> 05 23 45 67 89</p>
                        <p class="text-gray-600 mb-4"><i class="fas fa-envelope text-primary mr-2"></i>
                            parakou@immovision.com</p>
                        <button
                            class="w-full bg-primary hover:bg-secondary text-white py-2 rounded-full transition">Contacter
                            cette agence</button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button
                    class="bg-white hover:bg-gray-100 text-dark border-2 border-gray-200 font-bold py-3 px-8 rounded-full transition"> <a href="agence.php">Voir
                        toutes nos agences</a></button>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section id="contact" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto bg-gray-50 rounded-xl shadow-md overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2 bg-primary p-10 text-white">
                        <h2 class="text-3xl font-bold mb-6">Contactez-nous</h2>
                        <p class="mb-8">Vous avez des questions sur un bien ou sur nos services ? Notre équipe est à
                            votre disposition pour vous accompagner.</p>

                        <div class="mb-6 flex items-start">
                            <div>
                                <button
                                    class="mt-6 hover:bg-secondary text-white font-bold py-3 px-8 rounded-full transition pulse-animation" id="bg-four">
                                    <i class="fas fa-phone-alt mt-1 mr-4"></i> Entrez en contact
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Localisation -->
                    <div class="property-container p-4 mb-4">
                        <h3 class="h5 mb-3"><i class="fas fa-map-marked-alt text-primary me-2"></i>Notre localisation</h3>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3629.677699205508!2d2.3689831745379806!3d6.357675325069091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023568879c4a29d%3A0xae82ab1adae076ea!2sAgence%20immobili%C3%A8re%20BENIN-IMMO!5e1!3m2!1sfr!2sbj!4v1747412536444!5m2!1sfr!2sbj" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.html'; ?>


    <!-- Fenêtre surgissante (modale) -->
    <div id="videoModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl shadow-xl overflow-hidden w-full max-w-3xl relative">
            <!-- Bouton de fermeture -->
            <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-2xl">&times;</button>

            <!-- Vidéo démo -->
            <div class="aspect-w-16 aspect-h-9">
                <video id="demoVideo" class="w-full h-96" controls>
                    <source src="../videos/demo.mp4" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture vidéo.
                </video>
            </div>
        </div>
    </div>
    <script>
        // Sélection des éléments
        const openModalBtn = document.querySelector(".pulse-animation");
        const modal = document.getElementById("videoModal");
        const closeModalBtn = document.getElementById("closeModal");

        // Ouvrir la modale
        openModalBtn.addEventListener("click", () => {
            modal.classList.remove("hidden");
        });

        // Fermer la modale
        closeModalBtn.addEventListener("click", () => {
            modal.classList.add("hidden");
            const video = document.getElementById("demoVideo");
            video.pause();
            video.currentTime = 0;
        });

        // Fermer si clic en dehors
        window.addEventListener("click", (e) => {
            if (e.target === modal) {
                modal.classList.add("hidden");
                const video = document.getElementById("demoVideo");
                video.pause();
                video.currentTime = 0;
            }
        });
    </script>

</body>

</html>