@foreach(\App\Message::latestChat()->get() as $val)
    <div class="chat_list" data-id="{{ $val->chat_id }}">
        <div class="chat_people">
            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
            <div class="chat_ib">
                <h5>{{ 'User X' }} <span class="chat_date">{{ $val->created_at->format('M d, H:i') }}</span></h5>
                <p>{{ $val->text }}</p>
            </div>
        </div>
    </div>
@endforeach
