@foreach($messages as $val)
    @if($val->user_id)
        <div class="message personal">
            <p class="message-text">{!! $val->text !!}</p>
            <span class="time">{{$val->created_at->format('h:i a')}}</span>
        </div>
    @else
        <div class="message">
            <p class="message-text">{!! $val->text !!}</p>
            <span class="time">{{$val->created_at->format('h:i a')}}</span>
        </div>
    @endif
@endforeach
