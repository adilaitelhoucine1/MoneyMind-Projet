@foreach($DepensesRecurrente as $DepenseRecurrente)
<div class="recurring-item">
    <div class="recurring-icon">
        <i class="fas fa-sync-alt"></i>
    </div>
    <div class="recurring-details">
        <div class="recurring-title">{{$DepenseRecurrente->nom}}</div>
        <div class="recurring-schedule">
            <i class="far fa-calendar-alt me-1"></i>
            Chaque {{$DepenseRecurrente->date_extraction_salaire}} du mois
        </div>
    </div>
    <div class="recurring-amount">
        <div class="amount">{{number_format($DepenseRecurrente->montant, 2)}} DH</div>
        <div class="category-badge">{{$DepenseRecurrente->categorie->nom}}</div>
    </div>
</div>
@endforeach

<style>
.recurring-item {
    display: flex;
    align-items: center;
    padding: 1.25rem;
    background: white;
    border-radius: 12px;
    margin-bottom: 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.recurring-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.recurring-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1.25rem;
}

.recurring-icon i {
    color: white;
    font-size: 1.25rem;
}

.recurring-details {
    flex: 1;
}

.recurring-title {
    font-weight: 600;
    font-size: 1.1rem;
    color: #1F2937;
    margin-bottom: 0.25rem;
}

.recurring-schedule {
    color: #6B7280;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
}

.recurring-schedule i {
    margin-right: 0.5rem;
    color: #4F46E5;
}

.recurring-amount {
    text-align: right;
    min-width: 150px;
}

.amount {
    font-weight: 700;
    font-size: 1.2rem;
    color: #1F2937;
    margin-bottom: 0.25rem;
}

.category-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background: rgba(79, 70, 229, 0.1);
    color: #4F46E5;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

@media (max-width: 768px) {
    .recurring-item {
        flex-direction: column;
        text-align: center;
        padding: 1rem;
    }

    .recurring-icon {
        margin: 0 auto 1rem;
    }

    .recurring-details {
        margin-bottom: 1rem;
    }

    .recurring-amount {
        width: 100%;
        text-align: center;
    }

    .recurring-schedule {
        justify-content: center;
    }
}
</style> 