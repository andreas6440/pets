<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $fillable = [
        'mascota_id',
        'fecha_alta_suscripcion',
        'costo_suscripcion',
    ];

    public function mascota()
    {
        return $this->hasOne(Mascota::class, 'id', 'mascota_id');
    }
    public function movimientos()
    {
        return $this->hasMany(SuscripcionMovimiento::class, 'suscripcion_id', 'id');
    }
}