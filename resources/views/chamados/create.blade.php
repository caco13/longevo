@extends('app')

@section('content')
    <h1>Criar chamado</h1>
    <hr>
    {!! Form::model($chamado = new App\Chamado, ['url' => 'chamados/store']) !!}
        @include('chamados.form', ['botaoSubmeter' => 'Salvar'])
    {!! Form::close() !!}

    @include('errors.list')
@stop