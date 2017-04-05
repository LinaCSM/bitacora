<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pusher Chat</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/css/bootstrap.css">

    <style>
        .container{max-width:730px; padding-top: 50px;}
        #messages{margin-top: 30px;}
        .message{display: flex;margin-bottom: 20px;}
        .message-data span{display: block;}
        .text-display{margin-left: 10px;}
        .author{font-size: x-large;}
        .timestamp{font-size: smaller;}
        .message-body{font-size:medium;}
    </style>
</head>
<body>

<div class="container">

    <section id="send-container">

        <div class="input-group">
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
            <input type="text" class="form-control input-message" placeholder="Escribir Mensaje...">
            <span class="input-group-btn">
                <button class="btn btn-default send-message" type="button"><i class="glyphicon glyphicon-send"></i></button>
            </span>
        </div>

        <small id="response-status"></small>

    </section>

    <section id="messages"></section>

</div>

<!-- Template HTML para mensajes -->
<script id="chat_message_template" type="text/template">
    <div class="message">
        <div class="avatar">
            <img src="">
        </div>
        <div class="text-display">
            <div class="message-data">
                <span class="author"></span>
                <span class="timestamp"></span>
                <span class="seen"></span>
            </div>
            <p class="message-body"></p>
        </div>
    </div>
</script>

<!-- JQuery -->
<script src="/js/Table/jquery-1.12.4.js"></script>

<!-- Bootstrap -->
<script src="/js/bootstrap.min.js"></script>

<!-- Pusher -->
<script src="/js/pusher.min.js"></script>

<script>
    function init() {
        $('.send-message').click(sendMessage);
    }

    // Enviar mensaje
    function sendMessage() {
        let messageText =   $('.input-message').val(),
                token       =   $('#_token').val();

        $.ajax({
            method: "POST",
            url: "/chat",
            data: {_token: token, message: messageText},
        }).done(function( response ) {
            sendMessageStatus(response);
        });

        return false;
    }

    // Manejar la respuesta
    function sendMessageStatus(response) {
        let messageStatus = $("#response-status");

        if (response.status == 1) {
            $('.input-message').val('');

            messageStatus.text('Mensaje enviado con éxito');
        } else {

        }

        setTimeout(function(){
            messageStatus.text('');
        }, 3000);
    }

    // Agregar mensaje al html
    function addMessage(data) {

        let el = createMessageEl();

        el.find('.message-body').html(data.message);
        el.find('.author').text(data.username);
        el.find('.avatar img').attr('src', data.avatar)
        el.find('.timestamp').text(data.timestamp);

        let messages = $('#messages');
        messages.append(el);

        messages.scrollTop(messages[0].scrollHeight);
    }

    // Manipular HTML del template para crear nuevo post
    function createMessageEl() {
        let text    =   $('#chat_message_template').text(),
                el      =   $(text);

        return el;
    }

    $(init);

    let pusher = new Pusher('{{ env("PUSHER_KEY") }}'),
            channel = pusher.subscribe('{{ $chatChannel }}');

    channel.bind('new-message', addMessage);
</script>

</body>
</html>