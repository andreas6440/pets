@extends('layout.page')

@php(
    $title = trans('messages.mascota.list')
)
@section('title', implode(' - ', [
    config('app.name'),
    $title
]))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h1 class="m-0 text-dark">{{ $title }} <a href="{{ route('mascota.create',['client'=>$client->id]) }}" class="btn btn-success" title="Nuevo Client"><i class="fas fa-plus"></i></a></h1>
                </div>
                <div class="card-body">
                    <table id="laravel_datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              
                                <th>{{ trans('fields.mascota.name') }}</th>
                                <th>{{ trans('fields.mascota.race') }}</th>
                                <th>{{ trans('fields.mascota.date') }}</th>
                                <th>{{ trans('fields.mascota.suscripcion') }}</th>
                                <th>{{ trans('fields.mascota.action') }}</th>
                                
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

@stop

@section('js')
    <script>
       
        $(document).ready(function() {
            const table = $('#laravel_datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('mascota.datatable',['client'=>$client->id]) }}",
               
                "columns": [
                    
                    {data: 'nombre'},
                    {data: 'raza'},
                    {data: 'fecha_nacimiento'},
                    {data: 'suscripcion'},
                    {
                        defaultContent: null,
                        sortable: false,
                        render: (data, type, full, meta) => {
                            let base = `<td class="text-center">
                                <ul class="list-inline">`;

                            if(full.edit_url) {
                                base += `<li class="list-inline-item">
                                <a href="${full.edit_url}" class="btn btn-block btn-primary" title="Editar">
                                    <i class="far fa-edit"></i>
                                </a>
                            </li>`;
                            }
                            if(full.delete_url) {
                                base += `<li class="list-inline-item">
                                <a  href="#" onclick='deleteConfirm("${full.delete_url}")' class="btn btn-block btn-danger " title="Borrar">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </li>`;
                            }
                            if(full.suscripcion_url) {
                                base += `<li class="list-inline-item">
                                    <a href="${full.suscripcion_url}" class="btn btn-block btn-success" title="Movimientos">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </a>
                            </li>`;
                            }
                          

                            base += `
                            </ul>
                        </div>`;

                            return base;
                        },
                    },

                ]
            });

          

           
        });
    </script>
@stop

