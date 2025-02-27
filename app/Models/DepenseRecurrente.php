<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class DepenseRecurrente extends Model
{
    use HasFactory;

    protected $table = 'depenses_recurrentes';
    protected $fillable = ['user_id', 'categorie_id', 'nom', 'montant', 'date_extraction_salaire'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
