@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Fazer Recarga</h1>
    
    <ol class="breadcrumb">
        <li><a href=""></a>Dashboard</li>
        <li><a href=""></a>Saldo</li>
        <li><a href=""></a>Depositar</li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Fazer Recarga</h3>
        </div>
        <div class="box-body">
            @include('admin/includes/alerts')
            <form method="post" action="{{route('admin/financeiro/saldo/deposito/store')}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="number" name="txt_valor" placeholder="Valor Recarga" step="any" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Recarregar</button>
                </div>
            </form>
        </div>
    </div>
@stop