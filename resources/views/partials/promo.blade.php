@if($promo->type == \App\Promo::TYPE_IMAGE)
    <div class="promo-wrapper visible">
        <div class="promo-header">

            <span>{{ $promo->title }}</span>

            <button class="promo-close">
                <span class="div-img"></span>
            </button>
        </div>
        <div class="promo-content">
            <img src="/storage/{{ $promo->media }}" alt="{{ $promo->title }}">

            <div class="promo-explore">
                <a href="{{ $promo->link }}">
                    <span class="link-text">{{ $promo->link_title }}</span>
                </a>
            </div>
        </div>


    </div>
@endif
@if($promo->type == \App\Promo::TYPE_VIDEO)
    <div class="promo-wrapper video visible">
        <div class="promo-header">

            <span>{{ $promo->title }}</span>

            <button class="promo-close">
                <span class="div-img"></span>
            </button>
        </div>
        <div class="promo-content">
            <div class="video-wrapper">
                <video width="100%">
                    <source src="/storage/{{ $promo->media }}" type="video/mp4">
                    {{--<source src="https://www.w3schools.com/html/mov_bbb.ogg" type="video/ogg">--}}
                    @lang('Your browser does not support HTML5 video.')
                </video>
                <div class="timeline-wrapper">
                    <div class="timeline"></div>
                    <div class="currenttime"></div>
                </div>

                <div class="video-nav-bar">

                    <div class="play-wrapper">
                        <span>@lang('Play')</span>
                    </div>

                    <div class="timeLeave">
                        <span class="duration">0</span> / <span class="allDuration">10</span>
                    </div>

                    <div class="muted">
                        <img src="https://image.flaticon.com/icons/svg/2088/2088585.svg" alt="">
                    </div>

                    <div class="fullscreen">
                        <img src="https://image.flaticon.com/icons/svg/1231/1231725.svg" alt="">
                    </div>

                </div>

            </div>

            <div class="promo-explore play">
                <div>
                    <span class="link-text">@lang('play')</span>
                </div>
            </div>
        </div>


    </div>
@endif