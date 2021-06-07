<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    'client' => [
        'id' => 'ID',
        'nombre' => 'Nombre',
        'apellido' => 'Apellido',
        'email' => 'Email',
        'action' => 'Acciones'
    ],
    'mascota' => [
        'id' => 'ID',
        'name' => 'Nombre',
        'race' => 'Raza',
        'date' => 'Fecha de nacimiento',
        'suscripcion' => 'Fecha de suscripción',
        'action' => 'Acciones'
    ],
    'suscripcion' => [
        'costo' => '600.50',
        'monto' => 'Monto',
        'tipo_suscripcion' => 'Tipo de pago',
        'date' => 'Fecha de pago',
        'action' => 'Acciones',
        'tipo' => [
            'pago',
            'impago',
        ]

    ],
    'actions' => [
        'cancel' => 'Cancelar',
        'save_edit' => 'Guardar Cambios',
        'save' => 'Guardar'
    ]

];