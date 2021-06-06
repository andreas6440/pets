@extends('layout.page')

@php(
    $title = trans('messages.client.list')
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
                    <h1 class="m-0 text-dark">{{ $title }} <a href="{{ route('client.create') }}" class="btn btn-success" title="Nuevo Client"><i class="fas fa-plus"></i></a></h1>
                </div>
                <div class="card-body">
                    <table id="laravel_datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans('fields.client.id') }}</th>
                                <th>{{ trans('fields.client.nombre') }}</th>
                                <th>{{ trans('fields.client.apellido') }}</th>
                                <th>{{ trans('fields.client.email') }}</th>
                                <th>{{ trans('fields.client.action') }}</th>
                                
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
                "ajax": '/datatable/clients',
               
                "columns": [
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'apellido'},
                    {data: 'email'},
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
                                    <i class="fas fa-user"></i>
                                </a>
                            </li>`;
                            }
                            if(full.mascota_url) {
                                base += `<li class="list-inline-item">
                                <a href="${full.mascota_url}"  class="btn btn-block btn-success" title="Mascotas">
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
