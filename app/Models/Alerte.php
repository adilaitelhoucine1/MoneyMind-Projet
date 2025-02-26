<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message', 'type', 'est_lu'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
