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
                --primary-color: #4F46E5;
                --secondary-color: #3B82F6;
                --success-color: #10B981;
                --warning-color: #F59E0B;
                --danger-color: #EF4444;
                --light-color: #F9FAFB;
                --dark-color: #111827;
                --gray-color: #6B7280;
                --sidebar-width: 280px;
                --sidebar-collapsed-width: 70px;
                --topbar-height: 70px;
                --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.04), 0 1px 3px rgba(0, 0, 0, 0.08);
                --transition-speed: 0.3s;
                --primary-gradient: linear-gradient(135deg, #4F46E5, #3B82F6);
                --danger-gradient: linear-gradient(135deg, #EF4444, #DC2626);
            }
            
            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                min-height: 100vh;
                overflow-x: hidden;
            }
            
            /* Layout */
            .wrapper {
                display: flex;
                min-height: 100vh;
            }
            
            /* Sidebar */
            .sidebar {
                width: var(--sidebar-width);
                background: white;
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 1000;
                transition: all var(--transition-speed) ease;
                box-shadow: var(--card-shadow);
            }
            
            .sidebar.collapsed {
                width: var(--sidebar-collapsed-width);
            }
            
            .sidebar-header {
                height: var(--topbar-height);
                display: flex;
                align-items: center;
                padding: 0 1.5rem;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }
            
            .logo {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                text-decoration: none;
                color: var(--dark-color);
            }
            
            .logo-icon {
                font-size: 1.75rem;
                color: var(--primary-color);
            }
            
            .logo-text {
                font-size: 1.25rem;
                font-weight: 600;
            }
            
            .sidebar.collapsed .logo-text {
                display: none;
            }
            
            .sidebar-menu {
                padding: 1.5rem 0;
            }
            
            .menu-section {
                margin-bottom: 1.5rem;
            }
            
            .menu-header {
                padding: 0.75rem 1.5rem;
                font-size: 0.75rem;
                text-transform: uppercase;
                color: var(--gray-color);
                font-weight: 600;
                letter-spacing: 0.05em;
            }
            
            .sidebar.collapsed .menu-header {
                display: none;
            }
            
            .menu-item {
                padding: 0.5rem 1.5rem;
            }
            
            .menu-link {
                display: flex;
                align-items: center;
                padding: 0.75rem 1rem;
                color: var(--gray-color);
                text-decoration: none;
                border-radius: 0.5rem;
                transition: all var(--transition-speed) ease;
            }
            
            .menu-link:hover {
                color: var(--primary-color);
                background: rgba(79, 70, 229, 0.05);
            }
            
            .menu-link.active {
                color: var(--primary-color);
                background: rgba(79, 70, 229, 0.1);
                font-weight: 500;
            }
            
            .menu-icon {
                width: 1.5rem;
                font-size: 1.25rem;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 0.75rem;
            }
            
            .sidebar.collapsed .menu-text {
                display: none;
            }
            
            /* Main Content */
            .main-content {
                flex: 1;
                margin-left: var(--sidebar-width);
                padding: 2rem;
                transition: margin var(--transition-speed) ease;
            }
            
            .wrapper.collapsed .main-content {
                margin-left: var(--sidebar-collapsed-width);
            }
            
            /* Topbar */
            .topbar {
                height: var(--topbar-height);
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 2rem;
                margin-bottom: 2rem;
                background: white;
                border-radius: 1rem;
                box-shadow: var(--card-shadow);
            }
            
            .topbar-left {
                display: flex;
                align-items: center;
                gap: 1rem;
            }
            
            .menu-toggle {
                background: none;
                border: none;
                color: var(--gray-color);
                font-size: 1.25rem;
                cursor: pointer;
                width: 2.5rem;
                height: 2.5rem;
                border-radius: 0.5rem;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all var(--transition-speed) ease;
            }
            
            .menu-toggle:hover {
                color: var(--primary-color);
                background: rgba(79, 70, 229, 0.05);
            }
            
            .page-title {
                font-size: 1.25rem;
                font-weight: 600;
                color: var(--dark-color);
                margin: 0;
            }
            
            .topbar-right {
                display: flex;
                align-items: center;
                gap: 1rem;
            }
            
            .user-menu {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.5rem 1rem;
                border-radius: 0.5rem;
                cursor: pointer;
                transition: all var(--transition-speed) ease;
            }
            
            .user-menu:hover {
                background: rgba(79, 70, 229, 0.05);
            }
            
            .user-avatar {
                width: 2rem;
                height: 2rem;
                border-radius: 50%;
                object-fit: cover;
            }
            
            .user-info {
                display: none;
            }
            
            @media (min-width: 768px) {
                .user-info {
                    display: block;
                }
                
                .user-name {
                    font-size: 1rem;
                    font-weight: 600;
                    color: var(--dark-color);
                }
                
                .user-role {
                    font-size: 0.75rem;
                    color: var(--gray-color);
                }
            }
            
            /* Responsive */
            @media (max-width: 991.98px) {
                .sidebar {
                    transform: translateX(-100%);
                }
                
                .sidebar.show {
                    transform: translateX(0);
                }
                
                .main-content {
                    margin-left: 0 !important;
                }
                
                .overlay {
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                }
                
                .overlay.show {
                    display: block;
                }
            }
        </style>
        @yield('styles')
    </head>
    <body>
        <div class="wrapper" id="wrapper">
            <!-- Sidebar -->
            <aside class="sidebar" id="sidebar">
                <div class="sidebar-header">
                    <a href="/" class="logo">
                        <i class="fas fa-wallet logo-icon"></i>
                        <span class="logo-text">MoneyMind</span>
                    </a>
                </div>

                <nav class="sidebar-menu">
                    <div class="menu-section">
                        <div class="menu-header">Menu Principal</div>
                        <div class="menu-item">
                            <a href="/User/dashboard" class="menu-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                <i class="fas fa-home menu-icon"></i>
                                <span class="menu-text">Tableau de bord</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="/expenses/index" class="menu-link {{ request()->is('expenses*') ? 'active' : '' }}">
                                <i class="fas fa-receipt menu-icon"></i>
                                <span class="menu-text">Dépenses</span>
                            </a>
                        </div>
                 
                   
                        <div class="menu-item">
                            <a href="/wishlist" class="menu-link {{ request()->is('wishlist*') ? 'active' : '' }}">
                                <i class="fas fa-heart menu-icon"></i>
                                <span class="menu-text">Liste de Souhaits</span>
                            </a>
                        </div>
                    </div>

                    <div class="menu-section">
                        <div class="menu-header">Analyses</div>
                        <div class="menu-item">
                            <a href="/reports" class="menu-link {{ request()->is('reports*') ? 'active' : '' }}">
                                <i class="fas fa-chart-line menu-icon"></i>
                                <span class="menu-text">Rapports</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="/profile" class="menu-link {{ request()->is('profile*') ? 'active' : '' }}">
                                <i class="fas fa-user menu-icon"></i>
                                <span class="menu-text">Profile</span>
                            </a>
                        </div>
                    </div>

                </nav>
            </aside>

            <!-- Overlay -->
            <div class="overlay" id="overlay"></div>

            <!-- Main Content -->
            <main class="main-content">
                <!-- Topbar -->
                <div class="topbar">
                    <div class="topbar-left">
                        <button class="menu-toggle" id="menuToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="page-title">@yield('title', 'Tableau de bord')</h1>
                    </div>
                    <div class="topbar-right">
                        <div class="user-menu">
                            <div class="user-info">
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <div class="user-role">{{ Auth::user()->role }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page Content -->
                @yield('content')
            </main>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Custom JS -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const wrapper = document.getElementById('wrapper');
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                const menuToggle = document.getElementById('menuToggle');

                // Toggle sidebar
                menuToggle.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        sidebar.classList.toggle('show');
                        overlay.classList.toggle('show');
                    } else {
                        wrapper.classList.toggle('collapsed');
                        sidebar.classList.toggle('collapsed');
                    }
                });

                // Hide sidebar when clicking overlay
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });

                // Handle window resize
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 992) {
                        sidebar.classList.remove('show');
                        overlay.classList.remove('show');
                    }
                });
            });
        </script>

        @yield('scripts')
    </body>
</html>
