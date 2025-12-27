<?php
session_start();
require_once __DIR__ . '/../back/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        if (
            empty($_POST['nom']) ||
            empty($_POST['email']) ||
            empty($_POST['sujet']) ||
            empty($_POST['message'])
        ) {
            throw new Exception("Veuillez remplir tous les champs.");
        }

        $stmt = $pdo->prepare("INSERT INTO contacts (nom, email, sujet, message)
            VALUES (:nom, :email, :sujet, :message)
        ");

        $stmt->execute([
            ':nom' => htmlspecialchars($_POST['nom']),
            ':email' => htmlspecialchars($_POST['email']),
            ':sujet' => htmlspecialchars($_POST['sujet']),
            ':message' => htmlspecialchars($_POST['message'])
        ]);

        // Message de succès
        $_SESSION['success'] = "✅ Votre message a été envoyé avec succès. Nous vous répondrons sous 24h.";
        header('Location: contact.php');
        exit;
    } catch (Exception $e) {
        // Message d'erreur
        $_SESSION['error'] = "❌ Erreur : " . $e->getMessage();
        header('Location: contact.php');
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImmoVision - Contactez-nous</title>
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
    </style>
</head>

<body class="font-sans bg-gray-50">
    <?php include 'header.html'; ?>

    <!-- Hero spécifique -->
    <section class="hero-section flex items-center justify-center text-center text-white">
        <div class="container mx-auto px-6 container-padding">
            <h1 class="text-4xl md:text-6xl font-bold mb-6"> <span class="text-primary">Contactez </span>Nous</h1>
            <p class="text-xl md:text-2xl mb-8">Une question ? Un projet ? Notre équipe vous répond sous 24h</p>
        </div>
    </section>

    <!-- Formulaire de contact (reprise de l'index améliorée) -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 container-padding">
            <div class="max-w-4xl mx-auto bg-gray-50 rounded-xl shadow-md overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2 p-10 text-white" style="background-color: black;">
                        <h2 class="text-3xl font-bold mb-6">Contact rapide</h2>
                        <p class="mb-8">Préférez un contact direct ? Utilisez nos coordonnées ci-dessous.</p>

                        <div class="mb-6 flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-bold">Téléphone</h4>
                                <p>01 23 45 67 89</p>
                            </div>
                        </div>

                        <div class="mb-6 flex items-start">
                            <i class="fas fa-envelope mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-bold">Email</h4>
                                <p>contact@immovision.com</p>
                            </div>
                        </div>

                        <div class="mb-6 flex items-start">
                            <i class="fas fa-clock mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-bold">Horaires</h4>
                                <p>Lundi-Vendredi : 9h-19h</p>
                                <p>Samedi : 10h-18h</p>
                            </div>
                        </div>

                        <h4 class="font-bold mt-8 mb-4">Suivez-nous</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="text-white hover:text-secondary text-xl"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-white hover:text-secondary text-xl"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white hover:text-secondary text-xl"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-white hover:text-secondary text-xl"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>

                    <div class="md:w-1/2 p-10">
                        <h3 class="text-2xl font-bold text-dark mb-6">Envoyez-nous un message</h3>
                        <!-- Notifications de confirmation-->
                        <?php if (isset($_SESSION['success'])): ?>
                            <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700 font-semibold">
                                <?= $_SESSION['success']; ?>
                            </div>
                            <?php unset($_SESSION['success']); ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700 font-semibold">
                                <?= $_SESSION['error']; ?>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>

                        <!-- Fin de Notifications de confirmation-->

                        <form method="POST" action="contact.php">
                            <div class="mb-4">
                                <input type="text" placeholder="Votre nom" name="nom" class="contact-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-primary" required>
                            </div>
                            <div class="mb-4">
                                <input type="email" placeholder="Votre email" name="email" class="contact-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-primary" required>
                            </div>
                            <div class="mb-4">
                                <select name="sujet" class="contact-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-primary" required>
                                    <option>Sujet de votre message</option>
                                    <option>Information sur un bien</option>
                                    <option>Rendez-vous visite virtuelle</option>
                                    <option>Autre question</option>
                                </select>
                            </div>
                            <div class="mb-6">
                                <textarea placeholder="Votre message" name="message" rows="4" class="contact-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-primary" required></textarea>
                            </div>
                            <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-bold py-3 px-6 rounded-full transition">
                                Envoyer le message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section RDV -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 container-padding text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Prenez rendez-vous en ligne</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mb-8">Choisissez un créneau qui vous convient pour une visite virtuelle guidée avec un de nos conseillers</p>
            <button class="bg-primary hover:bg-secondary text-white font-bold py-3 px-8 rounded-full transition inline-flex items-center">
                <i class="fas fa-phone-alt mr-2"></i> Contactez-nous via WhatsApp
            </button>
        </div>
    </section>
    <!-- Footer -->
    <?php include 'footer.html'; ?>

</body>

</html>