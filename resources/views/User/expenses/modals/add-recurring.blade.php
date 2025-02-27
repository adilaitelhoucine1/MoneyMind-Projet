<!-- Modal Ajout Dépense Récurrente -->
<div class="modal fade" id="addRecurringModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une Dépense Récurrente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addRecurringForm">
                    <div class="mb-3">
                        <label class="form-label">Montant (DH)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                            <input type="number" class="form-control" required min="0" step="0.01">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Catégorie</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                            <select class="form-select" required>
                                <option value="">Sélectionner une catégorie</option>
                                <option value="logement">Logement</option>
                                <option value="transport">Transport</option>
                                <option value="services">Services</option>
                                <option value="abonnements">Abonnements</option>
                                <option value="autres">Autres</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fréquence</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-sync"></i></span>
                            <select class="form-select" required id="frequencySelect">
                                <option value="">Sélectionner une fréquence</option>
                                <option value="mensuel">Mensuel</option>
                                <option value="hebdomadaire">Hebdomadaire</option>
                                <option value="trimestriel">Trimestriel</option>
                                <option value="annuel">Annuel</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3" id="monthlyOptions">
                        <label class="form-label">Jour du mois</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            <select class="form-select">
                                @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mode de paiement</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                            <select class="form-select" required>
                                <option value="">Sélectionner un mode de paiement</option>
                                <option value="prelevement">Prélèvement automatique</option>
                                <option value="virement">Virement permanent</option>
                                <option value="carte">Carte bancaire</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="enableNotifications" checked>
                            <label class="form-check-label" for="enableNotifications">
                                Activer les notifications
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="addRecurringForm" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Enregistrer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const frequencySelect = document.getElementById('frequencySelect');
    const monthlyOptions = document.getElementById('monthlyOptions');

    frequencySelect?.addEventListener('change', function() {
        monthlyOptions.classList.toggle('d-none', this.value !== 'mensuel');
    });
});
</script> 