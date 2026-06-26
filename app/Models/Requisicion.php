<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    protected $table = 'requisiciones';

    protected $primaryKey = 'idRequisicion';

    protected $fillable = [
        'fecha',
        'estado',
        'idUsuario',
    ];

    // Requisicion pertenece a un Usuario (0..1 a 1)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario', 'idUsuario');
    }

    // Requisicion tiene muchos ItemRequisicion (1 a 1..*)
    public function itemRequisiciones()
    {
        return $this->hasMany(ItemRequisicion::class, 'idRequisicion', 'idRequisicion');
    }
}