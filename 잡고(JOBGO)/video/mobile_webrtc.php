
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />

    <title>videoChatApp</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=5.0,user-scalable=yes,target-densitydpi=medium-dpi">

    <script src="https://kit.fontawesome.com/c939d0e917.js"></script>
    <script src="https://dreamforone.co.kr:8443/js/socket.io.js" defer></script>
    <script src="https://unpkg.com/peerjs@1.4.4/dist/peerjs.min.js"></script>
    <script src="./webcam.js" defer></script>
    <!-- 공통 css -->
    <link href="https://dreamforone.co.kr:8443/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://dreamforone.co.kr:8443/css/import.css" rel="stylesheet" type="text/css"/>
    <link href="https://dreamforone.co.kr:8443/css/common.css" rel="stylesheet" type="text/css"/>
    <link href="https://dreamforone.co.kr:8443/css/app.css" rel="stylesheet" type="text/css"/>

    <style>
        video{
            transform: rotateY(180deg);
            -webkit-transform:rotateY(180deg); /* Safari and Chrome */
            -moz-transform:rotateY(180deg); /* Firefox */
            width:100%;
        }
        #youVideo{
            position: absolute;
            left: 0;
            top: 0;
            width:100%;
        }
    </style>
    <script>
        /*<![CDATA[*/
        const ROOM_ID = '121';
        const users =  "test01";

        /*<![CDATA[*/
    </script>
</head>
<body>
<div id="video-grid"></div>
<div id="remote_treat">
    <!--상대방화면(의사)-->
    <div class="" id="youVideo"></div>
    <!--//상대방화면(의사)-->

    <!--내화면(환자)-->
    <div class="" id="draggable"></div>
    <!--//내화면(환자)-->

    <button class="change" id="btn-change" onclick="videoChange('environment')"><img src="/img/app/change.svg" alt="화면전환"></button>
    <div class="btn_set">
        <p class="time">14:00</p>
        <button class="hang_up" onclick="history.back();"><img src="/img/app/hang_up.svg" alt="통화종료"></button>
    </div>

</div>

</body>

</html>