@extends('app')

@section('content')
    <h1>Chamado {{ $chamado->id }}</h1>
    <h5>Atualizado em: {{ $chamado->updated_at }}</h5>
    <hr>

    <table class="table">
        <thead>
        <tr>
            <th>Pedido</th>
            <th>Cliente</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $chamado->pedido->id }}</td>
            <td>{{ $chamado->pedido->cliente->nome }}</td>
            <td>{{ $chamado->pedido->cliente->email }}</td>
        </tr>
        </tbody>
    </table>

    <table class="table">
        <thead>
        <tr>
            <th>Título</th>
            <th>Observação</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $chamado->titulo }}</td>
            <td>{{ $chamado->observacao }}</td>
        </tr>
        </tbody>
    </table>

    <div class="col-lg-1">
        {{Html::link(url('chamados/' . $chamado->id . '/edit'), 'Atualizar', ['class' => 'btn btn-primary'])}}
    </div>
    <div class="col-lg-2">
        {!! Html::link('chamados', 'Cancelar', ['class' => 'btn btn-default']) !!}
    </div>
    <div class="clearfix"></div>
@stop