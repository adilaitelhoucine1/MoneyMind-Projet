@extends('layouts.app')

@section('title', 'Liste de Souhaits')

@section('styles')
<style>
    .wishlist-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .wishlist-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
        background: white;
        padding: 1.5rem 2rem;
        border-radius: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .wishlist-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1F2937;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .wishlist-title i {
        color: #4F46E5;
        font-size: 2rem;
    }

    .add-wish-btn {
        background: linear-gradient(135deg, #4F46E5, #6366F1);
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .add-wish-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(79, 70, 229, 0.3);
        color: white;
    }

    .add-wish-btn i {
        font-size: 1.1rem;
    }

    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .wish-card {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid rgba(226, 232, 240, 0.8);
        position: relative;
        overflow: hidden;
    }

    .wish-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #4F46E5, #6366F1);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .wish-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .wish-card:hover::before {
        opacity: 1;
    }

    .wish-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 1.25rem;
        background: linear-gradient(135deg, #4F46E5, #6366F1);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .wish-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1F2937;
        margin-bottom: 0.5rem;
    }

    .wish-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: #4F46E5;
        margin-bottom: 1rem;
    }

    .progress-container {
        margin-bottom: 1rem;
    }

    .progress-bar {
        height: 8px;
        background: #E5E7EB;
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #4F46E5, #6366F1);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .progress-text {
        font-size: 0.875rem;
        color: #6B7280;
        display: flex;
        justify-content: space-between;
    }

    .wish-category {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: rgba(79, 70, 229, 0.1);
        color: #4F46E5;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }

    .wish-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: auto;
    }

    .wish-btn {
        flex: 1;
        padding: 0.75rem;
        border-radius: 12px;
        border: none;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .edit-btn {
        background: rgba(79, 70, 229, 0.1);
        color: #4F46E5;
    }

    .delete-btn {
        background: rgba(239, 68, 68, 0.1);
        color: #EF4444;
    }

    .wish-btn:hover {
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .empty-state i {
        font-size: 4rem;
        color: #9CA3AF;
        margin-bottom: 1.5rem;
    }

    .empty-state p {
        color: #6B7280;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .empty-state .add-wish-btn {
        display: inline-flex;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 20px;
        border: none;
    }

    .modal-header {
        border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        padding: 1.5rem;
    }

    .modal-title {
        font-weight: 600;
        color: #1F2937;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        color: #4B5563;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border-radius: 12px;
        border: 1px solid #E5E7EB;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .modal-footer {
        border-top: 1px solid rgba(226, 232, 240, 0.8);
        padding: 1.5rem;
    }

    .btn-custom {
        background: linear-gradient(135deg, #4F46E5, #6366F1);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }
</style>
@endsection

@section('content')
<div class="wishlist-container">
    <div class="wishlist-header">
        <h1 class="wishlist-title">
            <i class="fas fa-heart"></i>
            Ma Liste de Souhaits
        </h1>
        <button class="add-wish-btn" data-bs-toggle="modal" data-bs-target="#addWishModal">
            <i class="fas fa-plus"></i>
            Ajouter un souhait
        </button>
    </div>

    <div class="wishlist-grid">
        @forelse($wishes as $wish)
        <div class="wish-card">
            <div class="wish-icon">
                <i class="fas fa-gift"></i>
            </div>
            <div class="wish-name">{{ $wish->nom }}</div>
            <div class="wish-price">{{ number_format($wish->prix_estime, 2) }} DH</div>
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $wish->progress }}%"></div>
                </div>
                <div class="progress-text">
                    <span>{{ number_format($wish->montant_actuel, 2) }} DH</span>
                    <span>{{ $wish->progress }}%</span>
                </div>
            </div>
            <div class="wish-category">{{ $wish->categorie ? $wish->categorie->nom : 'Sans catégorie' }}</div>
            <div class="wish-actions">
                <button class="wish-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editWishModal{{ $wish->id }}">
                    <i class="fas fa-edit"></i>
                    Modifier
                </button>
                <form action="{{ route('wishlist.destroy', $wish->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="wish-btn delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce souhait ?')">
                        <i class="fas fa-trash-alt"></i>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>

        <!-- Edit Wish Modal -->
        <div class="modal fade" id="editWishModal{{ $wish->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier le Souhait</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('wishlist.update', $wish->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-4">
                                <label class="form-label">Nom du souhait</label>
                                <input type="text" class="form-control" name="name" value="{{ $wish->nom }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Prix estimé</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="price" value="{{ $wish->prix_estime }}" required>
                                    <span class="input-group-text">DH</span>
                                </div>
                            </div>
                            Modifier le Souhait

                            <div class="mb-4">
                        
                                <select class="form-select" name="category" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $wish->categorie_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Priorité</label>
                                <select class="form-select" name="priorite" required>
                                    <option value="faible" {{ $wish->priorite === 'faible' ? 'selected' : '' }}>Faible</option>
                                    <option value="moyenne" {{ $wish->priorite === 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                                    <option value="élevée" {{ $wish->priorite === 'élevée' ? 'selected' : '' }}>Élevée</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-custom">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="fas fa-heart"></i>
            <p>Vous n'avez pas encore de souhaits dans votre liste.</p>
            <button class="add-wish-btn" data-bs-toggle="modal" data-bs-target="#addWishModal">
                <i class="fas fa-plus"></i>
                Ajouter mon premier souhait
            </button>
        </div>
        @endforelse
    </div>
</div>

<!-- Add Wish Modal -->
<div class="modal fade" id="addWishModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Souhait</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('wishlist.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="form-label">Nom du souhait</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Prix estimé</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="price" required>
                            <span class="input-group-text">DH</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Montant actuel</label>
                        <div class="input-group">
                            <categoryype="number" class="form-control" name="current_amount" value="0" required>
                            <span class="input-group-text">DH</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Catégorie</label>
                        <select class="form-select" name="category" required>
                            <option value="#">Sélectionner Catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Priorité</label>
                        <select class="form-select" name="priorite" required>
                            <option value="faible">Faible</option>
                            <option value="moyenne">Moyenne</option>
                            <option value="élevée">Élevée</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-custom">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@endsection 