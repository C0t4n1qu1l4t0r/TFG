<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'categoria_id'];

    protected $table = 'tipos';

    public function platos()
    {
        return $this->hasMany(Plato::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}

