<?php
require_once __DIR__ . '/../back/config/database.php';

try {
    $stmt = $pdo->query("SELECT * FROM biens");
    $biens = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des biens : " . $e->getMessage());
}

define('UPLOAD_PATH', '../uploads/biens/');

function limiterMots($texte, $limite = 20)
{
    $texte = strip_tags($texte); // sécurité
    $mots = explode(' ', $texte);

    if (count($mots) <= $limite) {
        return $texte;
    }

    return implode(' ', array_slice($mots, 0, $limite)) . '...';
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImmoVision - Nos biens immobiliers</title>
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
        #filtre {
            padding-left: 8rem;
            padding-right: 8rem;
        }

        #liste-biens {
            padding-left: 8rem;
            padding-right: 8rem;
        }

        .filter-btn {
            background-color: grey;
            transition: background-color 0.3s ease;
        }

        .filter-btn.active {
            background-color: var(--primary-color);
            /* ou .bg-primary si Tailwind custom */
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

        /* =========================
   RESPONSIVE TABLETTE
   ========================= */
        @media (max-width: 1024px) {

            /* Sections avec padding trop large */
            #filtre,
            #liste-biens {
                padding-left: 3rem;
                padding-right: 3rem;
            }

            /* Hero */
            .hero-section {
                height: 70vh;
                padding: 2rem;
            }

            .hero-section h1 {
                font-size: 3rem;
            }

            .hero-section p {
                font-size: 1.2rem;
            }

            /* Filtres */
            #filtre .bg-gray-50 {
                padding: 2rem;
            }

            /* Boutons filtres */
            .filter-btn {
                padding: 0.6rem 1.5rem;
                font-size: 0.95rem;
            }

            /* Cards */
            .bien-card {
                max-width: 100%;
            }
        }


        /* =========================
   RESPONSIVE MOBILE
   ========================= */
        @media (max-width: 640px) {

            /* Padding général */
            #filtre,
            #liste-biens {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }

            section.py-12 {
                padding-top: 2.5rem;
                padding-bottom: 2.5rem;
            }

            /* Hero */
            .hero-section {
                height: auto;
                min-height: 80vh;
                padding: 3rem 1.2rem;
            }

            .hero-section h1 {
                font-size: 2.2rem;
                line-height: 1.2;
            }

            .hero-section p {
                font-size: 1rem;
                margin-bottom: 1rem;
            }

            /* Filtres */
            #filtre .grid {
                gap: 1.2rem;
            }

            #filtre input,
            #filtre select {
                padding: 0.7rem 1rem;
                font-size: 0.95rem;
            }

            /* Boutons louer / vendre */
            .filter-btn {
                width: 100%;
                text-align: center;
                padding: 0.7rem;
                font-size: 0.95rem;
            }

            .flex.justify-center.gap-4 {
                flex-direction: column;
                gap: 0.8rem;
            }

            /* Cards */
            .bien-card img {
                height: 200px;
            }

            .bien-card h3 {
                font-size: 1.1rem;
            }

            .bien-card p {
                font-size: 0.9rem;
            }

            /* Prix + bouton */
            .bien-card .flex.justify-between {
                flex-direction: column;
                gap: 0.6rem;
                align-items: flex-start;
            }

            .bien-card a.bg-primary {
                width: 100%;
                text-align: center;
            }

            /* Newsletter */
            section.bg-primary form {
                flex-direction: column;
            }

            section.bg-primary input,
            section.bg-primary button {
                width: 100%;
                border-radius: 9999px;
            }

            section.bg-primary button {
                margin-top: 0.7rem;
            }
        }
    </style>
</head>

<body class="font-sans bg-gray-50">
    <?php include 'header.html'; ?>

    <!-- Hero section -->
    <section class="hero-section flex items-center justify-center text-center text-white">
        <div class="container mx-auto px-6 container-padding">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Nos <span class="text-primary">Biens Exclusifs</span></h1>
            <p class="text-xl md:text-2xl mb-8">Découvrez notre sélection de propriétés avec visites virtuelles 360°</p>
        </div>
    </section>

    <!-- Filtres -->
    <section class="py-12 bg-white" id="filtre">
        <div class="container mx-auto px-6">
            <div class="bg-gray-50 p-6 rounded-xl shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 mb-2">Recherche rapide</label>
                        <input type="text" id="searchInput" placeholder="Rechercher par titre, ville..."
                            class="w-full px-4 py-2 rounded-full border border-gray-300 focus:border-primary focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Type</label>
                        <select id="typeFilter" class="w-full px-4 py-2 rounded-full border border-gray-300 focus:border-primary">
                            <option value="">Tous</option>
                            <option value="appartements">Appartements</option>
                            <option value="maisons">Maisons</option>
                            <option value="terrains">terrains</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Budget maximum (€)</label>
                        <input type="number" id="budgetFilter" placeholder="Ex: 500000"
                            class="w-full px-4 py-2 rounded-full border border-gray-300 focus:border-primary focus:outline-none">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Liste des Biens -->
    <section class="py-12 bg-gray-100" id="liste-biens">
        <div class="container mx-auto px-6">
            <?php if (empty($biens)): ?>
                <div class="text-center py-12">
                    <i class="fas fa-home text-5xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-700">Aucun bien disponible actuellement</h3>
                    <p class="text-gray-500 mt-2">Nos équipes sont en train d'ajouter de nouvelles propriétés.</p>
                </div>
            <?php else: ?>
                <div class="flex justify-center gap-4 mb-8">
                    <button class="filter-btn bg-gray-500 text-white px-6 py-2 rounded-full font-semibold"
                        data-filter="all">
                        Tous
                    </button>
                    <button class="filter-btn bg-gray-600 text-white px-6 py-2 rounded-full font-semibold"
                        data-filter="location">
                        À louer
                    </button>
                    <button class="filter-btn bg-gray-500 text-white px-6 py-2 rounded-full font-semibold"
                        data-filter="vente">
                        À vendre
                    </button>
                </div>

                <div id="biensContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-items-center">
                    <?php foreach ($biens as $bien): ?>
                        <?php
                        $images = !empty($bien['image']) ? explode(',', $bien['image']) : [];
                        $firstImagePath = !empty($images) ? trim($images[0]) : '';
                        $fullImagePath = UPLOAD_PATH . $firstImagePath;

                        $imageExists = !empty($firstImagePath) && file_exists($fullImagePath);
                        ?>

                        <div class="bien-card relative max-w-sm w-full bg-white rounded-xl overflow-hidden shadow-md transform transition hover:scale-105"
                            data-titre="<?= strtolower(htmlspecialchars($bien['titre'])) ?>"
                            data-ville="<?= strtolower(htmlspecialchars($bien['ville'])) ?>"
                            data-type="<?= htmlspecialchars($bien['type']) ?>"
                            data-prix="<?= $bien['prix'] ?>"
                            data-nature="<?= htmlspecialchars($bien['nature'] ?? '') ?>"
                            data-date="<?= htmlspecialchars($bien['created_at'] ?? '') ?>">

                            <?php if (($bien['nature'] ?? '') === 'location'): ?>
                                <span class="absolute top-4 left-4 bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                                    À louer
                                </span>
                            <?php elseif (($bien['nature'] ?? '') === 'vente'): ?>
                                <span class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                                    À vendre
                                </span>
                            <?php endif; ?>

                            <!--Badge nouveau pour un bien immobilier-->
                            <?php
                            $isNew = false;
                            if (!empty($bien['created_at'])) {
                                $dateBien = new DateTime($bien['created_at']);
                                $now = new DateTime();
                                $diff = $now->diff($dateBien)->days;
                                $isNew = $diff <= 7;
                            }
                            ?>

                            <?php if ($isNew): ?>
                                <span class="absolute top-4 right-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow animate-pulse">
                                    Nouveau
                                </span>
                            <?php endif; ?>

                            <!--Fin Badge nouveau-->

                            <?php if ($imageExists): ?>
                                <img src="<?= $fullImagePath ?>" alt="<?= htmlspecialchars($bien['titre']) ?>" class="w-full h-48 object-cover">
                            <?php else: ?>
                                <div class="w-full h-48 img-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            <?php endif; ?>

                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2"><?= htmlspecialchars($bien['titre']) ?></h3>
                                <p class="text-gray-600 mt-2 text-sm">
                                    <?= limiterMots($bien['description'], 18) ?>
                                </p>
                                <p class="text-gray-600">
                                    <?= htmlspecialchars($bien['ville']) ?> -
                                    <?= htmlspecialchars($bien['surface']) ?>m² -
                                    <?= htmlspecialchars($bien['pieces']) ?> pièces
                                </p>
                                <h4 class="text-xl font-400 mb-2" style="color: #FFA500;">• <?= htmlspecialchars($bien['type']) ?></h4>
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
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-primary text-white">
        <div class="container mx-auto px-6 container-padding text-center">
            <h2 class="text-3xl font-bold mb-4">Ne ratez aucun nouveau bien</h2>
            <p class="max-w-2xl mx-auto mb-8">Abonnez-vous pour recevoir en avant-première nos nouvelles propriétés</p>
            <form class="max-w-md mx-auto flex">
                <input type="email" placeholder="Votre email"
                    class="flex-grow px-4 py-3 rounded-l-full text-dark focus:outline-none">
                <button class="bg-dark hover:bg-gray-800 px-6 py-3 rounded-r-full transition">S'abonner</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.html'; ?>


    <!-- Scripts -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const typeFilter = document.getElementById('typeFilter');
        const budgetFilter = document.getElementById('budgetFilter');
        const biens = document.querySelectorAll('.bien-card');
        const filterButtons = document.querySelectorAll('.filter-btn');

        let activeNature = 'all';

        function filterBiens() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedType = typeFilter.value;
            const maxBudget = budgetFilter.value ? parseInt(budgetFilter.value) : Infinity;

            biens.forEach(bien => {
                const titre = bien.dataset.titre;
                const ville = bien.dataset.ville;
                const type = bien.dataset.type;
                const prix = parseInt(bien.dataset.prix);
                const nature = bien.dataset.nature;

                const matchSearch = titre.includes(searchTerm) || ville.includes(searchTerm);
                const matchType = selectedType === "" || type === selectedType;
                const matchBudget = prix <= maxBudget;
                const matchNature = activeNature === 'all' || nature === activeNature;

                bien.style.display =
                    matchSearch && matchType && matchBudget && matchNature ?
                    "block" :
                    "none";
            });
        }

        // Événements filtres classiques
        searchInput.addEventListener('input', filterBiens);
        typeFilter.addEventListener('change', filterBiens);
        budgetFilter.addEventListener('input', filterBiens);

        // Boutons louer / vendre
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                activeNature = button.dataset.filter;

                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-primary');
                    btn.classList.add('bg-gray-500');
                });

                button.classList.remove('bg-gray-500');
                button.classList.add('bg-primary');

                filterBiens();
            });
        });
    </script>
    <script>
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.dataset.filter;
                const cards = document.querySelectorAll('.bien-card');

                cards.forEach(card => {
                    const nature = card.dataset.nature;

                    if (filter === 'all' || nature === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Style bouton actif
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('opacity-60');
                });
                button.classList.add('opacity-60');
            });
        });
    </script>



</body>

</html>