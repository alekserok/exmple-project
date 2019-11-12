@foreach($messages as $val)
    @if($val->user_id)
        <div class="outgoing_msg">
            <div class="sent_msg">
                <p>{!! $val->text !!}</p>
                <span class="time_date"> {{ $val->created_at->format('H:i') }}</span>
            </div>
        </div>
    @else
        <div class="incoming_msg">
            <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
            <div class="received_msg">
                <div class="received_withd_msg">
                    <p>{!! $val->text !!}</p>
                    <span class="time_date"> {{ $val->created_at->format('H:i') }}</span>
                </div>
            </div>
        </div>
    @endif
@endforeach
