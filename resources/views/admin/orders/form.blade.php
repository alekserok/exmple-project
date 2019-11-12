@if(isset($order))
    <div class="form-group">
        {!! Form::label('performer_id', 'Payment Url : ' . env('APP_URL') . '/transactions/' . $order->id, ['class' => 'control-label']) !!}
    </div>
@endif
<div class="form-group{{ $errors->has('performer_id') ? 'has-error' : ''}}">
    {!! Form::label('performer_id', 'Performer', ['class' => 'control-label']) !!}
    {!! Form::select('performer_id', \App\Performer::pluck('name', 'id'), null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('performer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group"><label class="control-label">Services</label></div>
<div class="form-row services">
    @if(isset($order))
        @include('admin.services.partials._services', ['services' => \App\Service::performerServices($order->performer_id)->orderBy('name')->get()])
    @elseif($performer = \App\Performer::first())
        @include('admin.services.partials._services', ['services' => \App\Service::performerServices($performer->id)->orderBy('name')->get()])
    @endif
</div>
<div class="form-group{{ $errors->has('payment_method') ? 'has-error' : ''}}">
    {!! Form::label('payment_method', 'Payment Method', ['class' => 'control-label']) !!}
    {!! Form::select('payment_method', \App\Order::$payment_methods, null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('payment_method', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'control-label']) !!}
    {!! Form::select('type', \App\Order::$types, null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
    {!! Form::text('email', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
    {!! Form::text('phone', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('duration', 'Duration', ['class' => 'control-label']) !!}
    {!! Form::select('duration', [60 => 60, 90 => 90, 120 => 120], null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('sessions') ? 'has-error' : ''}}">
    {!! Form::label('sessions', 'Sessions', ['class' => 'control-label']) !!}
    {!! Form::select('sessions', [1 => 1, 2 => 2], null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('sessions', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('date') ? 'has-error' : ''}}">
    {!! Form::label('date', 'Date', ['class' => 'control-label']) !!}
    {!! Form::date('date', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('time_slot') ? 'has-error' : ''}}">
    {!! Form::label('time_slot', 'Time Slot', ['class' => 'control-label']) !!}
    {!! Form::select('time_slot', \App\Order::$time_slots, null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('time_slot', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('color_id') ? 'has-error' : ''}}">
    {!! Form::label('color_id', 'Color', ['class' => 'control-label']) !!}
    {!! Form::select('color_id', \App\Color::pluck('name', 'id'), null, ('required' == 'required') ? ['class' => 'form-control', 'required' => ''] : ['class' => 'form-control']) !!}
    {!! $errors->first('color_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('message') ? 'has-error' : ''}}">
    {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
    {!! Form::textarea('message', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

@section('scripts')
    <script>
        $(document).on('change', '#performer_id', function () {
            let performer = $(this).val();
            $.get('/admin/services/' + performer + '/list', function (data) {
                $('.services').html(data);
            })
        })
    </script>
@endsection
