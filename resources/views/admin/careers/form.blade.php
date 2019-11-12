<div class="form-group{{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'control-label']) !!}
    {!! Form::select('type', \App\Career::$types, null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('age') ? 'has-error' : ''}}">
    {!! Form::label('age', 'Age', ['class' => 'control-label']) !!}
    {!! Form::text('age', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('age', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('visa_status') ? 'has-error' : ''}}">
    {!! Form::label('visa_status', 'Visa Status', ['class' => 'control-label']) !!}
    {!! Form::text('visa_status', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('visa_status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('nationality') ? 'has-error' : ''}}">
    {!! Form::label('nationality', 'Nationality', ['class' => 'control-label']) !!}
    {!! Form::text('nationality', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('nationality', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('language') ? 'has-error' : ''}}">
    {!! Form::label('language', 'Language', ['class' => 'control-label']) !!}
    {!! Form::text('language', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('language', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('contacts') ? 'has-error' : ''}}">
    {!! Form::label('contacts', 'Contacts', ['class' => 'control-label']) !!}
    {!! Form::text('contacts', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('contacts', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('socials') ? 'has-error' : ''}}">
    {!! Form::label('socials', 'Socials', ['class' => 'control-label']) !!}
    {!! Form::text('socials', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('socials', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('attachment') ? 'has-error' : ''}}">
    {!! Form::label('attachment', 'Attachment', ['class' => 'control-label']) !!}
    {!! Form::file('attachment', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('attachment', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

@if(isset($career))
    <div class="form-row">
        <div class="col-md-8">
            <img style="max-height: 300px" src="/storage/{{ $career->attachment }}">
        </div>
    </div>
@endif
