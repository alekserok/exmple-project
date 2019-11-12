@extends('layouts.app')

@section('content')
    <div id="content" class="recruit-page">

        <div class="recruit">
            <div class="recruit-top">
                <h1 class="regular zag">@lang('RECRUIT FORM')</h1>
            </div>

            <div class="recruit-container">
                <div class="recruit2-con-item2-2 {{ in_array(old('type'), \App\Career::$performer_types) ? 'active' : '' }}">

                    @include('partials.errors')

                    <div class="recruit2-top">
                        <span class="regular">@lang('PERFORMERS')</span>
                        <div class="rec2-top-change">
                            @foreach(\App\Career::$performer_types as $key => $val)
                                <button class="rec2-btn regular performersBtn" type="button" data-value="{{ $val }}">
                                    {{ __($key) }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                    <div class="recruit2-bot">

                        <form enctype="multipart/form-data" class="rec2-form" method="POST" action="{{ url('careers/performers') }}">
                            <div class="staff-clear"></div>
                            @csrf
                            <input type="hidden" name="type" id="performersField" value="{{ old('type') }}">
                            <input type="text" name="name" placeholder="@lang('Name')" class="regular" value="{{ old('name') }}">
                            <input type="text" name="age" placeholder="@lang('Age')" class="regular" value="{{ old('age') }}">
                            <input type="text" name="visa_status" placeholder="@lang('VISA STATUS')" class="regular" value="{{ old('visa_status') }}">
                            <input type="text" name="nationality" placeholder="@lang('Nationality')" class="regular" value="{{ old('nationality') }}">
                            <input type="text" name="language" placeholder="@lang('Language')" class="regular" value="{{ old('language') }}">
                            <input type="text" name="contacts" placeholder="@lang('Email / Phone')" class="regular" value="{{ old('contacts') }}">
                            <input type="text" name="socials" placeholder="@lang('LINKEDIN / SOCIAL MEDIA')" class="regular" value="{{ old('socials') }}">
                            <label for="AttachRESUME2" id="download-rec" class="regular">@lang('Attach RESUME / COVERLETTER')</label>
                            <input type="file" name="attachment" id="AttachRESUME2" style="display: none;" />
                            <button type="submit" name="submit" class="rec2-submit regular">@lang('SUBMIT')</button>
                        </form>
                        <div class="heigth-fix">

                        </div>
                    </div>
                </div>
                <a href="javascript:void(0)" class="recruit-item recruit-item-1 performers-click {{ in_array(old('type'), \App\Career::$performer_types) ? 'fluid' : '' }}">

                    <span class="regular">@lang('PERFORMERS')</span>

                </a>
                <a href="javascript:void(0)" class="staff recruit-item recruit-item-2 {{ in_array(old('type'), \App\Career::$staff_types) ? 'fluid' : '' }}">

                    <span class="regular">@lang('STAFF')</span>

                </a>

                <div class="recruit2-con-item2 {{ in_array(old('type'), \App\Career::$staff_types) ? 'active' : '' }}">

                    @include('partials.errors')

                    <div class="recruit2-top">
                        <span class="regular">@lang('STAFF')</span>
                        <div class="rec2-top-change">
                            @foreach(\App\Career::$staff_types as $key => $val)
                                <button class="rec2-btn regular staffBtn" type="button" data-value="{{ $val }}">
                                    {{ __($key) }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                    <div class="recruit2-bot">

                        <form enctype="multipart/form-data" class="rec2-form" method="POST" action="{{ url('careers/staff') }}">
                            @csrf
                            <input type="hidden" name="type" id="staffField" value="{{ old('type') }}">
                            <input type="text" name="name" placeholder="@lang('Name')" class="regular" value="{{ old('name') }}">
                            <input type="text" name="age" placeholder="@lang('Age')" class="regular" value="{{ old('age') }}">
                            <input type="text" name="visa_status" placeholder="@lang('VISA STATUS')" class="regular" value="{{ old('visa_status') }}">
                            <input type="text" name="nationality" placeholder="@lang('Nationality')" class="regular" value="{{ old('nationality') }}">
                            <input type="text" name="language" placeholder="@lang('Language')" class="regular" value="{{ old('language') }}">
                            <input type="text" name="contacts" placeholder="@lang('Email / Phone')" class="regular" value="{{ old('contacts') }}">
                            <input type="text" name="socials" placeholder="@lang('LINKEDIN / SOCIAL MEDIA')" class="regular" value="{{ old('socials') }}">
                            <label for="AttachRESUME2" id="download-rec" class="regular">@lang('Attach RESUME / COVERLETTER')</label>
                            <input type="file" name="attachment" id="AttachRESUME2" style="display: none;" />
                            <button type="submit" name="submit" class="rec2-submit regular">@lang('SUBMIT')</button>
                        </form>
                        <div class="heigth-fix">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
