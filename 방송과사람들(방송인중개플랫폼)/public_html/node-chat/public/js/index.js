// Socket.IO 클라이언트 초기화
let socket = io();

// 메시지 목록의 가장 아래로 스크롤하는 함수
function scrollToBottom() {
    let messages = document.querySelector('#messages').lastElementChild;
    if (messages) messages.scrollIntoView();
}

// 전역 변수로 params 선언
let params;

// 서버에 연결되었을 때 실행되는 이벤트 핸들러
socket.on('connect', function() {
    let searchQuery = window.location.search.substring(1);
    params = JSON.parse('{"' + decodeURI(searchQuery).replace(/&/g, '\",\"').replace(/\+/g, ' ').replace(/=/g, '\":\"') + '\"}');

    socket.emit('join', params, function(err) {
        if (err) {
            alert(err);
            window.location.href = '/';
        } else {
            console.log('No Error');
        }
    });
});

// 서버와의 연결이 끊어졌을 때 실행되는 이벤트 핸들러
socket.on('disconnect', function() {
    console.log('Disconnected from server.');
});

// 사용자 목록 업데이트 이벤트 핸들러
socket.on('updateUsersList', function(users) {
    let ol = document.createElement('ol');

    users.forEach(function(user) {
        let li = document.createElement('li');
        li.innerHTML = user;
        ol.appendChild(li);
    });

    let usersList = document.querySelector('#users');
    usersList.innerHTML = "";
    usersList.appendChild(ol);
});

// 새로운 메시지를 수신했을 때 실행되는 이벤트 핸들러
socket.on('newMessage', function(message) {
    const formattedTime = moment(message.createdAt).format('LT');
    const templateId = message.from === params.name ? '#message-template' : '#other-message-template';
    const template = document.querySelector(templateId).innerHTML;
    const html = Mustache.render(template, {
        from: message.from,
        text: message.text,
        createdAt: formattedTime
    });

    const div = document.createElement('div');
    div.innerHTML = html;
    document.querySelector('#messages').appendChild(div);
    scrollToBottom();
});

// 메시지 전송 버튼 클릭 이벤트 핸들러
document.querySelector('#submit-btn').addEventListener('click', function(e) {
    e.preventDefault();

    socket.emit("createMessage", {
        text: document.querySelector('input[name="message"]').value
    }, function() {
        document.querySelector('input[name="message"]').value = '';
    });
});
