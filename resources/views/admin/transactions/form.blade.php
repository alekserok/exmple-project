<div class="form-group{{ $errors->has('order_id') ? 'has-error' : ''}}">
    {!! Form::label('order_id', 'Order Id', ['class' => 'control-label']) !!}
    {!! Form::number('order_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('order_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('gateway') ? 'has-error' : ''}}">
    {!! Form::label('gateway', 'Gateway', ['class' => 'control-label']) !!}
    {!! Form::text('gateway', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('gateway', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('reference') ? 'has-error' : ''}}">
    {!! Form::label('reference', 'Reference', ['class' => 'control-label']) !!}
    {!! Form::text('reference', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('reference', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('currency') ? 'has-error' : ''}}">
    {!! Form::label('currency', 'Currency', ['class' => 'control-label']) !!}
    {!! Form::text('currency', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('currency', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('amount') ? 'has-error' : ''}}">
    {!! Form::label('amount', 'Amount', ['class' => 'control-label']) !!}
    {!! Form::text('amount', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
    {!! Form::number('status', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
