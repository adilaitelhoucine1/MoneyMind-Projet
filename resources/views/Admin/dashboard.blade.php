@extends('layouts.admin')

@section('styles')
<style>
    .admin-welcome-card {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 12px;
        padding: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
        box-shadow: 0 10px 20px rgba(58, 134, 255, 0.15);
    }
    
    .admin-welcome-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
    }
    
    .admin-welcome-card::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
    }
    
    .admin-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .admin-stat-card {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border-bottom: 3px solid transparent;
    }
    
    .admin-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .admin-stat-card.users {
        border-bottom-color: var(--primary-color);
    }
    
    .admin-stat-card.transactions {
        border-bottom-color: var(--success-color);
    }
    
    .admin-stat-card.revenue {
        border-bottom-color: var(--accent-color);
    }
    
    .admin-stat-card.growth {
        border-bottom-color: var(--secondary-color);
    }
    
    .admin-stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 1rem;
    }
    
    .admin-stat-icon.users {
        background-color: var(--primary-color);
    }
    
    .admin-stat-icon.transactions {
        background-color: var(--success-color);
    }
    
    .admin-stat-icon.revenue {
        background-color: var(--accent-color);
    }
    
    .admin-stat-icon.growth {
        background-color: var(--secondary-color);
    }
    
    .admin-stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .admin-stat-label {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }
    
    .admin-stat-change {
        display: inline-flex;
        align-items: center;
        font-size: 0.85rem;
        padding: 0.25rem 0.5rem;
        border-radius: 20px;
        margin-top: 0.5rem;
    }
    
    .admin-stat-change.positive {
        background-color: rgba(6, 214, 160, 0.1);
        color: var(--success-color);
    }
    
    .admin-stat-change.negative {
        background-color: rgba(239, 71, 111, 0.1);
        color: var(--danger-color);
    }
    
    .admin-chart-container {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
        margin-bottom: 2rem;
    }
    
    .admin-chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .admin-chart-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0;
    }
    
    .admin-chart-period {
        display: flex;
        align-items: center;
    }
    
    .period-selector {
        background-color: var(--background-color);
        border: none;
        border-radius: 20px;
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        color: var(--text-color);
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .period-selector:hover {
        background-color: rgba(58, 134, 255, 0.1);
    }
    
    .admin-chart {
        height: 300px;
        position: relative;
    }
    
    .admin-table-container {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
        margin-bottom: 2rem;
    }
    
    .admin-table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .admin-table-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0;
    }
    
    .admin-table-actions {
        display: flex;
        gap: 0.5rem;
    }
    
    .admin-table {
        width: 100%;
    }
    
    .admin-table th {
        font-weight: 600;
        color: var(--text-secondary);
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 1rem 0.5rem;
    }
    
    .admin-table td {
        padding: 1rem 0.5rem;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        vertical-align: middle;
    }
    
    .admin-table tr:last-child td {
        border-bottom: none;
    }
    
    .user-info {
        display: flex;
        align-items: center;
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 0.75rem;
    }
    
    .user-name {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .user-email {
        font-size: 0.85rem;
        color: var(--text-secondary);
    }
    
    .status-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .status-badge.active {
        background-color: rgba(6, 214, 160, 0.1);
        color: var(--success-color);
    }
    
    .status-badge.pending {
        background-color: rgba(255, 190, 11, 0.1);
        color: var(--warning-color);
    }
    
    .status-badge.inactive {
        background-color: rgba(239, 71, 111, 0.1);
        color: var(--danger-color);
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        background-color: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .action-btn:hover {
        background-color: rgba(0,0,0,0.05);
        color: var(--primary-color);
    }
    
    .admin-activity-container {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
    }
    
    .admin-activity-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .admin-activity-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0;
    }
    
    .activity-timeline {
        position: relative;
        padding-left: 1.5rem;
    }
    
    .activity-timeline::before {
        content: '';
        position: absolute;
        top: 0;
        left: 7px;
        height: 100%;
        width: 2px;
        background-color: rgba(0,0,0,0.05);
    }
    
    .activity-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    
    .activity-item:last-child {
        padding-bottom: 0;
    }
    
    .activity-dot {
        position: absolute;
        left: -1.5rem;
        top: 0;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-color: var(--primary-color);
        border: 3px solid var(--card-bg);
    }
    
    .activity-dot.login {
        background-color: var(--primary-color);
    }
    
    .activity-dot.transaction {
        background-color: var(--success-color);
    }
    
    .activity-dot.user {
        background-color: var(--accent-color);
    }
    
    .activity-dot.system {
        background-color: var(--secondary-color);
    }
    
    .activity-content {
        padding-left: 0.5rem;
    }
    
    .activity-title {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .activity-time {
        font-size: 0.85rem;
        color: var(--text-secondary);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="admin-welcome-card">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="mb-2">Bienvenue, Administrateur!</h2>
                <p class="mb-4">Voici un aperçu de l'activité de la plateforme MoneyMind.</p>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-light">Gérer les Utilisateurs</a>
                    <a href="#" class="btn btn-outline-light">Voir les Rapports</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="admin-stat-card users">
                <div class="admin-stat-icon users">
                    <i class="fas fa-users"></i>
                </div>
                <div class="admin-stat-value">1,254</div>
                <div class="admin-stat-label">Utilisateurs Totaux</div>
                <div class="admin-stat-change positive">
                    <i class="fas fa-arrow-up me-1"></i> 12% ce mois
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="admin-stat-card revenue">
                <div class="admin-stat-icon revenue">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="admin-stat-value">3,850 DH</div>
                <div class="admin-stat-label">Revenu Mensuel Moyen</div>
                <div class="admin-stat-change positive">
                    <i class="fas fa-arrow-up me-1"></i> 5% ce mois
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="admin-stat-card inactive">
                <div class="admin-stat-icon inactive">
                    <i class="fas fa-user-clock"></i>
                </div>
                <div class="admin-stat-value">87</div>
                <div class="admin-stat-label">Utilisateurs Inactifs</div>
                <div class="admin-stat-change negative">
                    <i class="fas fa-arrow-up me-1"></i> 3% ce mois
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="admin-stat-card categories">
                <div class="admin-stat-icon categories">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="admin-stat-value">12</div>
                <div class="admin-stat-label">Catégories</div>
                <div class="admin-stat-change positive">
                    <i class="fas fa-plus me-1"></i> 2 nouvelles
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="admin-panel">
                <div class="admin-panel-header">
                    <h5 class="admin-panel-title">
                        <i class="fas fa-user-clock me-2 text-danger"></i>
                        Utilisateurs Inactifs
                    </h5>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#bulkDeleteModal">
                        <i class="fas fa-trash me-1"></i> Supprimer Tous
                    </button>
                </div>
                <div class="admin-panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Utilisateur</th>
                                    <th>Email</th>
                                    <th>Dernière Connexion</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=Ahmed+Alami&background=ef476f&color=fff" alt="User" class="rounded-circle me-2" width="40">
                                            <div>
                                                <div class="fw-bold">Ahmed Alami</div>
                                                <div class="small text-secondary">Inscrit le 12/03/2023</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>ahmed.alami@example.com</td>
                                    <td>Il y a 3 mois</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-user-id="1" data-user-name="Ahmed Alami">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=Sara+Bennani&background=ef476f&color=fff" alt="User" class="rounded-circle me-2" width="40">
                                            <div>
                                                <div class="fw-bold">Sara Bennani</div>
                                                <div class="small text-secondary">Inscrite le 05/02/2023</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>sara.bennani@example.com</td>
                                    <td>Il y a 4 mois</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-user-id="2" data-user-name="Sara Bennani">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=Karim+Idrissi&background=ef476f&color=fff" alt="User" class="rounded-circle me-2" width="40">
                                            <div>
                                                <div class="fw-bold">Karim Idrissi</div>
                                                <div class="small text-secondary">Inscrit le 20/01/2023</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>karim.idrissi@example.com</td>
                                    <td>Il y a 2 mois</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-user-id="3" data-user-name="Karim Idrissi">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="admin-panel mt-4">
                <div class="admin-panel-header">
                    <h5 class="admin-panel-title">
                        <i class="fas fa-tags me-2 text-primary"></i>
                        Gestion des Catégories
                    </h5>
                </div>
                <div class="admin-panel-body">
                    <form class="add-category-form mb-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nom de la catégorie">
                            <select class="form-select" style="max-width: 150px;">
                                <option value="" selected>Icône</option>
                                <option value="home">Logement</option>
                                <option value="utensils">Alimentation</option>
                                <option value="car">Transport</option>
                                <option value="shopping-bag">Shopping</option>
                                <option value="gamepad">Divertissement</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                    
                    <div class="category-list">
                        <div class="category-tag">
                            <div class="category-icon"><i class="fas fa-home"></i></div>
                            <div class="category-name">Logement</div>
                            <div class="category-actions">
                                <button class="action-btn edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-category-id="1" data-category-name="Logement" data-category-icon="home">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-category-id="1" data-category-name="Logement">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="category-tag">
                            <div class="category-icon"><i class="fas fa-utensils"></i></div>
                            <div class="category-name">Alimentation</div>
                            <div class="category-actions">
                                <button class="action-btn edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-category-id="2" data-category-name="Alimentation" data-category-icon="utensils">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-category-id="2" data-category-name="Alimentation">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="category-tag">
                            <div class="category-icon"><i class="fas fa-car"></i></div>
                            <div class="category-name">Transport</div>
                            <div class="category-actions">
                                <button class="action-btn edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-category-id="3" data-category-name="Transport" data-category-icon="car">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-category-id="3" data-category-name="Transport">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="category-tag">
                            <div class="category-icon"><i class="fas fa-shopping-bag"></i></div>
                            <div class="category-name">Shopping</div>
                            <div class="category-actions">
                                <button class="action-btn edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-category-id="4" data-category-name="Shopping" data-category-icon="shopping-bag">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-category-id="4" data-category-name="Shopping">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="category-tag">
                            <div class="category-icon"><i class="fas fa-gamepad"></i></div>
                            <div class="category-name">Divertissement</div>
                            <div class="category-actions">
                                <button class="action-btn edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-category-id="5" data-category-name="Divertissement" data-category-icon="gamepad">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="action-btn delete" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-category-id="5" data-category-name="Divertissement">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="admin-panel">
                <div class="admin-panel-header">
                    <h5 class="admin-panel-title">
                        <i class="fas fa-chart-pie me-2 text-primary"></i>
                        Répartition des Utilisateurs
                    </h5>
                </div>
                <div class="admin-panel-body">
                    <div style="height: 250px;">
                        <canvas id="userStatusChart"></canvas>
                    </div>
                    <div class="mt-3">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="fw-bold">65%</div>
                                <div class="small text-secondary">Actifs</div>
                            </div>
                            <div class="col-4">
                                <div class="fw-bold">28%</div>
                                <div class="small text-secondary">Occasionnels</div>
                            </div>
                            <div class="col-4">
                                <div class="fw-bold">7%</div>
                                <div class="small text-secondary">Inactifs</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="admin-panel mt-4">
                <div class="admin-panel-header">
                    <h5 class="admin-panel-title">
                        <i class="fas fa-money-bill-wave me-2 text-success"></i>
                        Revenu Mensuel Moyen
                    </h5>
                </div>
                <div class="admin-panel-body">
                    <div style="height: 250px;">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer le compte de <span id="deleteUserName" class="fw-bold"></span>?</p>
                <p class="text-danger">Cette action est irréversible et toutes les données associées seront perdues.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteUser">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Delete Modal -->
<div class="modal fade" id="bulkDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression en masse</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer tous les comptes inactifs (87 utilisateurs)?</p>
                <p class="text-danger">Cette action est irréversible et toutes les données associées seront perdues.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmBulkDelete">Supprimer tous les comptes inactifs</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier la catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm">
                    <input type="hidden" id="editCategoryId">
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Nom de la catégorie</label>
                        <input type="text" class="form-control" id="editCategoryName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryIcon" class="form-label">Icône</label>
                        <select class="form-select" id="editCategoryIcon">
                            <option value="home">Maison</option>
                            <option value="utensils">Nourriture</option>
                            <option value="car">Transport</option>
                            <option value="shopping-bag">Shopping</option>
                            <option value="gamepad">Divertissement</option>
                            <option value="graduation-cap">Éducation</option>
                            <option value="heartbeat">Santé</option>
                            <option value="plane">Voyage</option>
                            <option value="gift">Cadeaux</option>
                            <option value="coffee">Café</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="saveCategory">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Category Modal -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer la catégorie <span id="deleteCategoryName" class="fw-bold"></span>?</p>
                <p class="text-danger">Toutes les transactions associées à cette catégorie seront reclassées comme "Non catégorisées".</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteCategory">Supprimer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // User Status Chart
        var userStatusCtx = document.getElementById('userStatusChart').getContext('2d');
        var userStatusChart = new Chart(userStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Utilisateurs Actifs', 'Utilisateurs Occasionnels', 'Utilisateurs Inactifs'],
                datasets: [{
                    data: [65, 28, 7],
                    backgroundColor: [
                        'rgba(58, 134, 255, 0.8)',
                        'rgba(255, 190, 11, 0.8)',
                        'rgba(239, 71, 111, 0.8)'
                    ],
                    borderColor: [
                        'rgba(58, 134, 255, 1)',
                        'rgba(255, 190, 11, 1)',
                        'rgba(239, 71, 111, 1)'
                    ],
                    borderWidth: 1
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
                cutout: '70%'
            }
        });
        
        // Revenue Chart
        var revenueCtx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin'],
                datasets: [{
                    label: 'Revenu Mensuel Moyen (DH)',
                    data: [3200, 3500, 3300, 3700, 3900, 3850],
                    backgroundColor: 'rgba(6, 214, 160, 0.8)',
                    borderColor: 'rgba(6, 214, 160, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                    maxBarThickness: 12
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
        
        // Delete User Modal
        var deleteUserModal = document.getElementById('deleteUserModal');
        if (deleteUserModal) {
            deleteUserModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var userId = button.getAttribute('data-user-id');
                var userName = button.getAttribute('data-user-name');
                
                var userNameElement = document.getElementById('deleteUserName');
                userNameElement.textContent = userName;
                
                var confirmButton = document.getElementById('confirmDeleteUser');
                confirmButton.setAttribute('data-user-id', userId);
            });
            
            var confirmDeleteUser = document.getElementById('confirmDeleteUser');
            confirmDeleteUser.addEventListener('click', function() {
                var userId = this.getAttribute('data-user-id');
                // Ici, vous pouvez ajouter le code pour supprimer l'utilisateur via AJAX
                console.log('Suppression de l\'utilisateur ID: ' + userId);
                
                // Fermer le modal après la suppression
                var modal = bootstrap.Modal.getInstance(deleteUserModal);
                modal.hide();
                
                // Afficher une notification de succès
                alert('L\'utilisateur a été supprimé avec succès.');
            });
        }
        
        // Bulk Delete Modal
        var bulkDeleteModal = document.getElementById('bulkDeleteModal');
        if (bulkDeleteModal) {
            var confirmBulkDelete = document.getElementById('confirmBulkDelete');
            confirmBulkDelete.addEventListener('click', function() {
                // Ici, vous pouvez ajouter le code pour supprimer tous les utilisateurs inactifs via AJAX
                console.log('Suppression de tous les utilisateurs inactifs');
                
                // Fermer le modal après la suppression
                var modal = bootstrap.Modal.getInstance(bulkDeleteModal);
                modal.hide();
                
                // Afficher une notification de succès
                alert('Tous les utilisateurs inactifs ont été supprimés avec succès.');
            });
        }
        
        // Edit Category Modal
        var editCategoryModal = document.getElementById('editCategoryModal');
        if (editCategoryModal) {
            editCategoryModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var categoryId = button.getAttribute('data-category-id');
                var categoryName = button.getAttribute('data-category-name');
                var categoryIcon = button.getAttribute('data-category-icon');
                
                document.getElementById('editCategoryId').value = categoryId;
                document.getElementById('editCategoryName').value = categoryName;
                document.getElementById('editCategoryIcon').value = categoryIcon;
            });
            
            var saveCategory = document.getElementById('saveCategory');
            saveCategory.addEventListener('click', function() {
                var categoryId = document.getElementById('editCategoryId').value;
                var categoryName = document.getElementById('editCategoryName').value;
                var categoryIcon = document.getElementById('editCategoryIcon').value;
                
                // Ici, vous pouvez ajouter le code pour mettre à jour la catégorie via AJAX
                console.log('Mise à jour de la catégorie ID: ' + categoryId);
                console.log('Nouveau nom: ' + categoryName);
                console.log('Nouvelle icône: ' + categoryIcon);
                
                // Fermer le modal après la mise à jour
                var modal = bootstrap.Modal.getInstance(editCategoryModal);
                modal.hide();
                
                // Afficher une notification de succès
                alert('La catégorie a été mise à jour avec succès.');
            });
        }
        
        // Delete Category Modal
        var deleteCategoryModal = document.getElementById('deleteCategoryModal');
        if (deleteCategoryModal) {
            deleteCategoryModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var categoryId = button.getAttribute('data-category-id');
                var categoryName = button.getAttribute('data-category-name');
                
                var categoryNameElement = document.getElementById('deleteCategoryName');
                categoryNameElement.textContent = categoryName;
                
                var confirmButton = document.getElementById('confirmDeleteCategory');
                confirmButton.setAttribute('data-category-id', categoryId);
            });
            
            var confirmDeleteCategory = document.getElementById('confirmDeleteCategory');
            confirmDeleteCategory.addEventListener('click', function() {
                var categoryId = this.getAttribute('data-category-id');
                // Ici, vous pouvez ajouter le code pour supprimer la catégorie via AJAX
                console.log('Suppression de la catégorie ID: ' + categoryId);
                
                // Fermer le modal après la suppression
                var modal = bootstrap.Modal.getInstance(deleteCategoryModal);
                modal.hide();
                
                // Afficher une notification de succès
                alert('La catégorie a été supprimée avec succès.');
            });
        }
    });
</script>
@endsection
