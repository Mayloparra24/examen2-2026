<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $table = 'unidades';

    protected $primaryKey = 'idUnidad';

    protected $fillable = [
        'nombre',
    ];

    // Una Unidad tiene muchos MaterialUnidad (1 a 0..*)
    public function materialUnidades()
    {
        return $this->hasMany(MaterialUnidad::class, 'idUnidad', 'idUnidad');
    }

    // Una Unidad tiene muchos Presupuestos (1 a 1..*)
    public function presupuestos()
    {
        return $this->hasMany(Presupuesto::class, 'idUnidad', 'idUnidad');
    }

    // Una Unidad tiene muchos Usuarios (labora en, 1 a 0..*)
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'idUnidad', 'idUnidad');
    }
}