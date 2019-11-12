@extends('layouts.app')
@section('content')
    <div id="categories">
        <ul class="categories">
            <li class="categories-item">
                <a href="{{ url('categories') }}">
                    <span class="regular"><img src="/img/per-backimg.svg"></i>@lang('BACK')</span>
                </a>
            </li>
            @foreach($categories as $val)
                <li class="categories-item">
                    <a href="/performers?category_id={{ $val->id }}">
                        <span class="regular">{{ $val->name }}</span>
                    </a>
                </li>
            @endforeach

            <li class="categories-item viewall">
                <a href="#">
                    <span class="regular">view all</span>
                </a>
            </li>
        </ul>

    </div>
@endsection
