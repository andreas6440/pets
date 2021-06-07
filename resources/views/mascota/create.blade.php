
@extends('layout.page')

@php(
    $title = trans('messages.mascota.create')
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
                    <h1 class="m-0 text-dark">{{ $title }}</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('mascota.store',['client'=>$client->id]) }}">
                        @csrf
                        <div class="row my-2">
                            @include('mascota.main-form')
                        </div>
                        <div class="row my-2">
                            <div class="col">                               
                                <a href="{{ route('mascota.list',['client'=>$client->id])}}" class="btn btn-secondary"> {{ trans('fields.actions.cancel') }}</a>                                
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">{{ trans('fields.actions.save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->

@stop