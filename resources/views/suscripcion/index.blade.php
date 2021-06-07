@extends('layout.page')

@php(
    $title = trans('messages.suscripcion.list')
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
                    <h1 class="m-0 text-dark">{{ $title }} <a href="{{ route('movimiento.create',['suscripcion'=>$suscripcion]) }}" class="btn btn-success" title="Nuevo Client"><i class="fas fa-plus"></i></a></h1>
                </div>
                <div class="card-body">
                    <table id="laravel_datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                               
                                <th>{{ trans('fields.suscripcion.id') }}</th>
                                <th>{{ trans('fields.suscripcion.monto') }}</th>
                                <th>{{ trans('fields.suscripcion.tipo_suscripcion') }}</th>
                                <th>{{ trans('fields.suscripcion.date') }}</th>                               
                                <th>{{ trans('fields.suscripcion.estado') }}</th>                               
                                <th>{{ trans('fields.suscripcion.action') }}</th>
                                
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
                order: [[ 0, "desc" ]],
                "ajax": "{{ route('datatable.movimientos.list',['suscripcion'=>$suscripcion]) }}",
               
                "columns": [
                   
                    {data:'id'},
                    {data: 'monto'},
                    {data: 'tipo'},
                    {data: 'date'},
                    {data: 'estado'},
                   
                    {
                        defaultContent: null,
                        sortable: false,
                        render: (data, type, full, meta) => {
                            let base = `<td class="text-center">
                                <ul class="list-inline">`;

                           
                            if(full.delete_url && full.tipo!=='impago') {
                                base += `<li class="list-inline-item">
                                <a  href="#" onclick='deleteConfirm("${full.delete_url}")' class="btn btn-block btn-danger " title="Borrar">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </li>`;
                            }
                            
                          

                            base += `
                            </ul>
                        </div>`;

                            return base;
                        },
                    },

                ] ,
                "columnDefs": [ 
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": true
                    },
                    
                ]
            });

          
        });
    </script>
@stop

