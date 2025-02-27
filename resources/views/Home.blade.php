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
            overflow-x: hidden;
            --emerald-500: #10b981;
            --emerald-600: #059669;
        }
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            background-color: transparent;
            pointer-events: none;
            opacity: 0.3;
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
            background: radial-gradient(circle at 10% 20%, rgba(236, 253, 245, 0.4) 0%, rgba(209, 250, 229, 0.4) 90%);
        }
        .hero-content {
            background-color: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 3.5rem;
            border-radius: 1.5rem;
            border: 1px solid rgba(229, 231, 235, 0.7);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
        }
        .hero-content:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border-color: rgba(16, 185, 129, 0.5);
        }
        .feature-card {
            transition: all 0.4s ease;
            border-radius: 1.2rem;
            overflow: hidden;
            border: 1px solid rgba(229, 231, 235, 0.7);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);
            position: relative;
            z-index: 1;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent 50%, rgba(16, 185, 129, 0.03) 100%);
            z-index: -1;
            transition: all 0.4s ease;
        }
        .feature-card:hover {
            transform: translateY(-12px) scale(1.03);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
            border-color: rgba(16, 185, 129, 0.4);
        }
        .feature-card:hover::before {
            background: linear-gradient(45deg, transparent 30%, rgba(16, 185, 129, 0.1) 100%);
        }
        .btn-primary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.85rem 2.2rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.4s ease;
            box-shadow: 0 6px 15px rgba(16, 185, 129, 0.25);
            position: relative;
            overflow: hidden;
            z-index: 1;
            border: none;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255,255,255,0.1), rgba(255,255,255,0.4));
            transition: all 0.6s ease;
            z-index: -1;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }
        .btn-primary:hover::before {
            left: 100%;
        }
        .btn-primary:active {
            transform: translateY(-1px);
            box-shadow: 0 5px 10px rgba(16, 185, 129, 0.3);
        }
        .btn-secondary {
            background-color: white;
            color: #374151;
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid rgba(229, 231, 235, 0.7);
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }
        .btn-secondary:hover {
            background-color: #f9fafb;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
        }
        .btn-secondary:active {
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }
        .stats-item {
            position: relative;
            z-index: 1;
            padding: 2.5rem;
            border-radius: 1.2rem;
            background-color: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(5, 150, 105, 0.15);
            overflow: hidden;
        }
        .stats-item::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            opacity: 0;
            transition: all 0.6s ease;
            z-index: -1;
        }
        .stats-item:hover {
            transform: translateY(-8px) scale(1.05);
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(5, 150, 105, 0.25);
        }
        .stats-item:hover::before {
            opacity: 1;
        }
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 1.2rem;
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -0.6rem;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(to right, #10b981, #059669);
            border-radius: 3px;
        }
        /* Glass morphism effect */
        .glassmorphism {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        /* Advanced 3D Card Effects */
        .card-3d {
            transition: transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
            transform-style: preserve-3d;
            perspective: 1000px;
        }
        .card-3d:hover {
            transform: translateY(-10px) rotateX(4deg) rotateY(10deg);
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.15);
        }
        
        /* Glowing button effects */
        .glow-on-hover {
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        .glow-on-hover::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(
                transparent 0deg,
                var(--emerald-500) 30deg,
                var(--emerald-600) 60deg,
                transparent 120deg,
                transparent 180deg,
                var(--emerald-500) 210deg,
                var(--emerald-600) 240deg,
                transparent 300deg
            );
            opacity: 0;
            transform: rotate(0deg);
            transition: opacity 0.6s, transform 15s linear;
            z-index: -1;
        }
        .glow-on-hover:hover::after {
            opacity: 0.15;
            transform: rotate(360deg);
        }
        
        /* Shine effect */
        .shine-effect {
            position: relative;
            overflow: hidden;
        }
        .shine-effect::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.3) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(-45deg) translateY(-100%);
            transition: transform 0.65s cubic-bezier(0.25, 0.1, 0.25, 1);
            pointer-events: none;
        }
        .shine-effect:hover::before {
            transform: rotate(-45deg) translateY(100%);
        }
        
        /* Text reveal animation */
        .text-reveal {
            background: linear-gradient(90deg, var(--emerald-600), var(--emerald-500));
            background-size: 200% 200%;
            animation: gradient-shift 5s ease infinite;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-fill-color: transparent;
        }
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Scroll animations */
        .fade-up {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.6s ease, transform 0.8s ease;
            transition-delay: var(--delay, 0ms);
        }
        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Enhanced hover effects */
        .hover-lift {
            transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .hover-lift:hover {
            transform: translateY(-10px);
        }
        
        /* Enhanced animations */
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-10px) rotate(1deg); }
            50% { transform: translateY(-15px) rotate(0deg); }
            75% { transform: translateY(-5px) rotate(-1deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        
        /* Animated background with moving mesh */
        .mesh-background {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -3;
            opacity: 0.6;
            background-image: 
                radial-gradient(rgba(16, 185, 129, 0.1) 2px, transparent 2px),
                radial-gradient(rgba(139, 92, 246, 0.07) 2px, transparent 2px);
            background-size: 50px 50px;
            background-position: 0 0, 25px 25px;
            animation: mesh-animation 30s linear infinite;
        }
        
        @keyframes mesh-animation {
            0% { background-position: 0 0, 25px 25px; }
            100% { background-position: 50px 50px, 75px 75px; }
        }
        
        /* 3D Floating Elements */
        .floating-3d {
            transform-style: preserve-3d;
            perspective: 1000px;
        }
        .floating-3d-item {
            transform: translateZ(20px);
            transition: transform 0.3s ease;
        }
        .floating-3d:hover .floating-3d-item {
            transform: translateZ(40px) scale(1.05);
        }
        
        /* Neon glow effect */
        .neon-glow {
            position: relative;
        }
        .neon-glow::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: inherit;
            box-shadow: 0 0 15px 2px var(--glow-color, rgba(16, 185, 129, 0.5));
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .neon-glow:hover::after {
            opacity: 1;
        }
        
        /* Enhanced morphing blobs */
        .morphing-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            background: var(--blob-color, linear-gradient(135deg, #10b981, #3b82f6));
            opacity: 0.4;
            animation: morph 15s ease-in-out infinite both alternate;
        }
        @keyframes morph {
            0% { border-radius: 40% 60% 60% 40% / 60% 30% 70% 40%; }
            25% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
            50% { border-radius: 60% 40% 30% 60% / 40% 50% 60% 50%; }
            75% { border-radius: 40% 60% 70% 30% / 60% 40% 50% 40%; }
            100% { border-radius: 40% 60% 60% 40% / 60% 30% 70% 40%; }
        }
        /* Animated gradient background */
        .gradient-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(45deg, #f3f4f6, #f9fafb, #f0fdfa, #ecfdf5);
            background-size: 400% 400%;
            animation: gradient-animation 15s ease infinite;
        }
        @keyframes gradient-animation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        /* Animated grid background */
        .grid-background {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-image: 
                linear-gradient(rgba(16, 185, 129, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(16, 185, 129, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
            z-index: -2;
            animation: grid-movement 20s linear infinite;
        }
        @keyframes grid-movement {
            0% {
                background-position: 0px 0px;
            }
            100% {
                background-position: 30px 30px;
            }
        }
        /* Animated navigation buttons */
        .nav-btn-animate {
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            z-index: 1;
        }
        
        .nav-btn-animate::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255,255,255,0.2), rgba(255,255,255,0));
            transition: all 0.6s ease;
            z-index: -1;
        }
        
        .nav-btn-animate:hover::before {
            left: 100%;
        }
        
        /* Pulsing effect for important buttons */
        .btn-pulse {
            animation: pulse-border 2s infinite;
        }
        
        @keyframes pulse-border {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            }
            70% {
                box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }
        
        /* Enhanced hover transitions */
        .hover-scale {
            transition: transform 0.3s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.05);
        }
        
        /* Animated icon rotation */
        .icon-rotate {
            transition: transform 0.4s ease;
        }
        
        .icon-rotate:hover i {
            transform: rotate(10deg);
        }
        
        /* Static background animation - more efficient than JavaScript */
        .static-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background-color: #f9fafb;
            background-image: 
                radial-gradient(rgba(16, 185, 129, 0.05) 2px, transparent 2px),
                radial-gradient(rgba(59, 130, 246, 0.05) 2px, transparent 2px);
            background-size: 50px 50px;
            background-position: 0 0, 25px 25px;
            animation: static-bg-animation 60s linear infinite;
        }
        
        @keyframes static-bg-animation {
            0% { background-position: 0 0, 25px 25px; }
            100% { background-position: 50px 50px, 75px 75px; }
        }
        
        /* Static animated blobs - pure CSS */
        .static-blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(60px);
            z-index: -3;
            opacity: 0.2;
            animation: static-blob-animation 20s ease-in-out infinite;
        }
        
        .static-blob-1 {
            background: linear-gradient(135deg, #10b981, #3b82f6);
            width: 600px;
            height: 600px;
            top: -300px;
            right: -200px;
            animation-delay: 0s;
        }
        
        .static-blob-2 {
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
            width: 500px;
            height: 500px;
            bottom: -200px;
            left: -100px;
            animation-delay: 5s;
        }
        
        .static-blob-3 {
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            width: 400px;
            height: 400px;
            top: 40%;
            right: 10%;
            animation-delay: 10s;
        }
        
        @keyframes static-blob-animation {
            0% { transform: scale(1) translate(0, 0); }
            33% { transform: scale(1.1) translate(40px, -20px); }
            66% { transform: scale(0.9) translate(-20px, 40px); }
            100% { transform: scale(1) translate(0, 0); }
        }
        
        /* Pre-defined animation classes - no JavaScript required */
        .static-fade-up {
            opacity: 0;
            transform: translateY(30px);
            animation: static-fade-up 1s forwards;
            animation-delay: var(--delay, 0s);
        }
        
        .delay-100 { --delay: 0.1s; }
        .delay-200 { --delay: 0.2s; }
        .delay-300 { --delay: 0.3s; }
        .delay-400 { --delay: 0.4s; }
        .delay-500 { --delay: 0.5s; }
        
        @keyframes static-fade-up {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Static float animation */
        .static-float {
            animation: static-float 6s ease-in-out infinite;
        }
        
        @keyframes static-float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>

<body class="bg-white">
    <!-- Static Background Elements -->
    <div class="static-bg"></div>
    <div class="static-blob static-blob-1"></div>
    <div class="static-blob static-blob-2"></div>
    <div class="static-blob static-blob-3"></div>
    
    <!-- Single particles.js instance with minimal config -->
    <div id="particles-js"></div>
    
    <div class="content-wrapper">
        <header class="bg-white shadow-md border-b border-gray-200 sticky top-0 z-10 glassmorphism">
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold"><span class="text-reveal">Money<span class="text-gray-800">Mind</span></span></h1>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                    @auth
                        @php
                            $dashboardRoute = auth()->user()->role === 'admin' ? route('admin.dashboard') : 
                                              (auth()->user()->role === 'user' ? route('user.dashboard') : route('dashboard'));
                        @endphp
                
                        <a href="{{ $dashboardRoute }}" class="px-5 py-2.5 rounded-lg border border-emerald-500 text-emerald-600 hover:text-white font-medium transition-all duration-300 hover:bg-emerald-500 hover:shadow-lg hover:shadow-emerald-500/30 flex items-center space-x-2 group shine-effect nav-btn-animate hover-scale">
                            <i class="fas fa-tachometer-alt text-lg transition-transform duration-300 group-hover:translate-x-1"></i>
                            <span>Dashboard</span>
                        </a>

                        <form method="get" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-5 py-2.5 rounded-lg border border-red-500 text-red-600 hover:text-white font-medium transition-all duration-300 hover:bg-red-500 hover:shadow-lg hover:shadow-red-500/30 flex items-center space-x-2 group shine-effect nav-btn-animate hover-scale">
                                <i class="fas fa-sign-out-alt text-lg transition-transform duration-300 group-hover:translate-x-1"></i>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-lg border border-emerald-500 text-emerald-600 hover:text-white font-medium transition-all duration-300 hover:bg-emerald-500 hover:shadow-lg hover:shadow-emerald-500/30 flex items-center space-x-2 group shine-effect nav-btn-animate hover-scale">
                            <i class="fas fa-sign-in-alt text-lg transition-transform duration-300 group-hover:translate-x-1"></i>
                            <span>Connexion</span>
                        </a>
                
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-lg border border-emerald-500 text-emerald-600 hover:text-white font-medium transition-all duration-300 hover:bg-emerald-500 hover:shadow-lg hover:shadow-emerald-500/30 flex items-center space-x-2 group shine-effect nav-btn-animate hover-scale">
                                <i class="fas fa-user-plus text-lg transition-transform duration-300 group-hover:translate-x-1"></i>
                                <span>Inscription</span>
                            </a>
                        @endif
                    @endauth
                @endif
                
                
           
                </div>
            </nav>
        </header>

        <main>
            <!-- Hero Section -->
            <div class="relative overflow-hidden hero-section">
                <div class="absolute top-0 right-0 w-6/12 h-full opacity-20">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                        <path fill="#10b981" d="M43.5,-67C57.9,-58.4,72.3,-49.2,79.2,-35.8C86.1,-22.4,85.6,-4.8,81.2,11.1C76.9,27,68.8,41.3,57.2,51.1C45.6,60.9,30.5,66.1,14.5,70.4C-1.5,74.6,-18.4,77.8,-33.3,73.3C-48.1,68.8,-60.9,56.6,-68.6,41.6C-76.3,26.6,-78.9,8.9,-76.9,-8C-74.9,-24.9,-68.4,-41,-57,-52.4C-45.7,-63.9,-29.6,-70.6,-13.8,-72.7C2,-74.8,18.3,-72.2,29.1,-75.6C39.9,-78.9,46.3,-88.1,43.5,-67Z" transform="translate(100 100)" />
                    </svg>
                </div>
                <div class="absolute bottom-0 left-0 w-6/12 h-full opacity-10">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                        <path fill="#059669" d="M38.7,-56.3C51.9,-51.3,65.6,-43.7,72.3,-31.7C79,-19.6,78.8,-3,75.4,12.3C72,27.5,65.4,41.3,54.8,50.7C44.1,60.1,29.5,65,14.3,69.1C-0.9,73.2,-16.8,76.4,-31.5,72.5C-46.2,68.6,-59.7,57.5,-68,43.3C-76.3,29.1,-79.5,11.9,-77.8,-4.4C-76.1,-20.8,-69.6,-36.3,-58.5,-43.9C-47.4,-51.5,-31.8,-51.2,-18.9,-56.3C-6,-61.4,5,-71.9,16.6,-72.4C28.2,-72.9,39.5,-63.5,38.7,-56.3Z" transform="translate(100 100)" />
                    </svg>
                </div>
                <div class="container mx-auto px-6 h-full flex items-center">
                    <div class="grid md:grid-cols-3 w-full gap-8">
                        <div class="md:col-span-2 text-center md:text-left">
                            <div class="hero-content animate-float card-3d shine-effect">
                                <h2 class="text-5xl font-bold text-gray-900 mb-6">
                                    Gérez vos finances avec <span class="text-reveal">intelligence</span>
                                </h2>
                                <p class="text-xl text-gray-600 max-w-3xl mx-auto md:mx-0 mb-10">
                                    Simplifiez votre gestion budgétaire grâce à l'IA et prenez le contrôle de vos finances personnelles
                                </p>
                                <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-5">
                                    <a href="{{ route('register') }}" class="register-btn btn-primary group relative overflow-hidden" style="position: relative; z-index: 5;">
                                        <span class="relative z-10 mr-2">Commencer maintenant</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block transition-transform group-hover:translate-x-1 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                    <a href="#features" class="btn-secondary shine-effect">
                                        En savoir plus
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:flex items-center justify-center">
                            <div class="relative w-64 h-64 floating-3d">
                                <div class="absolute top-0 right-0 w-48 h-48 bg-emerald-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob morphing-blob"></div>
                                <div class="absolute top-0 left-0 w-48 h-48 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000 morphing-blob"></div>
                                <div class="absolute bottom-0 left-20 w-48 h-48 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000 morphing-blob"></div>
                                <div class="relative glassmorphism w-48 h-48 rounded-full flex items-center justify-center floating-3d-item">
                                    <i class="fas fa-wallet text-6xl text-emerald-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Floating elements -->
                <div class="absolute bottom-10 right-10 animate-float" style="animation-delay: 1s;">
                    <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm p-3 rounded-full">
                        <i class="fas fa-chart-line text-emerald-500 text-xl"></i>
                    </div>
                </div>
                <div class="absolute top-20 left-10 animate-float" style="animation-delay: 2s;">
                    <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-sm p-3 rounded-full">
                        <i class="fas fa-dollar-sign text-emerald-500 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div id="features" class="container mx-auto px-6 py-20">
                <div class="text-center mb-16 static-fade-up delay-100" id="features-heading">
                    <span class="inline-block px-3 py-1 text-sm font-medium text-emerald-600 bg-emerald-100 rounded-full mb-3">Fonctionnalités</span>
                    <h3 class="text-3xl font-bold text-gray-900 section-title">Fonctionnalités Principales</h3>
                    <p class="text-gray-600 mt-4">Des outils intelligents pour votre gestion financière</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto mb-20">
                    <div class="feature-card bg-white p-8 rounded-xl shadow-sm overflow-visible group static-fade-up delay-200" id="feature-1">
                        <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-200 transition-all duration-300 transform group-hover:rotate-6 neon-glow" style="--glow-color: rgba(16, 185, 129, 0.4);">
                            <i class="fas fa-chart-pie text-2xl text-emerald-600"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-3">Suivi Budgétaire</h4>
                        <p class="text-gray-600">Suivez automatiquement vos revenus et dépenses en temps réel avec des visualisations claires</p>
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <a href="#" class="text-emerald-600 inline-flex items-center group">
                                <span>Explorer</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="feature-card bg-white p-8 rounded-xl shadow-sm overflow-visible group static-fade-up delay-300" id="feature-2">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-200 transition-all duration-300 transform group-hover:rotate-6 neon-glow" style="--glow-color: rgba(59, 130, 246, 0.4);">
                            <i class="fas fa-robot text-2xl text-blue-600"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-3">IA Prédictive</h4>
                        <p class="text-gray-600">Recevez des suggestions personnalisées pour optimiser vos dépenses et atteindre vos objectifs</p>
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <a href="#" class="text-blue-600 inline-flex items-center group">
                                <span>Explorer</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="feature-card bg-white p-8 rounded-xl shadow-sm overflow-visible group static-fade-up delay-400" id="feature-3">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-purple-200 transition-all duration-300 transform group-hover:rotate-6 neon-glow" style="--glow-color: rgba(139, 92, 246, 0.4);">
                            <i class="fas fa-bell text-2xl text-purple-600"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-900 mb-3">Alertes Intelligentes</h4>
                        <p class="text-gray-600">Soyez notifié des dépassements de budget et des échéances importantes pour rester en contrôle</p>
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <a href="#" class="text-purple-600 inline-flex items-center group">
                                <span>Explorer</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Statistics Section -->
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 py-20 my-20 rounded-2xl shadow-lg static-fade-up delay-500" id="stats-section">
                    <div class="container mx-auto px-6">
                        <div class="grid md:grid-cols-3 gap-12 text-white">
                            <div class="stats-item text-center neon-glow" style="--glow-color: rgba(255, 255, 255, 0.2);">
                                <div class="text-5xl font-bold mb-3 static-float">85%</div>
                                <div class="text-emerald-100 text-lg">Économies réalisées</div>
                            </div>
                            <div class="stats-item text-center neon-glow" style="--glow-color: rgba(255, 255, 255, 0.2);">
                                <div class="text-5xl font-bold mb-3 static-float">10K+</div>
                                <div class="text-emerald-100 text-lg">Utilisateurs actifs</div>
                            </div>
                            <div class="stats-item text-center neon-glow" style="--glow-color: rgba(255, 255, 255, 0.2);">
                                <div class="text-5xl font-bold mb-3 static-float">24/7</div>
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
                    <a href="{{ route('register') }}" class="register-btn inline-block px-10 py-4 bg-white text-emerald-600 rounded-xl hover:bg-emerald-50 transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:-translate-y-1" style="position: relative; z-index: 5;">
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
        // Simplified particle.js configuration with minimal particles for better performance
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure register buttons work properly by adding click handlers
            document.querySelectorAll('.register-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href) {
                        window.location.href = href;
                    }
                });
            });
            
            // Simplified particle config
            const particleConfig = {
                "particles": {
                    "number": {
                        "value": 30, // Reduced number of particles
                        "density": {
                            "enable": true,
                            "value_area": 1500
                        }
                    },
                    "color": {
                        "value": "#10b981"
                    },
                    "shape": {
                        "type": "circle",
                    },
                    "opacity": {
                        "value": 0.3,
                        "random": true,
                        "anim": {
                            "enable": false // Disable animation for better performance
                        }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": {
                            "enable": false // Disable animation for better performance
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#10b981",
                        "opacity": 0.2,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 1, // Slower movement for better performance
                        "direction": "none",
                        "random": false, // Less randomness for better performance
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": false // Disable attraction for better performance
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "grab"
                        },
                        "onclick": {
                            "enable": false // Disable click effects
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 140,
                            "line_linked": {
                                "opacity": 0.3
                            }
                        }
                    }
                },
                "retina_detect": false // Disable retina detection for better performance
            };
            
            // Initialize only one particle system
            particlesJS('particles-js', particleConfig);
            
            // Simplified smooth scroll without intersection observer
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
        });
    </script>
</body>

</html>
