<?php
include_once('./_common.php');

/**
 * 문의-채팅
 * ta_idx : 재능 idx / master_id : 구매자아이디 / room_name : 판매자닉네임 / sub_id : 판매자아이디 / room_id : 채팅방 id (chat_room - id)
 * ta_idx 정보가 있다면 해당 재능에 대한 채팅목록 및 채팅내용을 보여즘
 * ta_idx 정보가 없다면 전체 채팅 목록을 보여줌
 **/

if (empty($member['mb_id'])) {
    alert("로그인 후 이용해주세요.", G5_BBS_URL . "/login.php");
}

if(empty($room_id)) {
    alert('올바른 경로가 아닙니다.');
}

$sql = "select count(*) as cnt from chat_message where room_idx = '{$room_id}' ";
$row = sql_fetch($sql);
$first = 20 < $row['cnt'] - 20 ? $row['cnt'] - 20 : 0;

// 채팅방 정보
$sql = " select * from chat_room where id = '{$room_id}' ";
$chat = sql_fetch($sql);

// 채팅방 회원 정보 (상대방)
$you_nickname = sql_fetch(" select mb.mb_nick from chat_room_user as cru left join g5_member as mb on mb.mb_id = cru.user_id where room_idx = '{$room_id}' and mb_nick != '{$member['mb_nick']}' ; ")['mb_nick'];
$my_nickname = $member['mb_nick'];

// 전문인 아이디
$pro_id = sql_fetch(" select mb_id from new_talent where ta_idx = {$ta_idx}; ")['mb_id'];

$g5['title'] = $you_nickname;

include_once(G5_PATH . '/head.php');
?>

<!--<style>
    #mem_info li {
        float: left;
        margin-right: 10px;
    }
    /* 채팅방 날짜 표시 */
    .today {
        display: block;
        width: 100%;
        text-align: center;
        float: left;
        padding: 5px 0;
    }
</style>-->

<style>
    /*로딩바*/
    #mask { position:absolute; z-index:9000; background-color:#000000; display:none; left:0; top:0;}
    #loadingImg { position:absolute; left:50%; top:50%; display:none; z-index:10000; transform: translate(-50%, -50%);}
    #loadingImg img {
        width: 80px;
        height: 80px;
    }
</style>

<div id="MessageBoxWrap" class="appVer">
    <div class="msgCont">
        <div class="msgConts">
            <!-- 메세지내용  -->
            <div class="msgBox" style="overflow: unset !important;">

                <!--채팅시작-->

                <div class="chat-msg" id="chat-msg" style="overflow-y: auto;">
                    <p class="warning">
                        잡고를 통하지 않고 전문가에게 직접 결제하는 경우<br/>서비스 불이행 / 환불 거부 / 연락두절 등의 문제가 발생할 수 있습니다.
                    </p>
                    <div id="chat-view">
                        <div class="today" style="display: none;">2021년 6월 23일 수요일</div>
                        <div class="you-msg" style="display: none;">
                            <div class="msg">안녕하세요</div>
                            <div class="date">오후 12:16</div>
                        </div>
                        <div class="my-msg" style="display: none">
                            <div class="date">오후 12:14</div>
                            <div class="msg">안녕하세요</div>
                        </div>
                    </div>
                </div>
                <!--채팅끝-->

                <!--채팅폼시작-->
                <div class="msg-forms" id="msg-forms">
                    <form name='form' id='form1' method='post' enctype='multipart/form-data'>
                        <!-- msg에서 폼 입력을 할 때 mb_id를 들고가서 상대방에게 입력중이라는 것을 표시해줘야 함 -->
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $member['mb_id'] ?>">
                        <input type="hidden" name="room_idx" id="room_idx" value="<?php echo $room_id ?>">
                        <input type="hidden" name="user_name" id="user_name" value="<?php echo $member['mb_name'] ?>">
                        <input type="hidden" name="you_nickname" id="you_nickname" value="<?php echo $you_nickname ?>">
                        <input type="hidden" name="my_nickname" id="my_nickname" value="<?php echo $my_nickname ?>">
                        <!--<input type="hidden" name="room_id" value="<?php /*echo $chat['room_id'] */?>">-->
                        <input type="file" name="image" accept="image/*" id="image" style="display:none">
                    </form>
                </div>
                <!--채팅폼끝-->
                <div class="user-input" id="user-input">
                    <!--입력중...-->
                </div>
            </div>
        </div>

        <div class="msgTxt">
            <div class="textareaBox">
                <label for="" class="sound_only">메시지 입력창</label>
                <textarea name="msg" id="msg" class="msg_form" cols="30" rows="1" placeholder="메시지를 입력하세요." style="resize: unset;"></textarea>
            </div>
            <div class="btnBox">
                <button class="btn" id="btn-file" type="button">파일첨부</button>
                <span class="txtSend">
					<button class="btn btn-send" id="chat-send" type="button">전송</button>
				</span>
            </div>
        </div>
    </div>
    <!-- /msgCont -->
</div>

<form id="fpostdata" name="fpostdata" method="post" action="<?=G5_BBS_URL?>/chat_room_detail.php">
    <input type="hidden" id="pro_id" name="pro_id" value="<?=$pro_id?>">
</form>

<script src="<?= G5_JS_URL ?>/socket.io.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="<?= G5_JS_URL ?>/chat.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> <!-- 날짜 포맷 관련 라이브러리 -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ko.js"></script> <!-- 날짜 포맷 관련 라이브러리 -->

<script type="text/javascript">
    chatLogin('<?=$member['mb_id']?>');
    room_in('<?=$member['mb_id']?>', '<?=$member['mb_name']?>', '<?=$room_id?>');
    window.onload = function () {
        const chat_msg = document.getElementById("chat-msg");
        const scrolltop = chat_msg.scrollHeight - chat_msg.offsetHeight;
        chat_msg.scrollTop = scrolltop;
    }

    $(document).ready(function () {
        $("text").on("keyup", "textarea", function (e) {
            $(this).css("height", "auto");
            $(this).height(this.scrollHeight);
        });
        $("text").find("textarea").keyup();
    })

    function chatRoomDetail() {
        $('#fpostdata').submit();
    }

    // 로딩바 표시
    function showLoadingBar() {
        var maskHeight = $(document).height();
        var maskWidth = window.document.body.clientWidth;
        var mask = "<div id='mask'></div>";
        var loadingImg = '';
        loadingImg += "<div id='loadingImg'>";
        loadingImg += "<img src='<?=G5_IMG_URL?>/loading.gif'/>";
        loadingImg += "</div>";
        $('body').append(mask).append(loadingImg);
        $('#mask').css({'width': maskWidth, 'height': maskHeight, 'opacity': '0.3'})
        $('#mask').show();
        $('#loadingImg').show();
    }

    // 로딩바 숨김
    function hideLoadingBar() {
        $('#mask, #loadingImg').hide();
        $('#mask, #loadingImg').remove();
    }
</script>

<?php
include_once(G5_PATH . '/tail.sub.php');
?>