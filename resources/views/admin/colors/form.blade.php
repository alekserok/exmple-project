<ul class="nav nav-tabs" id="myTab" role="tablist">
    @foreach(config('languages') as $val)
        <li class="nav-item">
            <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="{{ $val }}-tab" data-toggle="tab" href="#{{ $val }}" role="tab" aria-controls="{{ $val }}" aria-selected="true">{{ strtoupper($val) }}</a>
        </li>
    @endforeach
</ul>
<div class="tab-content" id="tab-content">
    @foreach(config('languages') as $key => $val)
        <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}" id="{{ $val }}" role="tabpanel" aria-labelledby="{{ $val }}-tab">
            <div class="form-group{{ $errors->has('translations.name.' . $key) ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                {!! Form::text('translations[name][' . $key . ']', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                {!! $errors->first('translations.name.' . $key, '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    @endforeach
</div>
<div class="form-group{{ $errors->has('color') ? 'has-error' : ''}}">
    {!! Form::label('color', 'Color', ['class' => 'control-label']) !!}
    {!! Form::color('color', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('color', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
