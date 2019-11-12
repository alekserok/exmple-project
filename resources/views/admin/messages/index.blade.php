@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Messages</div>
                    <div class="messaging">
                        <div class="inbox_msg">
                            <div class="inbox_people">
                                <div class="inbox_chat">
                                    @include('admin.messages.chat-list')
                                </div>
                            </div>
                            <div class="mesgs">
                                <div class="msg_history">

                                </div>
                                <div class="type_msg" style="display: none">
                                    <div class="input_msg_write">
                                        <input type="text" class="write_msg" placeholder="Type a message" />
                                        <button id="msg_send_btn" class="msg_send_btn" type="button" data-id="0"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="/css/chat.css">
@endsection
@section('scripts')
    <script>
        $(document).on('click', '.chat_list', function () {
            let id = $(this).data('id');
            $('.chat_list').removeClass('active_chat');
            $(this).addClass('active_chat');
            $('.msg_send_btn').attr('data-id', id);
            $('.type_msg').css('display', 'block');
            getHistory(id);
        });

        $(document).on('click', '.msg_send_btn', function () {
            let id = document.getElementById('msg_send_btn').getAttribute('data-id');
            let text = $('.write_msg').val();
            if (text !== '') {
                $.post('/admin/messages', {chat_id: id, text: text, "_token": "{{ csrf_token() }}",}, function (data) {
                    $('.write_msg').val('');
                    $('.msg_history').append(data);
                    $('.msg_history').animate({ scrollTop: $('.msg_history').prop("scrollHeight")}, 1000);
                }).fail(function (error) {
                    if (error.status === 419) location.reload();
                })
            }
        });

        function getHistory(id) {
            $.get('/admin/messages/' + id, function (data) {
                $('.msg_history').html(data);
                $('.msg_history').animate({ scrollTop: $('.msg_history').prop("scrollHeight")}, 1000);
            })
        }
    </script>
@endsection
