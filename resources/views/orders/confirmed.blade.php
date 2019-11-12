@extends('layouts.app')

@section('content')
    <div id="content" class="big">
        <div class="contacts_us">

            <section class="contact-section">

                <h2 class="contact-section--title">
                    @lang('Contact us')
                </h2>

                <div class="contact-section-block">
                    <article>
                        <p>@lang('Thank you for your order.')</p>
                        <p>@lang('Your booking has been successfully sent.')</p>
                        <p>@lang('Remember you can find many answers to your questions withinthe Customer Care area.')</p>
                    </article>
                </div>

            </section>

            <section class="contact-section">

                <h2 class="contact-section--title">
                    @lang('have a question we have not answered yet?')
                </h2>

                <div class="contact-section-block">
                    <div class="block-col">
                        <div class="text-block">
                            @lang('Call us') <a href="tel:+ {{ setting('contact_phone', '1 111 111 1234') }}">+ {{ setting('contact_phone', '1 111 111 1234') }}</a>
                        </div>
                    </div>
                    <div class="block-col">
                        <div class="text-block">
                            <a href="/faq">@lang('Frequently Asked Questions')</a>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </div>
@endsection