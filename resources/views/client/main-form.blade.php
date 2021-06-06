<div class="col-md-4">
    <div class="form-group">
        @include('common.input_text', [
            'name' => 'nombre',
            'label' => trans('fields.client.nombre'),
            'value' => $client->nombre,
        ])
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        @include('common.input_text', [
            'name' => 'apellido',
            'label' => trans('fields.client.apellido'),
            'value' => $client->apellido,
        ])
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        @include('common.input_text', [
            'name' => 'email',
            'label' => trans('fields.client.email'),
            'value' => $client->email ,
            'type' =>'email'
        ])
    </div>
</div>