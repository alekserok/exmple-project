@extends('layouts.app')
@section('content')
    <div class="booking">
        <h1 class="regular zag">@lang('BOOKING')</h1>
        <div class="booking-con">
            <form class="booking-form" method="POST" action="{{ url('orders') }}">
                <div class="errors"></div>
                @csrf
                <div><img class="booking-img" src="{{ isset($order) ? '/storage/thumbs/159_200_' . str_replace('images/', '', $order->performer->avatar) : null }}"></div>
                <div class="booking-form-item">
                    <span class="regular fag-visio2">@lang('PERFORMER')<span class="plus regular"><img src="../img/plus.svg"></span></span>
                    <div class="form-change fag-collaps">
                        <div class="checked-wrap">
                            @foreach(\App\Performer::orderBy('letter')->pluck('letter', 'id') as $key => $val)
                                <button class="regular performer-btn" type="button" data-value="{{ $key }}">{{ $val }}</button>
                            @endforeach
                            <input type="hidden" name="performer_id" class="input-none performer-input" value="{{ isset($order) ? $order->performer_id : null }}">
                        </div>
                    </div>
                </div>
                <div class="arrow-block arrow-1">
                    <span class="regular">@lang('CHOOSE PERFORMER')</span>
                </div>
                <div class="booking-form-item">
                    <span class="regular fag-visio2">@lang('SERVICES')<span class="plus regular"><img src="/img/plus.svg"></span></span>
                    <div class="form-change fag-collaps">
                        <div class="checked-wrap performer-services">
                            @if(isset($order))
                                @include('orders.partials.services', ['services' => \App\Service::performerServices($order->performer_id)->orderBy('name')->get()])
                            @else
                                @lang('Select Performer First!')
                            @endif
                        </div>
                    </div>
                </div>
                <div class="booking-form-item">
                    <span class="regular">@lang('DURATION')</span>
                    <div class="form-change">
                        @foreach(\App\Order::$durations as $key => $val)
                            <button class="regular duration-btn" type="button" data-value="{{ $key }}">{{ $val }}</button>
                        @endforeach
                        <input type="hidden" name="duration" class="input-none duration-input">
                    </div>
                </div>
                <div class="booking-form-item">
                    <span class="regular">@lang('DATE')</span>
                    <div class="datepicker-here" data-language='app()->getLocale()'>
                        <input type="hidden" name="date">
                    </div>
                </div>
                <div class="booking-form-item">
                    <span class="regular">@lang('TIME SLOT')</span>
                    <div class="form-change">
                        @foreach(\App\Order::$time_slots as $key => $val)
                            <button class="regular timeslot-btn" type="button" data-value="{{ $key }}">{{ $val }}</button>
                        @endforeach
                        <input type="hidden" name="time_slot" class="input-none timeslot-input">
                    </div>
                </div>
                <div class="booking-form-item h">
                    @foreach(\App\Order::$types as $key => $val)
                        <button class="regular  type-btn" type="button" data-value="{{ $key }}">{{ __($val) }}</button>
                        @if(!$loop->last)
                            <span class="regular">@lang('OR')</span>
                        @endif
                    @endforeach
                    <input type="hidden" name="type" class="type-input">
                </div>
                <div class="arrow-block arrow-2">
    			<span class="regular">@lang('IF OUTCALL IS CHOSEN PLEASE LEAVE HOTEL INFORMATION IN MESSAGE WINDOW')</span>
                </div>
                <div class="booking-form-item">
                    <span class="regular">@lang('MESSAGE')</span>
                    <textarea placeholder="@lang('Your message')" rows="2" name="message"></textarea>
                </div>
                <div class="arrow-block arrow-3">
                    <span class="regular">
                        @lang('PLEASE LEAVE DETAILED MESSAGE PLEASE INCLUDE PREFERRED DATE, GENDER, BODY TYPE AND ANY SPECIFIC DETAILS.')
                    </span>
                </div>
                <div class="method-button">
                    <button class="regular btn-efect2">
    				<span class="btn-efect-text">@lang('NEXT')</span>
                    </button>
                </div>
            </form>

        </div>
        <div class="abs-content3">
            <a href="#">
                <span class="regular">@lang('TOKYO')</span>
            </a>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '.performer-btn', function () {

            let performer_id = $(this).data('value');
            $.get('performers/' + performer_id + '/services', function (data) {
                // $('.booking-img').attr('src', data.avatar);
                $('.performer-services').html(data);
            });
            $.get('performers/' + performer_id + '/avatar', function (data) {
                $('.booking-img').attr('src', '/storage/thumbs/159_200_' + data.replace('images/', ''));
            });
        });
        $(document).on('submit', '.booking-form', function (e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                data: $('.booking-form').serialize(),
                statusCode: {
                    422: function (data) {
                        $('.alert.alert-danger').remove();
                        $('.errors').append('<ul class="alert alert-danger"></ul>');
                        $.each(data.responseJSON.errors, function (index, value) {
                            $.each(value, function (i, v) {
                                $('.alert.alert-danger').append('<li>' + v + '</li>');
                            })
                        });
                        $('html').animate({ scrollTop: 0}, 700, function() {});
                    },
                    200: function (data) {
                        window.location = '/orders/confirm'
                    }
                }
            })
        })
    </script>
@endsection
