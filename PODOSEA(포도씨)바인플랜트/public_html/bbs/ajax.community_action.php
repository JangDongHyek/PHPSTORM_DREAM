<?php
include_once('./_common.php');

/**
 **  질문 ==> 조회(view) / 좋아요(good) / 싫어요(hate) / 삭제(delete) 동작
 **  답변 ==> 좋아요(answer_good) / 싫어요(answer_hate) / 삭제(answer_delete) / 채택(select) 동작
 **  넘어오는 idx => 질문 : g5_community idx / 답변 : g5_community_answer idx
 **  helpme와 구조는 같으나 컨펌된 화면이 아니라 별도의 파일로 사용
 **/

if(!$is_member) {
    exit;
}

// 댓글 삭제
if($mode == 'answer_delete')
{
    // 커뮤니티 댓글 정보 DELETE
    $result = sql_query(" update g5_community_answer set del_yn = 'Y' where idx = {$community_an_idx}; ");

    die($result);
}
// 게시글 삭제
else if($mode == 'delete')
{
    // 커뮤니티 게시글 정보 UPDATE (삭제하지않고 상태변경)
    $result = sql_query(" update g5_community set del_yn = 'Y' where idx = {$community_idx}; ");
    $result = sql_query(" update g5_community_answer set del_yn = 'Y' where community_idx = {$community_idx}; ");

    // 글 삭제 시 포인트 차감
    gradePointInsert($member['mb_id'], '차감','게시글', '5', '커뮤니티 글 삭제', '', 'g5_community', $community_idx);

    die($result);
}
// 그 외
else // $mode : view, good, hate, answer_good, answer_hate
{
    if(strpos($mode, 'answer') !== false) { // 답변 관련 액션
        $search_add = " and community_an_idx = {$community_an_idx} ";
        $insert_add = " , community_an_idx = {$community_an_idx} ";
    }
    $acc_count = sql_fetch(" select count(*) as count from g5_community_action where community_idx = {$community_idx} {$search_add} and mode = '{$mode}' order by idx ")['count']; // 누적카운트
    if(empty($acc_count)) { $acc_count = 0; }

    $count = sql_fetch(" select count(*) as count from g5_community_action where community_idx = {$community_idx} {$search_add} and mb_id = '{$member['mb_id']}' and mode = '{$mode}' and date_format(wr_datetime,'%Y-%m-%d') = date_format(now(), '%Y-%m-%d'); ")['count']; // 금일 해당 동작을 했는지 확인
    if($count == 0) {
        $acc_count = $acc_count + 1; // 누적카운트 + 1
        sql_query(" insert into g5_community_action set mode = '{$mode}', community_idx = {$community_idx} {$insert_add}, mb_id = '{$member['mb_id']}', acc_count = {$acc_count}, wr_datetime = '".G5_TIME_YMDHIS."'; ");

        // 인기순 표시하기 위하여 g5_community에 별도로 co_good 컬럼 추가하여 표시
        if($mode == 'good') {
            sql_query(" update g5_community set co_good = {$acc_count} where idx = {$community_idx}; ");
        }
    } else { // 다시 누르면 취소 (삭제함)
        if($mode != 'view') { // 좋아요/싫어요 액션일 때
            if($acc_count > 0) {
                $acc_count = $acc_count - 1; // 누적카운트 - 1
            }
            sql_query("delete from g5_community_action where community_idx = {$community_idx} {$search_add} and mb_id = '{$member['mb_id']}' and mode = '{$mode}' and date_format(wr_datetime,'%Y-%m-%d') = date_format(now(), '%Y-%m-%d'); ");
        }
    }

    echo $acc_count;
}
?>