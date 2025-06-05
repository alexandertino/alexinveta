<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cliente_id',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}