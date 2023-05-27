<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergeno extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    public function platos()
    {
        return $this->belongsToMany(Plato::class,'alergenos_platos','alergeno_id');
    }
}
