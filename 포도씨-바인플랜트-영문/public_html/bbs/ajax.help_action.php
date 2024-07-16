<?php
include_once('./_common.php');

/**
 **  질문 ==> 조회(view) / 좋아요(good) / 싫어요(hate) / 삭제(delete) 동작
 **  답변 ==> 좋아요(answer_good) / 싫어요(answer_hate) / 삭제(answer_delete) / 채택(select) 동작
 **  넘어오는 idx => 질문 : g5_helpme idx / 답변 : g5_helpme_answer idx
 **/

if(!$is_member) {
    exit;
}

// 답변 삭제
if($mode == 'answer_delete')
{
    // 헬프미 답변 정보 DELETE
    $result = sql_query(" update g5_helpme_answer set del_yn = 'Y', del_mb_id = '{$member['mb_id']}' where idx = {$helpme_an_idx}; ");

    // 답변수가 0일 경우 답변완료에서 답변대기로 상태변경
    $a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = '{$helpme_idx}' and del_yn is null; ")['count'];
    if($a_count == 0) {
        sql_fetch(" update g5_helpme set he_answer_state = '답변대기' where idx = {$helpme_idx} ");
    }

    die($result);
}
// 질문 삭제
else if($mode == 'delete')
{
    // 헬프미 정보
    $help = sql_fetch(" select * from g5_helpme where idx = '{$helpme_idx}' ");

    // 헬프미 정보 UPDATE (삭제하지않고 상태변경)
    $result = sql_query(" update g5_helpme set del_yn = 'Y', del_mb_id = '{$member['mb_id']}' where idx = {$helpme_idx}; ");
    sql_query(" update g5_helpme_answer set del_yn = 'Y', del_mb_id = '{$member['mb_id']}' where helpme_idx = {$helpme_idx}; ");

    // 글 삭제 시 포인트 차감
    gradePointInsert($member['mb_id'], '차감','게시글', '5', 'Delete help me question', '', 'g5_helpme', $helpme_idx);

    if(!empty($help['he_bunker'])) {
        // 글 삭제 시 벙커 설정하였으면 회수
        bunkerHistory($member['mb_id'], '적립', $help['he_bunker'], 'Delete help me question, BUNKER Deduction', '', 'g5_helpme', $helpme_idx, 'correct');
    }

    die($result);
}
// 답변 채택
else if($mode == 'select') {
    // 질문에 걸린 BUNKER 조회 - 채택 답변자에게 질문에 대한 BUNKER 적립
    $help = sql_fetch(" select he.*, an.mb_id as answer_mb_id from g5_helpme as he left join g5_helpme_answer as an on an.helpme_idx = he.idx where an.idx = {$helpme_an_idx} ");

    if($gubun == 'best') { // 베스트 답변 채택
        $update_sql = ", an_best = 'Y' ";
        $txt = '베스트 답변';
        if($fin == 'fin') { // 마감하기 선택
            $bunker = $help['he_bunker']; // 질문에 걸린 벙커의 100%
        }
        else if($fin == 'no_fin') { // 우수답변채택하기 선택
            $bunker = $help['he_bunker'] * 70 / 100; // 질문에 걸린 벙커의 70%
        }
        sql_query(" update g5_helpme set he_best = 'Y' where idx ='{$helpme_idx}'; ");
    }
    else if($gubun == 'great') { // 우수 답변 선택
        $update_sql = ", an_great = 'Y' ";
        $bunker = $help['he_bunker'] * 30 / 100; // 질문에 걸린 벙커의 30%
        $txt = '우수 답변';
        sql_query(" update g5_helpme set he_great = 'Y' where idx ='{$helpme_idx}'; ");
    }

    // 답변 정보 UPDATE
    $result = sql_query(" update g5_helpme_answer set an_selection = 'Y' {$update_sql} where idx = {$helpme_an_idx} ");

    if(!empty($help['he_bunker'])) { // 질문에 BUNKER를 입력했을 때
        // BUNKER HISTORY INSERT
        $etc2 = ''; // 관리자가 채택 시
        if($member['mb_id'] == 'admin') { $etc2 = 'admin'; }
        $result = bunkerHistory($help['answer_mb_id'], '적립', $bunker, 'Help me choose answer ('.$txt.')', '', 'g5_helpme_answer', $helpme_an_idx, $gubun, $etc2);
    }

    // 등급포인트 - 답변 채택 시 20NM 적립
    gradePointInsert($help['answer_mb_id'], '적립', '채택', '20', 'Help me choose answer', '', 'g5_helpme_answer', $helpme_an_idx);

    // 등급포인트 - 미채택 된 답변 5NM 적립
    // 헬프미 글에 달린 미채택 답변 조회
    if(($gubun == 'best' && $fin == 'fin') || $gubun == 'great') { // 베스트답변 채택 후 마감 시 || 우수답변 채택 시 미채택된 답변들에게 포인트 적립
        sql_query(" update g5_helpme set he_selection = 'Y' where idx = '{$helpme_idx}' "); // 해당 질문은 더이상 채택할 수 없도록 마감 처리를 하기 위한 표시
        $an_rlt = sql_query(" select * from g5_helpme_answer where helpme_idx = '{$helpme_idx}' and an_selection is null ");
        while($an = sql_fetch_array($an_rlt)) {
            gradePointInsert($an['mb_id'], '적립', '미채택', '5', 'Help me answer unselected', '', 'g5_helpme_answer', $an['idx']);
        }
    }

    if($help['he_answer_state'] == '답변대기') {
        // 질문 DB UPDATE - 상태 변경 ==> 채택 완료 시 상태 '답변완료' 변경
        sql_query(" update g5_helpme set he_answer_state = '답변완료' where idx ='{$helpme_idx}'; ");
    }

    die($result);
}
// 그 외
else // $mode : view, good, hate, answer_good, answer_hate
{
    if(strpos($mode, 'answer') !== false) { // 답변 관련 액션
        $search_add = " and helpme_an_idx = {$helpme_an_idx} ";
        $insert_add = " , helpme_an_idx = {$helpme_an_idx} ";
    }
    $acc_count = sql_fetch(" select count(*) as count from g5_helpme_action where helpme_idx = {$helpme_idx} {$search_add} and mode = '{$mode}' order by idx ")['count']; // 누적카운트
    if(empty($acc_count)) { $acc_count = 0; }

    $count = sql_fetch(" select count(*) as count from g5_helpme_action where helpme_idx = {$helpme_idx} {$search_add} and mb_id = '{$member['mb_id']}' and mode = '{$mode}' and date_format(wr_datetime,'%Y-%m-%d') = date_format(now(), '%Y-%m-%d'); ")['count']; // 금일 해당 동작을 했는지 확인
    if($count == 0) {
        $acc_count = $acc_count + 1; // 누적카운트 + 1
        sql_query(" insert into g5_helpme_action set mode = '{$mode}', helpme_idx = {$helpme_idx} {$insert_add}, mb_id = '{$member['mb_id']}', acc_count = {$acc_count}, wr_datetime = '".G5_TIME_YMDHIS."'; ");

        // 인기순 표시하기 위하여 g5_helpme에 별도로 he_good 컬럼 추가하여 표시
        if($mode == 'good') {
            sql_query(" update g5_helpme set he_good = {$acc_count} where idx = {$helpme_idx}; ");
        }
    } else { // 다시 누르면 취소 (삭제함)
        if($mode != 'view') { // 좋아요/싫어요 액션일 때
            if($acc_count > 0) {
                $acc_count = $acc_count - 1; // 누적카운트 - 1
            }
            sql_query("delete from g5_helpme_action where helpme_idx = {$helpme_idx} {$search_add} and mb_id = '{$member['mb_id']}' and mode = '{$mode}' and date_format(wr_datetime,'%Y-%m-%d') = date_format(now(), '%Y-%m-%d') ");
        }
    }

    echo $acc_count;
}
?>