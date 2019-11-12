@extends('layouts.app')
@section('content')
    <script>
        var _body = document.getElementsByTagName('body')[0];
        _body.classList.add('performerspage');
    </script>
    <div class="parpage">
        @include('partials.breadcrumbs', ['title' => $performer->name, 'breads' => [__('PERFORMERS') => '/performers']])
        <div class="parpage-con">
            <div class="parpage-left">
                <div class="photo-slider">
                    @foreach($performer->images as $val)
                        <div class="perpage-img">
                            <img src="/storage/thumbs/612_767_{{ str_replace('images/', '', $val->src) }}">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="parpage-right">
                <div class="fixed-container">
                    <div class="parpage-change">

                        <div class="change-1 regular">${{ $performer->price }}</div>
                        <a href="/orders?performer_id={{ $performer->id }}" class="change-1 regular">@lang('MAKE BOOKING')</a>
                    </div>
                    <div class="perpage-top">
                        <div class="parpage-wrap">
                            <span class="regular">{{ $performer->letter }}</span>

                            <span class="regular">{{ $performer->name }}</span>

                            <span class="regular">
                                {{ $performer->eyes }} @lang('EYES') /<br>
                                {{ $performer->hair }} @lang('hair')
                            </span>

                            <span class="regular">{{ $performer->country }}</span>

                            <p class="regular">{{ $performer->body_details }}</p>
                        </div>
                    </div>
                    <div class="perpage-top">
                        <div class="parpage-wrap">
                            <span class="regular">@lang('WEAR')<span class="selected-color"></span> </span>
                            <div class="circles-wrapper">
                                @foreach($performer->colors as $val)
                                    <div class="item" data-text="{{ $val->name }} @lang('color')">
                                        <div class="color-block" style="color: {{ $val->color }}"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="fag-acordeon">
                        <div class="fag-acordeon-con alwaysOn">
                            <div class="fag-visio">
                                <span class="regular">@lang('AVAILABILITY')</span>
                                <div class="plus regular"><img src="/img/plus.svg"></div>
                            </div>

                            <div class="fag-collaps">
                                <p class="regular">
                                    {!! $performer->availability !!}
                                </p>
                            </div>
                        </div>

                        <div class="fag-acordeon-con">
                            <div class="fag-visio">
                                <span class="regular">@lang('SERVICE DETAILS')</span>
                                <div class="plus regular"><img src="/img/plus.svg"></div>
                            </div>
                            <div class="fag-collaps">
                                <p class="regular"></p>

                                <ul>
                                    @foreach($performer->services as $val)
                                        <li>{{ $val->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                        <div class="fag-acordeon-con">
                            <div class="fag-visio">
                                <span class="regular">@lang('LATEST CHECKUP')</span>
                                <div class="plus regular"><img src="/img/plus.svg"></div>
                            </div>
                            <div class="fag-collaps">
                                <p class="regular">@lang('Latest checkup text')</p>
                            </div>
                        </div>
                        <div class="fag-acordeon-con">
                            <div class="fag-visio">
                                <span class="regular">@lang('CAN WE HELP?')</span>
                                <div class="plus regular"><img src="/img/plus.svg"></div>
                            </div>
                            <div class="fag-collaps">
                                <p class="regular">@lang('Can we help text')</p>
                                <div class="contact-box">
                                    <div>
                                        <a href="mailto:email@email.com" class="regular">Email us</a>
                                        <span class="regular">is missing on order page above Live Chat.</span>
                                    </div>
                                    <div id="liveChat">
                                        <a href="#" class="regular">Live Chat</a>
                                        <span class="regular">Mon - Sun 9am - 9pm</span>
                                        <small id="available" class="regular">Our Client Advisors are currently not available</small>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
