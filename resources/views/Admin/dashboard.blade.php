@extends('layouts.admin')

@section('styles')
<style>
    .dashboard-container {
        padding: 20px;
    }

    .stats-card {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .stats-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .stats-value {
        font-size: 24px;
        font-weight: bold;
        color: #4F46E5;
    }

    .stats-label {
        color: #6B7280;
        font-size: 14px;
    }

    .chart-container {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
<div class="dashboard-container">
    <h1 class="mb-4">Tableau de Bord</h1>

    <!-- Statistiques principales -->
    <div class="row">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-title">Utilisateurs</div>
                <div class="stats-value">{{ $TotalUsers }}</div>
                <div class="stats-label">Total des utilisateurs</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-title">Revenu Moyen</div>
                <div class="stats-value">{{ number_format($RevenuMensuelMoyen, 2) }} DH</div>
                <div class="stats-label">Par utilisateur</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-title">Dépenses</div>
                <div class="stats-value">{{ number_format($TotalDepenses, 2) }} DH</div>
                <div class="stats-label">Total des dépenses</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-title">Épargne</div>
                <div class="stats-value">{{ number_format($TotalEpargne, 2) }} DH</div>
                <div class="stats-label">Total épargné</div>
            </div>
        </div>
    </div>

    <!-- Graphiques simples -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="chart-container">
                <h3>Évolution des Dépenses</h3>
                <canvas id="expensesChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-container">
                <h3>Distribution des Utilisateurs</h3>
                <canvas id="userDistributionChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Graphique des dépenses
        new Chart(document.getElementById('expensesChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($graphiqueDepenses->labels) !!},
                datasets: [{
                    label: 'Dépenses',
                    data: {!! json_encode($graphiqueDepenses->data) !!},
                    borderColor: '#4F46E5',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Distribution des utilisateurs
        new Chart(document.getElementById('userDistributionChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($distributionUtilisateurs->labels) !!},
                datasets: [{
                    data: {!! json_encode($distributionUtilisateurs->data) !!},
                    backgroundColor: ['#4F46E5', '#10B981', '#EF4444']
                }]
            },
            options: {
                responsive: true
            }
        });
    });
</script>
@endsection
