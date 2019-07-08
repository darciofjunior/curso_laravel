@extends('adminlte::page')

@section('content')

<h1 class="title-pg">Produto: <b>{{$produto->produto}}</b></h1>

<p><b>Código de Barra: </b>{{$produto->codigo_barra}}</p>
<p><b>Preço R$: </b>{{number_format($produto->preco, 2, ',', '.')}}</p>
<p><b>Categoria: </b>{{$produto->categoria}}</p>
<p><b>Descrição: </b>{{$produto->descricao}}</p>

<hr>

@if(isset($errors) && count($errors) > 0) 
    <div class="alert alert-danger">
        @foreach($errors->all() as $error) 
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

{!! Form::open(['route' => ['admin/produtos/destroy', $produto->id], 'method' => 'delete']) !!}
    {!! Form::submit("Deletar", ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}

@endsection