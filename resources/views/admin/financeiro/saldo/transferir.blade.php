@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Transferir Saldo</h1>
    
    <ol class="breadcrumb">
        <li><a href=""></a>Dashboard</li>
        <li><a href=""></a>Saldo</li>
        <li><a href=""></a>Transferir</li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Transferir Saldo (Informe o Recebedor)</h3>
        </div>
        <div class="box-body">
            @include('admin/includes/alerts')
            <form method="post" action="{{route('admin/financeiro/saldo/confirmartransferencia')}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" name="txt_recebedor" placeholder="Recebedor de quem vai receber (Nome ou E-mail)" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Próxima Etapa</button>
                </div>
            </form>
        </div>
    </div>
@stop