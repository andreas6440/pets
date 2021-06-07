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
                    <h1 class="m-0 text-dark">{{ $title }} </h1>
                </div>
                <div class="card-body">
                    <table id="laravel_datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                               
                                <th>{{ trans('fields.suscripcion.monto') }}</th>
                                <th>{{ trans('fields.suscripcion.tipo_suscripcion') }}</th>
                                <th>{{ trans('fields.suscripcion.date') }}</th>                               
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
                "ajax": "{{ route('datatable.movimientos.list',['suscripcion'=>$suscripcion]) }}",
               
                "columns": [
                   
                   
                    {data: 'monto'},
                    {data: 'tipo'},
                    {data: 'date'},
                   
                    {
                        defaultContent: null,
                        sortable: false,
                        render: (data, type, full, meta) => {
                            let base = `<td class="text-center">
                                <ul class="list-inline">`;

                           
                            if(full.delete_url && full.tipo!=='impago') {
                                base += `<li class="list-inline-item">
                                <a  href="#" onclick='deleteConfirm("${full.delete_url}")' class="btn btn-block btn-danger " title="Borrar">
                                    <i class="fas fa-user"></i>
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
