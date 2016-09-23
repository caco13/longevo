@extends('app')

@section('content')
    <h1>Criar Chamado</h1>
    <hr>

    {!! Form::open(['url' => 'pedidos/encontrar']) !!}
    <div class="form-group col-lg-3">
        {!! Form::label('pedido', 'Número do pedido:') !!}
        {!! Form::text('pedido', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-lg-1 button-aligned">
        {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
    </div>
    <div class="form-group col-lg-1 button-aligned">
        {!! Html::link('chamados', 'Cancelar', ['class' => 'btn btn-default']) !!}
    </div>
    {!! Form::close() !!}
@endsection