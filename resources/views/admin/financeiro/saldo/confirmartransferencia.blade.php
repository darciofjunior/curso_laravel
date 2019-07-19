@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Confirmar Transferência</h1>
    
    <ol class="breadcrumb">
        <li><a href=""></a>Dashboard</li>
        <li><a href=""></a>Saldo</li>
        <li><a href=""></a>Transferir</li>
        <li><a href=""></a>Confirmação</li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Confirmar Transferência</h3>
        </div>
        <div class="box-body">
            @include('admin/includes/alerts')
            
            <p><strong>Recebedor: {{$tabela_user->name}}</strong></p>
            <p><strong>Seu Saldo Atual: {{number_format($saldo, 2, ',', '.')}}</strong></p>
            
            <form method="post" action="{{route('admin/financeiro/saldo/transferir/store')}}">
                {!! csrf_field() !!}
                
                <input type="hidden" name="user_id" value="{{$tabela_user->id}}">
                
                <div class="form-group">
                    <input type="number" name="txt_valor" placeholder="Valor" step="any" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Transferir</button>
                </div>
            </form>
        </div>
    </div>
@stop