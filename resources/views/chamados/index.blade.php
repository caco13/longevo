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
            // Clicar em uma linha da tabela para mostrar chamado
            $(document).ready(function($) {
                $(".clickable-row").click(function() {
                    window.location = $(this).data("href");
                });
            });

            // Ajax de busca com autocomplete
            $(document).ready(function () {
                var src = "{{ route('buscaajax') }}";
                $("#search_text").autocomplete({
                    source: function (request, response) {
                        $.ajax({
                            url: src,
                            dataType: "json",
                            data: {
                                term: request.term,
                                model: $("#search_text").attr('data-model'),
                                attribute: $("#search_text").attr('data-attribute')
                            },
                            success: function (data) {
                                response(data);
                            }
                        });
                    },
                    minLength: 3
                });
            });
        </script>
    @stop
@stop