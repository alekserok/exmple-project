@if((isset($category) && !in_array($category->id, \App\Category::$root_categories)) || !isset($category))
    <div class="form-group"><label class="control-label">Parent Categories</label></div>
    <div class="form-row">
        @foreach(\App\Category::whereIn('id', \App\Category::$root_categories)->orderBy('name')->get() as $service)
            @if($loop->index == 0 || $loop->index % 1 == 0)
                <div class="form-group col-md-4">
                    @endif
                    <div class="form-check">
                        {!! Form::checkbox('parents[]', $service->id) !!}
                        <label class="form-check-label" for="service-{{ $service->id }}">{{ $service->name}}</label>
                    </div>
                    @if(($loop->index + 1) % 1 == 0 || $loop->last)
                </div>
            @endif
        @endforeach
    </div>
@endif
@if (isset($category) && in_array($category->id, \App\Category::$root_categories))
    <div class="form-group"><label class="control-label">Child Categories</label></div>
    <div class="form-row">
        @foreach(\App\Category::whereNotIn('id', \App\Category::$root_categories)->orderBy('name')->get() as $service)
            @if($loop->index == 0 || $loop->index % 4 == 0)
                <div class="form-group col-md-4">
                    @endif
                    <div class="form-check">
                        {!! Form::checkbox('children[]', $service->id) !!}
                        <label class="form-check-label" for="service-{{ $service->id }}">{{ $service->name}}</label>
                    </div>
                    @if(($loop->index + 1) % 4 == 0 || $loop->last)
                </div>
            @endif
        @endforeach
    </div>
@endif
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


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
