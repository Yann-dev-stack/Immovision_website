<?php
require_once __DIR__ . '/../back/config/database.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - ImmoVision</title>

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
        #about-hero {
            padding-left: 8rem;
            padding-right: 8rem;
            background: linear-gradient(rgba(0, 0, 0, .75), rgba(0, 0, 0, .75)),
                url('https://images.unsplash.com/photo-1568605114967-8130f3a36994');
            background-size: cover;
            background-position: center;
            height: 60vh;
        }

        @media (min-width: 768px) {
            #about-hero {
                height: 70vh;
            }
        }

        @media (min-width: 1024px) {
            #about-hero {
                height: 80vh;
            }
        }


        #about-content,
        #values,
        #team {
            padding-left: 8rem;
            padding-right: 8rem;
        }

        .value-card:hover,
        .team-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, .1);
        }

        /* Padding responsive */
        #about-hero,
        #about-content,
        #values,
        #team {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        /* Tablette */
        @media (min-width: 768px) {

            #about-hero,
            #about-content,
            #values,
            #team {
                padding-left: 4rem;
                padding-right: 4rem;
            }
        }

        /* Desktop */
        @media (min-width: 1024px) {

            #about-hero,
            #about-content,
            #values,
            #team {
                padding-left: 8rem;
                padding-right: 8rem;
            }
        }
    </style>
</head>

<body class="font-sans bg-gray-50">

    <?php include 'header.html'; ?>

    <!-- HERO ABOUT -->
    <section id="about-hero" class="flex items-center text-white">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold mb-6">
                À propos de <span class="text-primary">ImmoVision</span>
            </h1>
            <p class="text-base sm:text-lg md:text-xl max-w-3xl mx-auto">
                Réinventer l’immobilier grâce à la technologie, la transparence
                et l’accompagnement humain.
            </p>
        </div>
    </section>

    <!-- ABOUT CONTENT -->
    <section id="about-content" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-dark mb-6">
                        Notre vision
                    </h2>
                    <p class="text-gray-600 mb-4">
                        ImmoVision est née d’une ambition simple :
                        <strong>rendre l’immobilier plus accessible, plus rapide et plus transparent</strong>.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Grâce aux visites virtuelles 360°, nous permettons aux acheteurs,
                        investisseurs et locataires de découvrir des biens sans contrainte
                        de déplacement.
                    </p>
                    <p class="text-gray-600">
                        Nous combinons innovation technologique et expertise humaine
                        pour offrir une expérience immobilière moderne et fiable.
                    </p>
                </div>

                <div>
                    <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be"
                        alt="Agence ImmoVision"
                        class="rounded-xl shadow-xl w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- VALUES -->
    <section id="values" class="py-16 bg-gray-100">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-dark mb-16">
                Nos <span class="text-primary">Valeurs</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="value-card bg-white p-8 rounded-xl shadow-md transition">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Innovation</h3>
                    <p class="text-gray-600">
                        Nous utilisons les technologies les plus avancées pour
                        transformer l’expérience immobilière.
                    </p>
                </div>

                <div class="value-card bg-white p-8 rounded-xl shadow-md transition">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Confiance</h3>
                    <p class="text-gray-600">
                        Transparence, sérieux et engagement sont au cœur
                        de notre relation client.
                    </p>
                </div>

                <div class="value-card bg-white p-8 rounded-xl shadow-md transition">
                    <div class="text-primary text-4xl mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Humain</h3>
                    <p class="text-gray-600">
                        Derrière la technologie, une équipe de conseillers
                        disponibles et à l’écoute.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- TEAM -->
    <section id="team" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-dark mb-16">
                Notre <span class="text-primary">Équipe</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 gap-y-8">
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

    <!-- CTA -->
    <section class="py-16 bg-primary bg-opacity-10" style="padding-top: 8rem; padding-bottom: 8rem;">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-dark mb-6" style="margin-bottom:3rem;">
                Prêt à vivre une nouvelle expérience immobilière ?
            </h2>
            <a href="contact.php"
                class="bg-primary hover:bg-secondary text-white font-bold py-3 px-10 rounded-full transition transform hover:scale-105">
                Contactez-nous
            </a>
        </div>
    </section>

    <?php include 'footer.html'; ?>

</body>

</html>