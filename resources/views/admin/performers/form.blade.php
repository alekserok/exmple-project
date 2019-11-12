<div class="form-group{{ $errors->has('letter') ? 'has-error' : ''}}">
    {!! Form::label('letter', 'Letter', ['class' => 'control-label']) !!}
    {!! Form::text('letter', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('letter', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'control-label']) !!}
    {!! Form::text('price', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('country') ? 'has-error' : ''}}">
    {!! Form::label('country', 'Country', ['class' => 'control-label']) !!}
    {!! Form::text('country', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group"><label class="control-label">Categories</label></div>
<div class="form-row">
    @foreach(\App\Category::orderBy('name')->get() as $service)
        @if($loop->index == 0 || $loop->index % 3 == 0)
            <div class="form-group col-md-4">
        @endif
                <div class="form-check">
                    {!! Form::checkbox('categories[]', $service->id) !!}
                    <label class="form-check-label" for="service-{{ $service->id }}">{{ $service->name}}</label>
                </div>
        @if(($loop->index + 1) % 3 == 0 || $loop->last)
            </div>
        @endif
    @endforeach
</div>
<div class="form-group"><label class="control-label">Services</label></div>
<div class="form-row">
    @foreach(\App\Service::orderBy('name')->get() as $service)
        @if($loop->index == 0 || $loop->index % 6 == 0)
            <div class="form-group col-md-4">
        @endif
                <div class="form-check">
                    {!! Form::checkbox('services[]', $service->id) !!}
                    <label class="form-check-label" for="service-{{ $service->id }}">{{ $service->name}}</label>
                </div>
        @if(($loop->index + 1) % 6 == 0 || $loop->last)
            </div>
        @endif
    @endforeach
</div>
<div class="form-group"><label class="control-label">Colors</label></div>
<div class="form-row">
    @foreach(\App\Color::orderBy('name')->get() as $color)
        @if($loop->index == 0 || $loop->index % 6 == 0)
            <div class="form-group col-md-4">
                @endif
                <div class="form-check">
                    {!! Form::checkbox('colors[]', $color->id) !!}
                    <label class="form-check-label" for="color-{{ $color->id }}">{{ $color->name}}</label>
                </div>
                @if(($loop->index + 1) % 6 == 0 || $loop->last)
            </div>
        @endif
    @endforeach
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
            <div class="form-group {{ $errors->has('translations.eyes.' . $key) ? 'has-error' : ''}}">
                {!! Form::label('eyes', 'Eyes', ['class' => 'control-label']) !!}
                {!! Form::text('translations[eyes][' . $key . ']', null, ('required' == '') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                {!! $errors->first('translations.eyes.' . $key, '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('translations.hair.' . $key) ? 'has-error' : ''}}">
                {!! Form::label('hair', 'Hair', ['class' => 'control-label']) !!}
                {!! Form::text('translations[hair][' . $key . ']', null, ('required' == '') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                {!! $errors->first('translations.hair.' . $key, '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('translations.body_details.' . $key) ? 'has-error' : ''}}">
                {!! Form::label('body_details', 'Body Details', ['class' => 'control-label']) !!}
                {!! Form::text('translations[body_details][' . $key . ']', null, ('required' == '') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                {!! $errors->first('translations.body_details.' . $key, '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('translations.availability.' . $key) ? 'has-error' : ''}}">
                {!! Form::label('availability', 'Availability', ['class' => 'control-label']) !!}
                {!! Form::textarea('translations[availability][' . $key . ']', null, ('required' == '') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                {!! $errors->first('translations.availability.' . $key, '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    @endforeach
</div>
<div class="form-group{{ $errors->has('images') ? 'has-error' : ''}}">
    {!! Form::label('images', 'images', ['class' => 'control-label']) !!}
    <input name="images[]" type="file" id="images" multiple>
    {!! $errors->first('images', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

@if(isset($performer))
    @foreach($performer->images as $image)
        <div id="item-image-{{ $image->id }}">
            <div class="form-row">
                <div class="col-md-8">
                    <img style="max-height: 300px" src="/storage/{{ $image->src }}">
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-danger delete-image" data-id="{{ $image->id }}">Delete</button>
                </div>
            </div>
        </div>
    @endforeach
@endif


@section('scripts')
    <script>
        $(document).on('click', '.delete-image', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                beforeSend: function (request) {
                    request.setRequestHeader('X-REST-Method', 'DELETE');
                },
                method: 'POST',
                url: '/admin/images/' + id,
                data: {"_token": "{{ csrf_token() }}", '_method': 'DELETE'}
            }).done(function () {
                $('#item-image-' + id).remove();
            })
        })
    </script>
@endsection
