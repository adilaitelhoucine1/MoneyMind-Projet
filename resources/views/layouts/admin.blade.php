<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyMind Admin - Gestion Financière Intelligente</title>
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
            --admin-primary: #3a0ca3;
            --admin-secondary: #4361ee;
            --admin-accent: #f72585;
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
        
        /* Admin Sidebar */
        .admin-sidebar {
            width: var(--sidebar-width);
            background-color: var(--dark-color);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            transition: all 0.3s;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--gray-color) transparent;
        }
        
        .admin-sidebar::-webkit-scrollbar {
            width: 4px;
        }
        
        .admin-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .admin-sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
        }
        
        .admin-sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        .admin-sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .admin-brand {
            display: flex;
            align-items: center;
            color: var(--light-color);
            text-decoration: none;
            font-weight: 700;
            font-size: 1.5rem;
            transition: all 0.3s;
        }
        
        .admin-brand:hover {
            color: var(--admin-accent);
        }
        
        .admin-brand .logo-icon {
            color: var(--admin-accent);
            font-size: 1.8rem;
            margin-right: 10px;
        }
        
        .admin-sidebar.collapsed .admin-brand .brand-text {
            display: none;
        }
        
        .admin-sidebar-toggle {
            background: transparent;
            border: none;
            color: var(--light-color);
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .admin-sidebar-toggle:hover {
            color: var(--admin-accent);
        }
        
        .admin-menu {
            padding: 1rem 0;
        }
        
        .admin-menu-label {
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 600;
            margin-top: 1rem;
        }
        
        .admin-sidebar.collapsed .admin-menu-label {
            display: none;
        }
        
        .admin-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .admin-nav-item {
            position: relative;
        }
        
        .admin-nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .admin-nav-link:hover {
            color: var(--light-color);
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        .admin-nav-link.active {
            color: var(--light-color);
            background-color: rgba(255, 255, 255, 0.05);
            border-left-color: var(--admin-accent);
        }
        
        .admin-nav-icon {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
            margin-right: 10px;
            color: inherit;
        }
        
        .admin-sidebar.collapsed .admin-nav-text {
            display: none;
        }
        
        .admin-sidebar.collapsed .admin-nav-link {
            padding: 0.75rem;
            justify-content: center;
        }
        
        .admin-sidebar.collapsed .admin-nav-icon {
            margin-right: 0;
            font-size: 1.3rem;
        }
        
        .admin-sidebar-profile {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }
        
        .admin-profile-info {
            display: flex;
            align-items: center;
        }
        
        .admin-profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid var(--admin-accent);
        }
        
        .admin-sidebar.collapsed .admin-profile-details {
            display: none;
        }
        
        .admin-profile-name {
            color: var(--light-color);
            font-weight: 600;
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        
        .admin-profile-role {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.8rem;
            margin-bottom: 0;
        }
        
        /* Main Content */
        .admin-main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .wrapper.collapsed .admin-main-content {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        /* Admin Topbar */
        .admin-topbar {
            height: var(--topbar-height);
            background-color: var(--light-color);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }
        
        .admin-page-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0;
            color: var(--dark-color);
        }
        
        .admin-topbar-right {
            display: flex;
            align-items: center;
        }
        
        .admin-topbar-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-color);
            font-size: 1.1rem;
            margin-left: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }
        
        .admin-topbar-icon:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: var(--admin-primary);
        }
        
        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: var(--admin-accent);
            color: white;
            font-size: 0.7rem;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }
        
        /* Admin Content */
        .admin-content {
            padding: 1.5rem;
            flex: 1;
        }
        
        /* Responsive */
        @media (max-width: 991.98px) {
            .admin-sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }
            
            .admin-sidebar.collapsed {
                margin-left: 0;
                width: var(--sidebar-width);
            }
            
            .admin-sidebar.collapsed .admin-brand .brand-text,
            .admin-sidebar.collapsed .admin-menu-label,
            .admin-sidebar.collapsed .admin-nav-text,
            .admin-sidebar.collapsed .admin-profile-details {
                display: block;
            }
            
            .admin-sidebar.collapsed .admin-nav-link {
                padding: 0.75rem 1.5rem;
                justify-content: flex-start;
            }
            
            .admin-sidebar.collapsed .admin-nav-icon {
                margin-right: 10px;
                font-size: 1.1rem;
            }
            
            .admin-main-content {
                margin-left: 0;
            }
            
            .wrapper.collapsed .admin-main-content {
                margin-left: 0;
            }
            
            .admin-sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }
            
            .admin-sidebar-overlay.active {
                display: block;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="wrapper" id="wrapper">
        <!-- Admin Sidebar -->
        <nav class="admin-sidebar" id="adminSidebar">
            <div class="admin-sidebar-header">
                <a href="#" class="admin-brand">
                    <i class="fas fa-chart-pie logo-icon"></i>
                    <span class="brand-text">MoneyMind Admin</span>
                </a>
                <button class="admin-sidebar-toggle" id="adminSidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <div class="admin-menu">
                <div class="admin-menu-label">
                    <span>Tableau de bord</span>
                </div>
                <ul class="admin-nav">
                    <li class="admin-nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="admin-nav-link active">
                            <i class="fas fa-tachometer-alt admin-nav-icon"></i>
                            <span class="admin-nav-text">Vue d'ensemble</span>
                        </a>
                    </li>
                </ul>
                
                <div class="admin-menu-label">
                    <span>Gestion</span>
                </div>
                <ul class="admin-nav">
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <i class="fas fa-users admin-nav-icon"></i>
                            <span class="admin-nav-text">Utilisateurs</span>
                        </a>
                    </li>
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <i class="fas fa-tags admin-nav-icon"></i>
                            <span class="admin-nav-text">Catégories</span>
                        </a>
                    </li>
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <i class="fas fa-exchange-alt admin-nav-icon"></i>
                            <span class="admin-nav-text">Transactions</span>
                        </a>
                    </li>
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <i class="fas fa-bullseye admin-nav-icon"></i>
                            <span class="admin-nav-text">Objectifs</span>
                        </a>
                    </li>
                </ul>
                
                <div class="admin-menu-label">
                    <span>Système</span>
                </div>
                <ul class="admin-nav">
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <i class="fas fa-cog admin-nav-icon"></i>
                            <span class="admin-nav-text">Paramètres</span>
                        </a>
                    </li>
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <i class="fas fa-bell admin-nav-icon"></i>
                            <span class="admin-nav-text">Notifications</span>
                        </a>
                    </li>
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <i class="fas fa-file-alt admin-nav-icon"></i>
                            <span class="admin-nav-text">Rapports</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="admin-sidebar-profile">
                <div class="admin-profile-info">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=3a0ca3&color=fff" alt="Admin" class="admin-profile-img">
                    <div class="admin-profile-details">
                        <p class="admin-profile-name">Admin</p>
                        <p class="admin-profile-role">Administrateur</p>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Sidebar Overlay -->
        <div id="adminSidebarOverlay" class="admin-sidebar-overlay"></div>
        
        <!-- Main Content -->
        <div class="admin-main-content">
            <!-- Top Bar -->
            <div class="admin-topbar">
                <h4 class="admin-page-title">Tableau de Bord</h4>
                
                <div class="admin-topbar-right">
                    <div class="admin-topbar-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="admin-topbar-icon">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    <div class="admin-topbar-icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                </div>
            </div>
            
            <!-- Content Area -->
            <div class="admin-content">
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
            const adminSidebar = document.getElementById('adminSidebar');
            const wrapper = document.getElementById('wrapper');
            const adminSidebarToggle = document.getElementById('adminSidebarToggle');
            const adminSidebarOverlay = document.getElementById('adminSidebarOverlay');
            
            adminSidebarToggle.addEventListener('click', function() {
                adminSidebar.classList.toggle('collapsed');
                wrapper.classList.toggle('collapsed');
                
                if (window.innerWidth < 992) {
                    adminSidebarOverlay.classList.toggle('active');
                }
            });
            
            adminSidebarOverlay.addEventListener('click', function() {
                adminSidebar.classList.remove('collapsed');
                adminSidebarOverlay.classList.remove('active');
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    adminSidebarOverlay.classList.remove('active');
                }
            });
        });
    </script>
    
    <!-- Additional scripts -->
    @yield('scripts')
</body>
</html> 