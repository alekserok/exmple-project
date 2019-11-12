@extends('layouts.app')

@section('content')
    <div id="content" class="big">
        <div class="contacts_us">

            <section class="contact-section">

                <h2 class="contact-section--title">
                    @lang('sitemap')
                </h2>

                <div class="contact-section-block">

                    <div class="sitemap_list">
                        <ul>
                            <li>
                                <a href="/">@lang('home')</a>
                                <ul>
                                    <li><a href="/categories">@lang('escort')</a></li>
                                    <li><a href="/comming">@lang('video')</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="/performers">@lang('performers')</a>
                                <ul>
                                    @foreach(\App\Performer::all() as $val)
                                        <li><a href="/performers/{{ $val->id }}">{{ $val->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>

            </section>


        </div>
    </div>
@endsection