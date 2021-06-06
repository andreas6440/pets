<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected  $fillable = [
        'client_id',
        'nombre',
        'raza',
        'fecha_nacimiento'
    ];

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
    public function suscripcion()
    {
        return $this->hasOne(Suscripcion::class, 'mascota_id', 'id');
    }
}