<?php
include_once('./_common.php');

/** 채팅리스트 (ajax) **/

// 검색
$sql_search = " and (room_user1 = '{$member['mb_id']}' or room_user2 = '{$member['mb_id']}') ";
if(!empty($_POST['stx'])) { // 회사명 또는 회원아이디로 검색 + 내용 검색 추가
    $sql_search .= " and (mb_company_name like '%{$_POST['stx']}%' or mb_id like '%{$_POST['stx']}' or cm.msg like '%{$_POST['stx']}%' ) ";
}

//-- 채팅방 나가기 한 리스트는 보이지 않음, 다만 채팅방을 나갔으나 상대방이 다시 대화를 걸 경우 채팅 리스트에 다시 출력
$sql_search .= " and (!find_in_set(cr.user_out, '{$member['mb_id']}') or cr.user_out is null) ";

// 채팅방 정보 (리스트에는 내정보가 아닌 채팅 상대방의 정보가 보여야 함)
$sql = " select cr.*, mb.mb_name, mb.mb_category, mb.mb_company_name, cm.msg from chat_room as cr 
         left join chat_room_user as cru on cru.room_idx = cr.id and cru.user_id != '{$member['mb_id']}'
         left join g5_member as mb on mb.mb_id = cru.user_id
         left join chat_message as cm on cm.room_idx = cr.id
         where 1=1 {$sql_search} group by cr.id order by cru.msgdate desc ";
//echo $sql;
$result = sql_query($sql);
$chat_cnt = sql_num_rows($result); // 채팅방 개수

// 내가 포함된 채팅의 메세지 개수 (채팅방은 만들어졌으나 대화가 없을 경우 리스트에 표시하지 않기 위하여)
$msg_cnt = sql_fetch(" select count(*) as cnt from chat_message_log where user_id = '{$member['mb_id']}' and (!find_in_set(user_out, '{$member['mb_id']}') or user_out is null) ")['cnt'];
if(!empty($msg_cnt) && !empty($chat_cnt)) {
    for($i=0; $row=sql_fetch_array($result); $i++) {
        $sql = "select count(*) as cnt from chat_message_log where room_idx='{$row['id']}' and user_id = '{$member['mb_id']}' and read_status = '0'"; // 메세지 로그 (안읽은 메세지 수 표시 위함)
        $log = sql_fetch($sql);

        // 채팅 상대방 정보 (chat_room_user 테이블에서 나를 제외한 데이터가 상대방 정보)
        $you = sql_fetch(" select cru.*, mb.mb_id, mb.mb_nick, mb.mb_company_name, mb.mb_category from chat_room_user as cru left join g5_member as mb on mb.mb_id = cru.user_id where room_idx = '{$row['id']}' and user_id != '{$member['mb_id']}' ");
        // 방이름
        if($you['mb_category'] == '기업') {
            //$room_name = $you['user_id'].' ('.$you['mb_company_name'].')';
            $room_name =  $you['mb_company_name']; // 회사명
        }
        else { // 일반
            $room_name = getNickOrId($you['mb_id']); // 닉네임
        }

        // 메세지 정보
        $msg = sql_fetch(" select * from chat_message where room_idx = {$row['id']} order by id desc limit 1; ");
        if(!empty($msg['file_name'])) {
            $msg['msg'] = $msg['file_name']; // 이미지 첨부 시 파일명을 표시
        }
        if(!empty($msg['id'])) { // 메세지가 있을 때만 표시
        ?>
        <li>
            <a href="javascript:chatting('<?=$you['user_id']?>', '<?=$row['inquiry_idx']?>');">
                <div class="area_img"><?php echo getProfileImg($you['user_id'], $you['mb_category'], '');?></div>
                <div class="chat_txt">
                    <!-- 방이름(상대방 회사명 표시, 없으면 아이디 표시) / 채팅일자 -->
                    <div class="info"><em class="name"><?=$room_name?></em><span claas="data"><?php if(!empty($msg['msg'])) { echo str_replace('-','.',substr($msg['msgdate'],0,10)); } ?></span></div>
                    <!-- 채팅내용 -->
                    <div class="cont"><?=$msg['msg']?></div>
                </div>
                <?php if(!empty($log['cnt'])) { ?>
                <div class="badge" id="chat-badge<?=$row['id']?>"><?=$log['cnt']?></div>
                <?php } ?>
            </a>
        </li>
    <?php
        }
    }
}
else {
?>
<li class="nodata">
    <p>There is no chat history.</p>
</li>
<?php
}
?>