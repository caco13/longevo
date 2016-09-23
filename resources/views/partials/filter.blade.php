<div>
    {!! Form::open(['url' => 'chamados']) !!}
    <div class="form-group col-lg-3">
        {!! Form::label('pedido', 'Pedido:') !!}
        {!! Form::text('pedido', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-lg-3">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-lg-1 button-aligned">
        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    <div class="clearfix"></div>
    {!! Form::close() !!}
</div>