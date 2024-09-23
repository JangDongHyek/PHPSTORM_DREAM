<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function sendAlimTalk() {
            var mb_name = '고명우';
            var mb_hp = '01026074128';
            var templateCode = '0';

            $.ajax({
                url: '/~naracelllar/API/send_alim_talk.php',
                type: 'POST',
                //contentType: 'application/json',
                dataType: 'json',
                data: {
                    mb_name: mb_name,
                    mb_hp: mb_hp,
                    templateCode: templateCode
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        }

        function checkAlimTalkResult() {
            var sendCode = prompt("Send Code를 입력하세요.");  // 사용자로부터 send code 값 받기

            if (sendCode) {
                $.ajax({
                    url: '/~naracelllar/API/admin.php', // `sendCode` 파라미터로 GET 요청
                    type: 'GET',
                    contentType: 'application/json',
                    dataType: 'json',
                    data: {
                        sendCode: sendCode,
                        mode : 'chkSendAlimTalk'
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.error("Error:", error);
                    }
                });
            } else {
                alert("Send Code를 입력해주세요.");
            }
        }
    </script>
</head>
<body>

<button onclick="sendAlimTalk()">알림톡 전송</button>
<button onclick="checkAlimTalkResult()">알림톡 전송결과 확인</button>

</body>
</html>
