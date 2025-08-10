<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlaceZo - Découvrez des logements uniques</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
            }

            50% {
                box-shadow: 0 0 40px rgba(59, 130, 246, 0.8);
            }
        }

        @keyframes slide-in {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fade-up {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        .slide-in {
            animation: slide-in 1s ease-out;
        }

        .fade-up {
            animation: fade-up 0.8s ease-out;
        }

        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 50%, #1e40af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
        }

        html {
            scroll-behavior: smooth;
        }

        /* House Showcase Gallery Styles */
        .house-showcase-container {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1000px;
        }

        .house-card {
            position: absolute;
            width: 300px;
            height: 400px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            transform-style: preserve-3d;
            animation: houseFloat 12s ease-in-out infinite;
            animation-delay: var(--delay);
            opacity: 0.7;
            transition: all 0.5s ease;
        }

        .house-card:hover {
            opacity: 1;
            transform: scale(1.05) translateZ(20px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
        }

        .house-image {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .house-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            padding: 20px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .house-card:hover .house-overlay {
            transform: translateY(0);
        }

        .house-info h3 {
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .house-info p {
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        @keyframes houseFloat {
            0%, 100% {
                transform: translateY(0px) rotateY(0deg);
            }
            25% {
                transform: translateY(-20px) rotateY(5deg);
            }
            50% {
                transform: translateY(-10px) rotateY(-5deg);
            }
            75% {
                transform: translateY(-15px) rotateY(3deg);
            }
        }

        /* Position houses in a circle */
        .house-card:nth-child(1) {
            transform: translate(-400px, -100px) rotateY(15deg);
        }
        .house-card:nth-child(2) {
            transform: translate(400px, -100px) rotateY(-15deg);
        }
        .house-card:nth-child(3) {
            transform: translate(-200px, 200px) rotateY(10deg);
        }
        .house-card:nth-child(4) {
            transform: translate(200px, 200px) rotateY(-10deg);
        }
        .house-card:nth-child(5) {
            transform: translate(-300px, -200px) rotateY(20deg);
        }
        .house-card:nth-child(6) {
            transform: translate(300px, -200px) rotateY(-20deg);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .house-card {
                width: 200px;
                height: 250px;
            }
            
            .house-card:nth-child(1) {
                transform: translate(-150px, -50px) rotateY(15deg);
            }
            .house-card:nth-child(2) {
                transform: translate(150px, -50px) rotateY(-15deg);
            }
            .house-card:nth-child(3) {
                transform: translate(-100px, 100px) rotateY(10deg);
            }
            .house-card:nth-child(4) {
                transform: translate(100px, 100px) rotateY(-10deg);
            }
            .house-card:nth-child(5) {
                transform: translate(-120px, -100px) rotateY(20deg);
            }
            .house-card:nth-child(6) {
                transform: translate(120px, -100px) rotateY(-20deg);
            }
        }

        @media (max-width: 480px) {
            .house-showcase-container {
                display: none;
            }
        }

        .background-repeat: no-repeat;
        .background-size: cover;
    </style>
</head>

<body class="font-['Inter'] overflow-x-hidden">
    <!-- Navigation moderne -->
    <nav class="fixed top-0 w-full z-50 glass-effect">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <div class="relative">
                        <h1 class="text-3xl font-bold gradient-text">PlaceZo</h1>
                        <div
                            class="absolute -top-1 -right-1 w-3 h-3 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full pulse-glow">
                        </div>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#"
                        class="text-white hover:text-blue-200 transition-colors duration-300 font-medium">Découvrir</a>
                    <a href="{{ route('experiences') }}"
                        class="text-white hover:text-blue-200 transition-colors duration-300 font-medium">Expériences</a>
                    <a href="#"
                        class="text-white hover:text-blue-200 transition-colors duration-300 font-medium">À propos</a>
                    <a href="#contact"
                        class="text-white hover:text-blue-200 transition-colors duration-300 font-medium">Contact</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="bg-white/20 text-white px-6 py-2 rounded-full hover:bg-white/30 transition-all duration-300 font-medium">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-white hover:text-blue-200 transition-colors duration-300 font-medium">Connexion</a>
                        <a href="{{ route('register') }}"
                            class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-2 rounded-full hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium">
                            Rejoindre
                        </a>
                    @endauth
                    
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" class="md:hidden text-white hover:text-blue-200 transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div id="mobile-menu" class="md:hidden hidden bg-white/10 backdrop-blur-lg rounded-lg mt-4 p-4">
                <div class="flex flex-col space-y-4">
                    <a href="#" class="text-white hover:text-blue-200 transition-colors duration-300 font-medium">Découvrir</a>
                    <a href="{{ route('experiences') }}" class="text-white hover:text-blue-200 transition-colors duration-300 font-medium">Expériences</a>
                    <a href="#" class="text-white hover:text-blue-200 transition-colors duration-300 font-medium">À propos</a>
                    <a href="#contact" class="text-white hover:text-blue-200 transition-colors duration-300 font-medium">Contact</a>
                </div>
            </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section avec parallax -->
    <section class="relative min-h-screen flex items-center justify-center parallax-bg"
        style="background-image: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 50%, #1e40af 100%);">
        <!-- Particules flottantes -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-4 h-4 bg-white/20 rounded-full floating"></div>
            <div class="absolute top-40 right-20 w-6 h-6 bg-white/30 rounded-full floating"
                style="animation-delay: 1s;"></div>
            <div class="absolute bottom-40 left-20 w-3 h-3 bg-white/40 rounded-full floating"
                style="animation-delay: 2s;"></div>
            <div class="absolute bottom-20 right-10 w-5 h-5 bg-white/25 rounded-full floating"
                style="animation-delay: 3s;"></div>
        </div>

        <!-- House Showcase Gallery -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="house-showcase-container">
                <!-- House 1 -->
                <div class="house-card" style="--delay: 0s;">
                    <div class="house-image">
                        <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Luxury Villa" class="w-full h-full object-cover">
                        <div class="house-overlay">
                            <div class="house-info">
                                <h3 class="text-white font-bold text-lg">Villa de Luxe</h3>
                                <p class="text-white/80 text-sm">Bali, Indonésie</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400">★★★★★</span>
                                    <span class="text-white/80 text-sm ml-2">4.9</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- House 2 -->
                <div class="house-card" style="--delay: 2s;">
                    <div class="house-image">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Modern House" class="w-full h-full object-cover">
                        <div class="house-overlay">
                            <div class="house-info">
                                <h3 class="text-white font-bold text-lg">Maison Moderne</h3>
                                <p class="text-white/80 text-sm">Los Angeles, USA</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400">★★★★★</span>
                                    <span class="text-white/80 text-sm ml-2">4.8</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- House 3 -->
                <div class="house-card" style="--delay: 4s;">
                    <div class="house-image">
                        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2075&q=80" 
                             alt="Cozy Cottage" class="w-full h-full object-cover">
                        <div class="house-overlay">
                            <div class="house-info">
                                <h3 class="text-white font-bold text-lg">Cottage Cosy</h3>
                                <p class="text-white/80 text-sm">Provence, France</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400">★★★★★</span>
                                    <span class="text-white/80 text-sm ml-2">4.9</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- House 4 -->
                <div class="house-card" style="--delay: 6s;">
                    <div class="house-image">
                        <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2053&q=80" 
                             alt="Beach House" class="w-full h-full object-cover">
                        <div class="house-overlay">
                            <div class="house-info">
                                <h3 class="text-white font-bold text-lg">Maison de Plage</h3>
                                <p class="text-white/80 text-sm">Maldives</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400">★★★★★</span>
                                    <span class="text-white/80 text-sm ml-2">5.0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- House 5 -->
                <div class="house-card" style="--delay: 8s;">
                    <div class="house-image">
                        <img src="https://images.unsplash.com/photo-1600607687644-c7171b42498b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Mountain Cabin" class="w-full h-full object-cover">
                        <div class="house-overlay">
                            <div class="house-info">
                                <h3 class="text-white font-bold text-lg">Chalet Montagne</h3>
                                <p class="text-white/80 text-sm">Alpes, Suisse</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400">★★★★★</span>
                                    <span class="text-white/80 text-sm ml-2">4.7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- House 6 -->
                <div class="house-card" style="--delay: 10s;">
                    <div class="house-image">
                        <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Urban Loft" class="w-full h-full object-cover">
                        <div class="house-overlay">
                            <div class="house-info">
                                <h3 class="text-white font-bold text-lg">Loft Urbain</h3>
                                <p class="text-white/80 text-sm">New York, USA</p>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-400">★★★★★</span>
                                    <span class="text-white/80 text-sm ml-2">4.8</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative z-10 text-center text-white px-4 sm:px-6 lg:px-8">
            <div class="fade-up">
                <h1 class="text-6xl md:text-8xl font-bold mb-6 leading-tight">
                    Découvrez des
                    <span class="gradient-text">logements uniques</span>
                </h1>
                <p class="text-xl md:text-2xl mb-12 text-blue-100 max-w-3xl mx-auto">
                    Des expériences de voyage authentiques dans des propriétés sélectionnées avec soin
                </p>
            </div>

            <!-- Barre de recherche innovante -->
            <div class="max-w-5xl mx-auto slide-in" style="animation-delay: 0.5s;">
                <div class="glass-effect rounded-3xl p-2 shadow-2xl">
                    <form action="{{ route('listings.search') }}" method="GET" class="flex flex-col lg:flex-row gap-4 p-6 w-full">
                        <div class="flex-1 relative">
                            <input type="text" name="q" placeholder="Où souhaitez-vous voyager ?" required
                                class="w-full px-6 py-4 bg-white/90 rounded-2xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300">
                            <svg class="w-6 h-6 text-gray-400 absolute right-4 top-1/2 transform -translate-y-1/2"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <input type="date" name="date_debut" placeholder="Arrivée"
                                class="w-full px-6 py-4 bg-white/90 rounded-2xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300">
                        </div>
                        <div class="flex-1">
                            <input type="date" name="date_fin" placeholder="Départ"
                                class="w-full px-6 py-4 bg-white/90 rounded-2xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300">
                        </div>
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-2xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 font-semibold text-lg hover-lift">
                            Explorer
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <div class="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white/70 rounded-full mt-2 animate-bounce"></div>
            </div>
        </div>
    </section>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', function() {
                document.getElementById('mobile-menu').classList.add('hidden');
            });
        });
    </script>

    <!-- Section Statistiques avec animations améliorées -->
    <section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    PlaceZo en <span class="gradient-text">chiffres</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Une communauté grandissante de voyageurs et de propriétaires passionnés
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Propriétés uniques -->
                <div class="group text-center transform transition-all duration-500 hover:scale-110 hover:-translate-y-2">
                    <div class="relative">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl mx-auto mb-6 flex items-center justify-center pulse-glow group-hover:shadow-2xl group-hover:shadow-blue-500/50 transition-all duration-500">
                            <svg class="w-12 h-12 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <span class="text-white text-sm font-bold">+</span>
                        </div>
                    </div>
                    <div class="text-5xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-300">10,000</div>
                    <div class="text-gray-600 font-medium group-hover:text-gray-800 transition-colors duration-300">Propriétés uniques</div>
                </div>

                <!-- Voyageurs satisfaits -->
                <div class="group text-center transform transition-all duration-500 hover:scale-110 hover:-translate-y-2">
                    <div class="w-24 h-24 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-3xl mx-auto mb-6 flex items-center justify-center group-hover:shadow-2xl group-hover:shadow-emerald-500/50 transition-all duration-500">
                        <svg class="w-12 h-12 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="text-5xl font-bold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors duration-300">50,000</div>
                    <div class="text-gray-600 font-medium group-hover:text-gray-800 transition-colors duration-300">Voyageurs satisfaits</div>
                </div>

                <!-- Pays couverts -->
                <div class="group text-center transform transition-all duration-500 hover:scale-110 hover:-translate-y-2">
                    <div class="w-24 h-24 bg-gradient-to-br from-orange-500 to-orange-600 rounded-3xl mx-auto mb-6 flex items-center justify-center group-hover:shadow-2xl group-hover:shadow-orange-500/50 transition-all duration-500">
                        <svg class="w-12 h-12 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="text-5xl font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors duration-300">150+</div>
                    <div class="text-gray-600 font-medium group-hover:text-gray-800 transition-colors duration-300">Pays couverts</div>
                </div>

                <!-- Support premium -->
                <div class="group text-center transform transition-all duration-500 hover:scale-110 hover:-translate-y-2">
                    <div class="w-24 h-24 bg-gradient-to-br from-rose-500 to-rose-600 rounded-3xl mx-auto mb-6 flex items-center justify-center group-hover:shadow-2xl group-hover:shadow-rose-500/50 transition-all duration-500">
                        <svg class="w-12 h-12 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-5xl font-bold text-gray-900 mb-2 group-hover:text-rose-600 transition-colors duration-300">24/7</div>
                    <div class="text-gray-600 font-medium group-hover:text-gray-800 transition-colors duration-300">Support premium</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Destinations avec vraies photos -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Découvrez nos <span class="gradient-text">destinations</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Des logements extraordinaires qui racontent une histoire
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Villa Bali avec vue océan -->
                <div class="group relative transform transition-all duration-500 hover:scale-105 hover:-translate-y-2">
                    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-amber-400 via-orange-500 to-rose-500 p-1 shadow-xl group-hover:shadow-2xl transition-all duration-500">
                        <div class="bg-white rounded-3xl p-6 h-full">
                            <div class="relative mb-6">
                                <div class="w-full h-48 rounded-2xl overflow-hidden relative group-hover:scale-105 transition-transform duration-500">
                                    <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                                         alt="Villa Bali" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                                    <div class="absolute top-4 right-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-500 text-white shadow-lg">Disponible</span>
                                    </div>
                                    <div class="absolute bottom-4 left-4">
                                        <div class="flex items-center text-white">
                                            <span class="text-yellow-400 mr-1">★★★★★</span>
                                            <span class="text-sm font-medium">4.9</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute -bottom-3 left-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-white font-bold">★</span>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors duration-300">Villa avec vue océan</h3>
                            <p class="text-gray-600 mb-4">Bali, Indonésie</p>

                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <div class="w-6 h-6 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center mr-2">
                                        <span class="text-white text-xs font-bold">S</span>
                                    </div>
                                    Sarah & Marc
                                </div>
                                <div class="text-sm text-gray-500">Superhost</div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-3xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors duration-300">€180</span>
                                    <span class="text-gray-500">/nuit</span>
                                </div>
                                @auth
                                    <a href="{{ route('properties') }}" class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-6 py-2 rounded-full hover:from-amber-600 hover:to-orange-700 transition-all duration-300 font-medium group-hover:shadow-lg transform group-hover:scale-105 inline-block">
                                    Réserver
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-amber-500 to-orange-600 text-white px-6 py-2 rounded-full hover:from-amber-600 hover:to-orange-700 transition-all duration-300 font-medium group-hover:shadow-lg transform group-hover:scale-105 inline-block">
                                        Réserver
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loft Berlin -->
                <div class="group relative transform transition-all duration-500 hover:scale-105 hover:-translate-y-2">
                    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-400 via-teal-500 to-cyan-500 p-1 shadow-xl group-hover:shadow-2xl transition-all duration-500">
                        <div class="bg-white rounded-3xl p-6 h-full">
                            <div class="relative mb-6">
                                <div class="w-full h-48 rounded-2xl overflow-hidden relative group-hover:scale-105 transition-transform duration-500">
                                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                                         alt="Loft Berlin" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                                    <div class="absolute top-4 right-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-500 text-white shadow-lg">Disponible</span>
                                    </div>
                                    <div class="absolute bottom-4 left-4">
                                        <div class="flex items-center text-white">
                                            <span class="text-yellow-400 mr-1">★★★★★</span>
                                            <span class="text-sm font-medium">4.8</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute -bottom-3 left-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-white font-bold">★</span>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-teal-600 transition-colors duration-300">Loft industriel chic</h3>
                            <p class="text-gray-600 mb-4">Berlin, Allemagne</p>

                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <div class="w-6 h-6 rounded-full bg-gradient-to-r from-emerald-400 to-emerald-600 flex items-center justify-center mr-2">
                                        <span class="text-white text-xs font-bold">A</span>
                                    </div>
                                    Anna & Tom
                                </div>
                                <div class="text-sm text-gray-500">Superhost</div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-3xl font-bold text-gray-900 group-hover:text-teal-600 transition-colors duration-300">€120</span>
                                    <span class="text-gray-500">/nuit</span>
                                </div>
                                @auth
                                    <a href="{{ route('properties') }}" class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-6 py-2 rounded-full hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 font-medium group-hover:shadow-lg transform group-hover:scale-105 inline-block">
                                    Réserver
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-6 py-2 rounded-full hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 font-medium group-hover:shadow-lg transform group-hover:scale-105 inline-block">
                                        Réserver
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maison Kyoto -->
                <div class="group relative transform transition-all duration-500 hover:scale-105 hover:-translate-y-2">
                    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-rose-400 via-pink-500 to-purple-500 p-1 shadow-xl group-hover:shadow-2xl transition-all duration-500">
                        <div class="bg-white rounded-3xl p-6 h-full">
                            <div class="relative mb-6">
                                <div class="w-full h-48 rounded-2xl overflow-hidden relative group-hover:scale-105 transition-transform duration-500">
                                    <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2075&q=80" 
                                         alt="Maison Kyoto" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                                    <div class="absolute top-4 right-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-500 text-white shadow-lg">Disponible</span>
                                    </div>
                                    <div class="absolute bottom-4 left-4">
                                        <div class="flex items-center text-white">
                                            <span class="text-yellow-400 mr-1">★★★★★</span>
                                            <span class="text-sm font-medium">4.9</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="absolute -bottom-3 left-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-white font-bold">★</span>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-pink-600 transition-colors duration-300">Maison traditionnelle</h3>
                            <p class="text-gray-600 mb-4">Kyoto, Japon</p>

                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <div class="w-6 h-6 rounded-full bg-gradient-to-r from-pink-400 to-pink-600 flex items-center justify-center mr-2">
                                        <span class="text-white text-xs font-bold">H</span>
                                    </div>
                                    Hiro & Yuki
                                </div>
                                <div class="text-sm text-gray-500">Superhost</div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-3xl font-bold text-gray-900 group-hover:text-pink-600 transition-colors duration-300">€200</span>
                                    <span class="text-gray-500">/nuit</span>
                                </div>
                                @auth
                                    <a href="{{ route('properties') }}" class="bg-gradient-to-r from-rose-500 to-pink-600 text-white px-6 py-2 rounded-full hover:from-rose-600 hover:to-pink-700 transition-all duration-300 font-medium group-hover:shadow-lg transform group-hover:scale-105 inline-block">
                                    Réserver
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-rose-500 to-pink-600 text-white px-6 py-2 rounded-full hover:from-rose-600 hover:to-pink-700 transition-all duration-300 font-medium group-hover:shadow-lg transform group-hover:scale-105 inline-block">
                                        Réserver
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer moderne -->
    <footer
        class="bg-gradient-to-br from-blue-900 via-indigo-900 to-blue-800 text-white backdrop-blur-md bg-opacity-80 shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Contact Section -->
            <section id="contact" class="mb-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <div>
                        <h3 class="text-2xl font-bold mb-4">Contact</h3>
                        <p class="text-blue-100 mb-6">Une question, une demande spécifique, ou besoin d'aide ? Envoyez-nous un message.</p>
                        <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm mb-2">Nom</label>
                                <input type="text" name="name" class="w-full px-4 py-3 rounded-lg text-gray-900" placeholder="Votre nom" required>
                            </div>
                            <div>
                                <label class="block text-sm mb-2">Email</label>
                                <input type="email" name="email" class="w-full px-4 py-3 rounded-lg text-gray-900" placeholder="vous@example.com" required>
                            </div>
                            <div>
                                <label class="block text-sm mb-2">Message</label>
                                <textarea name="message" class="w-full px-4 py-3 rounded-lg text-gray-900" rows="4" placeholder="Votre message..." required></textarea>
                            </div>
                            <button type="submit" class="bg-white/20 text-white px-6 py-3 rounded-lg hover:bg-white/30 transition">Envoyer</button>
                            @if(session('success'))
                                <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </form>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center mr-3">📍</div>
                            <div>
                                <div class="font-semibold">Adresse</div>
                                <div class="text-blue-100">123 Avenue des Voyages, Paris, France</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center mr-3">✉️</div>
                            <div>
                                <div class="font-semibold">Email</div>
                                <div class="text-blue-100">contact@placezo.com</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center mr-3">☎️</div>
                            <div>
                                <div class="font-semibold">Téléphone</div>
                                <div class="text-blue-100">+33 1 23 45 67 89</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-6">
                        <h3
                            class="text-3xl font-bold gradient-text bg-gradient-to-r from-blue-400 via-blue-600 to-indigo-500 bg-clip-text text-transparent">
                            PlaceZo</h3>
                        <div class="ml-2 w-3 h-3 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full pulse-glow">
                        </div>
                    </div>
                    <p class="text-blue-100 leading-relaxed">
                        Découvrez des logements extraordinaires et vivez des expériences uniques partout dans le monde.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Explorer</h4>
                    <ul class="space-y-3 text-blue-100">
                        <li><a href="#"
                                class="hover:text-blue-300 focus:text-blue-400 transition-colors duration-300">Destinations</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-blue-300 focus:text-blue-400 transition-colors duration-300">Expériences</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-blue-300 focus:text-blue-400 transition-colors duration-300">Communauté</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-blue-300 focus:text-blue-400 transition-colors duration-300">Blog</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Support</h4>
                    <ul class="space-y-3 text-blue-100">
                        <li><a href="#"
                                class="hover:text-blue-300 focus:text-blue-400 transition-colors duration-300">Centre
                                d'aide</a></li>
                        <li><a href="#"
                                class="hover:text-blue-300 focus:text-blue-400 transition-colors duration-300">Sécurité</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-blue-300 focus:text-blue-400 transition-colors duration-300">Contact</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-blue-300 focus:text-blue-400 transition-colors duration-300">Urgences</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Légal</h4>
                    <ul class="space-y-3 text-blue-100">
                        <li><a href="#"
                                class="hover:text-blue-300 focus:text-blue-400 transition-colors duration-300">Conditions</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-blue-300 focus:text-blue-400 transition-colors duration-300">Confidentialité</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-blue-300 focus:text-blue-400 transition-colors duration-300">Cookies</a>
                        </li>
                        <li><a href="#"
                                class="hover:text-blue-300 focus:text-blue-400 transition-colors duration-300">Accessibilité</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-blue-800 mt-12 pt-8 text-center">
                <p class="text-blue-200">&copy; 2024 PlaceZo. Créé avec amour pour les voyageurs du monde entier.</p>
            </div>
        </div>
    </footer>

    <script>
        // Animation au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-up');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-up').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>
