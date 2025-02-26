<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ListeSouhaits extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nom', 'prix_estime', 'priorite'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
