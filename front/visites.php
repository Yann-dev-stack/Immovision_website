<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImmoVision - Visites Virtuelles 360°</title>
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
        #technologie {
            padding-left: 8rem;
            padding-right: 8rem;
        }

        #pk {
            padding-left: 8rem;
            padding-right: 8rem;
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

        .nos-biens {
            align-items: center;
            text-align: center;
            justify-content: center;
            margin-top: 2rem;
        }

        /* =========================
   RESPONSIVE TABLETTE
   ========================= */
        @media (max-width: 1024px) {

            /* Sections avec gros padding */
            #technologie,
            #pk {
                padding-left: 3rem;
                padding-right: 3rem;
            }

            /* Hero */
            .hero-section {
                height: 70vh;
                padding: 2rem 1.5rem;
            }

            .hero-section h1 {
                font-size: 2.8rem;
            }

            .hero-section p {
                font-size: 1.2rem;
            }

            /* Cartes */
            .bg-primary.bg-opacity-10,
            .bg-gray-50 {
                padding: 2rem;
            }

            /* Bouton hero */
            .hero-section button {
                padding: 0.8rem 2rem;
                font-size: 1rem;
            }
        }


        /* =========================
   RESPONSIVE MOBILE
   ========================= */
        @media (max-width: 640px) {
            *{
                margin: 0;
                padding: 0;
            }

            /* Sections */
            #technologie,
            #pk {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }

            section.py-16 {
                padding-top: 3rem;
                padding-bottom: 3rem;
            }

            /* Hero */
            .hero-section {
                height: auto;
                min-height: 85vh;
                padding: 3rem 1rem;
            }

            .hero-section h1 {
                font-size: 2.1rem;
                line-height: 1.2;
            }

            .hero-section p {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }

            .hero-section button {
                width: 100%;
                padding: 0.9rem;
                font-size: 1rem;
            }

            /* Titres sections */
            h2 {
                font-size: 1.9rem !important;
                margin-bottom: 2.5rem !important;
            }

            /* Cards technologie */
            .bg-gray-50 {
                padding: 1.5rem;
            }

            .bg-gray-50 h3 {
                font-size: 1.1rem;
            }

            /* Avantages */
            .bg-primary.bg-opacity-10 {
                padding: 1.5rem;
            }

            /* Bouton "nos biens" */
            .nos-biens button {
                width: 90%;
                padding: 0.9rem;
                font-size: 1rem;
            }

            /* Vidéo modale */
            #videoModal video {
                height: 220px;
            }
        }
    </style>
</head>

<body class="font-sans bg-gray-50">
    <?php include 'header.html'; ?>
    <!-- Hero spécifique -->
    <section class="hero-section flex items-center justify-center text-center text-white">
        <div class="container mx-auto px-6 container-padding">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Visites <span class="text-primary">Virtuelles 360°</span></h1>
            <p class="text-xl md:text-2xl mb-8">Explorez les propriétés comme si vous y étiez, depuis chez vous</p>
            <button class="bg-primary hover:bg-secondary text-white font-bold py-3 px-8 rounded-full transition pulse-animation">
                <i class="fas fa-play mr-2"></i> Démarrer la démo
            </button>
        </div>
    </section>

    <!-- Section technologie -->
    <section class="py-16 bg-white" id="technologie">
        <div class="container mx-auto px-6 container-padding">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-dark mb-16">Notre <span class="text-primary">Technologie</span></h2>

            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
                    <div class="bg-gray-50 p-8 rounded-xl">
                        <div class="flex items-center mb-6">
                            <div class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center mr-4 text-xl font-bold">1</div>
                            <h3 class="text-xl font-bold text-dark">Scan 3D haute précision</h3>
                        </div>
                        <p class="text-gray-600 mb-8">Nos caméras professionnelles capturent chaque détail avec une précision millimétrique pour une reproduction fidèle.</p>

                        <div class="flex items-center mb-6">
                            <div class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center mr-4 text-xl font-bold">2</div>
                            <h3 class="text-xl font-bold text-dark">Moteur d'exploration immersif</h3>
                        </div>
                        <p class="text-gray-600 mb-8">Déplacez-vous librement entre les pièces avec une fluidité optimale, même sur mobile.</p>

                        <div class="flex items-center">
                            <div class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center mr-4 text-xl font-bold">3</div>
                            <h3 class="text-xl font-bold text-dark">Compatibilité VR</h3>
                        </div>
                        <p class="text-gray-600">Expérience encore plus réaliste avec un casque de réalité virtuelle (optionnel).</p>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <img src="https://media.ouest-france.fr/v1/pictures/MjAyMzA0Y2IxY2Y0NmFlNTgwZjI2MTkwZTA0OWEwZTY1MGE5ODI?width=1260&height=708&focuspoint=50%2C25&cropresize=1&client_id=bpeditorial&sign=bedd1355366b08e3de1f46a1e8c721b7278b40a1388a7eb54a86eb57cc7d4b7d" alt="Technologie 3D" class="rounded-xl shadow-xl w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Section avantages -->
    <section class="py-16 bg-white" id="pk">
        <div class="container mx-auto px-6 container-padding">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-dark mb-16">Pourquoi choisir une <span class="text-primary">visite virtuelle</span> ?</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-primary bg-opacity-10 p-8 rounded-xl">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-4">Gagnez un temps précieux</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mr-2 mt-1"></i>
                            <span>Visitez 10 propriétés en 1 heure</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mr-2 mt-1"></i>
                            <span>Pas de déplacement inutile</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mr-2 mt-1"></i>
                            <span>Accessible 24h/24</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-primary bg-opacity-10 p-8 rounded-xl">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-4">Détails invisibles en visite réelle</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mr-2 mt-1"></i>
                            <span>Mesures précises des pièces</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mr-2 mt-1"></i>
                            <span>Revivez la visite autant que nécessaire</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mr-2 mt-1"></i>
                            <span>Comparaison côte à côte possible</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="nos-biens">
            <button class="bg-primary hover:bg-secondary text-white font-bold py-3 px-6 rounded-full">
                <a href="biens.php"> Découvrez nos biens </a>
            </button>
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