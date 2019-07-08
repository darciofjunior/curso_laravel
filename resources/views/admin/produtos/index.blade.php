@extends('adminlte::page')

@section('content')

<h1 class="title-pg">Listagem de Produtos</h1>

@if(isset($message) > 0 || Session::get('message'))
    <div class="alert alert-success">
        @if(isset($message) && count($message) > 0)
            @foreach($message->all() as $msn) 
                <p>{{$msn}}</p>
            @endforeach
        @else
            <p>{{Session::get('message')}}</p>
        @endif
    </div>
@endif

<a href="{{route('admin/produtos/create')}}" class="btn btn-primary btn-add">
    Cadastrar
</a>

<table class="table table-striped">
    <tr>
        <th>Produto</th>
        <th>Código de Barra</th>
        <th>Preço R$</th>
        <th>Categoria</th>
        <th>Descrição</th>
        <th width="100px">Ações</th>
    </tr>
    @foreach($produtos as $produto) 
    <tr>
        <td>{{$produto->produto}}</td>
        <td>{{$produto->codigo_barra}}</td>
        <td>{{number_format($produto->preco, 2, ',', '.')}}</td>
        <td>{{$produto->categoria}}</td>
        <td>{{$produto->descricao}}</td>
        <td>
            <a href="{{route('admin/produtos/edit', $produto->id)}}">
                <img src="{{asset('imagens/alterar.png')}}">
            </a>
            <a href="{{route('admin/produtos/show', $produto->id)}}">
                <img src="{{asset('imagens/visualizar.png')}}">
            </a>
        </td>
    </tr>
    @endforeach
    <tfoot>
        <tr>
            <td colspan='5' id="center">{{$produtos->links()}}</td>
        </tr>
    </tfoot>
</table>

@endsection