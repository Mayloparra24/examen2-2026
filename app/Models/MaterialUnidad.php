<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialUnidad extends Model
{
    protected $table = 'material_unidades';

    protected $primaryKey = 'idMaterialUnidad';

    protected $fillable = [
        'cantidad',
        'idUnidad',
        'idMaterial',
    ];

    // MaterialUnidad pertenece a una Unidad (0..* a 1)
    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'idUnidad', 'idUnidad');
    }

    // MaterialUnidad pertenece a un Material (1..* a 1)
    public function material()
    {
        return $this->belongsTo(Material::class, 'idMaterial', 'codigo');
    }

    // MaterialUnidad puede estar comprado con un Presupuesto (0..* a 1)
    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class, 'idPresupuesto', 'codigoPresupuesto');
    }
}