<div class="col-md-4">
    <div class="form-group">
        @include('common.input_text', [
            'name' => 'nombre',
            'label' => trans('fields.mascota.name'),
            'value' => $mascota->nombre,
        ])
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        @include('common.input_text', [
            'name' => 'raza',
            'label' => trans('fields.mascota.race'),
            'value' => $mascota->apellido,
        ])
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        @include('common.input_date', [
            'name' => 'fecha_nacimiento',
            'label' => trans('fields.mascota.date'),
            'value' => $mascota->fecha_nacimiento ,
        ])
    </div>
</div>