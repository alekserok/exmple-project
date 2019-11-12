<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.min.css">
    @yield('styles')
</head>
<body>
    <header id="header-root">
        <div class="header-part">
            <div class="header-part-contant" onmouseover="textscram()">
                <a href="/" class="header-logo" ><div class="bold textscram">@lang('RUBY WATANABE')</div></a>
            </div>
        </div>
        <div class="header-part">
            <div class="header-part-contant">
                <form class="header-form" action="/coming">
                    <div class="header-form-container">
                        <button class="header-btn"><i class="fas fa-search"></i></button>
                        <input type="search" name="search" placeholder="@lang('SEARCH')" class="header-form-input">
                    </div>
                </form>
            </div>
        </div>
        <div class="header-part">
            <div class="header-part-contant">
                <ul class="header-nav">
                    <div class="languages_container">
                        <ul>
                            <li><a href="{{ url('locale', 'jp') }}">JP</a></li>
                            <li><a href="{{ url('locale', 'zh') }}">CH</a></li>
                            <li><a href="{{ url('locale', 'en') }}">EN</a></li>
                        </ul>
                    </div>
                    {{--<li>
                        <a href="#" class="log-in">
                            <span class="regular">LOG IN</span>
                        </a>
                    </li>--}}
                    <li>
                        <div class="korzina">
                            <img src="/img/korzina.svg">
                            <span id="howpay"></span>
                        </div>
                    </li>
                    <li><a href="{{ url('faq') }}"><img src="/img/help.svg"></a></li>
                    <li>
                        <div class="burger">
                            <img src="/img/burger.svg" class="burger-open">
                            <img src="/img/burger-closes.svg" class="burger-closes">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="burger-menu">
        <div class="burger-wrap">
            <div class="burger-top">

            </div>
            <div class="burger-items">
                <div class="burger-item">
                    <div>
                        <a href="/categories?parent_id={{ \App\Category::CATEGORY_MEN }}" class="regular">@lang('MAN')</a>
                        <img src="../img/per-backimg.svg">
                    </div>
                    <div>
                        <a href="/categories?parent_id={{ \App\Category::CATEGORY_WOMEN }}" class="regular">@lang('WOMAN')</a>
                        <img src="/img/per-backimg.svg">
                    </div>
                    <div>
                        <a href="/categories?parent_id={{ \App\Category::CATEGORY_SEXBOT }}" class="regular">@lang('SEXBOT')</a>
                        <img src="/img/per-backimg.svg">
                    </div>
                </div>
            </div>
            <div class="burger-bot">
                <div>
                    <span class="regular">@lang('CAN WE HELP?')</span>
                </div>
                <div>
                    <span class="regular">@lang('Call us  +1 646 889 1895 Mon - Sun 9am - 9pm')</span>
                </div>
                <div>
                    <a href="#" class="regular">@lang('Email us')</a>
                    <span class="regular">@lang('is missing on order page above Live Chat.')</span>
                </div>
                <div id="liveChat">
                    <a href="#" class="regular">@lang('Live Chat')</a>
                    <span class="regular">@lang('Mon - Sun 9am - 9pm')</span>
                    <small id="available" class="regular"></small>
                </div>
            </div>
        </div>
    </div>
    <div class="korzina-wrap">
        <div class="korzina-top">
            <span class="regular">@lang('MINI SHOPING BAG')</span>
            <img src="/img/cross.svg" class="korzina-closes">
        </div>

        <div class="korzina-clear" style="display:flex">
            <div>
                <span class="regular">@lang('Your Shopping Bag is empty')</span>
                <a href="#" class="k-btn"  id="backtoshop">
    				<span class="regular">
    					@lang('Back to shopping')
    				</span>
                </a>
            </div>
        </div>
    </div>
    <div class="main-scroll">
        @if (Session::has('flash_message'))
            <ul class="alert alert-success" style="margin-top: 46px">
                <li>{{ Session::get('flash_message') }}</li>
            </ul>
        @endif
        @yield('content')
        <footer id="footer">

            <div class="footer-container">
                <div class="footer-item">
                    <div class="footer-visiable">
                        <span class="regular footer-p-main">@lang('Client Service')</span>
                        <div class="plus regular"><img class="pl" src="/img/plus.svg"><img class="mn" src="/img/minus.svg"></div>
                    </div>
                    <div class="footer-collaps">
                        <ul class="footer-ul">
                            <li>
                                <a href="{{ url('faq') }}">
                                    <span class="regular">@lang('FAQ')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer-item">
                    <div class="footer-visiable">
                        <span class="regular footer-p-main">@lang('The company')</span>
                        <div class="plus regular"><img class="pl" src="/img/plus.svg"><img class="mn" src="/img/minus.svg"></div>
                    </div>
                    <div class="footer-collaps">
                        <ul class="footer-ul">
                            <li>
                                <a href="{{ url('careers') }}">
                                    <span class="regular">@lang('Careers')</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('philosophy') }}">
                                    <span class="regular">@lang('Philosophy')</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('privacy') }}">
                                    <span class="regular">@lang('Privacy Policy')</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('legal') }}">
                                    <span class="regular">@lang('Legal')</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('sitemap') }}">
                                    <span class="regular">@lang('Sitemap')</span>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="footer-item">
                    <div class="footer-visiable">
                        <span class="regular footer-p-main">@lang('Contact US')</span>
                        <div class="plus regular"><img class="pl" src="/img/plus.svg"><img class="mn" src="/img/minus.svg"></div>
                    </div>
                    <div class="footer-collaps">
                        <ul class="footer-ul">
                            <li>
                                <a href="{{ url('email-us') }}">
                                    <span class="regular">@lang('Email Us')</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('chat') }}">
                                    <span class="regular">@lang('Live Chat')</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <span class="regular">Mon - Sun 9am - 9pm</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer-item">
                    <div class="footer-visiable">
                        <span class="regular footer-p-main">@lang('Connect')</span>
                        <div class="plus regular"><img class="pl" src="/img/plus.svg"><img class="mn" src="/img/minus.svg"></div>
                    </div>
                    <div class="footer-collaps">
                        <ul class="footer-ul">
                            <li>
                                <a href="#" target="_blank">
                                    <span class="regular">@lang('Twitter')</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <span class="regular">@lang('Instagram')</span>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="footer-item">
                    <div class="footer-visiable">
                        <span class="regular footer-p-main">@lang('Newsletter')</span>
                        <div class="plus regular"><img class="pl" src="/img/plus.svg"><img class="mn" src="/img/minus.svg"></div>
                    </div>
                    <div class="footer-collaps">
                        <div class="footer-form newsletters-response" style="display: none">
                            @lang('THANK YOU FOR SUBSCRIBING. WE LOOK FORWARD TO KEEPING YOU POSTED WITH OUR LATEST STYLE NEWS.')
                        </div>
                        <form class="footer-form newsletters-form">

                            <div class="control-group">
                                <label class="control control-checkbox">
                                    <span class="regular">@lang('Women’s Performers')</span>
                                    <input type="checkbox">
                                    <span class="control_indicator"></span>
                                </label>
                                <label class="control control-checkbox">
                                    <span class="regular">@lang('Men’s Performers')</span>
                                    <input type="checkbox"/>
                                    <span class="control_indicator"></span>
                                </label>
                                <label class="control control-checkbox">
                                    <span class="regular">@lang('Sexbots')</span>
                                    <input type="checkbox"/>
                                    <span class="control_indicator"></span>
                                </label>
                            </div>

                            <div class="email-con">
                                <input type="email" name="email" required placeholder="@lang('Email')">
                                <button class="footer-btn">
                                    <i class="fas fa-angle-right"></i>
                                </button>
                            </div>
                            <div>
                                <p id="footer-email-error" class="regular">@lang('Please insert a valid email address.')</p>
                                <span class="regular">@lang('The data fields with an asterisk (*) must be completed in order')</span>
                                <div><a href="#" class="regular email-read">@lang('Read More')</a>...</div>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="footer-item">
                    <div class="footer-visiable">
                        <span class="regular footer-p-main">@lang('BLOG')</span>
                        <div class="plus regular"><img class="pl" src="/img/plus.svg"><img class="mn" src="/img/minus.svg"></div>
                    </div>
                    <div class="footer-collaps">
                        <p class="regular">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                        <p class="regular">
                            Integer iaculis risus ac neque ultricies vulputate.
                        </p>
                        <p class="regular">
                            Nam elementum tempus mi, at imperdiet metus aliquam in.
                        </p>
                    </div>
                </div>
            </div>
            <div class="footer-bot">
                <div class="wrap">
                    <span class="regular">© {{ date('Y') }} {{ env('APP_NAME') }}</span>
                </div>
            </div>
        </footer>


    </div>
    @if ($promo = \App\Promo::isAvailable(Request::getRequestUri())->first())
        @include('partials.promo', ['promo' => $promo])
    @endif
    <div class="chat-wrapper has-chat present">
        <div class="chat-container">
            <div class="chat-header">
                <span class="header-title">live chat</span>

                <div class="chat-header-nav">
                    <div class="hide-chat">
                        <img src="https://us5-cdn.inside-graph.com/custom/2-balenciaga-minimize-icon.svg" alt="">
                    </div>
                    <div class="close-chat">
                        <img src="https://us5-cdn.inside-graph.com/custom/2-balenciaga-close.svg" alt="">
                    </div>
                </div>
            </div>
            <div class="chat-message-container">
                <p class="block-placeholder">
                    Welcome to sexytime<br> How can we help you today?
                </p>



            </div>
            <div class="chat-form">
                <form action="">
                    <div class="form-field">
                        <input id="chatField" autocomplete="off" type="text" placeholder="Type your message here">
                        <label class="attach-file">
                            <img src="https://image.flaticon.com/icons/svg/659/659774.svg" alt="">
                            <input type="file" accept="application/pdf,image/*">
                        </label>
                        <button type="submit" class="send">SEND</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="/js/main.min.js"></script>
{{--    <script src="//code.jivosite.com/widget.js" jv-id="jEsu0rqtXW" async></script>--}}
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
        var module = {};
    </script>
    <script src="//{{ Request::getHost() }}:{{ env('ECHO_PORT', 6001) }}/socket.io/socket.io.js"></script>
    <script src="/js/echo.js"></script>
    <script>

        var historyFlag = true;
        var presentAdmins = [];

        function adminPresent(){
            if(presentAdmins.length == 0){
                $('.chat-wrapper').hide();
                $('.chat-wrapper').animate({bottom : '-100%'}, 250)
                $('#available').removeClass('available');
                $('#available').text('Our Client Advisors are currently not available');
                chatOpened = true
            }
            else{
                $('.chat-wrapper').show();
                $('#available').addClass('available');
                $('#available').text('Available now');
            }
        }

        window.Echo = new Echo({
            broadcaster: 'socket.io',
            host: window.location.hostname + ':{{ env('ECHO_PORT', 6001) }}',
        });

        window.Echo.join('{{ Str::slug(env('APP_NAME', 'laravel'), '_') }}_database.admin')
            .here(function (users) {
                //console.log('here', users)
                for (let k in users){
                    if(users[k].role == 'admin'){
                        presentAdmins.push(users[k])
                    }
                }
                adminPresent()

            })
            .joining(function (user) {
                //console.log('join', user)
                if(user.role == 'admin'){
                    presentAdmins.push(user)
                }
                adminPresent()
            })
            .leaving(function (user) {
                //console.log('leaving', user)
                if(user.role == 'admin'){
                    for(let k in presentAdmins){
                        if(presentAdmins[k].id == user.id){
                            presentAdmins.splice(k,1)
                        }
                    }

                }
                setTimeout(()=>{
                    adminPresent()
                },30000)
            });

        function getChatId(callback){

            var chatID;

            if(localStorage.getItem('chat_id') == null){

                $.get('/messages', function(data) {
                    localStorage.setItem('chat_id', data);
                    callback(data);
                });

            }
            else{
                chatID = localStorage.getItem('chat_id');
                callback(chatID);
            }
        }

        getChatId(function(id){

            if(historyFlag === true){

                $.get('/messages/history/'+id , function(data){

                    if(data != ''){
                        $('.block-placeholder').hide();
                    }
                    $('#mCSB_1_container').append($(data))

                    $('.chat-message-container').mCustomScrollbar("scrollTo","bottom",{
                        scrollEasing:"easeOut"
                    });

                    historyFlag = false
                });

            }

            window.Echo.channel('{{ strtolower(env('APP_NAME')) }}_database_chat.' + id).listen('NewMessage', (e) => {
                if(e.message.user_id !== null){
                    var created_at = new Date(e.message.created_at).toLocaleTimeString('en-US', { hour12 : true, hour: 'numeric', minute:'numeric'})
                    var text       = e.message.text
                    console.log(e)
                    $('.block-placeholder').hide();

                    $('#mCSB_1_container')
                        .append('<div class="message personal"><p class="message-text">'+ text +'</p><span class="time">'+ created_at.toLowerCase() +'</span></div>')

                    $('.chat-message-container').mCustomScrollbar("scrollTo","bottom",{
                        scrollEasing:"easeOut"
                    });
                }
            });

        })




        $('.chat-form form').submit(function (){
            event.preventDefault()

            var message = $('#chatField').val();
            if(message != ''){

                var text = $('#chatField').val();

                $.post('/messages', {chat_id: localStorage.getItem('chat_id'), text: text, "_token": "{{ csrf_token() }}",}, function (data) {
                    var text = data.text;
                    var created_at = new Date(data.created_at).toLocaleTimeString('en-US', { hour12 : true, hour: 'numeric', minute:'numeric'})

                    $('.block-placeholder').hide();

                    $('#mCSB_1_container')
                        .append('<div class="message"><p class="message-text">'+ text +'</p><span class="time">'+ created_at.toLowerCase() +'</span></div>')
                    $('#chatField').val('');
                    $('.form-field').removeClass('dirty')

                    $('.chat-message-container').mCustomScrollbar("scrollTo","bottom",{
                        scrollEasing:"easeOut"
                    });
                });
            }
            else return

        });


        $('.attach-file input').change(function () {
            console.log(event)

            var file = event.target.files[0];
            console.log(file)
            var fd   = new FormData();
            fd.append("attachment", file);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/messages?chat_id=' + localStorage.getItem('chat_id'),
                type: 'POST',
                data: fd,
                dataType:'json',
                async:false,
                processData: false,
                contentType: false,

                statusCode: {
                    422: function(data) {
                        alert(data.responseText);
                    }
                }
            }).done(function (data){
                console.log(data)
                var text = data.text;
                var created_at = new Date(data.created_at).toLocaleTimeString('en-US', { hour12 : true, hour: 'numeric', minute:'numeric'})
                $('.block-placeholder').hide();

                $('#mCSB_1_container')
                    .append('<div class="message"><p class="message-text">'+ text +'</p><span class="time">'+ created_at.toLowerCase() +'</span></div>')
                $('#chatField').val('');

                $('.chat-message-container').mCustomScrollbar("scrollTo","bottom",{
                    scrollEasing:"easeOut"
                });
            });

        });

        $(document).on('submit', '.newsletters-form', function (e) {
            e.preventDefault();
            $(this).css('display', 'none');
            $('.newsletters-response').css('display', 'block');
            $('.newsletters-response').addClass('regular')
        })

    </script>
    @yield('scripts')
</body>
</html>
