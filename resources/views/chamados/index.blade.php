@extends('app')

@section('content')
    <a href="{{ url('chamados') }}" class="href"><h1>Chamados</h1></a>
    <hr>
    @include('partials.filter')

    <div>
        @if($chamados->isEmpty())
            <p>A lista de chamados está vazia.</p>
        @else
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Chamado</th>
                    <th>Pedido</th>
                    <th>Cliente</th>
                </tr>
                </thead>
                <tbody>
                @foreach($chamados as $chamado)
                    <tr class="clickable-row" data-href="/chamados/{{ $chamado->id }}">
                        <td>{{ $chamado->id }}</td>
                        <td>{{ $chamado->pedido->id }}</td>
                        <td>{{ $chamado->pedido->cliente->nome }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div>
        <a href="{{ url('pedidos/buscar') }}" class="btn btn-primary">Novo Chamado</a>
        @if ($paginate)
            <span class="pull-right">
                {{ $chamados->links() }}
            </span>
        @endif
    </div>
    @section('footer')
        <script>
            $(document).ready(function($) {
                $(".clickable-row").click(function() {
                    window.location = $(this).data("href");
                });
            });
        </script>
    @stop
@stop