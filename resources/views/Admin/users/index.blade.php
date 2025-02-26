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
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJQAAACUCAMAAABC4vDmAAAAY1BMVEX///8AAADIyMjw8PBnZ2f19fW2trYqKir5+fnf39+MjIzq6urj4+MxMTEYGBgQEBB5eXlWVlbBwcHW1tZ/f385OTlPT09KSkqampqhoaHQ0NCvr69gYGBERERsbGw+Pj4iIiKc8V/iAAAJ1ElEQVR4nM0c25aiMAxB7qigqIg6+v9fud6apKWkqTB7Jg97jrO0TXNPmjYIpkCU9+G5aJfXdL1ZLDbr9Lpsi3PY59GkaScglBTLY7qwQnpcFsl/RizLk9qOjQ51kmf/CaWqa0YIZCFZ01W/j1F+2ksRUrA/5b+KUngR00ij1yX8LYzK8+objN6wOpe/gFLcefNNh30Xz4xSdFozyx2bn7otirb+aY4M6uvTnFYiS27WVe6rpkuqKorij+ZncRRVVdI1q7t1wC2ZzUT0jW2BZZcwYlIm3dI2qulnQSkuhlOvfralc89Zuf2xqEYxg2iFAyHZ1FvxvPG23pjj91PtQ9yaUx58pTU6Hcw52knEyk1p+km+mSb5MSVrgo3fGnMtd9/OtDOlfvvtTIaET/MV4UWfrfhqlkjf3PHrvSnYHnWyf2FJI32KYgZjHOmkP3pPudMswWGm4CPXFHHvKaKVZvWK2ZxDphFr5RUAhtR13ebxDB/oqRu9e+hORXE6zBzPVpSFd/HkO8q771SXBcrClVCuIirjJ8mIR7DStnXdto9ARvL9iUq7SAepLVg7jVPcd7rtWBy73unatiRkFFkGajNdIh531lCrcUa+Pfl66caJMPzu4HduibRAFB2WbUd0ySm21Ac7cCrYdCt1LLUj3zqEJMcv1zzvts4MMOXX6olcsWSNiYjwU3YulJ7Q8dvCDxtOBkmcydqC8jjEwAZHNgMllqEd/yrEr1iJyAcB7mJ9f8AwN+Q9OVGUUX8To9U8cHNVxuLX9hRWDwbEVXhqrwayrDXFze3HGIiI37ipKm3ddd1r1i/qaw3nKzsVeucR1hCDxilepkVahWXNSrNfey7uca2ZoeaxAkVreGNZiZYF1dxsiH9jQz6B/z5wezuT5RgNpT73zEyXoVhZsrcI2ctpTIlrbdgILSSZMWcY0Fzfhp4ZtyZlnsMLET8iZOCA8DGoDBtKECvsDJKJEHPeAUOltWkWOtEEAfKYE5QPoPjduM9wo4ZbKkHPL7LxLEcUIK/ZnULuvNeFDzfFSi8UKoRBLGz1h/sMvZtOfkgV2DAQZVdYfEEzw2oFBLsrO67s4JN1MAewWTbowM1SPgFXWTIHwA1xlQpItWc/A7EgEp2notUiIJS4UF8CqVghBNxTNNzAFjZiwaFMSGYChI08ccHZIJv3wz/ZoJMtoAFshA+NgSzA5kr9ZcMrOpgdjyJMpsbwhi0CT6lCoU42ELMKOU5BoMawuQHZ8IeiGEjxCQwIbeODlJrcoRzgKz5hFejeit8MFIhELkaBIoGj6BOrHX/0D2SRN1Ioel7VIYhMHPUYMFVvLQJ2SrNnXpEMAIF1FBeAf28+qF9sgBj8NqUwpH3+Aju9dGg6CPpXMuXyAhl45addEpo3EiJ+pX3O2phmmgv6g4NftVOEOE/pUGS7O70s+DGPowIQDqe/LJXFWRKmuGMkILAgPlcAIa1bZZXIPhgNptMtKYbWikBqbwKUvof5hETIvRVgRSouyVcQqblZDozoMRIWxCMQ9Yj5B9zjI7UXgKSHOEywexh2lyIFNWDBlsE4n8UW9zVsg+NEADveSGZXHxeg56JMDozCXXQAmAOhJAE0ZIktmCnRaQTmQmwirQCPjSXHQmCcloGqFTotrrGMIFTo/LYAHuMaKJ39EQXepH7sFF1Mj/lagIJMhVRpoEpAQoNYiLEiOAljHWVo14FSKGEul+FSvArSMqQw+1FqtAEvLo3c6IlSPaocES3XSjsagAuAlDjrpfXow4iwhPRIQhyogsEB9skE/Qlaf4it10TvIBGHhCDoGxB0VzCMYPR2LA3ROuvtKFdx8AUB8RpMgsxOvcE8w7p1Sd/vdn2fdGbz3lE+K9ipFIznwQOpaHiKtdjc74OessesHkFqrGa9+rkZgEEDmh08akaam1HTywthL0jG8KDg15YGKVzrFbogZKH17F+Hw9aL+iR0Acvr0TcUnezNqAPYdx70hxDkjC5WHOKWokNt2La49QrIE2LiIDS80dnegTsK907IRBCk3ifFeoK7HcGClkzgSYrlkYw+yHSxrrpJ9/v97fb4J7XYqueGJaJFklEwVGs38xMLmdZ1l4T5q886i6MqTLra8tXdLbE5OLyAsNI1LhrcAEkPp8riCOLqPLx2MB7mfADk/CncWrWDgdK0TA13oeKBl/G5q41Oq/5AMn5h44Sd3sW9XjpPRvNa19M7OyKDTbxIqn5sOGk02ohrUUfjzmiw4kLQElTk9VNSGNFdnZtKCnK9v5qxDUZJBxYcz850OomaBxXotnZ838C9N+JgPtMx/ml0ajxbfrOLBKsSkHhrDx6DjFCXdqotTv4tuzTbGvP7sG/VXeI4MMqJlb5/1QBONXek/mIeGDmO1jJqn77stq7IvqyWZ3i0hoeQtqoFseN8NxsH1Gna+AHMwrNmOJe8Dj8niucuajNYka4riwhAnxhqNnOwnWPb2G3SvTPSWzisuNkOttFIDHolSGb59VWQN5BOvvFVqKkcbZbwrTFxMN4lZG+WwE4L3aqTTi+vQz47YIuWkcsDo/RAE+2btgnPAqELUJG1LaIu6SEdtirR5D+Gr+VnDBzg+YNWRwMVMFqVCE2IAra2P04BpAmJKFFuTRHB9jfkN95T4eM/D4BIBm+nMO1vRAqhKoHUm+2Syg7cCVhJZMcwJCKKpswCTOB1aMwDyPpaoQnLWloqCWtvbzKiAMx44xqc/0fNY6SFTW4HbbqwKa8qkwuAW2/yO9p0qcV9GlZwiJt5rz2pNVZP+pMTjJFVEOvnALCnltBhCtCTzByjv7GskzTJX4mT9MoT3ACbXZKIZbxJnhKzlaWDXwBJ8EjllHH35CsQc3nVXwZQw1+QmJbTpdhSyZyZe3qr+gf4In4+HDCr7j2hH9awpG1MCtK5cQqCQZnImbeZl75mCaR0MItEgmrr0nuELxjVZcFVOvOQavKd6CHoIiI7f9GuZ87pjBVo2iTrbDeKdrN64zfQ0ybpRVbjyu91Zlrl9NaU/MqvcTl6NetLMSFlg8/l6ME18tleZIknXCM3L9xfJ6bsMKt24c33wv3AMrQzxAqlfp7q/zTB4BGH6/RHHPT7iN884hAMPM5hElpb4zD8a09heufL1xFDb/q7CRv8i0+o2B6buUoPOhVE3dWcY9pjM4HtWZ5Fzb1cpENpeZFt8rM8gf0Bo/Qie8DI9trYTJbY/tTTpTgzkpGfC+vR7kxPPQXjj2KtV01x3lVlFL9fxcriOCqr3bloVvaHvWZ8FCtwPB+2Oh6aZd229bI5HJnH2OZ9PuwJf/ChtSf8wSfpXvD3Hu97wR985vAFf+9ByBf8waczP/DXHhlFxH7nOdZ/lPVv1vqa7GAAAAAASUVORK5CYII=" alt="User" class="user-avatar">
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