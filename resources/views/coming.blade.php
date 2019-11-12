@extends('layouts.light')
@section('content')
    <div class="comming" id="comming">
        <div class="abs-content1">
            <a href="/">
                <span class="regular point">SEXYTIME</span>
                <span class="regular">JP</span>
            </a>
        </div>
        <div id="countdown">
            <div class="count-con">
                <div id="timerDay" class="day num regular"></div>
                <div class="regular">@lang('DAYS')</div>
            </div>
            <div class="count-con">
                <div id="timerHour"class="hour num regular"></div>
                <div class="regular">@lang('HOUR')</div>
            </div>
            <div class="count-con">
                <div id="timerMinute" class="minute num regular"></div>
                <div class="regular">@lang('MINUTE')</div>
            </div>
            <div class="count-con">
                <div id="timerSeconds" class="second num regular"></div>
                <div class="regular">@lang('SECONDS')</div>
            </div>
        </div>
        <div class="eTimer"></div>
        <div class="comming-text">
            <div class="bold">@lang('Coming soon')</div>
            <div class="regular">
                @lang('our website is under construction.')<br>
                @lang('we are working to bring you new best experience.')
            </div>
        </div>
        <div class="comming-btn">
            <a href="/404" class="regular sexy-btn">@lang('notify me!')</a>
            <a href="/careers" class="regular sexy-btn">@lang('Recruit')</a>
        </div>
    </div>
@endsection
