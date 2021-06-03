<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'email';
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'nombre',
        'apellido',
        'email'
    ];
}