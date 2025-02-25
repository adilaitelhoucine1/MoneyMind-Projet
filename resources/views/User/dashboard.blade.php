@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-primary">MoneyMind Dashboard</h1>
    
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Financial Overview</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <h6 class="text-muted">Monthly Income</h6>
                            <h3 class="text-success">5,000 DH</h3>
                            <p class="text-muted small">Next credit: 10th of the month</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <h6 class="text-muted">Remaining Budget</h6>
                            <h3 class="text-primary">3,200 DH</h3>
                            <div class="progress mt-2" style="height: 10px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 64%;" aria-valuenow="64" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <h6 class="text-muted">Total Spent</h6>
                            <h3 class="text-danger">1,800 DH</h3>
                            <p class="text-muted small">36% of monthly income</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Dashboard Content -->
    <div class="row">
        <!-- Left Column -->
        <div class="col-md-8">
            <!-- Expense Categories -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Expense Categories</h5>
                    <button class="btn btn-sm btn-light">Add Expense</button>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <canvas id="expenseChart" width="400" height="200"></canvas>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>% of Budget</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Housing</td>
                                    <td>1,000 DH</td>
                                    <td>20%</td>
                                    <td><span class="badge bg-success">Good</span></td>
                                </tr>
                                <tr>
                                    <td>Entertainment</td>
                                    <td>600 DH</td>
                                    <td>12%</td>
                                    <td><span class="badge bg-warning">Warning</span></td>
                                </tr>
                                <tr>
                                    <td>Food</td>
                                    <td>200 DH</td>
                                    <td>4%</td>
                                    <td><span class="badge bg-success">Good</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Recent Transactions -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Recent Transactions</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Game Purchase</h6>
                                <small class="text-danger">-600 DH</small>
                            </div>
                            <p class="mb-1">Entertainment</p>
                            <small class="text-muted">3 days ago</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Rent Payment</h6>
                                <small class="text-danger">-1,000 DH</small>
                            </div>
                            <p class="mb-1">Housing</p>
                            <small class="text-muted">7 days ago</small>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">Grocery Shopping</h6>
                                <small class="text-danger">-200 DH</small>
                            </div>
                            <p class="mb-1">Food</p>
                            <small class="text-muted">10 days ago</small>
                        </a>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="#" class="btn btn-sm btn-outline-primary">View All Transactions</a>
                </div>
            </div>
        </div>
        
        <!-- Right Column -->
        <div class="col-md-4">
            <!-- AI Suggestion -->
            <div class="card shadow-sm mb-4 border-info">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-robot me-2"></i>AI Suggestion</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Based on your spending habits, you could save more by reducing entertainment expenses. Consider setting a lower budget for games this month.</p>
                </div>
            </div>
            
            <!-- Savings Goals -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Savings Goals</h5>
                    <button class="btn btn-sm btn-light">Add Goal</button>
                </div>
                <div class="card-body">
                    <div class="savings-goal">
                        <div class="goal-icon vacation">
                            <i class="fas fa-umbrella-beach"></i>
                        </div>
                        <div class="goal-details">
                            <h6 class="goal-title">Vacances d'Été</h6>
                            <div class="goal-progress">
                                <div class="goal-progress-bar" style="width: 30%;"></div>
                            </div>
                            <div class="goal-info">
                                <div>300 DH épargnés</div>
                                <div>30%</div>
                            </div>
                        </div>
                        <div class="goal-amount">
                            <div class="goal-target">Objectif: 1 000 DH</div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-sm btn-success">Nouvel Objectif</a>
                    </div>
                </div>
            </div>
            
            <!-- Wishlist -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Wishlist</h5>
                    <button class="btn btn-sm btn-light">Add Item</button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6>New Smartphone</h6>
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-accent" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="small">150 DH épargnés</span>
                            <span class="small">Prix: 1 500 DH</span>
                        </div>
                    </div>
                    
                    <div class="goal-card">
                        <div class="d-flex align-items-center mb-2">
                            <div class="goal-icon entertainment">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            <h6 class="mb-0">Console de Jeux</h6>
                        </div>
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-accent" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="small">100 DH épargnés</span>
                            <span class="small">Prix: 2 000 DH</span>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-sm btn-accent">Ajouter un Article</a>
                    </div>
                </div>
            </div>
            
            <!-- Recurring Expenses -->
            <div class="card finance-card mb-4">
                <div class="card-body">
                    <div class="section-header">
                        <div class="section-icon danger">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h5 class="section-title">Dépenses Récurrentes</h5>
                    </div>
                    
                    <div class="recurring-expense">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="transaction-icon housing">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Loyer</h6>
                                    <p class="text-muted mb-0 small">Mensuel</p>
                                </div>
                            </div>
                            <h6 class="mb-0">1 000 DH</h6>
                        </div>
                    </div>
                    
                    <div class="recurring-expense">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="transaction-icon primary">
                                    <i class="fas fa-wifi"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Internet</h6>
                                    <p class="text-muted mb-0 small">Mensuel</p>
                                </div>
                            </div>
                            <h6 class="mb-0">300 DH</h6>
                        </div>
                    </div>
                    
                    <div class="recurring-expense">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="transaction-icon entertainment">
                                    <i class="fas fa-tv"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Services d'Abonnement</h6>
                                    <p class="text-muted mb-0 small">Mensuel</p>
                                </div>
                            </div>
                            <h6 class="mb-0">150 DH</h6>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary">Gérer les Dépenses Récurrentes</a>
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
        // Expense Chart
        var expenseCtx = document.getElementById('expenseChart').getContext('2d');
        var expenseChart = new Chart(expenseCtx, {
            type: 'doughnut',
            data: {
                labels: ['Logement', 'Divertissement', 'Alimentation', 'Shopping', 'Transport'],
                datasets: [{
                    data: [1000, 600, 200, 350, 150],
                    backgroundColor: [
                        'rgba(127, 90, 240, 0.8)',
                        'rgba(255, 137, 6, 0.8)',
                        'rgba(44, 182, 125, 0.8)',
                        'rgba(229, 49, 112, 0.8)',
                        'rgba(32, 201, 255, 0.8)'
                    ],
                    borderColor: [
                        'rgba(127, 90, 240, 1)',
                        'rgba(255, 137, 6, 1)',
                        'rgba(44, 182, 125, 1)',
                        'rgba(229, 49, 112, 1)',
                        'rgba(32, 201, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                },
                cutout: '70%'
            }
        });
        
        // Income vs Expense Chart
        var incomeExpenseCtx = document.getElementById('incomeExpenseChart').getContext('2d');
        var incomeExpenseChart = new Chart(incomeExpenseCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                datasets: [
                    {
                        label: 'Revenus',
                        data: [4800, 5000, 5000, 5200, 5000, 5000],
                        backgroundColor: 'rgba(44, 182, 125, 0.8)',
                        borderColor: 'rgba(44, 182, 125, 1)',
                        borderWidth: 1,
                        borderRadius: 5,
                        maxBarThickness: 12
                    },
                    {
                        label: 'Dépenses',
                        data: [3500, 3800, 4200, 3900, 4100, 2300],
                        backgroundColor: 'rgba(229, 49, 112, 0.8)',
                        borderColor: 'rgba(229, 49, 112, 1)',
                        borderWidth: 1,
                        borderRadius: 5,
                        maxBarThickness: 12
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 4]
                        },
                        ticks: {
                            callback: function(value) {
                                return value + ' DH';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection

