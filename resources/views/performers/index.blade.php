@extends('layouts.app')
@section('content')
    <div class="performers">
        @include('partials.breadcrumbs', [
                'title' => __('Performers')
            ])
        <script>
            var _body = document.getElementsByTagName('body')[0];
            _body.classList.add('performers');
        </script>
        <div class="per-content">
            <ul class="per-ul">
                @foreach($performers as $val)
                    <li class="per-item">
                        <a href="{{ url('performers', $val->id) }}" class="regular">
                            <img src="/storage/thumbs/459_570_{{ str_replace('images/', '', $val->avatar) }}">
                            <span>{{ $val->name }}<br>$ {{ $val->price }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="per-bot">
            <div class="abs-content3">
                <a href="#">
                    <span class="regular">TOKYO</span>
                </a>
            </div>
            <button class="load regular btn-efect back-to-top">
                back to top
            </button>
        </div>
    </div>
@endsection
