@extends('layouts.app')
@section('content')
    <div class="select" id="content">
        @include('partials.switch-lang')
        <div class="select-con">
            @foreach($categories as $val)
                <div class="select-item">
                    <a href="/categories?parent_id={{ $val->id }}"><span class="regular">{{ $val->name }}</span></a>
                </div>
            @endforeach
        </div>
     
        <div class="abs-content3">
            <a href="">
                <span class="regular">TOKYO</span>
            </a>
        </div>
    </div>
@endsection
