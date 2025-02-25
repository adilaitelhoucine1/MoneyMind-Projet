<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyMind - Gestion Budgétaire Intelligente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            background-color: #f8fafc;
            pointer-events: none;
        }
        #particles-js-secondary {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            pointer-events: none;
        }
        .content-wrapper {
            position: relative;
            z-index: 1;
        }
        .bg-white {
            background-color: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(8px);
        }
        .bg-gradient-to-r {
            background: linear-gradient(to right, rgba(16, 185, 129, 0.95), rgba(5, 150, 105, 0.95)) !important;
        }
        .bg-gradient-to-b {
            background: transparent !important;
        }
        .bg-gray-900 {
            background-color: rgba(17, 24, 39, 0.98) !important;
            backdrop-filter: blur(10px);
        }
        .bg-blue-600 {
            background-color: rgba(37, 99, 235, 0.9) !important;
        }
        [class*="from-gray-50"] {
            background: transparent !important;
        }
        [class*="from-blue-50"] {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(5px);
        }
        [class*="from-emerald-50"] {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(5px);
        }
        .bg-overlay {
            display: none;
        }
        .hero-section {
            height: 680px;
            padding: 2rem 0;
            position: relative;
            overflow: hidden;
        }
        .hero-content {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            padding: 3.5rem;
            border-radius: 1.5rem;
            border: 1px solid rgba(229, 231, 235, 0.5);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        .hero-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        .feature-card {
            transition: all 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
            border: 1px solid rgba(229, 231, 235, 0.7);
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: rgba(16, 185, 129, 0.3);
        }
        .btn-primary {
            background-color: #10b981;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.25);
        }
        .btn-primary:hover {
            background-color: #059669;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(16, 185, 129, 0.3);
        }
        .btn-secondary {
            background-color: white;
            color: #374151;
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid rgba(229, 231, 235, 0.7);
        }
        .btn-secondary:hover {
            background-color: #f9fafb;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
        }
        .stats-item {
            position: relative;
            z-index: 1;
            padding: 2rem;
            border-radius: 1rem;
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        .stats-item:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 255, 255, 0.15);
        }
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, #10b981, #059669);
            border-radius: 3px;
        }
    </style>
</head>

<body class="bg-white">
    <div id="particles-js"></div>
    <div id="particles-js-secondary"></div>
    <div id="particles-js-tertiary"></div>
    <div id="particles-js-quaternary"></div>
    
    <style>
        #particles-js, #particles-js-secondary, #particles-js-tertiary, #particles-js-quaternary {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            pointer-events: none;
        }
    </style>

    <div class="content-wrapper">
        <header class="bg-white shadow-md border-b border-gray-200 sticky top-0 z-10">
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-emerald-600">Money<span class="text-gray-800">Mind</span></h1>
                <div class="space-x-6">
                    <a href="/login" class="text-gray-700 hover:text-emerald-600 font-medium transition-colors">Connexion</a>
                    <a href="/register" class="btn-primary">
                        Inscription
                    </a>
                </div>
            </nav>
        </header>

        <main>
            <!-- Hero Section -->
            <div class="relative overflow-hidden hero-section">
                <div class="container mx-auto px-6 h-full flex items-center">
                    <div class="text-center w-full hero-content">
                        <h2 class="text-5xl font-bold text-gray-900 mb-6">
                            Gérez vos finances avec <span class="text-emerald-600">intelligence</span>
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-10">
                            Simplifiez votre gestion budgétaire grâce à l'IA et prenez le contrôle de vos finances personnelles
                        </p>
                        <div class="flex justify-center gap-5">
                            <a href="/register" class="btn-primary">
                                Commencer maintenant
                            </a>
                            <a href="#features" class="btn-secondary">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div id="features" class="container mx-auto px-6 py-20">
                <div class="text-center mb-16">
                    <h3 class="text-3xl font-bold text-gray-900 section-title">Fonctionnalités Principales</h3>
                    <p class="text-gray-600 mt-4">Des outils intelligents pour votre gestion financière</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto mb-20">
                    <div class="feature-card bg-white p-8 rounded-xl shadow-sm">
                        <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-chart-pie text-2xl text-emerald-600"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-3">Suivi Budgétaire</h4>
                        <p class="text-gray-600">Suivez automatiquement vos revenus et dépenses en temps réel avec des visualisations claires</p>
                    </div>

                    <div class="feature-card bg-white p-8 rounded-xl shadow-sm">
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-robot text-2xl text-blue-600"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-3">IA Prédictive</h4>
                        <p class="text-gray-600">Recevez des suggestions personnalisées pour optimiser vos dépenses et atteindre vos objectifs</p>
                    </div>

                    <div class="feature-card bg-white p-8 rounded-xl shadow-sm">
                        <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-bell text-2xl text-purple-600"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-3">Alertes Intelligentes</h4>
                        <p class="text-gray-600">Soyez notifié des dépassements de budget et des échéances importantes pour rester en contrôle</p>
                    </div>
                </div>

                <!-- Statistics Section -->
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 py-20 my-20 rounded-2xl shadow-lg">
                    <div class="container mx-auto px-6">
                        <div class="grid md:grid-cols-3 gap-12 text-white">
                            <div class="stats-item text-center">
                                <div class="text-5xl font-bold mb-3">85%</div>
                                <div class="text-emerald-100 text-lg">Économies réalisées</div>
                            </div>
                            <div class="stats-item text-center">
                                <div class="text-5xl font-bold mb-3">10K+</div>
                                <div class="text-emerald-100 text-lg">Utilisateurs actifs</div>
                            </div>
                            <div class="stats-item text-center">
                                <div class="text-5xl font-bold mb-3">24/7</div>
                                <div class="text-emerald-100 text-lg">Support IA</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Why Choose Us -->
                <div class="container mx-auto px-6 py-20">
                    <div class="text-center mb-16">
                        <h3 class="text-3xl font-bold text-gray-900 section-title">Pourquoi choisir MoneyMind ?</h3>
                        <p class="text-gray-600 max-w-2xl mx-auto mt-4">Une solution complète pour gérer vos finances personnelles avec l'aide de l'intelligence artificielle</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-10 max-w-5xl mx-auto">
                        <div class="feature-card bg-gradient-to-r from-emerald-50 to-white p-8 rounded-xl shadow-sm">
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="p-4 bg-emerald-100 rounded-xl">
                                    <i class="fas fa-wallet text-2xl text-emerald-600"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Gestion Simplifiée</h3>
                            </div>
                            <p class="text-gray-600 mb-6">
                                Automatisez le suivi de vos finances et recevez des insights personnalisés pour prendre de meilleures décisions
                            </p>
                            <a href="/register" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-medium">
                                En savoir plus <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>

                        <div class="feature-card bg-gradient-to-r from-blue-50 to-white p-8 rounded-xl shadow-sm">
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="p-4 bg-blue-100 rounded-xl">
                                    <i class="fas fa-brain text-2xl text-blue-600"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">IA Avancée</h3>
                            </div>
                            <p class="text-gray-600 mb-6">
                                Bénéficiez de conseils personnalisés basés sur vos habitudes financières et optimisez votre budget
                            </p>
                            <a href="/register" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                                En savoir plus <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-emerald-600 text-white py-20 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-emerald-800 opacity-90"></div>
                <div class="container mx-auto px-6 text-center relative z-10">
                    <h3 class="text-4xl font-bold mb-6">Prêt à optimiser vos finances ?</h3>
                    <p class="text-emerald-100 mb-10 max-w-2xl mx-auto text-lg">Rejoignez MoneyMind et prenez le contrôle de votre avenir financier dès aujourd'hui</p>
                    <a href="/register" class="inline-block px-10 py-4 bg-white text-emerald-600 rounded-xl hover:bg-emerald-50 transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:-translate-y-1">
                        Créer mon compte gratuitement
                    </a>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 py-16">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-4 gap-10">
                    <div>
                        <h4 class="text-white text-xl font-semibold mb-6">MoneyMind</h4>
                        <p class="text-sm">Votre assistant financier intelligent pour une gestion budgétaire optimisée et personnalisée</p>
                        <div class="mt-6">
                            <img src="https://via.placeholder.com/120x40/10b981/FFFFFF?text=MoneyMind" alt="MoneyMind Logo" class="h-10">
                        </div>
                    </div>
                    <div>
                        <h4 class="text-white text-lg font-semibold mb-6">Liens rapides</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="hover:text-emerald-400 transition-colors">À propos</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors">Comment ça marche</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors">FAQ</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors">Blog</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white text-lg font-semibold mb-6">Nous contacter</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="hover:text-emerald-400 transition-colors">Support</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors">Contact</a></li>
                            <li><a href="#" class="hover:text-emerald-400 transition-colors">Partenariats</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white text-lg font-semibold mb-6">Suivez-nous</h4>
                        <div class="flex space-x-5 mb-6">
                            <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors text-xl"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors text-xl"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors text-xl"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors text-xl"><i class="fab fa-linkedin"></i></a>
                        </div>
                        <p class="text-sm">Inscrivez-vous à notre newsletter</p>
                        <div class="mt-3 flex">
                            <input type="email" placeholder="Votre email" class="px-4 py-2 rounded-l-lg text-gray-800 w-full focus:outline-none">
                            <button class="bg-emerald-600 text-white px-4 py-2 rounded-r-lg hover:bg-emerald-700 transition-colors">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-12 pt-8 text-sm text-center">
                    <p>&copy; 2024 MoneyMind. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Particle system configuration factory
        function createParticleConfig(color, number, size, speed, opacity) {
            return {
                "particles": {
                    "number": {
                        "value": number,
                        "density": {
                            "enable": true,
                            "value_area": 1000
                        }
                    },
                    "color": {
                        "value": color
                    },
                    "shape": {
                        "type": "circle"
                    },
                    "opacity": {
                        "value": opacity,
                        "random": false,
                        "anim": {
                            "enable": true,
                            "speed": speed * 0.8,
                            "opacity_min": opacity * 0.4,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": size,
                        "random": true,
                        "anim": {
                            "enable": true,
                            "speed": speed,
                            "size_min": size * 0.1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": color,
                        "opacity": opacity * 0.8,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": speed,
                        "direction": "none",
                        "random": true,
                        "straight": false,
                        "out_mode": "bounce",
                        "bounce": false,
                        "attract": {
                            "enable": true,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "window",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "grab"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 200,
                            "line_linked": {
                                "opacity": opacity * 0.8
                            }
                        },
                        "push": {
                            "particles_nb": 3
                        }
                    }
                },
                "retina_detect": true
            };
        }

        // Initialize all particle systems
        particlesJS('particles-js', createParticleConfig('#10b981', 150, 3, 1, 0.5));  // Emerald
        particlesJS('particles-js-secondary', createParticleConfig('#9681EB', 100, 2, 0.8, 0.3));  // Lavender
        particlesJS('particles-js-tertiary', createParticleConfig('#14b8a6', 120, 2.5, 0.9, 0.4));  // Teal
        particlesJS('particles-js-quaternary', createParticleConfig('#f472b6', 80, 2, 0.7, 0.2));  // Soft Pink

        // Update mouse movement handler for all particle systems
        document.addEventListener('mousemove', function(e) {
            if (window.pJSDom) {
                window.pJSDom.forEach(function(system) {
                    if (system && system.pJS) {
                        system.pJS.interactivity.mouse.pos_x = e.clientX;
                        system.pJS.interactivity.mouse.pos_y = e.clientY;
                    }
                });
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>
