@extends('layouts.app')
@section('content')
    <div id="pay">
        <div class="pay">
            @include('partials.errors')
            <div class="pay-1">
                <h1 class="regular zag">ORDER #{{ $order->id }}</h1>
                <div class="pay-con-1">
                    <div class="pay-main-img"><img src="{{ '/storage/thumbs/159_200_' . str_replace('images/', '', $order->performer->avatar) }}"></div>
                    <div class="pay-r">
                        <div class="pay-top">
                            <div class="pay-top-item">
                                <div class="regular first-pay-item">{{ $order->performer->name }}</div>
                                <div class="regular">DATE:	{{ $order->date }} {{ $order->time_slot }}</div>
                            </div>
                            <div class="pay-top-item">
                                <span class="regular">$ {{ $order->total }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($order->paid)
                <div class="pay-2 custome">
                    <h1 class="regular zag">@lang('This order is already paid!')</h1>
                </div>
            @else
                <div class="pay-2 custome">
                    <h1 class="regular zag">@lang('PAY WITH PAYPAL')</h1>
                    <form class="pay-method" action="{{ route('purchase') }}" method="POST">
                        <div class="method-conteiner">
                            <div class="inner-content">
                                <p class="regular">@csrf</p>
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <button class="button">
                                    <span>@lang('PAY ORDER')</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="pay-2 custome">
                    <h1 class="regular zag">@lang('PAY WITH CREDIT OR DEBIT CARD')</h1>
                    <form class="pay-method" action="{{ route('purchase') }}" method="POST" id="stripe-card-form">
                        <div class="method-conteiner">


                            <div class="inner-content">

                                <div id="payment-request-button" style="width: 200px; margin: 20px auto"></div>

                                <div id="card-element" style="width: 300px; margin: 20px auto"></div>
                                <div id="card-errors" role="alert" style="width: 300px; margin: auto"></div>

                                <p class="regular">@csrf</p>
                                <input type="hidden" name="gateway" value="Stripe">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <button class="button" id="card-button" type="button">
                                    <span>@lang('PAY ORDER')</span>
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            @endif

            <div class="method-etiket">
                <span class="regular">YOU CAN PAY BY:</span>
                <div class="pay-img">
                    <img src="/img/payimg.gif">
                    <img src="/img/payimg2.gif">
                </div>
            </div>
            <div class="method-etiket">
                <span class="regular">SECURE PAYMENTS</span>
                <div class="sec-pay">
                    <p class="regular">Payment information is transferred according to the highest security standards, guaranteed by Trustwave: your credit card details will be completely encrypted.</p>
                    <div class="pay-img2">
                        <a href="#"><img src="/img/payimg3.gif"></a>
                        <a href="#"><img src="/img/payimg4.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if(!$order->paid)
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe('{{ env('STRIPE_KEY') }}');

            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            // const cardholderName = document.getElementById('cardholder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = '{{ $order->stripe_client_secret }}';

            cardButton.addEventListener('click', async (ev) => {
                const {paymentIntent, error} = await stripe.handleCardPayment(
                    clientSecret, cardElement
                );

                if (error) {
                    console.log(error);
                    alert(error.message);
                } else {
                    confirmPayment(paymentIntent.id)
                }
            });

            const paymentRequest = stripe.paymentRequest({
                country: "JP",
                currency: "usd",
                total: {
                    amount: {{ $order->total * 100 }},
                    label: "Total"
                }
            });

            // Check the availability of the Payment Request API first.
            paymentRequest.canMakePayment().then(function(result) {
                if (result) {
                    prButton.mount('#payment-request-button');
                } else {
                    $('#payment-request-button').html('not supported');
                }
            });


            const prButton = elements.create('paymentRequestButton', {
                paymentRequest,
            });

            (async () => {
                // Check the availability of the Payment Request API first.
                const result = await paymentRequest.canMakePayment();
                if (result) {
                    prButton.mount('#payment-request-button');
                } else {
                    document.getElementById('payment-request-button').style.display = 'none';
                }
            })();

            paymentRequest.on('paymentmethod', async (ev) => {
                const confirmResult = await stripe.confirmPaymentIntent(clientSecret, {
                    payment_method: ev.paymentMethod.id,
                });

                if (confirmResult.error) {
                    // Report to the browser that the payment failed, prompting it to
                    // re-show the payment interface, or show an error message and close
                    // the payment interface.
                    ev.complete('fail');
                } else {
                    // Report to the browser that the confirmation was successful, prompting
                    // it to close the browser payment method collection interface.
                    ev.complete('success');
                    if (!confirmResult.paymentIntent.next_action) {
                        // The payment has succeeded.
                        confirmPayment(confirmResult.paymentIntent.id);
                    } else {
                        // The PaymentIntent requires additional action, pass it back to
                        // Stripe.js to handle the rest of the flow.
                        const {error, paymentIntent} = await stripe.handleCardPayment(clientSecret);
                        if (error) {
                            // The payment failed -- ask your customer for a new payment method.
                            console.log(error);
                            alert(error.message)
                        } else {
                            // The payment has succeeded.
                            confirmPayment(paymentIntent.id)
                        }
                    }
                }
            });

            function confirmPayment(payment_intent_id) {
                window.location = '/transactions/{{ $order->id }}/stripe/confirm/' + payment_intent_id;
            }

        </script>
    @endif
@endsection
