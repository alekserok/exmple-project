<div class="lang-container">
    <div class="abs-content1">
        <a href="">
            <span class="regular point">@lang('SEXYTIME')</span>
            <span class="regular">@lang('JP')</span>
        </a>
    </div>
    <div class="abs-content2">
        <a href="{{ url('locale', app()->getLocale() == 'en' ? 'ja' : 'en') }}">
            <span class="regular">{{ app()->getLocale() == 'en' ? __('JAPANESE') : __('ENGLISH') }}</span>
        </a>
    </div>
</div>
