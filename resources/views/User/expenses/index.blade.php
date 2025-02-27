@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- En-tête de la page -->
    <div class="expense-header">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="mb-2">Gestion des Dépenses</h2>
                <p class="mb-4">Gérez vos dépenses quotidiennes et récurrentes en un seul endroit</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                    <i class="fas fa-plus me-2"></i>Nouvelle Dépense
                </button>
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addRecurringModal">
                    <i class="fas fa-sync me-2"></i>Nouvelle Récurrence
                </button>
            </div>
        </div>
    </div>

    <!-- Statistiques Globales -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card primary">
                <div class="stat-card-inner">
                    <div class="stat-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-value">4,570 DH</div>
                        <div class="stat-label">Dépenses ce mois</div>
                    </div>
                </div>
                <div class="stat-footer">
                    <span class="text-success">
                        <i class="fas fa-arrow-down me-1"></i>12% vs mois dernier
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card success">
                <div class="stat-card-inner">
                    <div class="stat-icon">
                        <i class="fas fa-sync"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-value">2,850 DH</div>
                        <div class="stat-label">Dépenses Récurrentes</div>
                    </div>
                </div>
                <div class="stat-footer">
                    <span class="text-muted">Mensuel</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card warning">
                <div class="stat-card-inner">
                    <div class="stat-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-value">8</div>
                        <div class="stat-label">Catégories Actives</div>
                    </div>
                </div>
                <div class="stat-footer">
                    <span class="text-primary">Gérer les catégories</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card info">
                <div class="stat-card-inner">
                    <div class="stat-icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-value">1,720 DH</div>
                        <div class="stat-label">Économies Potentielles</div>
                    </div>
                </div>
                <div class="stat-footer">
                    <span class="text-success">Voir les conseils</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Conteneur principal avec les deux sections -->
    <div class="row">
        <!-- Section Dépenses -->
        <div class="col-lg-6">
            <div class="expense-panel">
                <div class="panel-header">
                    <h5><i class="fas fa-receipt me-2"></i>Dépenses Récentes</h5>
                    <div class="panel-actions">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">
                                Ce mois
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Cette semaine</a></li>
                                <li><a class="dropdown-item" href="#">Ce mois</a></li>
                                <li><a class="dropdown-item" href="#">Les 3 derniers mois</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="expense-list">
                    @foreach($Depenses as $depense)
                    <div class="expense-item flex items-center justify-between bg-white p-4 shadow-md rounded-lg mb-2">
                        <div class="flex items-center">
                            <div class="expense-details">
                                <div class="expense-title font-semibold">{{ $depense->nom }}</div>
                                <div class="expense-category text-gray-500 text-sm">{{ $depense->categorie->nom }}</div>
                            </div>
                        </div>
                        <div class="expense-amount text-right">
                            <div class="amount text-red-500 font-bold">-{{ $depense->prix }} DH</div>
                            <div class="date text-gray-400 text-sm">{{ $depense->created_at->format('d F Y') }}</div>
                        </div>
                        <div class="action-buttons">
                           


                            <form action="{{ route('depenses.update', $depense->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="button" 
                                class="action-btn edit-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal{{ $depense->id }}"
                            >
                                <i class="fas fa-edit"></i>
                            </button>
                            </form>

                        
                            
                          
                            <form action="{{ route('depenses.destroy', $depense->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="action-btn delete-btn" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette Dépense ?')"
                                >
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Modal de modification -->
                    <div class="modal fade" id="editModal{{ $depense->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modifier la dépense</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('depenses.update', $depense->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nom</label>
                                            <input type="text" class="form-control" name="nom" value="{{ $depense->nom }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Montant (DH)</label>
                                            <input type="number" class="form-control" name="prix" value="{{ $depense->prix }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Catégorie</label>
                                            <select class="form-select" name="categorie_id" required>
                                                @foreach($categories as $categorie)
                                                    <option value="{{ $categorie->id }}" 
                                                        {{ $depense->categorie_id == $categorie->id ? 'selected' : '' }}>
                                                        {{ $categorie->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Section Dépenses Récurrentes -->
        <div class="col-lg-6">
            <div class="expense-panel">
                <div class="panel-header">
                    <h5><i class="fas fa-sync me-2"></i>Dépenses Récurrentes</h5>
                    <div class="panel-actions">
                        <button class="btn btn-sm btn-light">
                            <i class="fas fa-filter me-1"></i>Filtrer
                        </button>
                    </div>
                </div>
                <div class="recurring-list">
                    <div class="recurring-item">
                        <div class="recurring-icon home">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="recurring-details">
                            <div class="recurring-title">Loyer</div>
                            <div class="recurring-schedule">Chaque 1er du mois</div>
                        </div>
                        <div class="recurring-amount">
                            <div class="amount">3,500 DH</div>
                            <div class="status active">Actif</div>
                        </div>
                    </div>
                    <!-- Répéter pour d'autres dépenses récurrentes -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles personnalisés -->
<style>
    .expense-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        padding: 2rem;
        border-radius: 1rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .stat-card {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .stat-card-inner {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .primary .stat-icon { background: rgba(79, 70, 229, 0.1); color: var(--primary-color); }
    .success .stat-icon { background: rgba(16, 185, 129, 0.1); color: var(--success-color); }
    .warning .stat-icon { background: rgba(245, 158, 11, 0.1); color: var(--warning-color); }
    .info .stat-icon { background: rgba(59, 130, 246, 0.1); color: var(--secondary-color); }

    .expense-panel {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }

    .panel-header {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .expense-list, .recurring-list {
        padding: 1rem;
    }

    .expense-item {
        background: linear-gradient(145deg, #ffffff, #f8fafc);
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(226, 232, 240, 0.8);
        position: relative;
        overflow: hidden;
    }

    .expense-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        border-color: rgba(99, 102, 241, 0.2);
    }

    .expense-details {
        position: relative;
        padding-left: 1rem;
    }

    .expense-title {
        color: #1F2937;
        font-size: 1.1rem;
        margin-bottom: 0.4rem;
        transition: color 0.3s ease;
    }

    .expense-category {
        background: rgba(99, 102, 241, 0.1);
        color: #4F46E5;
        padding: 0.35rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

    .expense-amount {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(8px);
        padding: 0.6rem 1.2rem;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
    }

    .amount {
        font-size: 1.2rem;
        font-weight: 600;
        background: linear-gradient(135deg, #EF4444, #DC2626);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.3rem;
    }

    .date {
        color: #6B7280;
        font-size: 0.85rem;
    }

    .ml-4 {
        display: flex;
        align-items: center;
    }

    form.ml-4 button {
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.2s ease;
        opacity: 0.8;
        font-size: 1.1rem;
    }

    form.ml-4 button:hover {
        background: rgba(239, 68, 68, 0.1);
        opacity: 1;
        transform: scale(1.1);
    }


    .expense-item {
        animation: slideIn 0.3s ease-out forwards;
    }

    @media (max-width: 768px) {
        .expense-item {
            padding: 1rem;
        }

        .expense-title {
            font-size: 1rem;
        }

        .amount {
            font-size: 1.1rem;
        }

        .modal-body {
            padding: 1.5rem;
        }
    }

    .expense-item:hover .expense-title {
        color: #4F46E5;
    }

    .expense-item:hover .expense-category {
        background: rgba(99, 102, 241, 0.15);
    }

    .expense-item:hover .expense-amount {
        transform: scale(1.02);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    /* Style pour les boutons d'action */
    .gap-3 {
        gap: 1rem;
    }

    /* Style du modal */
    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .modal-header {
        background: linear-gradient(135deg, #4F46E5, #6366F1);
        color: white;
        border-radius: 20px 20px 0 0;
        padding: 1.5rem;
    }

    .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-body {
        padding: 2rem;
    }

    .form-label {
        color: #4B5563;
        font-weight: 500;
        font-size: 0.95rem;
        margin-bottom: 0.6rem;
    }

    .form-control, .form-select {
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #6366F1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .modal-footer {
        padding: 1.5rem;
        border-top: 1px solid #E5E7EB;
    }

    .btn {
        padding: 0.8rem 1.5rem;
        border-radius: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4F46E5, #6366F1);
        border: none;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #4338CA, #4F46E5);
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(99, 102, 241, 0.3);
    }

    .btn-secondary {
        background: #9CA3AF;
        border: none;
    }

    .btn-secondary:hover {
        background: #6B7280;
    }

    /* Container pour les boutons d'action */
    .action-buttons {
        display: flex;
        gap: 0.8rem;
        align-items: center;
    }

    /* Style commun pour les boutons d'action */
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.6rem;
        border-radius: 8px;
        transition: all 0.2s ease;
        font-size: 1rem;
        border: none;
        cursor: pointer;
    }

    /* Style du bouton modifier */
    .edit-btn {
        color: #4F46E5;
        background: rgba(79, 70, 229, 0.1);
        border: 1px solid rgba(79, 70, 229, 0.2);
    }

    .edit-btn:hover {
        background: rgba(79, 70, 229, 0.15);
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.2);
    }

    .edit-btn i {
        transition: transform 0.2s ease;
    }

    .edit-btn:hover i {
        transform: rotate(15deg);
    }

    /* Style du bouton supprimer */
    .delete-btn {
        color: #EF4444;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .delete-btn:hover {
        background: rgba(239, 68, 68, 0.15);
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.2);
    }

    .delete-btn i {
        transition: transform 0.2s ease;
    }

    .delete-btn:hover i {
        transform: scale(1.1);
    }

    /* Animation au survol */
    .action-btn:active {
        transform: translateY(1px);
    }

    /* Style responsive */
    @media (max-width: 640px) {
        .action-btn {
            padding: 0.5rem;
            font-size: 0.9rem;
        }
    }
</style>

@include('User.expenses.modals.add-expense')
@include('User.expenses.modals.add-recurring')
@endsection 