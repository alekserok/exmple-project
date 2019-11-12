@foreach($services as $service)
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
