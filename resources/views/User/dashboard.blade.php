@extends('layouts.app')

@section('styles')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366F1, #4F46E5);
        --secondary-gradient: linear-gradient(135deg, #3B82F6, #2563EB);
        --success-gradient: linear-gradient(135deg, #10B981, #059669);
        --danger-gradient: linear-gradient(135deg, #EF4444, #DC2626);
        --warning-gradient: linear-gradient(135deg, #F59E0B, #D97706);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: 1px solid rgba(255, 255, 255, 0.18);
        --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
    }

    body {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
        position: relative;
    }

    .container {
        max-width: 100%;
        overflow-x: hidden;
    }

    .dashboard-header {
        background: var(--primary-gradient);
        border-radius: 24px;
        padding: 2.5rem;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(79, 70, 229, 0.15);
        transition: all 0.3s ease;
    }

    .dashboard-header:hover {
        transform: translateY(-5px);
    }

    .dashboard-header h2 {
        font-weight: 700;
        font-size: 2rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .dashboard-header::before,
    .dashboard-header::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(45deg, rgba(255,255,255,0.15), rgba(255,255,255,0.05));
        animation: pulse 10s infinite;
        pointer-events: none;
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

    .overview-card {
        background: var(--glass-bg);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: var(--glass-border);
        box-shadow: var(--glass-shadow);
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 1.75rem;
        transition: all 0.4s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0));
        opacity: 0;
        transition: all 0.4s ease;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .stat-card:hover::after {
        opacity: 1;
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
        margin-bottom: 1.25rem;
        position: relative;
        overflow: hidden;
    }

    .stat-icon::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255,255,255,0.2), rgba(255,255,255,0));
        animation: shimmer 2s infinite;
        pointer-events: none;
    }

    .stat-icon.income { background: var(--success-gradient); }
    .stat-icon.budget { background: var(--primary-gradient); }
    .stat-icon.expense { background: var(--danger-gradient); }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: -0.5px;
    }

    .stat-label {
        color: #6B7280;
        font-size: 0.9rem;
    }

    .progress {
        height: 8px;
        border-radius: 4px;
        margin: 0.5rem 0;
    }

    .chart-card {
        background: var(--glass-bg);
        border-radius: 24px;
        padding: 1.75rem;
        backdrop-filter: blur(10px);
        border: var(--glass-border);
        box-shadow: var(--glass-shadow);
        margin-bottom: 1.75rem;
        transition: all 0.3s ease;
        min-height: 400px;
    }

    .chart-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(31, 38, 135, 0.2);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.75rem;
    }

    .chart-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1F2937;
        letter-spacing: -0.5px;
    }

    .transaction-list {
        margin-top: 1.5rem;
    }

    .transaction-item {
        display: flex;
        align-items: center;
        padding: 1.25rem;
        border-radius: 16px;
        margin-bottom: 0.75rem;
        transition: all 0.4s ease;
        background: white;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .transaction-item:hover {
        transform: translateX(8px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
    }

    .transaction-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
    }

    .transaction-icon.expense { background: var(--danger-gradient); }
    .transaction-icon.income { background: var(--success-gradient); }

    .transaction-details {
        flex: 1;
    }

    .transaction-title {
        font-weight: 600;
        color: #1F2937;
        margin-bottom: 0.25rem;
    }

    .transaction-category {
        font-size: 0.875rem;
        color: #6B7280;
    }

    .transaction-amount {
        font-weight: 600;
    }

    .amount-expense { color: #DC2626; }
    .amount-income { color: #059669; }

    .goal-card {
        background: white;
        border-radius: 20px;
        padding: 1.75rem;
        margin-bottom: 1rem;
        transition: all 0.4s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .goal-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
    }

    .goal-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-bottom: 1rem;
    }

    .goal-progress {
        height: 8px;
        background: #E5E7EB;
        border-radius: 4px;
        margin: 1.25rem 0;
        overflow: hidden;
    }

    .goal-progress-bar {
        height: 100%;
        background: var(--primary-gradient);
        border-radius: 4px;
        transition: width 0.5s ease;
        position: relative;
        overflow: hidden;
    }

    .goal-progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,0.3), rgba(255,255,255,0));
        animation: shimmer 2s infinite;
        pointer-events: none;
    }

    .goal-info {
        display: flex;
        justify-content: space-between;
        font-size: 0.875rem;
        color: #6B7280;
    }

    .ai-suggestion {
        background: linear-gradient(135deg, #6366F1, #4F46E5);
        border-radius: 20px;
        padding: 1.75rem;
        color: white;
        margin-bottom: 1.75rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(99, 102, 241, 0.2);
        transition: all 0.3s ease;
    }

    .ai-suggestion:hover {
        transform: translateY(-5px);
    }

    .ai-suggestion::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
        animation: shimmer 2s infinite;
        pointer-events: none;
    }

    .ai-suggestion i {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .recurring-expense {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }

    .recurring-expense:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .btn-custom {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
        background: var(--primary-gradient);
        border: none;
        color: white;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(79, 70, 229, 0.3);
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.2); opacity: 0.3; }
        100% { transform: scale(1); opacity: 0.5; }
    }

    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1.75rem;
            margin-bottom: 1.5rem;
        }
        
        .stat-card {
            margin-bottom: 1.25rem;
        }

        .chart-card {
            padding: 1.25rem;
        }
    }

    #expenseChart {
        position: relative;
        width: 100%;
        height: 300px !important;
        margin: 0 auto;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <!-- Salary Management Modal -->
    <div class="modal fade" id="salaryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gérer Mon Salaire</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('Salaire.Store', Auth::id()) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Salaire Mensuel</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="amount" value="{{ Auth::user()->salaire_mensuel ?? ''}}" required>
                                <span class="input-group-text">DH</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date de Crédit</label>
                            <input type="date" class="form-control" name="date_credit" value="{{ Auth::user()->date_credit ?? ''}}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-custom">Enregistrer</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <!-- Add Expense Modal -->
    <div class="modal fade" id="expenseModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une Dépense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/user/expenses/store" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Montant</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="amount" required>
                                <span class="input-group-text">DH</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catégorie</label>
                            <select class="form-select" name="category_id" required>
                                @foreach($categories as $category)
                                
                                <option value="{{$category->id}}">{{$category->nom}}</option>
                                @endforeach
                              
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="isRecurring" name="is_recurring">
                                <label class="form-check-label" for="isRecurring">
                                    Dépense Récurrente
                                </label>
                            </div>
                        </div>
                        <div id="recurringOptions" class="d-none">
                            <div class="mb-3">
                                <label class="form-label">Jour du mois</label>
                                <input type="number" class="form-control" name="recurring_day" min="1" max="31">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-custom">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Budget Alerts Modal -->
    <div class="modal fade" id="alertsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Configurer les Alertes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="/user/alerts/update" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Seuil Global (%)</label>
                            <input type="number" class="form-control" name="global_threshold" min="1" max="100" value="80">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Seuils par Catégorie</label>
                            <div class="input-group mb-2">
                                <span class="input-group-text">Logement</span>
                                <input type="number" class="form-control" name="category_thresholds[1]" value="75" min="1" max="100">
                                <span class="input-group-text">%</span>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">Alimentation</span>
                                <input type="number" class="form-control" name="category_thresholds[2]" value="70" min="1" max="100">
                                <span class="input-group-text">%</span>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">Transport</span>
                                <input type="number" class="form-control" name="category_thresholds[3]" value="80" min="1" max="100">
                                <span class="input-group-text">%</span>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">Loisirs</span>
                                <input type="number" class="form-control" name="category_thresholds[4]" value="60" min="1" max="100">
                                <span class="input-group-text">%</span>
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text">Factures</span>
                                <input type="number" class="form-control" name="category_thresholds[5]" value="85" min="1" max="100">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-custom">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="dashboard-header">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0 capitalize">Bonjour, {{Auth::user()->name}} 👋</h2>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#salaryModal">
                <i class="fas fa-edit me-2"></i>Gérer Salaire
            </button>
        </div>
        <p class="mb-0">Voici un aperçu de vos finances</p>
    </div>

    <!-- Financial Overview -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon income">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-value">{{ Auth::user()->salaire_mensuel }} DH</div>
                <div class="stat-label">Revenu Mensuel</div>
                <small class="text-muted">
                    Prochain crédit: {{ \Carbon\Carbon::parse(Auth::user()->date_credit)->format('d') }} du mois
                </small>
                            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon budget">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div class="stat-value">8,500 DH</div>
                <div class="stat-label">Budget Restant</div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" 
                         style="width: 65%; background: var(--success-gradient)">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon expense">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-value">6,500 DH</div>
                <div class="stat-label">Dépenses Totales</div>
                <small class="text-muted">43% du revenu mensuel</small>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Expense Chart -->
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">Répartition des Dépenses</h5>
                    <div>
                        <button class="btn btn-custom btn-sm me-2" data-bs-toggle="modal" data-bs-target="#alertsModal">
                            <i class="fas fa-bell me-2"></i>Alertes
                        </button>
                        <button class="btn btn-custom btn-sm" data-bs-toggle="modal" data-bs-target="#expenseModal">
                            <i class="fas fa-plus me-2"></i>Ajouter
                        </button>
                    </div>
                </div>
                <canvas id="expenseChart" height="300"></canvas>
            </div>

            <!-- Recent Transactions -->
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">Transactions Récentes</h5>
                    <a href="#" class="btn btn-custom btn-sm">Voir Tout</a>
                </div>
                <div class="transaction-list">
                    <div class="transaction-item">
                        <div class="transaction-icon expense">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="transaction-details">
                            <div class="transaction-title">Courses Alimentaires</div>
                            <div class="transaction-category">Alimentation</div>
                        </div>
                        <div class="transaction-amount amount-expense">-850 DH</div>
                    </div>
                    <div class="transaction-item">
                        <div class="transaction-icon expense">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="transaction-details">
                            <div class="transaction-title">Loyer</div>
                            <div class="transaction-category">Logement</div>
                        </div>
                        <div class="transaction-amount amount-expense">-3000 DH</div>
                    </div>
                    <div class="transaction-item">
                        <div class="transaction-icon expense">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="transaction-details">
                            <div class="transaction-title">Essence</div>
                            <div class="transaction-category">Transport</div>
                        </div>
                        <div class="transaction-amount amount-expense">-400 DH</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- AI Suggestion -->
            <div class="ai-suggestion">
                <i class="fas fa-robot mb-3"></i>
                <h5 class="mb-3">Conseil IA</h5>
                <p class="mb-0">Basé sur vos dépenses, vous pourriez économiser 500 DH par mois en optimisant vos achats alimentaires.</p>
            </div>

            <!-- Savings Goals -->
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">Objectifs d'Épargne</h5>
                    <button class="btn btn-custom btn-sm" data-bs-toggle="modal" data-bs-target="#savingsGoalModal">
                        <i class="fas fa-plus me-2"></i>Ajouter
                    </button>
                </div>

                <div class="goal-card">
                    <div class="d-flex align-items-center">
                        <div class="goal-icon" style="background: var(--primary-gradient)">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Vacances d'été</h6>
                            <small class="text-muted">Objectif: 10,000 DH</small>
                        </div>
                    </div>
                    <div class="goal-progress">
                        <div class="goal-progress-bar" style="width: 60%"></div>
                    </div>
                    <div class="goal-info">
                        <span>6,000 DH épargnés</span>
                        <span>60%</span>
                    </div>
                </div>

                <div class="goal-card">
                    <div class="d-flex align-items-center">
                        <div class="goal-icon" style="background: var(--primary-gradient)">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Nouvelle Voiture</h6>
                            <small class="text-muted">Objectif: 100,000 DH</small>
                        </div>
                    </div>
                    <div class="goal-progress">
                        <div class="goal-progress-bar" style="width: 25%"></div>
                    </div>
                    <div class="goal-info">
                        <span>25,000 DH épargnés</span>
                        <span>25%</span>
                    </div>
                </div>
            </div>

            <!-- Recurring Expenses -->
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">Dépenses Récurrentes</h5>
                </div>

                <div class="recurring-expense">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="transaction-icon expense">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="ms-3">
                                <div class="fw-bold">Loyer</div>
                                <small class="text-muted">Chaque 1 du mois</small>
                            </div>
                        </div>
                        <div class="fw-bold">3,000 DH</div>
                    </div>
                </div>

                <div class="recurring-expense">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="transaction-icon expense">
                                <i class="fas fa-wifi"></i>
                            </div>
                            <div class="ms-3">
                                <div class="fw-bold">Internet</div>
                                <small class="text-muted">Chaque 5 du mois</small>
                            </div>
                        </div>
                        <div class="fw-bold">399 DH</div>
                    </div>
                </div>

                <div class="recurring-expense">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="transaction-icon expense">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="ms-3">
                                <div class="fw-bold">Forfait Mobile</div>
                                <small class="text-muted">Chaque 15 du mois</small>
                            </div>
                        </div>
                        <div class="fw-bold">199 DH</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle recurring expense options
        const isRecurringCheckbox = document.getElementById('isRecurring');
        const recurringOptions = document.getElementById('recurringOptions');
        
        isRecurringCheckbox?.addEventListener('change', function() {
            recurringOptions.classList.toggle('d-none', !this.checked);
        });

        // Expense Chart
        const expenseCtx = document.getElementById('expenseChart').getContext('2d');
        const expenseData = {
            labels: ['Logement', 'Alimentation', 'Transport', 'Loisirs', 'Factures'],
            data: [3000, 2000, 800, 500, 700],
            colors: [
                'rgba(99, 102, 241, 0.8)',
                'rgba(16, 185, 129, 0.8)',
                'rgba(239, 68, 68, 0.8)',
                'rgba(245, 158, 11, 0.8)',
                'rgba(59, 130, 246, 0.8)'
            ]
        };
        
        new Chart(expenseCtx, {
            type: 'doughnut',
            data: {
                labels: expenseData.labels,
                datasets: [{
                    data: expenseData.data,
                    backgroundColor: expenseData.colors,
                    borderWidth: 0,
                    borderRadius: 5,
                    spacing: 5,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: 20
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                size: 12,
                                family: "'Poppins', sans-serif"
                            },
                            color: '#6B7280'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#1F2937',
                        titleFont: {
                            size: 14,
                            family: "'Poppins', sans-serif",
                            weight: '600'
                        },
                        bodyColor: '#6B7280',
                        bodyFont: {
                            size: 12,
                            family: "'Poppins', sans-serif"
                        },
                        padding: 12,
                        boxPadding: 8,
                        borderColor: 'rgba(0, 0, 0, 0.05)',
                        borderWidth: 1,
                        displayColors: true,
                        callbacks: {
                            label: function(context) {
                                let value = context.raw;
                                return context.label + ': ' + value + ' DH';
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endsection

