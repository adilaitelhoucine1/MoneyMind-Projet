<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Categorie;

class ListeSouhaits extends Model
{
    use HasFactory;

    protected $table = 'liste_souhaits';

    protected $fillable = [
        'nom',
        'prix_estime',
        'montant_actuel',
        'categorie_id',
        'user_id',
        'priorite'
    ];

    protected $casts = [
        'prix_estime' => 'decimal:2',
        'montant_actuel' => 'decimal:2'
    ];

    /**
     * Get the progress percentage of the wish
     */
    public function getProgressAttribute()
    {
        if ($this->prix_estime <= 0) return 0;
        return min(100, round(($this->montant_actuel / $this->prix_estime) * 100));
    }

    /**
     * Get the category that owns the wish.
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    /**
     * Get the user that owns the wish.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
