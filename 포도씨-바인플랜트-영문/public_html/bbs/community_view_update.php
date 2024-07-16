<?php
include_once('./_common.php');

/** 커뮤니티 댓글 **/

if(empty($an_open)) { $an_open = 'open'; } // 익명 여부

if($w == "") { // 등록
    // 답변 DB INSERT
    $sql = " insert into g5_community_answer set community_idx = '{$community_idx}', mb_id = '{$member['mb_id']}', an_contents = '{$an_contents}', an_open = '{$an_open}', wr_datetime = '".G5_TIME_YMDHIS."'; ";
    sql_query($sql);
    $answer_idx = sql_insert_id();

    // 질문 DB UPDATE - 상태 변경
    sql_query(" update g5_community set he_answer_state = '답변완료' where idx ='{$community_idx}'; ");

    // 등급포인트 - 댓글 등록 시 1NM 적립 (답변 당 1개의 댓글만 인정)
    $my_answer = sql_fetch(" select count(*) as count from g5_community_answer where community_idx = '{$community_idx}' and mb_id = '{$member['mb_id']}' ")['count']; // 내가 쓴 댓글 개수
    if($my_answer <= 1) { // 위에서 댓글 INSERT 진행으로 처음 등록 == 1개로 처리
        gradePointInsert($member['mb_id'], '적립','댓글', '1', '커뮤니티 댓글 등록', '', 'g5_community_answer', $answer_idx);
    }

    alert('comment has been registered', G5_BBS_URL.'/community_view.php?idx='.$community_idx, false);
}
else { // 수정
    // 답변 DB UPDATE
    $sql = " update g5_community_answer set an_contents = '{$an_contents}', an_open = '{$an_open}', up_datetime = '".G5_TIME_YMDHIS."' where idx = '{$community_an_idx}'; ";
    sql_query($sql);

    alert('comment has been edited.', G5_BBS_URL.'/community_view.php?idx='.$community_idx, false);
}
?>