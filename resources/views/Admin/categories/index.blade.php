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
        background: var(--glass-bg, rgba(255, 255, 255, 0.9));
        border-radius: 20px;
        padding: 1.75rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
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
        background: linear-gradient(135deg, var(--primary-color, #4F46E5), var(--secondary-color, #7C3AED));
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
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        animation: shimmer 2s infinite;
    }

    .category-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary, #1F2937);
        margin-bottom: 0.5rem;
    }

    .category-description {
        color: var(--text-secondary, #6B7280);
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
        margin-bottom: 1rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary, #1F2937);
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--text-secondary, #6B7280);
    }

    .category-footer {
        padding-top: 0.5rem;
    }

    .progress {
        background-color: rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar {
        transition: width 0.6s ease;
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
        text-align: center;
        padding: 3rem 2rem;
    }

    .add-category-card:hover {
        background: rgba(79, 70, 229, 0.1);
        border-color: rgba(79, 70, 229, 0.3);
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
        color: var(--primary-color, #4F46E5);
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .add-category-card:hover .add-icon {
        background: linear-gradient(135deg, var(--primary-color, #4F46E5), var(--secondary-color, #7C3AED));
        color: white;
    }

    .add-text {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-color, #4F46E5);
        margin-bottom: 0.5rem;
    }

    .add-description {
        color: var(--text-secondary, #6B7280);
        font-size: 0.875rem;
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

    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
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
         
        </div>
    </div>

    <div class="categories-grid">
        @foreach($categories as $category)
        <div class="category-card">
            <div class="category-header">
                <div>
                    <div class="category-icon">
                        <i class="fas fa-{{ $category->icon ?? 'folder' }}"></i>
                    </div>
                    <h4 class="category-name">{{ $category->nom }}</h4>
                    <p class="category-description">
                        {{ $category->description ?? 'Catégorie de dépenses et revenus' }}
                    </p>
                </div>
                <div class="category-actions">
                    <div class="dropdown">
                        <button class="action-btn" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editCategoryModal" 
                                   data-category-id="{{ $category->id }}" data-category-name="{{ $category->nom }}"
                                   onclick="editCategory({{ $category->id }}, '{{ $category->nom }}')">
                                    <i class="fas fa-edit me-2 text-primary"></i>Modifier
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                
                                    <button class="dropdown-item text-danger" type="submit" 
                                            onclick="if(!confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')) { event.preventDefault(); }">
                                        <i class="fas fa-trash-alt me-2"></i>Supprimer
                                    </button>
                                </form>
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="category-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ $category->transactions_count ?? 0 }}</div>
                    <div class="stat-label">Transactions</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ number_format($category->total_amount ?? 0, 2) }} DH</div>
                    <div class="stat-label">Total</div>
                </div>
            </div>
            <div class="category-footer">
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-primary" role="progressbar" 
                         style="width: {{ ($category->transactions_count ?? 0) > 0 ? '75' : '0' }}%"></div>
                </div>
            </div>
            <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
        @endforeach

        <!-- Add Category Card -->
        <div class="category-card add-category-card" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <div class="add-icon">
                <i class="fas fa-plus"></i>
            </div>
            <div class="add-text">Ajouter une Catégorie</div>
            <p class="add-description">Créer une nouvelle catégorie pour organiser vos transactions</p>
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
                <form action="{{ route('categories.store') }}" method="POST" id="addCategoryForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nom de la catégorie</label>
                        <input type="text" class="form-control" name="nom" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="addCategoryForm" class="btn btn-primary">Créer</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier la Catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.edit', ':category_id') }}" method="POST" id="editCategoryForm">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nom de la catégorie</label>
                        <input type="text" class="form-control" name="nom" id="editCategoryName" required>
                        <input type="hidden" id="categoryId" name="category_id">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="editCategoryForm" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editModal = document.getElementById('editCategoryModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            const button = event.relatedTarget;
            
            // Extract info from data-* attributes
            const categoryId = button.getAttribute('data-category-id');
            const categoryName = button.getAttribute('data-category-name');
            
            // Update the modal's content
            const modalTitle = editModal.querySelector('.modal-title');
            const categoryInput = editModal.querySelector('#editCategoryName');
            const form = editModal.querySelector('#editCategoryForm');
            
            modalTitle.textContent = 'Modifier la Catégorie';
            categoryInput.value = categoryName;
            form.action = `/categories/${categoryId}`;
        });
    }
});

function editCategory(id, nom) {
    document.getElementById('editCategoryName').value = nom;
    
    document.getElementById('categoryId').value = id;
    
    let form = document.getElementById('editCategoryForm');
    let action = form.getAttribute('action');
    form.setAttribute('action', action.replace(':category_id', id));
   
}
</script>
@endsection 