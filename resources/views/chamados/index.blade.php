@extends('app')

@section('content')
    <h1>Chamados</h1>
    <hr>
    @include('partials.filter')

    @if($chamados->isEmpty())
        <p>A lista de chamados está vazia.</p>
    @else
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
                        <td>{{ $chamado->pedido->id }}</td>
                        <td>{{ $chamado->pedido->cliente->nome }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection