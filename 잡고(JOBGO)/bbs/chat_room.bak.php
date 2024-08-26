<?php
include_once('./_common.php');
include_once(G5_PATH . '/head.sub.php');

$idx = $_GET['idx'];
$room_idx = $_GET['room_idx'];

if (empty($member['mb_id'])) {
    alert("로그인 후 이용해주세요.", G5_BBS_URL . "/login.php");
}

// 채팅방에 초대 받지 않은 사람이 있을 경우
$sql = "select count(*) as cnt from chat_room_user as cru left join chat_room as cr on cr.id = cru.room_idx 
        where cru.room_idx='$room_idx' and (cru.user_id = '{$member['mb_id']}' || cr.master_id = '{$member['mb_id']}') ";
$cnt = sql_fetch($sql)['cnt'];
//$result2 = sql_fetch($sql);
//$cnt = sql_num_rows($result2);
if ($cnt == 0) {
    alert("이 채팅방에 들어올 수 없습니다.");
    exit;
}

$sql = "select count(*) as cnt from chat_message where room_idx = '{$room_idx}' ";
$row = sql_fetch($sql);
$first = 20 < $row['cnt'] - 20 ? $row['cnt'] - 20 : 0;

// 메세지
//$sql = "select * from chat_message where room_idx = '{$room_idx}' order by id asc limit {$first}, 20";
//$result = sql_query($sql);

// 채팅방 정보
$sql = " select * from chat_room where id = '{$room_idx}' ";
$chat = sql_fetch($sql);

// 채팅방 회원 정보
$sql = " select cru.*, mb.mb_id2 from chat_room_user as cru left join g5_member as mb on mb.mb_id = cru.user_id where room_idx = '{$room_idx}' ; ";
$result = sql_query($sql);
?>

<style>
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
</style>

<!-- 채팅 참여 인원 모달창 -->
<div class="modal fade" id="Chatting_Member" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">작업실 참여자</h4>
            </div>

            <div class="modal-body">
                <!--리스트-->
                <div id="mem_info">
                    <?php
                    for ($i=0; $user=sql_fetch_array($result); $i++) {
                    ?>
                    <ul>
                        <li><i class="fas fa-user-circle"></i>&nbsp;회원번호 <strong><?=$user['mb_id2']?></strong></li>
                        <li>이름 <strong><?=$user['user_name']?></strong></li>
                    </ul>
                    <br/>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="select_member()">선택</button>
            </div>
        </div><!--//modal-content-->
    </div>

</div>
<!-- // 채팅 참여 인원 모달창 -->

<link rel="stylesheet" href="<?= G5_CSS_URL ?>/chat.css"/>
<header>
    <a href="<?=G5_BBS_URL?>/office03_work.php?idx=<?=$idx?>" style="text-align:right;float:left;font-size:12px"><i class="fal fa-arrow-left fa-2x"></i></a>
    <?=$chat['room_name']?>
    <a href="<?=G5_BBS_URL?>/office03_work_write.php?idx=<?=$idx?>&room_idx=<?=$room_idx?>&w=u" style="text-align:right;float:right;font-size:12px; color:#787dd6"><i class="fas fa-comment-edit fa-2x"></i></a>
    <!--<a data-toggle="modal" href="#Chatting_Member" style="text-align:right;float:right;font-size:12px;margin-right:10px;">작업실참여자</a>-->
</header>
<!-- 채팅 대화 뷰 시작 -->
<div class="chat-msg" id="chat-msg">
    <div class="user_in" id="user_in"></div>
    <div id="chat-view">
        <?php
        /*	while($row=sql_fetch_array($result)){
                $chatClass=$row[user_id]==$member[mb_id]?"my-msg":"you-msg";//자신인지 상대방인지
                $sql="select * from chat_room_user where room_idx='$room_idx' and user_id='$row[user_id]' and user_id!='$member[mb_id]'";
                $row2=sql_fetch($sql);

                $sql="select count(*) as cnt from chat_message_log where msg_idx='$row[id]' and read_status='0'";
                $row3=sql_fetch($sql);
                $readCount=0 < $row3[cnt]?$row3[cnt]:"";

        ?>
            <div class="<?=$chatClass?>">
                <?php
                    if($row[user_id]==$member[mb_id]){?>
                <span class="read-status" id="read-status<?=$row[idx]?>"><?=$readCount?></span>
                <?php }else{?>
                <div class="name"><?=$row2[user_name]?> <span class="read-status" id="read-status<?=$row[idx]?>"><?=$readCount?></span></div>
                <?php }?>
                <div class="msg"><?=nl2br($row[msg])?></div>
                <div class="date">
                    <?
                        $ampm=date("H",strtotime($row[msgdate]))<13?"오전":"오후";
                        $time=date("H:s",strtotime($row[msgdate]));
                        $msgTime=$ampm." ".$time;
                    ?>
                    <?=$msgTime?>
                </div>
            </div>
        <?php }*/ ?>
        <div class="today" style="display: none;"></div>
        <!-- 상대방 대화 -->
        <div class="you-msg" style="display:none">
            <div class="name">상대방이름 <span class="read-status">1</span></div>
            <div class="msg">메세지</div>
            <div class="date">오후 1:00</div>
        </div>
        <!-- 내 대화 -->
        <div class="my-msg" style="display:none">
            <div>
                <span class="read-status">1</span>
                <div class="msg">메세지</div>
            </div>
            <div class="date">오후 2:00</div>
        </div>
    </div>
</div>
<!-- 채팅 대화 끝 -->
<!-- 채팅폼 시작 -->
<div class="msg-forms" id="msg-forms">
    <form name='form' id='form1' method='post' enctype='multipart/form-data'>
        <!-- msg에서 폼 입력을 할 때 mb_id를 들고가서 상대방에게 입력중이라는 것을 표시해줘야 함 -->
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $member['mb_id'] ?>">
        <input type="hidden" name="room_idx" id="room_idx" value="<?php echo $_GET['room_idx'] ?>">
        <input type="hidden" name="user_name" id="user_name" value="<?php echo $member['mb_name'] ?>">
        <input type="hidden" name="room_id" value="<?php echo $_GET['room_id'] ?>">
        <input type="file" name="image" accept="image/*" id="image" style="display:none">
        <!--<input type="file" name="image" accept="image/*" id="image" style="display:none" onchange="uploader(event)">-->
        <ul>
            <li>
                <button class="btn" id="btn-file" type="button">+</button>
            </li>
            <li class="text">
                <textarea name="msg" id="msg" class="msg-form" placeholder="메시지를 입력하세요" style="height:38px;"></textarea>
            </li>
            <li>
                <button class="btn btn-send" id="chat-send" disabled='false'><img src="<?= G5_IMG_URL ?>/icon_send.svg" width="30"></button>
            </li>
        </ul>
    </form>
</div>
<!-- 채팅폼 끝 -->
<div class="user-input" id="user-input">
    입력중...
</div>


<script src="<?= G5_JS_URL ?>/socket.io.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="<?= G5_JS_URL ?>/chat.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> <!-- 날짜 포맷 관련 라이브러리 -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ko.js"></script> <!-- 날짜 포맷 관련 라이브러리 -->

<script type="text/javascript">
    room_in('<?=$member[mb_id]?>', '<?=$member[mb_name]?>', '<?=$_GET[room_idx]?>');
    window.onload = function () {
        const chat_msg = document.getElementById("chat-msg");
        const scrolltop = chat_msg.scrollHeight - chat_msg.offsetHeight;
        chat_msg.scrollTop = scrolltop;
    }
</script>


<script>
    $(document).ready(function () {
        $("text").on("keyup", "textarea", function (e) {
            $(this).css("height", "auto");
            $(this).height(this.scrollHeight);
        });
        $("text").find("textarea").keyup();
    })

</script>

<?php
include_once(G5_PATH . '/tail.sub.php');
?>
