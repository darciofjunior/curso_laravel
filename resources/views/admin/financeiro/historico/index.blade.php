@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Histórico</h1>
@stop

@section('content')
    <div class="box-header">
        <form method="post" action="{{route('admin/financeiro/historico/pesquisar')}}" class="form form-inline">
            {!! csrf_field() !!}
            <input type="text" name="id" class="form-control" placeholder="id">
            <input type="date" name="data" class="form-control">
            <select name="tipo" class="form-control">
                <option value="">-- Selecione o Tipo--</option>
                @foreach($tipos as $id => $tipo)
                    <option value="{{$id}}">{{$tipo}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </form>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Valor</th>
                    <th>Tipo</th>
                    <th>Recebedor</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @forelse($historicos as $historico)
                <tr>
                    <td>{{$historico->id}}</td>
                    <td>{{number_format($historico->saldo, 2, ',', '.')}}</td>
                    <td>{{$historico->tipos($historico->tipo)}}</td>
                    <td>
                        @if($historico->user_id_transaction)
                            {{$historico->user_transferidor->name}}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{$historico->data}}</td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        
        @if(isset($dados_formulario))
            {!! $historicos->appends($dados_formulario)->links() !!}
        @else
            {!! $historicos->links() !!}
        @endif
    </div>
@stop