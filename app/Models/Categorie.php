<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }
    public function listeSouhaits()
{
    return $this->hasMany(ListeSouhaits::class);
}
}
