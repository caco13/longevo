<section>
    {!! Form::open(['url' => 'chamados']) !!}
    <div class="form-group">
        {!! Form::label('pedido', 'Pedido:') !!}
        {!! Form::text('pedido', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
</section>