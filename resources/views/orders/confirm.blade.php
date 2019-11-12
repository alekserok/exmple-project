@extends('layouts.app')
@section('content')
    <div id="pay">
        <div class="pay">
            <div class="pay-1">
                <h1 class="regular zag">@lang('ORDER')</h1>
                <div class="pay-con-1">
                    <div class="pay-main-img"><img src="{{ '/storage/thumbs/159_200_' . str_replace('images/', '', $order->performer->avatar) }}"></div>
                    <div class="pay-r">
                        <div class="pay-top">
                            <div class="pay-top-item">
                                <div class="regular first-pay-item">{{ $order->performer->name }}</div>
                                <div class="regular">@lang('DATE'):	{{ $order->date }} {{ $order->time_slot }}</div>
                                <div class="selector-wrap">
                                    <div class="pay-droptop">
                                        <span class="regular" id="main-select"></span>
                                        <img src="/img/payselect.svg">

                                    </div>
                                    <div class="pay-dropdown">
                                        <div class="regular selector-item" data-value="1" selected>Sessions: 1</div>
                                        <div class="regular selector-item" data-value="2">Sessions: 2</div>
                                    </div>
                                </div>
{{--                                <div class="pay-last">--}}
{{--                                    <img src="../img/paylast.svg">--}}
{{--                                    <span class="regular">Last available item in this size and color</span>--}}
{{--                                </div>--}}
                            </div>
                            <div class="pay-top-item">
                                <span class="regular">$ {{ $order->performer->price }}</span>
                            </div>
                        </div>
                        <div class="pay-bot">
{{--                            <a href="#" class="regular">Remove</a>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="pay-2">
                <h1 class="regular zag">@lang('PAYMENT METHOD')</h1>
                <form method="POST" action="/orders/confirm" class="pay-method">
                    @include('partials.errors')
                    @csrf
                    <input type="hidden" name="performer_id" value="{{ $order->performer_id }}">
                    <input type="hidden" name="duration" value="{{ $order->duration }}">
                    <input type="hidden" name="date" value="{{ $order->date }}">
                    <input type="hidden" name="time_slot" value="{{ $order->time_slot }}">
                    <input type="hidden" id="calls" name="type" value="{{ $order->type }}">
                    <input type="hidden" name="message" value="{{ $order->message }}">
                    <input name="sessions" id="payDroptopSelectValue" value="{{ $order->sessions }}" type="hidden">
                    <div class="fag-acordeon">
                        <div class="fag-acordeon-con">
                            <div class="fag-visio">
                                <span class="regular">@lang('SERVIСES')</span>
                                <div class="plus regular"><img src="../img/plus.svg"></div>
                            </div>
                            <div class="fag-collaps">
                                <div class="checked-wrap">
                                    @include('orders.partials.services', [
                                            'services' => \App\Service::performerServices($order->performer_id)->orderBy('name')->get(),
                                            'selected' => $order->services,
                                        ])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="method-conteiner">
                        <span class="regular">@lang('DURATION')</span>
                        <span class="regular">{{ $order->duration }}</span>
                    </div>
                    <div class="method-conteiner">
                        <span class="regular">@lang('Time Slot')</span>
                        <span class="regular">{{ $order->time_slot }}</span>
                    </div>
                    <div class="method-conteiner">
                        <span class="regular">@lang('Transportation total')</span>
                        <span class="regular">{{ setting('transportation_total', 50) }}$</span>
                    </div>
                    <div class="incall">
                        <a href="javascript:void(0)" data-value="{{ \App\Order::TYPE_INCALL }}" class="item-type {{ $order->type == \App\Order::TYPE_INCALL ? 'selected' : '' }}"><span class="regular">@lang('Incall')</span></a>
                        <a href="javascript:void(0)" data-value="{{ \App\Order::TYPE_OUTCALL }}" class="item-type {{ $order->type == \App\Order::TYPE_OUTCALL ? 'selected' : '' }}"><span class="regular">@lang('Outcall')</span></a>
                    </div>
                    <div class="method-conteiner" id="HOTELFEE" style="display: {{ $order->type == \App\Order::TYPE_INCALL ? 'block' : 'none' }}">
                        <span class="regular">@lang('Love Hotel Fee')</span>
                        <span class="regular">{{ setting('love_hotel_fee', 500) }}$</span>
                    </div>
                    <div class="method-conteiner">
                        <span class="regular">@lang('Estimated Total')</span>
                        <span class="regular"><span class="estimated-total">{{ $order->total }}</span>$</span>
                    </div>
                    <div class="method-conteiner">

                    </div>
                    @foreach(\App\Order::$payment_methods as $key => $val)
                        @if (!in_array($key, array_keys(\App\Order::$crypto_payment_methods)))
                            <div class="method-item">
                                <label class="control control-radio">
                                    <span class="regular">{{ $val }}</span>
                                    <input type="radio" name="payment_method"  value="{{ $key }}" {{ $key == $order->payment_method ? 'checked="checked"' : '' }}/>
                                    <div class="control_indicator"></div>
                                </label>
                                @if($key == \App\Order::CARD)
                                    <div class="img-wrapper">
                                        <img src="/img/Pays.png" alt="" style="width: auto;">
                                        <img src="/img/credit-card.png">
                                    </div>
                                @else
                                    <img src="/img/{{ $val }}.png">
                                @endif
                            </div>
                        @endif
                    @endforeach
                    <div class="method-item as_col crypto-container">
                        <div class="block-header">
                            <span class="regular block-title">Bitcoin</span>
                            <img src="/img/bitcoin.png">
                        </div>

                        <div class="block-row {{ in_array($order->payment_method, array_keys(\App\Order::$crypto_payment_methods)) ? 'visible' : ''}}">

                            @foreach(\App\Order::$crypto_payment_methods as $key => $val)
                                <div data-value="{{ $key }}" class="crypto-item {{ $key == $order->payment_method ? 'active' : '' }}">
                                    <img src="/img/{{ $val }}.png"> <span class="regular">{{ $val }}</span>
                                </div>
                            @endforeach

                            <input type="hidden" id="selectedCrypto" name="payment_method" value="{{ $order->payment_method }}">

                        </div>
                    </div>

                    <div class="method-conteiner">

                    </div>
                    <div class="payment-fio">
                        <input type="text" name="name" placeholder="@lang('Name')" class="regular" required value="{{ $order->name }}">
                        <input type="text" name="email" placeholder="@lang('Email')" class="regular" required value="{{ $order->email }}">
                        <input type="text" name="email_confirmation" placeholder="@lang('Confirm Email')" class="regular" required value="">
                        <input type="text" name="phone" placeholder="@lang('Phone')" class="regular" required value="{{ $order->phone }}">
                    </div>
                    <div class="method-item method-button">
                        <span class="regular">@lang('You are in our Tokyo market')</span>
                        <button class="regular btn-efect2">
    						<span class="btn-efect-text">@lang('Confirm')</span>
                        </button>
                    </div>
                    <div class="method-canwehelp">
                        <span class="regular">@lang('CAN WE HELP?')</span>
                        <span class="regular">@lang('Call us  +1 646 889 1895 Mon - Sun 9am - 9pm')</span>
                        <div>
                            <a href="#" class="regular">@lang('Email us')</a>
                            <span class="regular"> @lang('is missing on order page above Live Chat.')</span>
                        </div>
                        <div>
                            <a href="#" class="regular">@lang('Live Chat')</a>
                            <span class="regular">@lang('Mon - Sun 9am - 9pm')</span>
                        </div>
                    </div>
                    <div class="method-etiket">
                        <span class="regular">@lang('Etiquette and Instructions')</span>
                        <p class="regular">@lang('Etiquette and Instructions text')</p>
                    </div>
                    <div class="method-etiket">
                        <span class="regular">@lang('YOU CAN PAY BY:')</span>
                        <div class="pay-img">
                            <img src="/img/payimg.gif">
                            <img src="/img/payimg2.gif">
                        </div>
                    </div>
                    <div class="method-etiket">
                        <span class="regular">@lang('SECURE PAYMENTS')</span>
                        <div class="sec-pay">
                            <p class="regular">@lang('Payment information is transferred according to the highest security standards, guaranteed by Trustwave: your credit card details will be completely encrypted.')</p>
                            <div class="pay-img2">
                                <a href="#"><img src="/img/payimg3.gif"></a>
                                <a href="#"><img src="/img/payimg4.png"></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let performer_price = {{ $order->performer->price }};
        let love_hotel_fee = {{ setting('love_hotel_fee', 500) }};
        let duration = {{ $order->duration / 60 }};
        let is_incall = {{ $order->type == \App\Order::TYPE_INCALL ? 1 : 0}};
        let type_incall = {{ \App\Order::TYPE_INCALL }};
        let sessions = {{ $order->sessions }}

        $('.pay-dropdown .selector-item').click(function () {
            sessions = $(this).data('value');
            setTotal();
        });

        $('.item-type').click(function () {
            let type = $(this).data('value');
            if (type == type_incall) is_incall = 1;
            else is_incall = 0;
            setTotal();
        });

        function setTotal() {

            let total = performer_price * duration;

            if (is_incall) total += love_hotel_fee;

            $('.estimated-total').html(total * sessions)
        }
    </script>
@endsection
