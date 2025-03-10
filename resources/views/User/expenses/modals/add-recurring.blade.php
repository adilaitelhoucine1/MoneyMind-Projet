<!-- Modal Ajout Dépense -->
<div class="modal fade" id="addRecurringModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une Dépense Récurrente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addRecurringForm" action="{{ route('DepenseRecurrentes.store') }}" method="POST">
                    @csrf
                
                    <!-- Nom de la dépense -->
                    <div class="mb-3">
                        <label class="form-label">Nom de la dépense</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                            <input type="text" name="nom" class="form-control" placeholder="Ex: Abonnement Netflix" required>
                        </div>
                    </div>
                
                    <!-- montant -->
                    <div class="mb-3">
                        <label class="form-label">Montant (DH)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                            <input type="number" name="montant" class="form-control" required min="0" step="0.01">
                        </div>
                    </div>
                
                    <!-- Catégorie (choisie parmi celles ajoutées par l'admin) -->
                    <div class="mb-3">
                        <label class="form-label">Catégorie</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            <select name="categorie_id" class="form-select" required>
                                <option value="">Sélectionner une catégorie</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                
                        <!-- Date -->
                        <div class="mb-3">
                            <label for="date_extraction_salaire">Date de l'extraction du salaire</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                                <input type="date" name="date_extraction_salaire" id="date_extraction_salaire" />
                            </div>
                        </div>

                    <!-- Boutons -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Enregistrer
                        </button>
                    </div>
                </form>
                
                
            </div>
        </div>
    </div>
</div>

<style>
.modal-content {
    border-radius: 1rem;
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.modal-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    border-radius: 1rem 1rem 0 0;
    padding: 1.5rem;
}

.modal-body {
    padding: 2rem;
}

.input-group-text {
    background: var(--light-color);
    border: 1px solid rgba(0, 0, 0, 0.1);
}

.form-control, .form-select {
    border: 1px solid rgba(0, 0, 0, 0.1);
    padding: 0.75rem 1rem;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
}

.modal-footer {
    padding: 1.5rem;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addReceipt = document.getElementById('addReceipt');
    const receiptUpload = document.getElementById('receiptUpload');

    addReceipt?.addEventListener('change', function() {
        receiptUpload.classList.toggle('d-none', !this.checked);
    });
});
</script> 