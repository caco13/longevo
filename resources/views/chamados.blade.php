@extends('app')

@section('content')
    <h1>Chamados</h1>

    @if(isEmpty($chamados))
        <p>A lista de chamados está vazia.</p>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Chamado</th>
                <th>Pedido</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chamados as $chamado)
                <tr>
                    <td>{{ $chamado->id }}</td>
                    <td>{{ $chamado->pedido }}</td>
                    <td>{{ $chamado->pedido->cliente }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection