@foreach($services as $val)
    @if($loop->first || $loop->index % 6 == 0)
        <div class="control-group">
    @endif
            <label class="control control-checkbox">
                <span class="regular">{{ $val->name }}</span>
                <input type="checkbox" name="services[]" value="{{ $val->id }}" {{ isset($selected) && in_array($val->id, $selected) ? 'checked' : '' }}>
                <span class="control_indicator"></span>
            </label>
    @if($loop->last || ($loop->index + 1) % 6 == 0)
        </div>
    @endif
@endforeach
