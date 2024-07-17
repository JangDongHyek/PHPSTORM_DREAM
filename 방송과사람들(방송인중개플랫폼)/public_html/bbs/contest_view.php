<?php
$sub_id = "contest";
include_once('./_common.php');

$g5['title'] = '공모전';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    //alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php');
}
$cp_idx = $_REQUEST['idx'];

if (empty($cp_idx)){
    alert('올바른 경로로 접속해주세요.');
}

$sql = "select * from new_competition where cp_idx = {$cp_idx}";
$row = sql_fetch($sql);

if (empty($row)){
    alert('올바른 경로로 접속해주세요.');
}

//선호하는 디자인 스타일
$sql = "select * from {$g5['board_file_table']} where wr_id = '{$cp_idx}' and bo_table = 'competition' and `bf_no` != '0' ";
$sub_result =sql_query($sql);
//메인이미지
$sql = "select * from {$g5['board_file_table']} where wr_id = '{$cp_idx}' and bo_table = 'competition' ";
$main_result =sql_fetch($sql);
//좋아요
$like_sql = "select li_idx from {$g5['like_table']} where ta_idx = '{$row['cp_idx']}' and li_table = 'competition' and mb_id = '{$member['mb_id']}' ";
$like_row = sql_fetch($like_sql);

// 한번 읽은글은 브라우저를 닫기전까지는 카운트를 증가시키지 않음
$ss_name = 'ss_view_competition_'.$cp_idx;
//조회수 증가
if (!get_session($ss_name))
{

    // 자신의 글이면 통과
    if ($row['mb_id'] == $member['mb_id']) {
        ;
    }else {
        sql_query(" update new_competition set hit = hit + 1 where cp_idx = '{$cp_idx}' ");
    }
        set_session($ss_name, TRUE);

}

//문의사항
$comment_sql = "select * from new_comment where wr_cp_idx = '{$row['cp_idx']}' and wr_table = 'competition' and wr_parent = '0' order by comment_idx desc";
$comment_result = sql_query($comment_sql);

//공모전 참여
$apply_sql = "select * from new_competition_apply where ap_cp_idx = '{$row['cp_idx']}' ";
$apply_result = sql_query($apply_sql);
//공모전 참여자 본인 것만
$apply_my_sql = "select * from new_competition_apply where ap_cp_idx = '{$row['cp_idx']}' and mb_id = '{$member["mb_id"]}' ";
$apply_my_result = sql_query($apply_my_sql);


//진행상황 변경(날짜가 지낫을 경우 update)
if (G5_TIME_YMD >= date('Y-m-d', strtotime($row['cp_datetime'])) && $row['cp_progress'] < 2 ) {

    $sql = "update new_competition set cp_progress = 2, up_datetime = '" . G5_TIME_YMDHIS . "' where cp_idx = '{$row['cp_idx']}' ";
    sql_query($sql);
    $row['cp_progress'] = 2;
}

//탈퇴한 사용자 일 경우 게시물 접근 X
$mb = get_member($row['mb_id']);
if($mb['mb_8'] == 2){
    alert("탈퇴한 사용자가 올린 글이므로 해당 게시물에 접근할 수 없습니다.", G5_URL);
}

include_once($member_skin_path.'/contest_view.skin.php');

include_once('./_tail.php');
?>