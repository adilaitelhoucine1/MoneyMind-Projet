<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObjectifMensuel extends Model
{
    use HasFactory;

    protected $table = 'objectifs_mensuels';
    
    protected $fillable = [
        'user_id',
        'nom',
        'montant',
        'date_objectif'
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_objectif' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
