<?php
include_once('./_common.php');

//$sql = " select * from new_talent where ta_idx = {$idx} ";
//$ta = sql_fetch($sql);

// 검색
$sql_search = '';
if(!empty($sel) && !empty($stx)) {
    $sql_search .= " and {$sel} like '%{$stx}%' ";
}

/*// 전문인일때
if($member['mb_division'] == 2) {
    $sql_left = " cr.master_id "; // 전문인으로 입장하면 구매자 닉네임 필요
}
else {
    $sql_left = " cr.sub_id "; // 일반인으로 입장하면 판매자 닉네임 필요
}*/
$sql_search .= " and (cr.sub_id = '{$member['mb_id']}' or cr.master_id = '{$member['mb_id']}') ";

// 채팅 리스트
/*$sql = " select cr.*, ta.ta_title from chat_room as cr
         left join g5_member as mb on mb.mb_id = {$sql_left}
         left join new_talent as ta on ta.ta_idx = cr.ta_idx
         where 1=1 {$sql_search} order by id ";*/
$sql = " select cr.*, ta.ta_title from chat_room as cr 
         left join new_talent as ta on ta.ta_idx = cr.ta_idx
         where 1=1 {$sql_search} order by id ";
$result = sql_query($sql);

// 전체 읽지 않은 메세지 수
$no_read_badge = sql_fetch("select count(*) as cnt from chat_message_log where user_id='{$member['mb_id']}' and read_status='0'")['cnt']; // 메세지 로그
?>
<ul>
    <?php
    for($i=0; $row=sql_fetch_array($result); $i++) {
        //$sql = "select * from chat_message where room_idx='{$row['id']}' order by id desc"; // 메세지
        //$row2 = sql_fetch($sql);
        // 채팅방에 메세지 있는지 확인 -- 없으면 리스트에서 보여주지 않음
        $message_count = sql_fetch(" select count(*) as count from chat_message where room_idx = '{$row['id']}'; ")['count'];
        if($message_count > 0)
        {
            /*$sql = "select * from chat_room_user where user_id != '{$member['mb_id']}' and room_idx='{$row['id']}' "; // 채팅방 회원
            $result3 = sql_query($sql);

            $chatName = "";
            while ($row3 = sql_fetch_array($result3)) {
                $sql = "select * from g5_member where mb_id = '{$row3['user_id']}'";
                $row4 = sql_fetch($sql);
                $chatName .= $row4['mb_name'] . ",";
            }
            $chatName = substr($chatName, 0, strlen($chatName) - 1);*/

            $sql = "select count(*) as cnt from chat_message_log where room_idx='{$row['id']}' and user_id='{$member['mb_id']}' and read_status='0'"; // 메세지 로그
            $row5 = sql_fetch($sql);

            $file = sql_fetch(" select img_file from chat_img where room_idx = {$row['id']}; ")['img_file']; // 채팅방 이미지
            if(!empty($file)) {
                $img_url = G5_DATA_URL.'/file/chatting/'.$file;
            }

            $msg = sql_fetch(" select * from chat_message where room_idx = {$row['id']} order by id desc limit 1; "); // 메세지 정보
            if(!empty($msg['file_name'])) {
                $msg['msg'] = $msg['file_name'];
            }

            // 채팅방 정보
            $sql = " select * from chat_room where id = '{$row['id']}' ";
            $chat = sql_fetch($sql);

            // 채팅방 프로필 이미지
            $dest_path = G5_DATA_PATH . '/member/' . $mb_dir . '/' . $chat['sub_id'] . '.jpg';

            // 마지막 메세지
            $msg = sql_fetch(" select * from chat_message where room_idx = {$row['id']} order by id desc limit 1; "); // 메세지 정보
            if(!empty($msg['file_name'])) {
                $msg['msg'] = $msg['file_name'];
            }

            // 재능 정보
            $sql = " select * from new_talent where ta_idx = {$row['ta_idx']} ";
            $ta = sql_fetch($sql);

            $class_on = 0 < $row5['cnt'] ? "on" : ""; // 읽음/안읽음 표시

            $add_style = '';
            if($sel_room_id == $row['id']) { $add_style = "background: #efeeff;"; } // 현재 채팅방 색상 표시

            // 채팅방 회원 정보 (상대방)
            $you_nickname = sql_fetch(" select mb.mb_nick from chat_room_user as cru left join g5_member as mb on mb.mb_id = cru.user_id where room_idx = '{$row['id']}' and mb_nick != '{$member['mb_nick']}' ; ")['mb_nick'];
        ?>
        <div class="inbox" onclick="chatting('<?=$row['id']?>', '<?=$row['ta_idx']?>', '<?=$row['room_name']?>', '<?=$row['sub_id']?>', '<?=$row['master_id']?>');" style="cursor: pointer;<?=$add_style?>">
            <?php if($class_on == 'on') { ?>
            <span class="onnum"><?=$row5['cnt']?></span><!-- 안읽은 채팅 추가 -->
            <?php } ?>
            <p class="img">
                <?php
                if(file_exists($dest_path)) { echo '<img class="p_img" src="'.$dest_url.'">'; }
                else { echo '<img class="p_img" src="'.G5_THEME_IMG_URL.'/sub/default.png">'; }
                ?>
                <!--<img class="p_img" src="http://jobgo.ac/theme/basic/img/sub/default.png" title="">-->
            </p>
            <p class="txt">
                <span class="ment"><b><?=$ta['ta_title']?></b><b style="width: 50px !important;"><?php if(!empty($msg['msg'])) { echo str_replace('-','.',substr($msg['msgdate'],2,8)); } ?></b></span> <!-- 마지막 채팅 시간 -->
                <span class="name"><?=$you_nickname?></span> <!-- 전문인으로 입장하면 구매자 닉네임 필요/일반인으로 입장하면 판매자 닉네임 필요 -->
                <span class="cont"><?=$msg['msg']?></span>
            </p>
        </div>
    <?php
        }
    }
    if($i==0) {
    ?>
    <div style="text-align: center;">문의내역이 없습니다.</div>
    <?php
    }
    ?>
</ul>

<!--채팅-->
<form name="fchatting" id="fchatting" method="post">
    <input type="hidden" name="room_id" id="room_id" value=""> <!-- chat_room id -->
    <input type="hidden" name="ta_idx" id="ta_idx" value="">
    <input type="hidden" name="room_name" id="room_name" value="">
    <input type="hidden" name="sub_id" id="sub_id" value="">
    <input type="hidden" name="master_id" id="master_id" value="">
</form>

<script>
    $(function() {
        $('.no_read_badge').text(<?=$no_read_badge?>);
    });

    // 채팅방 입장
    function chatting(id, ta_idx, room_name, sub_id, master_id) {
        $('#room_id').val(id);
        $('#ta_idx').val(ta_idx);
        $('#room_name').val(room_name);
        $('#sub_id').val(sub_id);
        $('#master_id').val(master_id);

        if('<?=$mobile?>') { // 모바일 웹 또는 안드로이드 접속 시
            $('#fchatting').attr('action', '<?=G5_BBS_URL?>/chat_room.php');
        } else {
            $('#fchatting').attr('action', '<?=G5_BBS_URL?>/message.php');
        }

        $('#fchatting').submit();
    }
</script>