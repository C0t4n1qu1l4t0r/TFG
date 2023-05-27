<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ingredients',
        'price',
        'image',
        'alergens_id',
        'type_id',
        'category_id',
    ];

    public function alergenos()
    {
        return $this->belongsToMany(Alergeno::class,'alergenos_platos','plato_id');
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
