<!-- Modal Objectif d'Épargne -->
<div class="modal fade" id="savingsGoalModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Objectif d'Épargne</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('savings-goals.store') }}" method="POST">
                @csrf
      
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nom de l'objectif</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                            <input type="text" class="form-control" name="nom" required placeholder="Ex: Vacances, Voiture..." value="{{ old('nom') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Montant à atteindre</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-coins"></i></span>
                            <input type="number" class="form-control" name="montant" required min="0" step="0.01" placeholder="0.00" value="{{ old('montant') }}">
                            <span class="input-group-text">DH</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pourcentage</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-percent"></i>
                            </span>
                            <input type="number" class="form-control" name="Pourcentage" required min="0" step="0.01" placeholder="10.00" value="{{ old('montant') }}">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date objectif</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="date" class="form-control" name="date_objectif" required value="{{ old('date_objectif') }}">
                        </div>
                        <small class="text-muted">Date à laquelle vous souhaitez atteindre cet objectif</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-custom">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 