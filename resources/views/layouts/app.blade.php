<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MoneyMind - Gestion Financière Intelligente</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- Custom CSS -->
        <style>
            :root {
                --primary-color: #3a86ff;
                --secondary-color: #8338ec;
                --accent-color: #ff006e;
                --success-color: #06d6a0;
                --warning-color: #ffbe0b;
                --danger-color: #ef476f;
                --light-color: #ffffff;
                --dark-color: #1a1a2e;
                --gray-color: #6c757d;
                --sidebar-width: 260px;
                --sidebar-collapsed-width: 70px;
                --topbar-height: 60px;
                --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.04), 0 1px 3px rgba(0, 0, 0, 0.08);
                --background-color: #f8f9fa;
                --card-bg: #ffffff;
                --text-color: #212529;
                --text-secondary: #6c757d;
            }
            
            body {
                font-family: 'Poppins', sans-serif;
                background-color: var(--background-color);
                color: var(--text-color);
                overflow-x: hidden;
                min-height: 100vh;
            }
            
            /* Layout */
            .wrapper {
                display: flex;
                width: 100%;
                min-height: 100vh;
            }
            
            /* Sidebar */
            .sidebar {
                width: var(--sidebar-width);
                background-color: var(--light-color);
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 1000;
                transition: all 0.3s;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
                overflow-y: auto;
                scrollbar-width: thin;
                scrollbar-color: var(--gray-color) transparent;
            }
            
            .sidebar::-webkit-scrollbar {
                width: 4px;
            }
            
            .sidebar::-webkit-scrollbar-track {
                background: transparent;
            }
            
            .sidebar::-webkit-scrollbar-thumb {
                background-color: var(--gray-color);
                border-radius: 20px;
            }
            
            .sidebar.collapsed {
                width: var(--sidebar-collapsed-width);
            }
            
            .sidebar-header {
                padding: 20px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }
            
            .sidebar-brand {
                display: flex;
                align-items: center;
                color: var(--dark-color);
                text-decoration: none;
                font-weight: 700;
                font-size: 1.5rem;
                transition: all 0.3s;
            }
            
            .sidebar-brand:hover {
                color: var(--primary-color);
            }
            
            .sidebar-brand .logo-icon {
                color: var(--primary-color);
                font-size: 1.8rem;
                margin-right: 10px;
            }
            
            .sidebar.collapsed .sidebar-brand .brand-text {
                display: none;
            }
            
            .sidebar-toggle {
                background: transparent;
                border: none;
                color: var(--gray-color);
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s;
            }
            
            .sidebar-toggle:hover {
                color: var(--primary-color);
                background-color: rgba(58, 134, 255, 0.1);
            }
            
            .sidebar-menu {
                padding: 20px 0;
            }
            
            .menu-label {
                color: var(--gray-color);
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
                padding: 10px 20px;
                margin-top: 15px;
            }
            
            .sidebar.collapsed .menu-label {
                text-align: center;
                padding: 10px 0;
            }
            
            .sidebar.collapsed .menu-label span {
                display: none;
            }
            
            .nav-item {
                position: relative;
                margin: 5px 15px;
                border-radius: 8px;
                overflow: hidden;
                transition: all 0.3s;
            }
            
            .nav-link {
                display: flex;
                align-items: center;
                color: var(--text-color);
                padding: 12px 15px;
                border-radius: 8px;
                transition: all 0.3s;
                position: relative;
                z-index: 1;
            }
            
            .nav-link i {
                min-width: 24px;
                margin-right: 10px;
                font-size: 1.1rem;
                text-align: center;
                transition: all 0.3s;
                color: var(--gray-color);
            }
            
            .nav-link span {
                transition: all 0.3s;
            }
            
            .sidebar.collapsed .nav-link span {
                display: none;
            }
            
            .sidebar.collapsed .nav-link {
                padding: 12px 0;
                justify-content: center;
            }
            
            .sidebar.collapsed .nav-link i {
                margin-right: 0;
                font-size: 1.2rem;
            }
            
            .nav-link:hover {
                color: var(--primary-color);
                background-color: rgba(58, 134, 255, 0.1);
            }
            
            .nav-link:hover i {
                color: var(--primary-color);
            }
            
            .nav-link.active {
                color: var(--primary-color);
                background-color: rgba(58, 134, 255, 0.1);
                font-weight: 500;
            }
            
            .nav-link.active i {
                color: var(--primary-color);
            }
            
            .nav-link.active::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                width: 4px;
                background-color: var(--primary-color);
                border-radius: 0 4px 4px 0;
            }
            
            .sidebar.collapsed .nav-link.active::before {
                display: none;
            }
            
            .sidebar-profile {
                padding: 15px;
                margin: 15px;
                border-top: 1px solid rgba(0, 0, 0, 0.05);
            }
            
            .profile-info {
                display: flex;
                align-items: center;
            }
            
            .profile-img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                object-fit: cover;
                margin-right: 10px;
            }
            
            .sidebar.collapsed .profile-details {
                display: none;
            }
            
            .profile-name {
                font-weight: 600;
                margin-bottom: 0;
                font-size: 0.9rem;
                color: var(--dark-color);
            }
            
            .profile-role {
                font-size: 0.75rem;
                color: var(--gray-color);
                margin-bottom: 0;
            }
            
            /* Main Content */
            .main-content {
                width: calc(100% - var(--sidebar-width));
                margin-left: var(--sidebar-width);
                transition: all 0.3s;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            
            .wrapper.collapsed .main-content {
                width: calc(100% - var(--sidebar-collapsed-width));
                margin-left: var(--sidebar-collapsed-width);
            }
            
            /* Top Bar */
            .topbar {
                height: var(--topbar-height);
                background-color: var(--light-color);
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 20px;
                position: sticky;
                top: 0;
                z-index: 999;
            }
            
            .page-title {
                font-weight: 600;
                margin-bottom: 0;
                font-size: 1.2rem;
            }
            
            .topbar-right {
                display: flex;
                align-items: center;
            }
            
            .topbar-icon {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--gray-color);
                margin-left: 10px;
                cursor: pointer;
                transition: all 0.3s;
                position: relative;
            }
            
            .topbar-icon:hover {
                color: var(--primary-color);
                background-color: rgba(58, 134, 255, 0.1);
            }
            
            .notification-badge {
                position: absolute;
                top: 5px;
                right: 5px;
                width: 18px;
                height: 18px;
                border-radius: 50%;
                background-color: var(--danger-color);
                color: white;
                font-size: 0.7rem;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
            }
            
            /* Content */
            .content {
                flex: 1;
                padding: 20px;
            }
            
            /* Sidebar Overlay */
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
                transition: all 0.3s;
            }
            
            .sidebar-overlay.active {
                display: block;
            }
            
            /* Responsive */
            @media (max-width: 991.98px) {
                .sidebar {
                    margin-left: calc(-1 * var(--sidebar-width));
                }
                
                .sidebar.collapsed {
                    margin-left: 0;
                    width: var(--sidebar-width);
                }
                
                .main-content {
                    width: 100%;
                    margin-left: 0;
                }
                
                .wrapper.collapsed .main-content {
                    width: 100%;
                    margin-left: 0;
                }
            }
        </style>
        @yield('styles')
    </head>
    <body>
        <div id="wrapper" class="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar" class="sidebar">
                <div class="sidebar-header">
                    <a href="#" class="sidebar-brand">
                        <i class="fas fa-wallet logo-icon"></i>
                        <span class="brand-text">MoneyMind</span>
                    </a>
                    <button id="sidebarToggle" class="sidebar-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                
                <div class="sidebar-menu">
                    <div class="menu-label">
                        <span>Menu Principal</span>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="fas fa-home"></i>
                                <span>Tableau de Bord</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-exchange-alt"></i>
                                <span>Transactions</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-chart-pie"></i>
                                <span>Budget</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Dépenses Récurrentes</span>
                            </a>
                        </li>
                    </ul>
                    
                    <div class="menu-label">
                        <span>Objectifs</span>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-bullseye"></i>
                                <span>Objectifs d'Épargne</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-gift"></i>
                                <span>Liste de Souhaits</span>
                            </a>
                        </li>
                    </ul>
                    
                    <div class="menu-label">
                        <span>Paramètres</span>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user-circle"></i>
                                <span>Profil</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-cog"></i>
                                <span>Paramètres</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-bell"></i>
                                <span>Notifications</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="sidebar-profile">
                    <div class="profile-info">
                        <img src="data:image/png;base64,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" alt="User" class="profile-img">
                        <div class="profile-details">
                            <p class="profile-name">{{ Auth::user()->name }}</p>
                            <p class="profile-role">Utilisateur</p>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Sidebar Overlay -->
            <div id="sidebarOverlay" class="sidebar-overlay"></div>
            
            <!-- Main Content -->
            <div class="main-content">
                <!-- Top Bar -->
                <div class="topbar">
                    <h4 class="page-title">Tableau de Bord</h4>
                    
                    <div class="topbar-right">
                        <div class="topbar-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="topbar-icon">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </div>
                        <div class="topbar-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Content Area -->
                <div class="content">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Sidebar Toggle Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sidebar = document.getElementById('sidebar');
                const wrapper = document.getElementById('wrapper');
                const sidebarToggle = document.getElementById('sidebarToggle');
                const sidebarOverlay = document.getElementById('sidebarOverlay');
                
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    wrapper.classList.toggle('collapsed');
                    
                    if (window.innerWidth < 992) {
                        sidebarOverlay.classList.toggle('active');
                    }
                });
                
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('collapsed');
                    sidebarOverlay.classList.remove('active');
                });
                
                // Handle window resize
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 992) {
                        sidebarOverlay.classList.remove('active');
                    }
                });
            });
        </script>
        
        <!-- Additional scripts -->
        @yield('scripts')
    </body>
</html>
