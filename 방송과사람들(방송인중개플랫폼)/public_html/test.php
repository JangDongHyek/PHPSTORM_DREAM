<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP WebSocket Chat</title>
</head>
<body>
<h1>PHP WebSocket 채팅</h1>
<div id="chat-box"></div>
<input type="text" id="message" placeholder="메시지를 입력하세요">
<button onclick="sendMessage()">전송</button>

<script>
    const ws = new WebSocket('wss://itforone.com/~broadcast/test.php443');

    ws.onmessage = function(event) {
        const chatBox = document.getElementById('chat-box');
        chatBox.innerHTML += '<p>' + event.data + '</p>';
    };

    function sendMessage() {
        const messageInput = document.getElementById('message');
        ws.send(messageInput.value);
        messageInput.value = '';
    }
</script>
</body>
</html>
