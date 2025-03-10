@extends('layouts.app')

@section('title', 'Liste de Souhaits')

@section('styles')
<style>
    .wishlist-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        background: #f8fafc;
        min-height: 100vh;
    }

    .wishlist-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
        background: white;
        padding: 1.8rem 2.5rem;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(226, 232, 240, 0.8);
    }

    .wishlist-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1F2937;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 1.2rem;
        letter-spacing: -0.5px;
    }

    .wishlist-title i {
        color: #4F46E5;
        font-size: 2.2rem;
        background: linear-gradient(135deg, #4F46E5, #6366F1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .add-wish-btn {
        background: linear-gradient(135deg, #4F46E5, #6366F1);
        border: none;
        padding: 1rem 2.2rem;
        border-radius: 16px;
        color: white;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.25);
        font-size: 1.05rem;
    }

    .add-wish-btn:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 25px rgba(79, 70, 229, 0.35);
        color: white;
    }

    .add-wish-btn i {
        font-size: 1.2rem;
    }

    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .wish-card {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04),
                    0 1px 2px rgba(0, 0, 0, 0.02);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(226, 232, 240, 0.8);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .wish-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, #4F46E5, #6366F1);
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .wish-card:hover {
        transform: translateY(-10px) scale(1.01);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.08),
                    0 2px 4px rgba(0, 0, 0, 0.03);
        border-color: rgba(79, 70, 229, 0.1);
    }

    .wish-card:hover::before {
        opacity: 1;
    }

    .wish-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            135deg,
            rgba(255, 255, 255, 0.2) 0%,
            rgba(255, 255, 255, 0) 100%
        );
        opacity: 0;
        transition: opacity 0.5s ease;
        pointer-events: none;
    }

    .wish-card:hover::after {
        opacity: 1;
    }

    .wish-icon {
        width: 50px;
        height: 50px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 0.75rem;
        background: linear-gradient(135deg, #4F46E5, #6366F1);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.25);
    }

    .wish-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 0.5rem;
        letter-spacing: -0.3px;
    }

    .wish-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: #4F46E5;
        margin-bottom: 0.75rem;
        letter-spacing: -0.5px;
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
        border-radius: 6px;
        transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .progress-text {
        font-size: 1rem;
        color: #6B7280;
        display: flex;
        justify-content: space-between;
        font-weight: 500;
    }

    .wish-category {
        font-size: 0.9rem;
        color: #6B7280;
        margin-bottom: 0.75rem;
        font-weight: 500;
    }

    .wish-status {
        padding: 0.4rem 1rem;
        border-radius: 10px;
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
    }

    .wish-status i {
        font-size: 1.1rem;
    }

    .wish-actions {
        display: flex;
        gap: 0.8rem;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid rgba(226, 232, 240, 0.8);
    }

    .wish-btn {
        flex: 1;
        padding: 0.8rem 1rem;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        cursor: pointer;
        text-decoration: none;
    }

    .edit-btn {
        background: rgba(79, 70, 229, 0.1);
        color: #4F46E5;
        border: 1px solid rgba(79, 70, 229, 0.2);
    }

    .edit-btn:hover {
        background: #4F46E5;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .delete-btn {
        background: rgba(239, 68, 68, 0.1);
        color: #EF4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .delete-btn:hover {
        background: #EF4444;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    }

    .wish-btn i {
        font-size: 1rem;
        transition: transform 0.3s ease;
    }

    .wish-btn:hover i {
        transform: translateX(2px);
    }

    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(226, 232, 240, 0.8);
    }

    .empty-state i {
        font-size: 5rem;
        color: #9CA3AF;
        margin-bottom: 2rem;
        opacity: 0.8;
    }

    .empty-state p {
        color: #6B7280;
        font-size: 1.2rem;
        margin-bottom: 2.5rem;
        font-weight: 500;
    }

    .empty-state .add-wish-btn {
        display: inline-flex;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 24px;
        border: none;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        padding: 1.8rem;
    }

    .modal-title {
        font-weight: 700;
        color: #1F2937;
        font-size: 1.4rem;
        letter-spacing: -0.3px;
    }

    .modal-body {
        padding: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #4B5563;
        margin-bottom: 0.8rem;
        font-size: 1.05rem;
    }

    .form-control, .form-select {
        border-radius: 16px;
        border: 2px solid #E5E7EB;
        padding: 0.9rem 1.2rem;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .modal-footer {
        border-top: 1px solid rgba(226, 232, 240, 0.8);
        padding: 1.8rem;
    }

    .btn-custom {
        background: linear-gradient(135deg, #4F46E5, #6366F1);
        border: none;
        padding: 0.9rem 2rem;
        border-radius: 16px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 1.05rem;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.25);
    }

    .alert {
        border-radius: 16px;
        padding: 1.2rem 1.8rem;
        margin-bottom: 2rem;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .alert-danger {
        background: rgba(239, 68, 68, 0.1);
        color: #DC2626;
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
                    <div class="progress-fill" style="width: {{ $wish->progression }}%"></div>
                </div>
                <div class="progress-text">
                    <span>{{ $wish->progression }}%</span>
                </div>

                <div style="
                display: flex;
                justify-content:start;
                align-items: center;
                gap: 15px; 
            ">


                    <span style="
                    color: white;
                    background-color: {{ ['completed' => 'green', 'pending' => 'orange', 'canceled' => 'red'][$wish->status] ?? 'gray' }};
                    padding: 5px 10px;
                    border-radius: 15px;
                    font-weight: bold;
                    font-size: 14px;
                    display: inline-block;
                    text-transform: capitalize;
                ">
                    {{ $wish->status }}
                </span>
    
    
                <span style="
                color: white;
                background-color: {{ $wish->montant_realise > 0 ? '#007bff' : '#6c757d' }};
                padding: 6px 12px;
                border-radius: 20px;
                font-weight: bold;
                font-size: 14px;
                display: inline-block;
                margin-left: 10px;
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                text-transform: capitalize;
            ">
                💰 Montant Réalisé : {{ number_format($wish->montant_realise, 2, ',', ' ') }} DH
            </span>
                      
                    
                </div>
                
            </div>
            <div class="wish-category">{{ $wish->categorie->nom}}</div>
            @if($wish->status === 'completed')
            
                <div class="wish-status completed">
                    <i class="fas fa-check-circle"></i>
                    Réalisé le {{ $wish->date_realisation->format('d/m/Y') }}
                </div>
            @endif
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
                    {{-- <div class="mb-4">
                        <label class="form-label">Montant actuel</label>
                        <div class="input-group">
                            <categoryype="number" class="form-control" name="current_amount" value="0" required>
                            <span class="input-group-text">DH</span>
                        </div>
                    </div> --}}
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