@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Saldo</h1>
@stop

@section('content')
    <div class="box-header">
        <a href="{{route('saldo/deposito')}}" class="btn btn-primary">
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
            Recarregar
        </a>
        <a href="" class="btn btn-danger">
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
            Sacar
        </a>
    </div>
    <div class="box-body">
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