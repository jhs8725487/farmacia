<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'laboratorio_id',
        'codigo_producto',
        'codigo_barra',
        'nombre_comercial',
        'nombre_generico',
        'forma_farmaceutica',
        'presentacion',
        'concentracion',
        'accion_terapeutica',
        'unidad_medida',
        'usa_receta',
        'imagen',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class);
    }
}
