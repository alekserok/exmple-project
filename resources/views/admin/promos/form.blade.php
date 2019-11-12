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
            <div class="form-group{{ $errors->has('translations.title.' . $key) ? 'has-error' : ''}}">
                {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                {!! Form::text('translations[title][' . $key . ']', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                {!! $errors->first('translations.title.' . $key, '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group{{ $errors->has('translations.link_title.' . $key) ? 'has-error' : ''}}">
                {!! Form::label('link_title', 'Link Title', ['class' => 'control-label']) !!}
                {!! Form::text('translations[link_title][' . $key . ']', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                {!! $errors->first('translations.link_title', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    @endforeach
</div>
<div class="form-group{{ $errors->has('media') ? 'has-error' : ''}}">
    {!! Form::label('media', 'Media', ['class' => 'control-label']) !!}
    {!! Form::file('media', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('media', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('link') ? 'has-error' : ''}}">
    {!! Form::label('link', 'Link', ['class' => 'control-label']) !!}
    {!! Form::text('link', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('location_page') ? 'has-error' : ''}}">
    {!! Form::label('location_page', 'Location Page', ['class' => 'control-label']) !!}
    {!! Form::text('location_page', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('location_page', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'control-label']) !!}
    {!! Form::select('type', \App\Promo::$types, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
