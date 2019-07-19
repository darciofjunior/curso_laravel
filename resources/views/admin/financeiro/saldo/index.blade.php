@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Saldo</h1>
@stop

@section('content')
    <div class="box-header">
        <a href="{{route('admin/financeiro/saldo/deposito')}}" class="btn btn-primary">
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
            Recarregar
        </a>
        @if($saldo > 0)
            <a href="{{route('admin/financeiro/saldo/sacar')}}" class="btn btn-danger">
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                Sacar
            </a>
        @endif
        
        @if($saldo > 0)
            <a href="{{route('admin/financeiro/saldo/transferir')}}" class="btn btn-info">
                <i class="fa fa-exchange" aria-hidden="true"></i>
                Transferir
            </a>
        @endif
    </div>
    <div class="box-body">
        @include('admin/includes/alerts')
        <div class="small-box bg-green">
            <div class="inner">
                <h3><sup style="font-size: 20px">R$ {{number_format($saldo, 2, ',', '.')}}</sup></h3>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
            <a href="#" class="small-box-footer">
                Histórico
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
@stop