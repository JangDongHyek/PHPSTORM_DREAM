const url = "https://www.jobgo.ac:5000";
const options = {'forceNew': true};
const socket = io.connect(url, options);
const account = 'chating';
var is_chat_scroll = false;//챗방 스크롤 여부
var socket_mb_id = "";
var socket_room_idx = 0;
var socket_mb_name = 0;

//알람톡 보내기 위한 전역변수
var sale_mb_id = $("#sel_mb_id").val(); //판매자아이디
var buy_mb_id = $("#buy_mb_id").val(); //구매자아이디
var ta_idx = $("#idx").val(); //ta_idx 텔런트 아이디

if (socket == undefined) {
    alert("소켓통신 안 됨");
}

if (socket != undefined) {
    socket.on('connect', function () {
        console.log('connect');
        //채팅 로그인 아이디가 있을 경우
        if (socket_mb_id != "" && socket_room_idx == 0) {
            //	chatLogin(socket_mb_id);
        } else if (socket_mb_id != "" && socket_room_idx != 0) {
            //	room_in(socket_mb_id,socket_mb_name,socket_room_idx);
        }
    });
    socket.on('disconnect', function () {
        console.log('disconnect');
        //alert("연결이 끊겼습니다.");
    });
    //console.log('연결성공');
}

//이건 사용안해도 됨 로그인이 제대로 됐는지 확인용
socket.on('socketLogin', function (data) {
});

//


//초대하기를 할 때
socket.on('invite', function (data) {
    // console.log(data);
    if (confirm(data.name + '님이 대화방에 초대하였습니다. 초대에 응하시겠습니까?')) {
        location.href = g5_bbs_url + '/chat_room.php?room_idx=' + data.room_idx;
    }
});

//챗방 들어가기
socket.on('room_in', function (data) {
    console.log('room_in'); // -- 들어오지 않음
    location.href = g5_bbs_url + "/chat_room.php?room_idx=" + data.room_idx;
});

//상대방이 들어왔을 때
socket.on('user_in', function (data) {
    console.log('user_in'); // -- 들어오지 않음

    $("#user_in").html(data.message);
    $("#user_in").fadeIn(600);
    $("#user_in").fadeOut(1000);

    //누가 들어오게 되면 읽음상태를 업데이트 하기
    for (var i = 0; i < data.read.length; i++) {
        if (data.read[i].msg_idx) {
            var readLength = 0;
            if (document.getElementById("read-status" + data.read[i].msg_idx) != undefined) {
                readLength = document.getElementById("read-status" + data.read[i].msg_idx).innerHTML;
                if (readLength == 1) {
                    document.getElementById("read-status" + data.read[i].msg_idx).style.display = "none";
                } else {
                    readLength--;
                    document.getElementById("read-status" + data.read[i].msg_idx).innerHTML = readLength;
                }
            }
        }
    }
});

//상대방이 나갔을 때
socket.on('user_out', function (data) {

    // console.log(data);
    $("#user_in").html(data.message);
    $("#user_in").fadeIn(600);
    $("#user_in").fadeOut(1000);
});

//상대방이 채팅을 입력할 때
socket.on('user_input', function (data) {
    is_user_input = 3;
    clearTimeout(userInputTime);

    if (data.user_id != document.getElementById("user_id").value) {
        if ($("#user-input").css("display") == "none") {
            $("#user-input").fadeIn(600);
        }
        userInputTime = setTimeout("hiddenUserInput()", "1000");//상대방이 입력이 없을 경우
        //$("#user-input").fadeOut(1000);
    }
});

var isMessage = false;
//방에 들어올 때 메세지 내용 가져오기
socket.on('get_message', function (data) {
    console.log('get_message 동작');
    const chat_msg = document.getElementById("chat-msg");
    var chat_view = document.getElementById("chat-view");
    //채팅 내용 최근 20개만 보여주기
    var chat_view_html = document.getElementById("chat-view").innerHTML;

    //자기 아이디와 data 받을 때 아이디가 일치 될 때 채팅 내용을 가지고 옴
    if (isMessage == false) {
        for (var i = 0; i < data.chats.length; i++) {
            //console.log('get_message', data.chats[i]);
            var msg = nl2br(data.chats[i].msg);
            if(msg.indexOf('jobgo.ac/node/uploads') != -1) { // 파일 첨부 시 width 줄임
                var add_class = 'style="width:50%";'
            }

            var msgdate_format = moment(data.chats[i].msgdate).format("LLLL").split(' ').splice(0,4).join(' '); // 보낸날짜 포맷 (0000년 00월 00일 0요일)
            if (i == 0) {
                chat_view_html += "<input type='hidden' name='msg_idx_first' value='" + data.chats[i].id + "'>";
                if(data.chats[i].msgdate.substring(0,10) != data.chats[i].last_msgdate.substring(0,10) || data.chats[i].msg_count < 20) { // 21.05.20 21번째 메세지(scrollTopView data) 날짜와 다를 경우 날짜 표시
                    chat_view_html += '<div class="today get_message">'+msgdate_format+'</div>';
                }
            }
            else { // 21.05.20 이전메세지와 다음메세지의 날짜가 다를 경우 날짜 표시
                if(data.chats[i].msgdate.substring(0,10) != data.chats[i-1].msgdate.substring(0,10)) {
                    chat_view_html += '<div class="today">'+msgdate_format+'</div>';
                }
            }
            if (data.user_id != data.chats[i].user_id) { //상대방이 챗을 보낼 때 챗방에서 보여주기
                chat_view_html += '<div class="you-msg">';
                //chat_view_html += `<div class="name">${data.chats[i].user_name}`;
                if (data.chats[i].read_count != 0) {
                    //chat_view_html += ` <span class="read-status" id="read-status${data.chats[i].id}">${data.chats[i].read_count}</span>`;
                }
                //chat_view_html += '</div>';
                chat_view_html += `<p class="nm">${document.getElementById('you_nickname').value}</p>`;
                chat_view_html += `<div class="msg">${msg}</div>`;
                chat_view_html += `<div class="date">${convert12H(data.chats[i].msgdate.substring(11, 16))}</div>`; // 21.05.14 채팅방 재입장 시 시간 표시 문제로 수정 (수정 전 코드 : data.chats[i].msgdate)
                chat_view_html += '</div>';
            }
            else { //내가 보낼때 챗방에서 보여주기
                chat_view_html += '<div class="my-msg">';
                //읽음상태표시
                if (data.chats[i].read_count != 0) {
                    //chat_view_html += ` <span class="read-status" id="read-status${data.chats[i].id}">${data.chats[i].read_count}</span>`;
                }
                chat_view_html += `<p class="nm">${document.getElementById('my_nickname').value}</p>`;
                chat_view_html += `<div class="date">${convert12H(data.chats[i].msgdate.substring(11, 16))}</div>`; // 21.05.14 채팅방 재입장 시 시간 표시 문제로 수정 (수정 전 코드 : data.chats[i].msgdate)
                chat_view_html += `<div class="msg" `+add_class+`>${msg} </div></div>`;
                /*// 21.05.20 기준이 되는 메세지와 다음 메세지의 날짜 시간을 비교하여 다르면 시간 표시 || 작성자를 비교하여 다르면 시간 표시  || 마지막 메세지 시간 표시
                if((i != data.chats.length-1 && (data.chats[i].msgdate.substring(0,16) != data.chats[i+1].msgdate.substring(0,16) || data.chats[i].user_name !=  data.chats[i+1].user_name)) || i == data.chats.length-1) {
                    chat_view_html += `<div class="date">${convert12H(data.chats[i].msgdate.substring(11, 16))}</div>`; // 21.05.14 채팅방 재입장 시 시간 표시 문제로 수정 (수정 전 코드 : data.chats[i].msgdate)
                } else {
                    chat_view_html += `<div class="date"></div>`;
                }*/
                chat_view_html += '</div>';
            }
        }
        chat_view.innerHTML = chat_view_html;
        //들어오면 스크롤은 맨 밑으로 내려가게
        const scrolltop = chat_msg.scrollHeight - chat_msg.offsetHeight;
        chat_msg.scrollTop = scrolltop;
        setTimeout("viewScrollTop()", 500);
        isMessage = true;

        hideLoadingBar();
    }
});

var msgScrollHeight = 0;
//스크롤 상단에 올 때 이전 메세지 보여주기
socket.on('scrollTopView', function (data) {
    console.log('scrollTopView 동작');
    const chat_msg = document.getElementById("chat-msg");
    var chat_view = document.getElementById("chat-view");
    const user_id = document.getElementById("user_id").value;

    //console.log('data.chats.length', data.chats.length);
    //채팅 내용 최근 20개만 보여주기
    var chat_view_html = "";
    //자기 아이디와 data 받을 때 아이디가 일치 될 때 채팅 내용을 가지고 옴
    if (0 < data.chats.length) {
        for (var i = 0; i < data.chats.length; i++) {
            console.log('scrollTopView', data.chats[i]);
            var msg = nl2br(data.chats[i].msg);
            var msgdate_format = moment(data.chats[i].msgdate).format("LLLL").split(' ').splice(0,4).join(' '); // 보낸날짜 포맷 (0000년 00월 00일 0요일)
            if (i == 0) {
                chat_view_html += "<input type='hidden' name='msg_idx_first' value='" + data.chats[i].id + "'>";
                if(data.chats[i].msg_count <= 20) { // 21.05.20 총 메세지 개수가 20개 or 20개 보다 작으면 제일 상단에 날짜 표시
                    chat_view_html += '<div class="today">'+msgdate_format+'</div>';
                }
            }
            else { // 21.05.20 이전메세지와 다음메세지의 날짜가 다를 경우 날짜 표시
                if(data.chats[i].msgdate.substring(0,10) != data.chats[i-1].msgdate.substring(0,10)) {
                    chat_view_html += '<div class="today">'+msgdate_format+'</div>';
                }
            }
            if (user_id != data.chats[i].user_id) { //상대방이 챗을 보낼 때 챗방에서 보여주기
                chat_view_html += '<div class="you-msg">';
                //chat_view_html += `<div class="name">${data.chats[i].user_name}`;
                if (data.chats[i].read_count != 0) {
                    //chat_view_html += ` <span class="read-status" id="read-status${data.chats[i].id}">${data.chats[i].read_count}</span>`;
                }
                //chat_view_html += '</div>';
                chat_view_html += `<p class="nm">${document.getElementById('you_nickname').value}</p>`;
                chat_view_html += `<div class="msg">${msg}</div>`;
                chat_view_html += `<div class="date">${convert12H(data.chats[i].msgdate.substring(11, 16))}</div>`; // 21.05.14 채팅방 재입장 시 시간 표시 문제로 수정 (수정 전 코드 : data.chats[i].msgdate)
                chat_view_html += '</div>';
            } else { //내가 보낼때 챗방에서 보여주기
                chat_view_html += '<div class="my-msg">';
                //읽음상태표시
                if (data.chats[i].read_count != 0) {
                    //chat_view_html += `<span class="read-status" id="read-status${data.chats[i].id}">${data.chats[i].read_count}</span>`;
                }
                chat_view_html += `<p class="nm">${document.getElementById('my_nickname').value}</p>`;
                chat_view_html += `<div class="date">${convert12H(data.chats[i].msgdate.substring(11, 16))}</div>`; // 21.05.14 채팅방 재입장 시 시간 표시 문제로 수정 (수정 전 코드 : data.chats[i].msgdate)
                chat_view_html += `<div class="msg">${msg} </div>`;
                chat_view_html += '</div>';
            }
        }

        chat_view.innerHTML = chat_view_html + document.getElementById("chat-view").innerHTML;
        //console.log(chat_msg.offsetHeight);
        chat_msg.scrollTop = chat_msg.scrollHeight - msgScrollHeight;
        //console.log('chat_mag.scrollTop', chat_msg.scrollTop);
    }
});

//상대방이 입력을 하고 자신이 방안에 없을 때 목록에 카운터 하기
socket.on('badgeCount', function (data) {
    /*
    document.getElementById("chat-badge"+data.room_idx).style.display="";
    var badge=parseInt(document.getElementById("chat-badge"+data.room_idx).innerHTML);
    badge++;
    document.getElementById("chat-badge"+data.room_idx).innerHTML=badge;
    var msg=data.msg;

    document.getElementById("msg"+data.room_idx).innerHTML=msg;
    */
    //목록 갱신을 있는 줄 몰라서 ajax로 대처 했음
    $.ajax({
        url: g5_bbs_url + "/ajax.chat.list.php",
        // url: "https://www.jobgo.ac/bbs/ajax.chat.list.php",
        dataType: "html",
        type: "POST",
        data: {sel_room_id : document.getElementById("sel_room_id").value, idx: document.getElementById("idx").value, stx: document.getElementById("stx").value, sel: document.getElementById("sch_state").value}, // 21.05.18 data 추가 - 채팅방 검색 및 뱃지 표시 때문에 사용
        success: function (data) {
            $("#chat-lists").html(data);
        },
        complete: function() {
            hideLoadingBar();
        }
    });

    $.ajax({
        url: g5_bbs_url + "/ajax.chat.badge.php",
        dataType: "html",
        type: "POST",
        success: function (data) {
            console.log(data);
            $(".no_read_badge").html(data);
        }
    });
});

//채팅 목록 가져오기
socket.on('chatList', function (data) {
    $.ajax({
        url: g5_bbs_url + "/ajax.chat.list.php",
        // url: "httsp://www.jobgo.ac/bbs/ajax.chat.list.php",
        dataType: "html",
        type: "POST",
        data: {sel_room_id : document.getElementById("sel_room_id").value, idx: document.getElementById("idx").value, stx: document.getElementById("stx").value, sel: document.getElementById("sch_state").value}, // 21.05.18 data 추가 - 채팅방 검색 및 뱃지 표시 때문에 사용
        success: function (data) {
            $("#chat-lists").html(data);
        },
        complete: function() {
            hideLoadingBar();
        }
    });
});

//메세지를 보내고 받는 폼
socket.on('chat_view', function (data) {
    console.log("메세지 입력 후 보내는 버튼 누른 후 동작");

    const user_id = document.getElementById("user_id").value;
    const chat_msg = document.getElementById("chat-msg");
    const chat_view = document.getElementById("chat-view");
    var chat_view_html = document.getElementById("chat-view").innerHTML;
    $("#user-input").fadeOut(600);
    var readLength = 0;
    //파일 첨부 끝나고 난 담에 주석 풀기
    for (var i = 0; i < data.read.length; i++) {
        // console.log(data.read.length);
        if (data.read[i].read_status == false) {
            readLength++;
        }
    }

    // 21.05.20 메세지 입력 시 메세지 입력한 날짜와 이전 마지막 메세지의 날짜가 다를 경우 날짜 표시
    var msgdate_format = moment(data.msgdate).format("LLLL").split(' ').splice(0,4).join(' '); // 보낸날짜 포맷 (0000년 00월 00일 0요일)
    if(data.msgdate != undefined) {
        if(data.msgdate.substring(0,10) != data.last_msgdate.substring(0,10) || data.msg_count == 1) {
            chat_view_html += '<div class="today">'+msgdate_format+'</div>';
        }
    }

    const msg = nl2br(data.msg);
    if (user_id != data.user_id) { //상대방이 챗을 보낼 때 챗방에서 보여주기
        chat_view_html += '<div class="you-msg">';
        //chat_view_html += `<div class="name">${data.user_name}`;
        //읽음상태표시
        if (readLength != 0) {
            //chat_view_html += `<span class="read-status" id="read-status${data.msg_idx}">${readLength}</span>`;
        }
        //chat_view_html += '</div>';
        chat_view_html += `<p class="nm">${document.getElementById('you_nickname').value}</p>`;
        chat_view_html += `<div class="msg">${msg}</div>`;
        chat_view_html += `<div class="date">${convert12H(data.time.substring(3, 8))}</div>`; // 21.05.14 채팅방 재입장 시 시간 표시 문제로 수정 (수정 전 코드 : data.time)
        chat_view_html += '</div>';

    }
    else { //내가 보낼때 챗방에서 보여주기
        chat_view_html += '<div class="my-msg">';
        //읽음상태표시

        if (readLength != 0 && sale_mb_id != data.user_id) {
            //채팅 보낸사람이 판매자가 아니고, 상대방이 안읽었을 경우 알림톡 발송
            console.log(data.msg_count);
            if(data.msg_count > 1){
                //메세지 처음이 아닐땐 계속 새로만든 판매자 구매자 이름 바꿔서 문자보내줌 문의내용있다고
                $.ajax({
                    url: g5_bbs_url + "/ajax.controller.php",
                    type: "POST",
                    data: {"room_id" : document.getElementById("sel_room_id").value , "mode" : "chat_alimtalk_buy", "buy_mb_id" : sale_mb_id,"sale_mb_id" : buy_mb_id,"idx" : ta_idx},
                    success: function (data) {
                    }
                });
            }else{
                //기존의 재능구매요청하는거 처음일떄
                $.ajax({
                    url: g5_bbs_url + "/ajax.controller.php",
                    type: "POST",
                    data: {"room_id" : document.getElementById("sel_room_id").value , "mode" : "chat_alimtalk", "sale_mb_id" : sale_mb_id},
                    success: function (data) {
                    }
                });
                //chat_view_html += `<span class="read-status" id="read-status${data.msg_idx}">${readLength}</span>`;
            }
        }else if(readLength != 0 && sale_mb_id == data.user_id){
            // 23.04.26 판매자가 채팅해도 구매자가 안읽을경구 wc
            console.log(buy_mb_id);
            $.ajax({
                url: g5_bbs_url + "/ajax.controller.php",
                type: "POST",
                data: {"room_id" : document.getElementById("sel_room_id").value , "mode" : "chat_alimtalk_buy", "buy_mb_id" : buy_mb_id,"sale_mb_id" : sale_mb_id,"idx" : ta_idx},
                success: function (data) {
                }
            });

        }


        chat_view_html += `<p class="nm">${document.getElementById('my_nickname').value}</p>`;
        chat_view_html += `<div class="date">${convert12H(data.time.substring(3, 8))}</div>`; // 21.05.14 채팅방 재입장 시 시간 표시 문제로 수정 (수정 전 코드 : data.time)
        chat_view_html += `<div class="msg">${msg}</div>`;
        chat_view_html += '</div>';

    }
   chat_view.innerHTML = chat_view_html;
    const scrolltop = Math.round(chat_msg.scrollHeight - chat_msg.offsetHeight);
    // console.log('chat_view_html', chat_view_html);

    if (!is_chat_scroll) {
        chat_msg.scrollTop = scrolltop;
        setTimeout("viewScrollTop()", 500);
    }

    socket.emit('chatList', {mb_id: user_id}); // -- 채팅방 목록에 마지막 메세지 실시간 표시 위함
    // console.log(chat_msg.scrollTop);
    // console.log(chat_msg.scrollHeight);
});

//채팅방에 들어올 때 자동으로 아래로 내려오게 만든 함수
function viewScrollTop() {
    const chat_msg = document.getElementById("chat-msg");
    const scrolltop = Math.round(chat_msg.scrollHeight - chat_msg.offsetHeight);

    chat_msg.scrollTop = scrolltop;
    if (scrolltop != Math.round(chat_msg.scrollTop)) {
        setTimeout("viewScrollTop()", 500);
    }
}

//초대를 할 때 방생성하는 것
function invite(my_id, my_name, you_id, you_name) {
    if (my_id == "") {
        alert("회원 로그인 후에 이용하십시오");
        location.href = g5_bbs_url + "/login.php";
        return;
    }
    socket.emit('room_create', {
        master_id: my_id,
        account: account,
        youID: you_id,
        youName: you_name,
        my_name: my_name,
        room_id: my_id + ':' + you_id
    });
}

// 로그
function log(message) {
    console.log('app.js log', message);
}

//챗로그인
function chatLogin(mb_id) {
    console.log('chatlogin');
    socket_mb_id = mb_id;
    socket.emit('conn', {mb_id: mb_id});
    console.log('test');

    showLoadingBar(); // 로딩바
}

//채팅 목록
function chatList(mb_id) {
    console.log('chatlist');
    socket_mb_id = mb_id;
    socket.emit('chatList', {mb_id: mb_id});
}

//챗방에 들어왔을 때
function room_in(user_id, user_name, room_idx) {
    socket_mb_id = user_id;
    socket_mb_name = user_name;
    socket_room_idx = room_idx;
    socket_mb_id = user_id;
    socket.emit('room_in', {user_id: user_id, user_name: user_name, room_idx: room_idx});
}

var is_user_input = 0;//상대방이 입력중인지 아닌지 판별하기
var userInputTime = 0;


//상대방이 입력이 없을 경우 3초 후에 입력중 뷰를 자동으로 닫히게
function hiddenUserInput() {
    is_user_input--;
    // console.log(is_user_input);
    if (is_user_input <= 0) {
        $("#user-input").fadeOut(600);
        clearTimeout(userInputTime);
    } else {
        setTimeout("hiddenUserInput()", "1000");
    }
}

function nl2br(str) {
    return str.replace(/\n/g, "<br />");
}

// 푸시
function sendPush(room_id) {
    $.ajax({
        url: g5_bbs_url + "/ajax.send_push.php",
        type: "POST",
        data: {room_id : room_id},
        success: function (data) {
        }
    });
}

try {
    //메세지 폼에 글자를 입력한 후 높이만큼 자동으로 높이 조절하기
    document.getElementById("msg").addEventListener('keyup', function (event) {
        const user_id = document.getElementById("user_id").value;
        const room_idx = document.getElementById("room_idx").value;
        const msg = document.getElementById("msg").value;

        this.style.height = "1px";
        this.style.height = (2 + this.scrollHeight) + "px";
        if (parseInt(this.style.height) <= 150) {
            document.getElementById("msg-forms").style.height = this.style.height;
            document.getElementById("user-input").style.bottom = (20 + this.scrollHeight) + "px";
        }
        //delete키 back space키 enter키는 상대방 입력 중이라고 표시하면 안 됨
        if (event.keyCode != 8 && event.keyCode != 46 && event.keyCode != 13) {
            if (msg != '') {
                document.getElementById("chat-send").disabled = false;
            } else {
                document.getElementById("chat-send").disabled = true;
            }
            socket.emit("user_input", {user_id: user_id, room_idx: room_idx});
        } else {
            if (msg == '') {
                document.getElementById("chat-send").disabled = true;
            }
        }
    });

    //메세지 보내기 버튼을 눌렀을 때
    document.getElementById("chat-send").addEventListener('click', function (event) {
        console.log('전송 버튼 클릭');
        const msg = document.getElementById("msg").value;
        const user_id = document.getElementById("user_id").value;
        const room_idx = document.getElementById("room_idx").value;
        const user_name = document.getElementById("user_name").value;
        const chat_msg = document.getElementById("chat-msg");
        // console.log('msg', msg);
        // console.log('user_id', user_id);
        // console.log('room_idx', room_idx);
        // console.log('user_name', user_name);
        // console.log('chat_msg', chat_msg);
        const now = new Date();
        const nowYear = now.getFullYear();
        const Month = now.getMonth() + 1;
        const nowMonth = Month < 10 ? "0" + Month : Month;
        const nowDay = now.getDate() < 10 ? "0" + now.getDate() : now.getDate();
        const nowHour = now.getHours() < 10 ? "0" + now.getHours() : now.getHours();
        const nowMinute = now.getMinutes() < 10 ? "0" + now.getMinutes() : now.getMinutes();
        const nowSecond = now.getSeconds() < 10 ? "0" + now.getSeconds() : now.getSeconds();
        const msgdate = nowYear + "-" + nowMonth + "-" + nowDay + " " + nowHour + ":" + nowMinute + ":" + nowSecond;

        socket.emit('chat_send', { // DB 컬럼 추가 시 아래에 항목 추가
            room_idx: room_idx,
            user_id: user_id,
            msg: msg,
            user_name: user_name,
            msgdate: msgdate
        });
        document.getElementById("chat-send").disabled = true;
        document.getElementById("msg").value = '';
        document.getElementById("msg").focus();
        document.getElementById("msg").style.height = "38px";
        document.getElementById("msg-forms").style.height = "38px";

        const scrolltop = chat_msg.scrollHeight - chat_msg.offsetHeight;
        chat_msg.scrollTop = Math.round(scrolltop);

        sendPush(room_idx); // 푸시
    });

    // 메세지 입력란 엔터키 이벤트 (추가)
    document.getElementById("msg").addEventListener('keyup', function (event) {
        if(event.shiftKey && event.keyCode==13) {}
        else if(event.keyCode==13) {
            console.log('엔터키 입력');
            if($.trim(document.getElementById("msg").value).length == 0) {
                document.getElementById("msg").value = '';
                document.getElementById("msg").focus();
                return false;
            }
            const msg = document.getElementById("msg").value;
            const user_id = document.getElementById("user_id").value;
            const room_idx = document.getElementById("room_idx").value;
            const user_name = document.getElementById("user_name").value;
            const chat_msg = document.getElementById("chat-msg");
            // console.log('msg', msg);
            // console.log('user_id', user_id);
            // console.log('room_idx', room_idx);
            // console.log('user_name', user_name);
            // console.log('chat_msg', chat_msg);
            const now = new Date();
            const nowYear = now.getFullYear();
            const Month = now.getMonth() + 1;
            const nowMonth = Month < 10 ? "0" + Month : Month;
            const nowDay = now.getDate() < 10 ? "0" + now.getDate() : now.getDate();
            const nowHour = now.getHours() < 10 ? "0" + now.getHours() : now.getHours();
            const nowMinute = now.getMinutes() < 10 ? "0" + now.getMinutes() : now.getMinutes();
            const nowSecond = now.getSeconds() < 10 ? "0" + now.getSeconds() : now.getSeconds();
            const msgdate = nowYear + "-" + nowMonth + "-" + nowDay + " " + nowHour + ":" + nowMinute + ":" + nowSecond;

            socket.emit('chat_send', { // DB 컬럼 추가 시 아래에 항목 추가
                room_idx: room_idx,
                user_id: user_id,
                msg: msg,
                user_name: user_name,
                msgdate: msgdate
            });
            document.getElementById("chat-send").disabled = true;
            document.getElementById("msg").value = '';
            document.getElementById("msg").focus();
            document.getElementById("msg").style.height = "38px";
            document.getElementById("msg-forms").style.height = "38px";

            const scrolltop = chat_msg.scrollHeight - chat_msg.offsetHeight;
            chat_msg.scrollTop = Math.round(scrolltop);

            sendPush(room_idx); // 푸시
        }
    });

    //챗방 스크롤 이벤트
    document.getElementById("chat-msg").addEventListener('scroll', function () {
        const room_idx = document.getElementById("room_idx").value;
        const msg_idx = document.getElementsByName("msg_idx_first")[0].value;
        const chat_msg = this;
        const scrolltop = chat_msg.scrollHeight - chat_msg.offsetHeight;
        // console.log('scrolltop', scrolltop);
        // console.log('chat_msg scrolltop', Math.round(chat_msg.scrollTop));
        // console.log('msg_idx', msg_idx);
        if (scrolltop != Math.round(chat_msg.scrollTop)) {
            is_chat_scroll = true;
        } else {
            is_chat_scroll = false;
        }
        msgScrollHeight = chat_msg.scrollHeight;
        if (Math.round(chat_msg.scrollTop) == 0 && is_chat_scroll) {
            // console.log("이전페이지");
            var data = {room_idx: room_idx, msg_idx: msg_idx};
            // console.log(data);
            socket.emit("scrollViewTop", data);
        }
    });
    document.getElementById("btn-file").addEventListener("click", function () {
        document.getElementById("image").click();
    });
    document.getElementById("image").addEventListener("change", function (ev) {
        console.log('이미지 첨부 시 동작');
        ev.preventDefault();
        const user_id = document.getElementById("user_id").value;
        const room_idx = document.getElementById("room_idx").value;
        const user_name = document.getElementById("user_name").value;
        const files = ev.target.files || ev.dataTransfer.files;
        const fileReader = new FileReader();
        var fileName = files[0].name;
        fileReader.readAsDataURL(files[0]);
        const now = new Date();
        const nowYear = now.getFullYear();
        const Month = now.getMonth() + 1;
        const nowMonth = Month < 10 ? "0" + Month : Month;
        const nowDay = now.getDate() < 10 ? "0" + now.getDate() : now.getDate();
        const nowHour = now.getHours() < 10 ? "0" + now.getHours() : now.getHours();
        const nowMinute = now.getMinutes() < 10 ? "0" + now.getMinutes() : now.getMinutes();
        const nowSecond = now.getSeconds() < 10 ? "0" + now.getSeconds() : now.getSeconds();
        const msgdate = nowYear + "-" + nowMonth + "-" + nowDay + " " + nowHour + ":" + nowMinute + ":" + nowSecond;

        fileReader.onload = function (event) {
            if (!event) {
                var fileData = fileReader.content;
            } else {
                var fileData = event.target.result;
            }
            var formData = new FormData();
            formData.append("image", files[0]);
            formData.append("room_idx", room_idx);
            formData.append("user_id", user_id);
            formData.append("user_name", user_name);
            formData.append("msgdate", msgdate);
            try {
                const result = axios.post(url + "/upload", formData);
                document.getElementById("image").value = '';

            } catch (err) {
                console.error(err);
            }
        }
        setTimeout("viewScrollTop()", 500);
        // console.log(fileReader);

        sendPush(room_idx); // 푸시
    });
} catch (err) {
    console.log(err);
}

// 21.05.14 24시 단위로 받아온 시간을 12시간 단위로 변경 (오전/오후)
function convert12H(a) {
    var time = a; // 'hh:mm' 형태로 값을 받아서
    var getTime = time.substring(0, 2); // 시간(hh)부분만 저장
    var intTime = parseInt(getTime); // int형으로 변환

    if (intTime < 12) { // intTime이 12보다 작으면
        var str = '오전 '; // '오전' 출력
    } else { // 12보다 크면
        var str = '오후 '; // '오후 출력'
    }

    if (intTime == 12) { // intTime이 12면 변환 후 그대로 12
        var cvHour = intTime;
    } else {
        var cvHour = intTime % 12; // intTime을 12로 나눈 나머지 값이 변환 후 시간이 됨
    }

    var res = str + ('0' + cvHour).slice(-2) + time.slice(-3); // 'hh:mm'형태로 만들기

    return res; // return
}