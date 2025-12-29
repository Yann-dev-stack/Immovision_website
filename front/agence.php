<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImmoVision - Nos Agences</title>
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
        #maps iframe {
            border-radius: 10px;
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


        .team-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, .1);
        }

        /* Tablette */
        @media (min-width: 768px) {

            #values,
            #team {
                padding-left: 4rem;
                padding-right: 4rem;
            }
        }

        /* Desktop */
        @media (min-width: 1024px) {

            #values,
            #team {
                padding-left: 8rem;
                padding-right: 8rem;
            }
        }
    </style>
</head>

<body class="font-sans bg-gray-50">
    <div id="header-placeholder"></div>

    <?php include 'header.html'; ?>

    <!-- Contenu principal avec espacement amélioré -->
    <div class="main-content">
        <!-- Hero spécifique -->
        <section class="hero-section flex items-center justify-center text-center text-white min-h-[60vh] md:min-h-[80vh]">
            <div class="max-w-[1600px] mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-32">
                <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold mb-6">
                    Nos <span class="text-primary">Agences</span>
                </h1>
                <p class="text-base sm:text-xl md:text-2xl max-w-3xl mx-auto">
                    Rencontrez nos conseillers dans l'une de nos agences partenaires
                </p>
            </div>
        </section>


        <!-- Carte interactive (placeholder) -->
        <section class="py-16 bg-white">
            <div class="max-w-[1600px] mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-32">
                <h3 class="text-2xl sm:text-3xl font-semibold text-center mb-8">
                    <i class="fas fa-map-marked-alt text-primary mr-2"></i>
                    Notre <span class="text-primary">localisation</span>
                </h3>

                <div class="overflow-hidden rounded-xl shadow-md">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3629.677699205508!2d2.3689831745379806!3d6.357675325069091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023568879c4a29d%3A0xae82ab1adae076ea!2sAgence%20immobili%C3%A8re%20BENIN-IMMO!5e1!3m2!1sfr!2sbj!4v1747412536444!5m2!1sfr!2sbj" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-[300px] sm:h-[400px] md:h-[450px]"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </section>

        <!-- Our Agencies (Nos Agences) -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-[1600px] mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-32">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-16">
                    Nos <span class="text-primary">Agences</span>
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

                    <div class="bg-white rounded-xl overflow-hidden shadow-md transition hover:-translate-y-2 hover:shadow-xl">
                        <img src="https://images.unsplash.com/photo-1560520031-3a4dc4e9de0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                            alt="Agence Paris" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-dark mb-2">ImmoVision Cotonou</h3>
                            <p class="text-gray-600 mb-4"><i class="fas fa-map-marker-alt text-primary mr-2"></i> 12 Rue
                                de la Paix, 75002 Cotonou</p>
                            <p class="text-gray-600 mb-4"><i class="fas fa-phone text-primary mr-2"></i> 01 23 45 67 89
                            </p>
                            <p class="text-gray-600 mb-4"><i class="fas fa-envelope text-primary mr-2"></i>
                                cotonou@immovision.com</p>
                            <button
                                class="w-full bg-primary hover:bg-secondary text-white py-2 rounded-full transition">Contacter
                                cette agence</button>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl overflow-hidden shadow-md transition hover:-translate-y-2 hover:shadow-xl">
                        <img src="https://images.unsplash.com/photo-1560520031-3a4dc4e9de0c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                            alt="Agence Paris" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-dark mb-2">ImmoVision Calavi</h3>
                            <p class="text-gray-600 mb-4"><i class="fas fa-map-marker-alt text-primary mr-2"></i> 24 Rue
                                de la République, 69002 Calavi</p>
                            <p class="text-gray-600 mb-4"><i class="fas fa-phone text-primary mr-2"></i> 04 23 45 67 89
                            </p>
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
                            <p class="text-gray-600 mb-4"><i class="fas fa-map-marker-alt text-primary mr-2"></i> 8
                                Cours de l'Intendance, 33000 Parakou</p>
                            <p class="text-gray-600 mb-4"><i class="fas fa-phone text-primary mr-2"></i> 05 23 45 67 89
                            </p>
                            <p class="text-gray-600 mb-4"><i class="fas fa-envelope text-primary mr-2"></i>
                                parakou@immovision.com</p>
                            <button
                                class="w-full bg-primary hover:bg-secondary text-white py-2 rounded-full transition">Contacter
                                cette agence</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        </section>
        <!-- TEAM -->
        <section class="py-16 bg-white">
            <div class="max-w-[1600px] mx-auto px-4 sm:px-6 md:px-10 lg:px-20 xl:px-32">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-16">
                    Notre <span class="text-primary">Équipe</span>
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                    <div class="team-card bg-gray-50 rounded-xl p-6 text-center shadow-md transition">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                            class="w-24 h-24 mx-auto rounded-full mb-4" alt="">
                        <h4 class="text-xl font-bold">Jean KOUASSI</h4>
                        <p class="text-primary mb-2">Directeur Général</p>
                        <p class="text-gray-600 text-sm">
                            Plus de 10 ans d’expérience dans l’immobilier
                            et l’investissement.
                        </p>
                    </div>

                    <div class="team-card bg-gray-50 rounded-xl p-6 text-center shadow-md transition">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135789.png"
                            class="w-24 h-24 mx-auto rounded-full mb-4" alt="">
                        <h4 class="text-xl font-bold">Sarah MENSAH</h4>
                        <p class="text-primary mb-2">Conseillère Immobilière</p>
                        <p class="text-gray-600 text-sm">
                            Spécialiste en accompagnement client
                            et visites virtuelles.
                        </p>
                    </div>

                    <div class="team-card bg-gray-50 rounded-xl p-6 text-center shadow-md transition">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135823.png"
                            class="w-24 h-24 mx-auto rounded-full mb-4" alt="">
                        <h4 class="text-xl font-bold">Marc ADJOVI</h4>
                        <p class="text-primary mb-2">Expert Technique</p>
                        <p class="text-gray-600 text-sm">
                            Responsable des visites 360° et
                            des solutions numériques.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include 'footer.html'; ?>

</body>

</html>