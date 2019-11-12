@extends('layouts.app')

@section('content')
    <div id="content" class="big">
        <div class="wrap">
            @include('partials.switch-lang')

            <div class="contant-container">
                <div class="contant-item">
                    <a href="{{ url('categories') }}">
                        <span class="regular">@lang('ESCORT')</span>
                    </a>
                </div>
                <div class="contant-item">
                    <a href="{{ url('coming') }}">
                        <span class="regular">@lang('VIDEO')</span>
                    </a>
                </div>
            </div>
            <div class="abs-content3">
                <a href="">
                    <span class="regular">@lang('TOKYO')</span>
                </a>
            </div>
        </div>
    </div>
@endsection
