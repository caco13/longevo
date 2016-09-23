@extends('app')

@section('content')
    <h1>Criar Chamado</h1>
    <hr>

    {!! Form::open(['url' => 'pedidos/encontrar']) !!}
    <div class="form-group">
        {!! Form::label('pedido', 'Número do pedido:') !!}
        {!! Form::text('pedido', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Buscar', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
@endsection