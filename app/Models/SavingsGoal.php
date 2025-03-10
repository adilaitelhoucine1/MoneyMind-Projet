<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavingsGoal extends Model
{
    use HasFactory;

    protected $table = 'savings_goals';
    
    protected $fillable = [
        'user_id',
        'nom',
        'montant',
        'montant_epargne',
        'Pourcentage',
        'progression',
        'date_objectif'
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'montant_epargne' => 'decimal:2',
        'Pourcentage' => 'decimal:2',
        'progression' => 'decimal:2',
        'date_objectif' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
