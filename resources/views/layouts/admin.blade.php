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
            --primary-gradient: linear-gradient(135deg, #4F46E5, #7C3AED);
            --secondary-gradient: linear-gradient(135deg, #2563EB, #1D4ED8);
            --success-gradient: linear-gradient(135deg, #059669, #047857);
            --danger-gradient: linear-gradient(135deg, #DC2626, #B91C1C);
            --warning-gradient: linear-gradient(135deg, #D97706, #B45309);
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --topbar-height: 70px;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: 1px solid rgba(255, 255, 255, 0.18);
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
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
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-right: var(--glass-border);
            box-shadow: var(--glass-shadow);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            scrollbar-width: thin;
        }
        
        .admin-sidebar-header {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .admin-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }
        
        .brand-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1F2937;
        }
        
        .admin-menu {
            padding: 1.5rem 0;
        }
        
        .admin-menu-label {
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #6B7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .admin-nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: #4B5563;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0 50px 50px 0;
            margin: 0.25rem 0;
            margin-right: 1rem;
        }
        
        .admin-nav-link:hover {
            background: rgba(99, 102, 241, 0.08);
            color: #4F46E5;
        }
        
        .admin-nav-link.active {
            background: var(--primary-gradient);
            color: white;
        }
        
        .admin-nav-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }
        
        .admin-nav-text {
            font-weight: 500;
        }
        
        .admin-sidebar-profile {
            padding: 1.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            margin-top: auto;
        }
        
        .admin-profile-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-radius: 16px;
            background: rgba(99, 102, 241, 0.05);
        }
        
        .admin-profile-img {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            object-fit: cover;
        }
        
        .admin-profile-name {
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 0.25rem;
        }
        
        .admin-profile-role {
            font-size: 0.875rem;
            color: #6B7280;
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
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-bottom: var(--glass-border);
            display: flex;
            align-items: center;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
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
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4B5563;
            background: transparent;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }
        
        .admin-topbar-icon:hover {
            background: rgba(99, 102, 241, 0.08);
            color: #4F46E5;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger-gradient);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Responsive */
        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.collapsed {
                transform: translateX(0);
            }
            
            .admin-main-content {
                margin-left: 0 !important;
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
                <div class="admin-menu-label">Menu Principal</div>
                <ul class="admin-nav">
                    <li class="admin-nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <span class="admin-nav-icon"><i class="fas fa-chart-pie"></i></span>
                            <span class="admin-nav-text">Tableau de bord</span>
                        </a>
                    </li>
                    <li class="admin-nav-item">
                        <a href="{{ route('admin.users') }}" class="admin-nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                            <span class="admin-nav-icon"><i class="fas fa-users"></i></span>
                            <span class="admin-nav-text">Utilisateurs</span>
                        </a>
                    </li>
                    <li class="admin-nav-item">
                        <a href="{{ route('admin.categories') }}" class="admin-nav-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                            <span class="admin-nav-icon"><i class="fas fa-tags"></i></span>
                            <span class="admin-nav-text">Catégories</span>
                        </a>
                    </li>
                </ul>
                
                <div class="admin-menu-label">Transactions</div>
                <ul class="admin-nav">
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <span class="admin-nav-icon"><i class="fas fa-arrow-down"></i></span>
                            <span class="admin-nav-text">Dépenses</span>
                        </a>
                    </li>
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <span class="admin-nav-icon"><i class="fas fa-arrow-up"></i></span>
                            <span class="admin-nav-text">Revenus</span>
                        </a>
                    </li>
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <span class="admin-nav-icon"><i class="fas fa-exchange-alt"></i></span>
                            <span class="admin-nav-text">Transferts</span>
                        </a>
                    </li>
                </ul>
                
                <div class="admin-menu-label">Rapports</div>
                <ul class="admin-nav">
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <span class="admin-nav-icon"><i class="fas fa-chart-line"></i></span>
                            <span class="admin-nav-text">Statistiques</span>
                        </a>
                    </li>
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <span class="admin-nav-icon"><i class="fas fa-file-alt"></i></span>
                            <span class="admin-nav-text">Rapports</span>
                        </a>
                    </li>
                </ul>
                
                <div class="admin-menu-label">Paramètres</div>
                <ul class="admin-nav">
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <span class="admin-nav-icon"><i class="fas fa-cog"></i></span>
                            <span class="admin-nav-text">Configuration</span>
                        </a>
                    </li>
                    <li class="admin-nav-item">
                        <a href="#" class="admin-nav-link">
                            <span class="admin-nav-icon"><i class="fas fa-bell"></i></span>
                            <span class="admin-nav-text">Notifications</span>
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
                    <a href="{{ route('logout') }}" class="admin-topbar-icon">
                        <div>
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                    </a>
                    
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
</html> 
