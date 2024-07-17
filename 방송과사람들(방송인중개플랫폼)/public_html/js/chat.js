var url = "https://itforone.com:6003"; // chat.js 충돌 오류로 const에서 var로 변경
// const uploadurl = "http://itforone.co.kr:5100";
var options = {'forceNew': true};
var socket = io.connect(url, options);
var account = 'chating';
var is_chat_scroll = false;//챗방 스크롤 여부
var socket_mb_id = "";
var socket_room_idx = 0;
var socket_mb_name = 0;

if (socket == undefined) {
    alert("소켓통신 안 됨");
}

if (socket != undefined) {
    socket.on('connect', function () {
        // 연결 성공
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

// //초대하기를 할 때
// socket.on('invite', function (data) {
//     // console.log(data);
//     if (confirm(data.name + '님이 대화방에 초대하였습니다. 초대에 응하시겠습니까?')) {
//         location.href = g5_bbs_url + '/chat_room.php?room_idx=' + data.room_idx;
//     }
// });

// //챗방 들어가기
// socket.on('room_in', function (data) {
//     console.log('room_in'); // -- 들어오지 않음
//     location.href = g5_bbs_url + "/chat_room.php?room_idx=" + data.room_idx;
// });

//상대방이 들어왔을 때
socket.on('user_in', function (data) {
    console.log('user_in');
    // $("#user_in").html(data.message);
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
    // chatBadge(data.user_id); // 상단 채팅 수신 여부 표시

    console.log('get_message');
    const chat_msg = document.getElementById("chat-msg");
    var chat_view = document.getElementById("chat-view");
    var chat_html = document.getElementById("chat-view").innerHTML;

    //채팅 내용 최근 20개만 보여주기
    //자기 아이디와 data 받을 때 아이디가 일치 될 때 채팅 내용을 가지고 옴
    if (isMessage == false) {
        isMessage = true;

        chat_view.innerHTML = chat_html + getChatData(data, 'get_message'); // 채팅데이터
        chat_msg.scrollTop = chat_msg.scrollHeight - chat_msg.offsetHeight;

        //들어오면 스크롤은 맨 밑으로 내려가게
        setTimeout("viewScrollTop()", 200); // 500이었으나 200으로 변경, 테스트 필요

        // hideLoadingBar();
    }
});

var msgScrollHeight = 0;
//스크롤 상단에 올 때 이전 메세지 보여주기
socket.on('scrollTopView', function (data) {
    console.log('scrollTopView');
    const chat_msg = document.getElementById("chat-msg");
    var chat_view = document.getElementById("chat-view");
    const user_id = document.getElementById("user_id").value;

    //채팅 내용 최근 20개만 보여주기
    //자기 아이디와 data 받을 때 아이디가 일치 될 때 채팅 내용을 가지고 옴
    if (0 < data.chats.length) {
        chat_view.innerHTML = getChatData(data, 'scrollTopView') + document.getElementById("chat-view").innerHTML; // 채팅데이터
        chat_msg.scrollTop = chat_msg.scrollHeight - msgScrollHeight;
        //console.log(chat_msg.offsetHeight);
        //console.log('chat_mag.scrollTop', chat_msg.scrollTop);
    }
});

//상대방이 입력을 하고 자신이 방안에 없을 때 목록에 카운터 하기
socket.on('badgeCount', function (data) {
    //목록 갱신을 있는 줄 몰라서 ajax로 대처 했음
    $.ajax({
        url: g5_bbs_url + "/ajax.chat_list.php",
        dataType: "html",
        type: "POST",
        data: {stx: document.getElementById("stx").value},
        success: function (data) {
            $(".ul_chat_list").html(data);
        },
        complete: function() {
            // hideLoadingBar();
        }
    });
});

//채팅 목록 가져오기
socket.on('chatList', function (data) {
    // 1. chat_list.php 처음 접속 시 실행
    console.log('chatList');
    $.ajax({
        url: g5_bbs_url + "/ajax.chat_list.php",
        dataType: "html",
        type: "POST",
        data: {stx: document.getElementById("stx").value},
        success: function (data) {
            $(".ul_chat_list").html(data);

            // hideLoadingBar(); // 로딩바 숨김
        },
        beforeSend: function (data) {
            // showLoadingBar();
        }
    });
});

//메세지를 보내고 받는 폼
socket.on('chat_view', function (data) {
    // chatBadge(data.user_id); // 상단 채팅 수신 여부 표시

    console.log("chat_view : " + data);

    const user_id = document.getElementById("user_id").value;
    const chat_msg = document.getElementById("chat-msg");
    const chat_view = document.getElementById("chat-view");
    var chat_html = document.getElementById("chat-view").innerHTML;
    var readLength = 0;
    //파일 첨부 끝나고 난 담에 주석 풀기
    for (var i = 0; i < data.read.length; i++) {
        // console.log(data.read.length);
        if (data.read[i].read_status == false) {
            readLength++;
        }
    }

    const msg = nl2br(data.msg); // 메세지

    var img_class = '';
    var file_size = ''; // 파일 사이즈
    if(data.server_file_name) { // 파일업로드여부
        file_size = formatBytes(data.file_size);
        var reg = /(.*?)\.(jpg|JPG|jpeg|png|PNG|gif|bmp)$/;
        if(data.server_file_name.match(reg)) { // 이미지 확장자이면
            img_class = 'img';
        } else {
            img_class = 'file';
        }
    }

    // 21.05.20 메세지 입력 시 메세지 입력한 날짜와 이전 마지막 메세지의 날짜가 다를 경우 날짜 표시
    var msgdate_format = moment(data.msgdate).format("LLLL").split(' ').splice(0,4).join(' '); // 보낸날짜 포맷 (0000년 00월 00일 0요일)
    if(data.msgdate != undefined) {
        if(data.msgdate.substring(0,10) != data.last_msgdate.substring(0,10) || data.msg_count == 1) {
            chat_html += '<div class="data today">'+msgdate_format+'</div>';
        }
    }

    // 상대방 메세지
    if (user_id != data.user_id) {
        chat_html += `<div class="receive">`;
        chat_html += `<div class="area_img">${g_user_img}</div>`;
        chat_html += `<div class="area_msg">`;
        chat_html += `<div class="name">${document.getElementById('room_name').value}</div>`; // 일반은 닉네임 or 아이디 / 기업은 회사명
        chat_html += `<div class="cont_box msg `+img_class+`">`;
        if(img_class == 'file') { // 파일
            chat_html += `<a class="file_box" href="https://itforone.com/~broadcast/bbs/file_download.php?mode=chat&temp=${data.server_file_name}&real=${data.file_name}" width="100%">
                                <div class="icon"><img src="https://itforone.com/~broadcast/img/icon_chat_file.svg"></div>
                                <div class="file_info">
                                    <div class="subject">${data.file_name}</div>
                                    <div class="size">용량 ${file_size}</div>
                                </div>
                           </a>`;
        } else if(img_class == 'img') {
            chat_html += `<a href="https://itforone.com/~broadcast/bbs/file_download.php?mode=chat&temp=${data.server_file_name}&real=${data.file_name}">`
            chat_html += `${msg}`;
            chat_html += `</a>`;
        } else { // 그 외
            chat_html += `${msg}`;
        }
        chat_html += `</div>`; // ==.cont_box 닫음
        chat_html += `<div class="time date">${convert12H(data.time.substring(3, 8))}</div>`; // 21.05.14 채팅방 재입장 시 시간 표시 문제로 수정 (수정 전 코드 : data.chats[i].msgdate)
        chat_html += `</div>`; // ==.area_msg 닫음
        chat_html += `</div>`; // ==.receive 닫음
    }
    // 내 메세지
    else {
        chat_html += `<div class="send">`;
        chat_html += `<div class="area_msg">`;
        chat_html += `<div class="cont_wrap `+img_class+`">`;
        chat_html += `<div class="cont_box msg `+img_class+`">`;
        if(img_class == 'file') { // 파일
            chat_html += `<a class="file_box" href="https://itforone.com/~broadcast/bbs/file_download.php?mode=chat&temp=${data.server_file_name}&real=${data.file_name}" width="100%">
                                <div class="icon"><img src="https://itforone.com/~broadcast/img/icon_chat_file.svg"></div>
                                <div class="file_info">
                                    <div class="subject">${data.file_name}</div>
                                    <div class="size">용량 ${file_size}</div>
                                </div>
                           </a>`;
        } else if(img_class == 'img') {
            chat_html += `<a href="https://itforone.com/~broadcast/bbs/file_download.php?mode=chat&temp=${data.server_file_name}&real=${data.file_name}">`
            chat_html += `${msg}`;
            chat_html += `</a>`;
        } else { // 그 외
            chat_html += `${msg}`;
        }
        chat_html += `</div>`; // ==.cont_box 닫음
        if (readLength != 0) { // 읽음 표시
            //chat_html += `<i class="read read-status" id="read-status${data.msg_idx}">${readLength}</i>`;
            chat_html += `<i class="read read-status" id="read-status${data.msg_idx}">1</i>`;
        }
        chat_html += `</div>`; // ==.cont_wrap 닫음
        chat_html += `<div class="time date">${convert12H(data.time.substring(3, 8))}</div>`; // 21.05.14 채팅방 재입장 시 시간 표시 문제로 수정 (수정 전 코드 : data.chats[i].msgdate)
        chat_html += `</div>`; // ==.area_msg 닫음
        chat_html += `</div>`; // ==.send 닫음
    }
    chat_view.innerHTML = chat_html;

    const scrolltop = Math.round(chat_msg.scrollHeight - chat_msg.offsetHeight);
    if (!is_chat_scroll) {
        chat_msg.scrollTop = scrolltop;
        setTimeout("viewScrollTop()", 500);
    }
    // console.log(chat_msg.scrollTop);
    // console.log(chat_msg.scrollHeight);
    // hideLoadingBar(); // 파일 첨부 완료 시 로딩바 삭제

    // 푸시
    if (readLength != 0) { // 안읽었을때
        var message = data.msg;
        if(img_class == 'file' || img_class == 'img') { message = data.file_name; }
        $.ajax({
            url: g5_bbs_url + "/ajax.chat_push.php",
            type: "POST",
            data: {mb_id: data.user_id, message: message, room_idx: socket_room_idx},
            success: function (data) {},
        });
    }
});

//상단에 채팅 수신 여부 표시 (개수를 표시하고 싶으면 head에서 badge 추가)
function chatBadge(user_id) {
    $.ajax({
        url: g5_bbs_url + "/ajax.chat_badge.php",
        dataType: "html",
        type: "POST",
        data: {user_id: user_id},
        success: function (data) {
            if(data > 0) {
                $('.alarm').show();
            } else {
                $('.alarm').hide();
            }
        },
    });
}

//상단에 채팅 수신 여부 표시 (개수를 표시하고 싶으면 head에서 badge 추가)
socket.on('chat_badge', function (data) {
    // console.log('chat_badge');
    chatBadge(data.user_id);
});

// 파일사이즈 체크
socket.on('filesize_check', function (data) {
    console.log('filesize_check');
    alert('파일이 최대 용량 10MB를 초과합니다.');
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
        account: 'chating',
        my_name: my_name,
        room_id: my_id + ':' + you_id
    });
}

// 로그
function log(message) {
    console.log('app.js log', message);
}

// 챗로그인
function chatLogin(mb_id) {
    // 서버 연결
    // console.log('chatLogin');
    socket_mb_id = mb_id;
    socket.emit('conn', {mb_id: mb_id});
}

// 채팅 목록
function chatList(mb_id) {
    // showLoadingBar(); // 로딩바
    console.log('chatList');
    socket_mb_id = mb_id;
    socket.emit('chatList', {mb_id: mb_id});
}

// 챗방에 들어왔을 때
var g_user_img = '';
function room_in(user_id, user_name, room_idx, user_img) {
    // showLoadingBar(); // 로딩바
    console.log('room_in');
    socket_mb_id = user_id;
    socket_mb_name = user_name;
    socket_room_idx = room_idx;
    socket_mb_id = user_id;
    g_user_img = user_img; // 상대방 프로필 이미지
    socket.emit('room_in', {user_id: user_id, user_name: user_name, room_idx: room_idx, user_img: user_img});
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

try {
    //메세지 폼에 글자를 입력한 후 높이만큼 자동으로 높이 조절하기
    document.getElementById("msg").addEventListener('keyup', function (event) {
        const user_id = document.getElementById("user_id").value;
        const room_idx = document.getElementById("room_idx").value;
        const msg = document.getElementById("msg").value;

        var is_mobile = mobileCheck();
        if(is_mobile) { // 모바일
            // 모바일과 높이 달라서 별도로 설정 (높이는 기기마다 달라서 변경하여야 할 수도 있음)
            document.getElementById("test").value = this.scrollHeight;
            if (this.scrollHeight > 42) { // 높이 자동 조절
                document.getElementById("msg").style.height = '66px;';
            }
        }
        else { // PC
            console.log("여기타나?");
            if(this.scrollHeight > 45) { // 높이 자동 조절
                document.getElementById("msg").style.height = '66px';
            }
            if(this.scrollHeight == 45 || this.scrollHeight == 64) {
                document.getElementById("msg").style.height = '45px';
            }
        }

        //delete키 back space키 enter키는 상대방 입력 중이라고 표시하면 안 됨
        if (event.keyCode != 8 && event.keyCode != 46 && event.keyCode != 13) {
            if (msg != '') {
                document.getElementById("chat-send").disabled = false;
            } else {
                document.getElementById("chat-send").disabled = true;
            }
            // socket.emit("user_input", {user_id: user_id, room_idx: room_idx});
        } else {
            if (msg == '') {
                document.getElementById("chat-send").disabled = true;
            }
        }

        // 메세지 입력 엔터키 이벤트 (추가)
        if(event.shiftKey && event.keyCode==13) {}
        else if(event.keyCode==13) {
            console.log('chat-send enter');
            if($.trim(document.getElementById("msg").value).length == 0) { // 빈칸이면 실행 X
                document.getElementById("msg").value = '';
                document.getElementById("msg").focus();
                return false;
            }

            const msg = $.trim(document.getElementById("msg").value);
            const user_id = document.getElementById("user_id").value;
            const room_idx = document.getElementById("room_idx").value;
            const user_name = document.getElementById("user_name").value;
            const chat_msg = document.getElementById("chat-msg");

            // console.log('msg', msg);
            // console.log('user_id', user_id);
            // console.log('room_idx', room_idx);
            // console.log('user_name', user_name);
            // console.log('chat_msg', chat_msg);
            // console.log('user_img', g_user_img);

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
                msgdate: msgdate,
                user_img: g_user_img,
            });
            document.getElementById("chat-send").disabled = true;
            document.getElementById("msg").value = '';
            document.getElementById("msg").focus();
            document.getElementById("msg").style.height = "45px";
            // document.getElementById("msg-forms").style.height = "38px";

            const scrolltop = chat_msg.scrollHeight - chat_msg.offsetHeight;
            chat_msg.scrollTop = Math.round(scrolltop);
        }
    });

    //메세지 보내기 버튼을 눌렀을 때
    document.getElementById("chat-send").addEventListener('click', function (event) {
        console.log('chat-send click');
        if($.trim(document.getElementById("msg").value).length == 0) { // 빈칸이면 실행 X
            document.getElementById("msg").value = '';
            document.getElementById("msg").focus();
            return false;
        }
        const msg = $.trim(document.getElementById("msg").value);
        const user_id = document.getElementById("user_id").value;
        const room_idx = document.getElementById("room_idx").value;
        const user_name = document.getElementById("user_name").value;
        const chat_msg = document.getElementById("chat-msg");

        const now = new Date();
        const nowYear = now.getFullYear();
        const Month = now.getMonth() + 1;
        const nowMonth = Month < 10 ? "0" + Month : Month;
        const nowDay = now.getDate() < 10 ? "0" + now.getDate() : now.getDate();
        const nowHour = now.getHours() < 10 ? "0" + now.getHours() : now.getHours();
        const nowMinute = now.getMinutes() < 10 ? "0" + now.getMinutes() : now.getMinutes();
        const nowSecond = now.getSeconds() < 10 ? "0" + now.getSeconds() : now.getSeconds();
        const msgdate = nowYear + "-" + nowMonth + "-" + nowDay + " " + nowHour + ":" + nowMinute + ":" + nowSecond;

        // console.log('msg', msg);
        // console.log('user_id', user_id);
        // console.log('room_idx', room_idx);
        // console.log('user_name', user_name);
        // console.log('chat_msg', chat_msg);
        // console.log('user_img', g_user_img);

        socket.emit('chat_send', { // DB 컬럼 추가 시 아래에 항목 추가
            room_idx: room_idx,
            user_id: user_id,
            msg: msg,
            user_name: user_name,
            msgdate: msgdate,
            user_img: g_user_img,
        });
        document.getElementById("chat-send").disabled = true;
        document.getElementById("msg").value = '';
        document.getElementById("msg").focus();
        document.getElementById("msg").style.height = "45px";
        //document.getElementById("msg-forms").style.height = "38px";

        const scrolltop = chat_msg.scrollHeight - chat_msg.offsetHeight;
        chat_msg.scrollTop = Math.round(scrolltop);
    });

    //챗방 스크롤 이벤트
    document.getElementById("chat-msg").addEventListener('scroll', function () {
        const user_id = document.getElementById("user_id").value;
        const room_idx = document.getElementById("room_idx").value;
        const msg_idx = document.getElementsByName("msg_idx_first")[0].value;
        const chat_msg = this;
        const scrolltop = chat_msg.scrollHeight - chat_msg.offsetHeight;
        // console.log('scrolltop', scrolltop);
        // console.log('chat_msg scrolltop', Math.round(chat_msg.scrollTop));
        // console.log('msg_idx', msg_idx);
        // console.log('scrollHeight - offsetHeight', scrolltop);
        if (scrolltop != Math.round(chat_msg.scrollTop)) {
            is_chat_scroll = true;
        } else {
            is_chat_scroll = false;
        }
        msgScrollHeight = chat_msg.scrollHeight;
        if (Math.round(chat_msg.scrollTop) == 0 && is_chat_scroll) {
            // console.log("이전페이지");
            var data = {user_id: user_id, room_idx: room_idx, msg_idx: msg_idx, user_img: g_user_img};
            // console.log(data);
            socket.emit("scrollViewTop", data);
        }
    });
    document.getElementById("btn-img").addEventListener("click", function () {
        try {
            dreamforone.setUpLoadType("img");
            document.getElementById("image").click();
        } catch (e) {
            document.getElementById("image").click();
        }

    });
    document.getElementById("image").addEventListener("change", function (ev) {
        // showLoadingBar(); // 파일 첨부 시 로딩바
        console.log("file_add");
        ev.preventDefault();

        const user_id = document.getElementById("user_id").value;
        const room_idx = document.getElementById("room_idx").value;
        const user_name = document.getElementById("user_name").value;
        const files = ev.target.files || ev.dataTransfer.files;
        const fileReader = new FileReader();
        var fileName = files[0].name;
        var fileSize = files[0].size;
        fileReader.readAsDataURL(files[0]);

        // 파일사이즈 10MB 넘으면 알림창
        if(fileSize > 10485760) {
            // 상단에 채팅이 왔는지 여부를 표시하기 위함
            fileSizeCheck();
            // hideLoadingBar(); // 로딩바 삭제
            return false;
        }

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

            // console.log('image', files[0]);
            // console.log('user_id', user_id);
            // console.log('room_idx', room_idx);
            // console.log('user_name', user_name);

            try {
                const result = axios.post(url + "/upload", formData);
                document.getElementById("image").value = '';
            } catch (err) {
                console.log("에러발생");
                console.error(err);
            }
        }
        setTimeout("viewScrollTop()", 500);
        $("#chataddModal").modal("hide");
        // console.log(fileReader);
    });

    document.getElementById("btn-camera").addEventListener("click", function () {
        try {
            dreamforone.setUpLoadType("camera");
            document.getElementById("camera").click();
        } catch (e) {
            document.getElementById("camera").click();
        }

    });

    document.getElementById("camera").addEventListener("change", function (ev) {
        // showLoadingBar(); // 파일 첨부 시 로딩바
        console.log("file_add");
        ev.preventDefault();

        const user_id = document.getElementById("user_id").value;
        const room_idx = document.getElementById("room_idx").value;
        const user_name = document.getElementById("user_name").value;
        const files = ev.target.files || ev.dataTransfer.files;
        const fileReader = new FileReader();
        var fileName = files[0].name;
        var fileSize = files[0].size;
        fileReader.readAsDataURL(files[0]);

        // 파일사이즈 10MB 넘으면 알림창
        if(fileSize > 10485760) {
            // 상단에 채팅이 왔는지 여부를 표시하기 위함
            fileSizeCheck();
            // hideLoadingBar(); // 로딩바 삭제
            return false;
        }

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

            // console.log('image', files[0]);
            // console.log('user_id', user_id);
            // console.log('room_idx', room_idx);
            // console.log('user_name', user_name);

            try {
                const result = axios.post(url + "/upload", formData);
                document.getElementById("image").value = '';
            } catch (err) {
                console.log("에러발생");
                console.error(err);
            }
        }
        setTimeout("viewScrollTop()", 500);
        $("#chataddModal").modal("hide");
        // console.log(fileReader);
    });

    document.getElementById("btn-file").addEventListener("click", function () {
        try {
            dreamforone.setUpLoadType("file");
            document.getElementById("file").click();
        } catch (e) {
            document.getElementById("file").click();
        }

    });
    document.getElementById("file").addEventListener("change", function (ev) {
        // showLoadingBar(); // 파일 첨부 시 로딩바
        console.log("file_add");
        ev.preventDefault();

        const user_id = document.getElementById("user_id").value;
        const room_idx = document.getElementById("room_idx").value;
        const user_name = document.getElementById("user_name").value;
        const files = ev.target.files || ev.dataTransfer.files;
        const fileReader = new FileReader();
        var fileName = files[0].name;
        var fileSize = files[0].size;
        fileReader.readAsDataURL(files[0]);

        // 파일사이즈 10MB 넘으면 알림창
        if(fileSize > 10485760) {
            // 상단에 채팅이 왔는지 여부를 표시하기 위함
            fileSizeCheck();
            // hideLoadingBar(); // 로딩바 삭제
            return false;
        }

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

            // console.log('image', files[0]);
            // console.log('user_id', user_id);
            // console.log('room_idx', room_idx);
            // console.log('user_name', user_name);

            try {
                const result = axios.post(url + "/upload", formData);
                document.getElementById("image").value = '';
            } catch (err) {
                console.log("에러발생");
                console.error(err);
            }
        }
        setTimeout("viewScrollTop()", 500);
        $("#chataddModal").modal("hide");
        // console.log(fileReader);
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

// 채팅데이터
function getChatData(data, func) {
    console.log(data);
    var chat_html = "";
    var user_id = data.user_id;
    for (var i = 0; i < data.chats.length; i++) {
        var msg = nl2br(data.chats[i].msg); // 메세지
        var user_img = ""; // 프로필이미지

        var msgdate_format = moment(data.chats[i].msgdate).format("LLLL").split(' ').splice(0,4).join(' '); // 보낸날짜 포맷 (0000년 00월 00일 0요일)
        if(func == "get_message") {
            /*// 채팅방나가기 후 다시 들어오면 이전 데이터는 보이지 않음 -- 스크롤때문에 쿼리에서부터 제외하고 가져오는게 맞는 것 같음
            if(data.chats[i].user_out) {
                var out_arr = data.chats[i].user_out.split(',');
                if(jQuery.inArray(socket_mb_id, out_arr) != -1) {
                    continue;
                }
            }*/
            user_img = data.user_img;
            if (i == 0) {
                chat_html += `<input type='hidden' name='msg_idx_first' value='${data.chats[i].id}'>`;
                if(data.chats[i].msg_count < 20) { // 21.05.20 21번째 메세지(scrollTopView data) 날짜와 다를 경우 날짜 표시
                    chat_html += `<div class="data today get_message">${msgdate_format}</div>`;
                }
            }
            else { // 21.05.20 이전메세지와 다음메세지의 날짜가 다를 경우 날짜 표시
                if(data.chats[i].msgdate.substring(0,10) != data.chats[i-1].msgdate.substring(0,10)) {
                    chat_html += `<div class="data today">${msgdate_format}</div>`;
                }
            }
        }
        else if(func == "scrollTopView") {
            user_img = data.chats[i].user_img;
            if (i == 0) {
                chat_html += `<input type='hidden' name='msg_idx_first' value='${data.chats[i].id}'>`;
                if(data.chats[i].msg_count <= 20) { // 21.05.20 총 메세지 개수가 20개 or 20개 보다 작으면 제일 상단에 날짜 표시
                    chat_html += `<div class="data today">${msgdate_format}</div>`;
                }
            }
            else { // 21.05.20 이전메세지와 다음메세지의 날짜가 다를 경우 날짜 표시
                if(data.chats[i].msgdate.substring(0,10) != data.chats[i-1].msgdate.substring(0,10)) {
                    chat_html += `<div class="data today">${msgdate_format}</div>`;
                }
            }
        }

        // 클래스 적용
        var img_class = ""; // 파일첨부 클래스
        var file_size = ""; // 파일 사이즈
        if(data.chats[i].server_file_name) { // 파일업로드여부
            file_size = formatBytes(data.chats[i].file_size);
            var reg = /(.*?)\.(jpg|JPG|jpeg|png|PNG|gif|bmp)$/;
            if(data.chats[i].server_file_name.match(reg)) { // 이미지 확장자이면
                img_class = 'img';
            } else {
                img_class = 'file';
            }
        }

        // 상대방 메세지
        if (data.user_id != data.chats[i].user_id) {
            chat_html += `<div class="receive">`;
            chat_html += `<div class="area_img">${user_img}</div>`;
            chat_html += `<div class="area_msg">`;
            chat_html += `<div class="name">${document.getElementById('room_name').value}</div>`; // 일반은 닉네임 or 아이디 / 기업은 회사명
            chat_html += `<div class="cont_box msg `+img_class+`">`;
            if(img_class == 'file') { // 파일
                chat_html += `<a class="file_box" href="https://itforone.com/~broadcast/bbs/file_download.php?mode=chat&temp=${data.chats[i].server_file_name}&real=${data.chats[i].file_name}" width="100%">
                                    <div class="icon"><img src="https://itforone.com/~broadcast/img/icon_chat_file.svg"></div>
                                    <div class="file_info">
                                        <div class="subject">${data.chats[i].file_name}</div>
                                        <div class="size">용량 ${file_size}</div>
                                    </div>
                               </a>`;
            } else if(img_class == 'img') {
                chat_html += `<a href="https://itforone.com/~broadcast/bbs/file_download.php?mode=chat&temp=${data.chats[i].server_file_name}&real=${data.chats[i].file_name}">`
                chat_html += `${msg}`;
                chat_html += `</a>`;
            } else { // 그 외
                chat_html += `${msg}`;
            }
            chat_html += `</div>`; // ==.cont_box 닫음
            chat_html += `<div class="time date">${convert12H(data.chats[i].msgdate.substring(11, 16))}</div>`; // 21.05.14 채팅방 재입장 시 시간 표시 문제로 수정 (수정 전 코드 : data.chats[i].msgdate)
            chat_html += `</div>`; // ==.area_msg 닫음
            chat_html += `</div>`; // ==.receive 닫음
        }
        // 내 메세지
        else {
            chat_html += `<div class="send">`;
            chat_html += `<div class="area_msg">`;
            chat_html += `<div class="cont_wrap `+img_class+`">`;
            chat_html += `<div class="cont_box msg `+img_class+`">`;
            if(img_class == 'file') { // 파일
                //<a class="file_box" href="https://itforone.com/~broadcast/node/uploads/${data.chats[i].server_file_name}" download="${data.chats[i].file_name}" width="100%">
                //<a class="file_box" href="https://itforone.com/~broadcast/bbs/file_download.php?mode=chat&temp=${data.chats[i].server_file_name}&real=${data.chats[i].file_name}" width="100%">
                chat_html += `<a class="file_box" href="https://itforone.com/~broadcast/bbs/file_download.php?mode=chat&temp=${data.chats[i].server_file_name}&real=${data.chats[i].file_name}" width="100%">
                                    <div class="icon"><img src="https://itforone.com/~broadcast/img/icon_chat_file.svg"></div>
                                    <div class="file_info">
                                        <div class="subject">${data.chats[i].file_name}</div>
                                        <div class="size">용량 ${file_size}</div>
                                    </div>
                               </a>`;
            } else if(img_class == 'img') {
                chat_html += `<a href="https://itforone.com/~broadcast/bbs/file_download.php?mode=chat&temp=${data.chats[i].server_file_name}&real=${data.chats[i].file_name}">`
                chat_html += `${msg}`;
                chat_html += `</a>`;
            } else { // 그 외
                chat_html += `${msg}`;
            }
            chat_html += `</div>`; // ==.cont_box 닫음
            if (data.chats[i].read_count != 0) { // 읽음 표시
                //chat_html += `<i class="read read-status" id="read-status${data.chats[i].id}">${data.chats[i].read_count}</i>`;
                chat_html += `<i class="read read-status" id="read-status${data.chats[i].id}">1</i>`;
            }
            chat_html += `</div>`; // ==.cont_wrap 닫음
            chat_html += `<div class="time date">${convert12H(data.chats[i].msgdate.substring(11, 16))}</div>`; // 21.05.14 채팅방 재입장 시 시간 표시 문제로 수정 (수정 전 코드 : data.chats[i].msgdate)
            chat_html += `</div>`; // ==.area_msg 닫음
            chat_html += `</div>`; // ==.send 닫음
        }
    }

    return chat_html;
}

// 바이트를 다른 단위로 변환
function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

function mobileCheck() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}