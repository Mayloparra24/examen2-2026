<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $table = 'presupuestos';

    protected $primaryKey = 'codigoPresupuesto';

    protected $fillable = [
        'nombrePresupuesto',
        'idUnidad',
    ];

    // Presupuesto pertenece a una Unidad (1..* a 1)
    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'idUnidad', 'idUnidad');
    }

    // Presupuesto tiene muchos MaterialUnidad (0..* a 1)
    public function materialUnidades()
    {
        return $this->hasMany(MaterialUnidad::class, 'idPresupuesto', 'codigoPresupuesto');
    }
}