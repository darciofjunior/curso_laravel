@extends('adminlte::page')

@section('content')

<h1 class="title-pg">Gerenciar Produtos</h1>

@if(isset($errors) && count($errors) > 0) 
    <div class="alert alert-danger">
        @foreach($errors->all() as $error) 
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if(isset($produto)) {{--Alterar--}}
    <?php 
        $route  = route('admin/produtos/update', $produto->id);
    ?>
@else {{--Incluir--}}
    <?php 
        $route  = route('admin/produtos/store');
    ?>
@endif

<form class='form' method='post' action="{{$route}}">
    @if(isset($produto)) {{--Alterar--}}
        {!! method_field('put') !!}
    @endif

    {!! csrf_field() !!}
    
    <div class='form-group'>
        <input type='text' name='produto' value='{{isset($produto->produto) ? $produto->produto : old('produto')}}' placeholder='Produto: ' class='form-control'>
        <!--{!! Form::text('produto', null, ['class' => 'form-control', 'placeholder' => 'Produto: ']) !!}-->
    </div>
    <div class='form-group'>
        <input type='number' name='codigo_barra' value='{{isset($produto->codigo_barra) ? $produto->codigo_barra : old('codigo_barra')}}' placeholder='Código de Barra: ' class='form-control'>
    </div>
    <div class='form-group'>
        <input type='text' name='preco' value='{{(isset($produto->preco) && $produto->preco > 0) ? number_format($produto->preco, 2, ',', '.') : old('preco')}}' placeholder='Preço: ' class='form-control'>
    </div>
    <div class='form-group'>
        <select name='categoria' class='form-control'>
            <option style='color:red'>Escolha a Categoria</option>
            @foreach($categorias as $categoria)
                <option value='{{$categoria}}' 
                @if(isset($produto->categoria) == $categoria) ?? old('categoria') 
                    selected
                @endif
                >{{$categoria}}</option>
            @endforeach
        </select>
    </div>
    <div class='form-group'>
        <textarea name='descricao' placeholder='Descrição: ' class='form-control'>{{isset($produto->descricao) ? $produto->descricao : old('descricao')}}</textarea>
    </div>
    <button class='btn btn-primary'>Enviar</button>
</form>

@endsection