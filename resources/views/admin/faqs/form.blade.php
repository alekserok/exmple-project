<div class="form-group{{ $errors->has('category_id') ? 'has-error' : ''}}">
    {!! Form::label('category_id', 'Category Id', ['class' => 'control-label']) !!}
    {!! Form::select('category_id', \App\FaqCategory::pluck('name','id'), null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
</div>
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
            <div class="form-group{{ $errors->has('translations.content.' . $key) ? 'has-error' : ''}}">
                {!! Form::label('content', 'Content', ['class' => 'control-label']) !!}
                {!! Form::textarea('translations[content][' . $key . ']', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                {!! $errors->first('translations.content.' . $key, '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    @endforeach
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
