@extends('app')

@section('content')
    <h1>Criar chamado</h1>
    <hr>

    {!! Form::model($chamado, ['method' => 'PATCH', 'action' => ['ChamadosController@update', $chamado->id]]) !!}
        @include('chamados.form', ['botaoSubmeter' => 'Atualizar'])
    {!! Form::close() !!}

    @include('errors.list')
@stop