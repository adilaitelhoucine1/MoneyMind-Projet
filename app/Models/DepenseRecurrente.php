<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepenseRecurrente extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'categorie_id', 'nom', 'montant', 'frequence', 'date_debut'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
