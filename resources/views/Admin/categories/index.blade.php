@extends('layouts.admin')

@section('styles')
<style>
    .page-header {
        background: var(--primary-gradient);
        border-radius: 24px;
        padding: 2.5rem;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .page-header::before,
    .page-header::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        animation: pulse 10s infinite;
    }

    .page-header::before {
        width: 300px;
        height: 300px;
        top: -150px;
        right: -150px;
    }

    .page-header::after {
        width: 200px;
        height: 200px;
        bottom: -100px;
        left: -100px;
        animation-delay: -5s;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .category-card {
        background: var(--glass-bg);
        border-radius: 20px;
        padding: 1.75rem;
        backdrop-filter: blur(10px);
        border: var(--glass-border);
        box-shadow: var(--glass-shadow);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .category-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.1) 100%);
        pointer-events: none;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .category-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .category-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 1rem;
        position: relative;
        overflow: hidden;
    }

    .category-icon::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 200%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        animation: shimmer 2s infinite;
    }

    .category-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1F2937;
        margin-bottom: 0.5rem;
    }

    .category-description {
        color: #6B7280;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
        line-height: 1.5;
    }

    .category-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: #6B7280;
    }

    .category-actions {
        position: absolute;
        top: 1.75rem;
        right: 1.75rem;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
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
        background: rgba(79, 70, 229, 0.1);
        color: #4F46E5;
    }

    .add-category-card {
        background: rgba(79, 70, 229, 0.05);
        border: 2px dashed rgba(79, 70, 229, 0.2);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        min-height: 300px;
    }

    .add-category-card:hover {
        background: rgba(79, 70, 229, 0.1);
        border-color: rgba(79, 70, 229, 0.3);
        transform: translateY(-5px);
    }

    .add-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: #4F46E5;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .add-category-card:hover .add-icon {
        background: var(--primary-gradient);
        color: white;
    }

    .add-text {
        font-size: 1.25rem;
        font-weight: 600;
        color: #4F46E5;
    }

    .modal-content {
        border-radius: 20px;
        border: var(--glass-border);
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
    }

    .modal-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }

    .modal-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }

    .form-control, .form-select {
        border-radius: 12px;
        padding: 0.75rem 1.25rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    @media (max-width: 768px) {
        .categories-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-2">Gestion des Catégories</h2>
                <p class="mb-0">Gérez les catégories de dépenses et de revenus</p>
            </div>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="fas fa-plus me-2"></i>Nouvelle Catégorie
            </button>
        </div>
    </div>

    <div class="categories-grid">
        <!-- Category Card -->
        <div class="category-card">
            <div class="category-header">
                <div>
                    <div class="category-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h4 class="category-name">Logement</h4>
                    <p class="category-description">Dépenses liées au logement, loyer, charges, etc.</p>
                </div>
                <div class="category-actions">
                    <div class="dropdown">
                        <button class="action-btn" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                    <i class="fas fa-edit me-2"></i>Modifier
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal">
                                    <i class="fas fa-trash me-2"></i>Supprimer
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="category-stats">
                <div class="stat-item">
                    <div class="stat-value">45</div>
                    <div class="stat-label">Transactions</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">2,500 DH</div>
                    <div class="stat-label">Total</div>
                </div>
            </div>
        </div>

        <!-- More Category Cards -->
        <div class="category-card">
            <div class="category-header">
                <div>
                    <div class="category-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h4 class="category-name">Alimentation</h4>
                    <p class="category-description">Dépenses alimentaires, courses, restaurants</p>
                </div>
                <div class="category-actions">
                    <div class="dropdown">
                        <button class="action-btn" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Modifier</a></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Supprimer</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="category-stats">
                <div class="stat-item">
                    <div class="stat-value">78</div>
                    <div class="stat-label">Transactions</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">1,800 DH</div>
                    <div class="stat-label">Total</div>
                </div>
            </div>
        </div>

        <!-- Add Category Card -->
        <div class="category-card add-category-card" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <div class="add-icon">
                <i class="fas fa-plus"></i>
            </div>
            <div class="add-text">Ajouter une Catégorie</div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvelle Catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nom de la catégorie</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icône</label>
                        <select class="form-select">
                            <option value="home">Maison</option>
                            <option value="utensils">Alimentation</option>
                            <option value="car">Transport</option>
                            <option value="shopping-bag">Shopping</option>
                            <option value="heartbeat">Santé</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="form-select">
                            <option>Dépense</option>
                            <option>Revenu</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Créer</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit & Delete Modals (similar structure to Add Modal) -->
@endsection 