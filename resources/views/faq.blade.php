@extends('layouts.app')
@section('content')
    <div class="fag">

        <h1 class="zag regular">@lang('CUSTOMER SERVICE')</h1>
        <div class="fag-con1">
            <div class="regular">
                @lang('WE HAVE SET UP THIS SECTION FOR QUICK REFERENCE ON OUR POLICIES AND FEATURES.')
            </div>
            <div class="regular">@lang('For any custom reservations please contact Customer Service.')</div>
            <div class="regular">@lang('Thank you'),<br>
                Ruby Watanabe</div>
        </div>
        <div class="fag-con2">
            <div class="fag-item">
                <div class="regular">@lang('LIVE CHAT')</div>
                <div class="regular">@lang('Mon-Fri 9am-9pm')</div>
            </div>
            <div class="fag-item">
                <div class="regular">@lang('CALL US')<br class="br-n"> +81 7022316228</div>
                <div class="regular">@lang('Mon-Fri 9am-9pm')</div>
            </div>
            <div class="fag-item">
                <div class="regular">@lang('EMAIL US')</div>
                <div class="regular">@lang('We’ll reply within 24hours')<br>
                    <a href="#" class="regular">@lang('Send a message')</a>
                </div>
            </div>
        </div>


        <h1 class="regular zag">@lang('frequently asked questions')</h1>
        <div class="fag-con3">
            <div class="fag-nav">
                @foreach(\App\FaqCategory::pluck('name', 'id') as $key => $val)
                    <div class="nav-item {{ Request::has('category') && Request::get('category') == $key ? 'fag-active' : !Request::has('category') && $loop->iteration == 1 ? 'fag-active' : '' }}"><a href="/faq?category={{ $key }}" class="regular">{{ $val }}</a></div>
                @endforeach
            </div>
            <div class="fag-acordeon">
                @foreach($faqs as $val)
                    <div class="fag-acordeon-con">
                        <div class="fag-visio">
                            <span class="regular">{{ $val->title }}</span>
                            <div class="plus regular"><img src="../img/plus.svg"></div>
                        </div>
                        <div class="fag-collaps">{!! $val->content !!}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
