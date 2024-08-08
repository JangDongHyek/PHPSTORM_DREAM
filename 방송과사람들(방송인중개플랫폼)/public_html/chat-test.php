<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP WebSocket Chat</title>
    <style>
        #chat {
            border: 1px solid #ddd;
            padding: 10px;
            height: 300px;
            overflow-y: scroll;
        }
        #message {
            width: calc(100% - 110px);
        }
    </style>
</head>
<body>
<div id="chat"></div>
<input type="text" id="message" placeholder="Type a message...">
<button onclick="sendMessage()">Send</button>

<script>
    var room = 'room1'; // 예시로 'room1'이라는 방에 연결
    var conn = new WebSocket('wss://itforone.com/~broadcast/chat-server.php:8080');

    conn.onopen = function(e) {
        console.log("Connection established!");
        conn.send(JSON.stringify({room: room, message: 'User has connected to ' + room}));
    };

    conn.onmessage = function(e) {
        var chat = document.getElementById('chat');
        var message = document.createElement('div');
        message.textContent = e.data;
        chat.appendChild(message);
    };

    function sendMessage() {
        var input = document.getElementById('message');
        var message = input.value;
        conn.send(JSON.stringify({room: room, message: message}));
        input.value = '';
    }
</script>
</body>
</html>
