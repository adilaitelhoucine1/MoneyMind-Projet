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

    .content-card {
        background: var(--glass-bg);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: var(--glass-border);
        box-shadow: var(--glass-shadow);
    }

    .filter-bar {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .search-box {
        flex: 1;
        min-width: 200px;
    }

    .search-input {
        background: white;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        padding: 0.75rem 1.25rem;
        width: 100%;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .filter-dropdown .btn {
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        background: white;
        color: #4B5563;
        font-weight: 500;
        min-width: 140px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .filter-dropdown .dropdown-menu {
        border-radius: 16px;
        border: var(--glass-border);
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        box-shadow: var(--glass-shadow);
        padding: 0.5rem;
        min-width: 200px;
    }

    .filter-dropdown .dropdown-item {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        color: #4B5563;
        transition: all 0.3s ease;
    }

    .filter-dropdown .dropdown-item:hover {
        background: rgba(79, 70, 229, 0.1);
        color: #4F46E5;
    }

    .table-container {
        overflow-x: auto;
        border-radius: 16px;
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 0.75rem;
    }

    .custom-table th {
        background: transparent;
        padding: 1rem 1.5rem;
        color: #6B7280;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }

    .custom-table td {
        background: white;
        padding: 1.25rem 1.5rem;
    }

    .custom-table tr td:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    .custom-table tr td:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        object-fit: cover;
    }

    .user-details {
        line-height: 1.4;
    }

    .user-name {
        font-weight: 600;
        color: #1F2937;
    }

    .user-email {
        color: #6B7280;
        font-size: 0.875rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-badge.active {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .status-badge.inactive {
        background: rgba(239, 68, 68, 0.1);
        color: #DC2626;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #4B5563;
        background: transparent;
    }

    .action-btn:hover {
        background: rgba(79, 70, 229, 0.1);
        color: #4F46E5;
    }

    .action-btn.delete:hover {
        background: rgba(239, 68, 68, 0.1);
        color: #DC2626;
    }

    .pagination {
        margin: 2rem 0 0;
        gap: 0.5rem;
    }

    .page-link {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        color: #4B5563;
        border: 1px solid rgba(0, 0, 0, 0.1);
        min-width: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .page-link:hover,
    .page-item.active .page-link {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
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

    .form-control {
        border-radius: 12px;
        padding: 0.75rem 1.25rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    @media (max-width: 768px) {
        .filter-bar {
            flex-direction: column;
        }
        
        .search-box {
            width: 100%;
        }
        
        .filter-dropdown {
            width: 100%;
        }
        
        .filter-dropdown .btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-2">Gestion des Utilisateurs</h2>
                <p class="mb-0">Gérez et surveillez tous les utilisateurs de la plateforme</p>
            </div>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-plus me-2"></i>Ajouter un Utilisateur
            </button>
        </div>
    </div>

    <div class="content-card">
        <div class="filter-bar">
            <div class="search-box">
                <input type="text" class="search-input" placeholder="Rechercher un utilisateur...">
            </div>
            
            <div class="filter-dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-2"></i>
                    <span>Statut</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Tous</a></li>
                    <li><a class="dropdown-item" href="#">Actifs</a></li>
                    <li><a class="dropdown-item" href="#">Inactifs</a></li>
                </ul>
            </div>
            
            <div class="filter-dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-sort me-2"></i>
                    <span>Trier par</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Date d'inscription</a></li>
                    <li><a class="dropdown-item" href="#">Nom</a></li>
                    <li><a class="dropdown-item" href="#">Statut</a></li>
                </ul>
            </div>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Date d'inscription</th>
                        <th>Statut</th>
                        <th>Dernière connexion</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="user-info">
                                <img src="https://ui-avatars.com/api/?name=Ahmed+Alami" alt="User" class="user-avatar">
                                <div class="user-details">
                                    <div class="user-name">{{$user->name}}</div>
                                    <div class="user-email">{{$user->email}}</div>
                                </div>
                            </div>
                        </td>
                        <td>12 Mars 2023</td>
                        <td>
                            <span class="status-badge active">
                                <i class="fas fa-check-circle"></i>
                                Actif
                            </span>
                        </td>
                        <td>{{$user->last_logged_in->diffForHumans()}} </td>
                        <td>
                            <div class="action-buttons">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                
                    @endforeach
                </tbody>
            </table>
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nom complet</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rôle</label>
                        <select class="form-select">
                            <option>Utilisateur</option>
                            <option>Administrateur</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit & Delete Modals (similar structure to Add Modal) -->
@endsection 