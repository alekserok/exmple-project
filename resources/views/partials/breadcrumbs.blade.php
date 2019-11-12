<div class="per-top">
    <a href="#" class="per-back"><img src="/img/per-backimg.svg"></a>
    <ul class="per-nav">
        <li>
            <a href="/" class="regular">@lang('HOME')</a>
            <img src="/img/per-backimg.svg">
        </li>
        @if(isset($breads))
            @foreach($breads as $key => $val)
                <li>
                    <a href="{{ $val }}" class="regular">{{ $key }}</a>
                    <img src="/img/per-backimg.svg">
                </li>
            @endforeach
        @endif
        <li><span class="regular">{{ $title }}</span></li>
    </ul>
</div>
