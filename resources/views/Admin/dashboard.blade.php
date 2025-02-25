@extends('layouts.admin')

@section('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4F46E5, #7C3AED);
        --secondary-gradient: linear-gradient(135deg, #2563EB, #1D4ED8);
        --success-gradient: linear-gradient(135deg, #059669, #047857);
        --danger-gradient: linear-gradient(135deg, #DC2626, #B91C1C);
        --warning-gradient: linear-gradient(135deg, #D97706, #B45309);
        --card-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1);
        --hover-transform: translateY(-5px);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: 1px solid rgba(255, 255, 255, 0.18);
        --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
    }

    body {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .admin-welcome-card {
        background: var(--primary-gradient);
        border-radius: 24px;
        padding: 3rem;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 2.5rem;
        box-shadow: var(--glass-shadow);
        backdrop-filter: blur(10px);
        border: var(--glass-border);
    }

    .admin-welcome-card h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .admin-welcome-card p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .admin-welcome-card::before,
    .admin-welcome-card::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        animation: pulse 10s infinite;
    }

    .admin-welcome-card::before {
        width: 400px;
        height: 400px;
        top: -200px;
        right: -200px;
        animation-delay: 0s;
    }
    
    .admin-welcome-card::after {
        width: 300px;
        height: 300px;
        bottom: -150px;
        left: -150px;
        animation-delay: -5s;
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.2); opacity: 0.3; }
        100% { transform: scale(1); opacity: 0.5; }
    }
    
    .admin-stat-card {
        background: var(--glass-bg);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: var(--glass-border);
        box-shadow: var(--glass-shadow);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .admin-stat-card:hover {
        transform: var(--hover-transform);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .admin-stat-card.users {
        background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%);
    }
    
    .admin-stat-card.revenue {
        background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
    }
    
    .admin-stat-card.inactive {
        background: linear-gradient(135deg, #ffffff 0%, #fef2f2 100%);
    }
    
    .admin-stat-card.categories {
        background: linear-gradient(135deg, #ffffff 0%, #eff6ff 100%);
    }
    
    .admin-stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        font-size: 2rem;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 16px -4px rgba(0, 0, 0, 0.1);
    }

    .admin-stat-icon::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 200%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    .admin-stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.75rem;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1.2;
    }
    
    .admin-stat-label {
        color: #6B7280;
        font-size: 0.95rem;
        font-weight: 500;
    }
    
    .admin-stat-change {
        display: inline-flex;
        align-items: center;
        font-size: 0.9rem;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        margin-top: 0.75rem;
        font-weight: 500;
    }
    
    .admin-stat-change.positive {
        background-color: rgba(16, 185, 129, 0.1);
        color: #059669;
    }
    
    .admin-stat-change.negative {
        background-color: rgba(239, 68, 68, 0.1);
        color: #DC2626;
    }

    .admin-panel {
        background: var(--glass-bg);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: var(--glass-border);
        box-shadow: var(--glass-shadow);
    }

    .admin-panel-header {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .admin-panel-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1F2937;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .admin-panel-title i {
        font-size: 1.25rem;
        padding: 0.75rem;
        border-radius: 12px;
        background: var(--primary-gradient);
        color: white;
    }

    .table {
        border-collapse: separate;
        border-spacing: 0 0.5rem;
    }

    .table thead th {
        background: transparent;
        font-weight: 600;
        color: #4B5563;
        padding: 1.25rem 1rem;
        border: none;
    }

    .table tbody tr {
        background: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .table tbody td {
        padding: 1.25rem 1rem;
        border: none;
    }

    .table tbody td:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    .table tbody td:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 12px -1px rgba(0, 0, 0, 0.15);
    }

    .btn-light {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
    }

    .btn-light:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    .category-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .category-tag {
        background: var(--glass-bg);
        border-radius: 16px;
        padding: 1.25rem;
        backdrop-filter: blur(10px);
        border: var(--glass-border);
        box-shadow: var(--glass-shadow);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .category-tag:hover {
        transform: translateY(-3px) scale(1.02);
    }

    .category-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        font-size: 1.5rem;
        background: var(--primary-gradient);
        box-shadow: 0 8px 16px -4px rgba(79, 70, 229, 0.2);
    }

    .category-name {
        flex: 1;
        font-weight: 500;
        color: #1F2937;
    }

    .category-actions {
        display: flex;
        gap: 0.5rem;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #6B7280;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .action-btn:hover {
        background: #F3F4F6;
        color: #6366F1;
    }

    .chart-container {
        position: relative;
        margin-top: 1rem;
    }

    .modal-content {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        border: var(--glass-border);
        border-radius: 24px;
        box-shadow: var(--glass-shadow);
    }

    .form-control, .form-select {
        border-radius: 12px;
        padding: 0.875rem 1.25rem;
        border: 1px solid rgba(0, 0, 0, 0.08);
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        background: white;
    }

    @media (max-width: 768px) {
        .admin-welcome-card {
            padding: 2rem;
        }

        .admin-welcome-card h2 {
            font-size: 2rem;
        }

        .admin-stat-card {
            padding: 1.5rem;
        }

        .admin-stat-value {
            font-size: 2rem;
        }
    }

    .dashboard-header {
        background: var(--primary-gradient);
        border-radius: 24px;
        padding: 2.5rem;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-header::before,
    .dashboard-header::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        animation: pulse 10s infinite;
    }

    .dashboard-header::before {
        width: 300px;
        height: 300px;
        top: -150px;
        right: -150px;
    }

    .dashboard-header::after {
        width: 200px;
        height: 200px;
        bottom: -100px;
        left: -100px;
        animation-delay: -5s;
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.2); opacity: 0.3; }
        100% { transform: scale(1); opacity: 0.5; }
    }

    .quick-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--glass-bg);
        border-radius: 20px;
        padding: 1.5rem;
        backdrop-filter: blur(10px);
        border: var(--glass-border);
        box-shadow: var(--glass-shadow);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 1rem;
        position: relative;
        overflow: hidden;
    }

    .stat-icon::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 200%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .stat-icon.users { background: var(--primary-gradient); }
    .stat-icon.revenue { background: var(--success-gradient); }
    .stat-icon.expenses { background: var(--danger-gradient); }
    .stat-icon.growth { background: var(--secondary-gradient); }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #6B7280;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .stat-change {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        margin-top: 0.5rem;
    }

    .stat-change.positive {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .stat-change.negative {
        background: rgba(239, 68, 68, 0.1);
        color: #DC2626;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
    }

    .chart-card {
        background: var(--glass-bg);
        border-radius: 20px;
        padding: 1.5rem;
        backdrop-filter: blur(10px);
        border: var(--glass-border);
        box-shadow: var(--glass-shadow);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .chart-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1F2937;
    }

    .chart-actions {
        display: flex;
        gap: 0.5rem;
    }

    .period-selector {
        padding: 0.5rem 1rem;
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        background: white;
        font-size: 0.875rem;
        color: #4B5563;
        cursor: pointer;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 1rem;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 500;
        color: #1F2937;
        margin-bottom: 0.25rem;
    }

    .activity-time {
        font-size: 0.875rem;
        color: #6B7280;
    }

    @media (max-width: 991.98px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="dashboard-header">
        <h2 class="mb-2">Bienvenue, {{ Auth::user()->name }}!</h2>
        <p class="mb-4">Voici un aperçu de vos statistiques financières</p>
        <div class="d-flex gap-3">
            <button class="btn btn-light">
                <i class="fas fa-download me-2"></i>Télécharger le rapport
                                </button>
            <button class="btn btn-light">
                <i class="fas fa-share me-2"></i>Partager
                                </button>
                            </div>
                        </div>
                        
    <div class="quick-stats">
        <div class="stat-card">
            <div class="stat-icon users">
                <i class="fas fa-users"></i>
                            </div>
            <div class="stat-value">1,254</div>
            <div class="stat-label">Utilisateurs actifs</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up me-1"></i>12% ce mois
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon revenue">
                <i class="fas fa-wallet"></i>
                </div>
            <div class="stat-value">45,650 DH</div>
            <div class="stat-label">Revenu total</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up me-1"></i>8% ce mois
                </div>
            </div>
            
        <div class="stat-card">
            <div class="stat-icon expenses">
                <i class="fas fa-shopping-cart"></i>
                </div>
            <div class="stat-value">28,320 DH</div>
            <div class="stat-label">Dépenses totales</div>
            <div class="stat-change negative">
                <i class="fas fa-arrow-up me-1"></i>5% ce mois
    </div>
</div>

        <div class="stat-card">
            <div class="stat-icon growth">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-value">17,330 DH</div>
            <div class="stat-label">Économies</div>
            <div class="stat-change positive">
                <i class="fas fa-arrow-up me-1"></i>15% ce mois
        </div>
    </div>
</div>

    <div class="dashboard-grid">
        <div class="chart-card">
            <div class="chart-header">
                <h5 class="chart-title">Aperçu des dépenses</h5>
                <div class="chart-actions">
                    <select class="period-selector">
                        <option>Cette semaine</option>
                        <option>Ce mois</option>
                        <option>Cette année</option>
                    </select>
            </div>
            </div>
            <div style="height: 300px;">
                <canvas id="expensesChart"></canvas>
    </div>
</div>

        <div class="chart-card">
            <div class="chart-header">
                <h5 class="chart-title">Activités récentes</h5>
            </div>
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon" style="background: var(--primary-gradient)">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Nouvel utilisateur inscrit</div>
                        <div class="activity-time">Il y a 2 heures</div>
                    </div>
            </div>
                <div class="activity-item">
                    <div class="activity-icon" style="background: var(--success-gradient)">
                        <i class="fas fa-money-bill"></i>
            </div>
                    <div class="activity-content">
                        <div class="activity-title">Nouvelle transaction</div>
                        <div class="activity-time">Il y a 4 heures</div>
        </div>
    </div>
                <!-- Add more activity items -->
</div>
            </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Initialize your charts here
    const ctx = document.getElementById('expensesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
            data: {
            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                datasets: [{
                label: 'Dépenses',
                data: [1200, 1900, 1500, 2100, 1800, 2500, 2200],
                borderColor: '#4F46E5',
                backgroundColor: 'rgba(79, 70, 229, 0.1)',
                tension: 0.4,
                fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        drawBorder: false
                    }
                },
                    x: {
                        grid: {
                            display: false
                        }
                }
            }
        }
    });
</script>
@endsection
