<?php
include_once('./_common.php');

// he_open ==> open : 전체공개 / private : 비공개

if(!$is_member) {
    alert('로그인 후 이용해 주세요.', G5_BBS_URL.'/login.php');
}

if($w == "") { // 등록
    if(empty($he_category) || empty($he_subject) || empty($he_contents)) {
        alert('오류가 발생하였습니다.\n다시 진행해 주세요.');
    }

    $sql = " insert into g5_helpme set mb_id = '{$member['mb_id']}', he_category = '{$he_category}', he_subject = '{$he_subject}', 
             he_contents = '{$he_contents}', he_hashtag = '{$he_hashtag}', he_bunker = '{$he_bunker}', he_answer_state = '답변대기', wr_datetime = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);
    $idx = sql_insert_id();

    if($member['mb_level'] != 10) { // 관리자 제외
        if(!empty($he_bunker)) {
            // BUNKER HISTORY(질문 등록에 대한 BUNKER 차감)
            bunkerHistory($member['mb_id'], '차감', $he_bunker, '헬프미 질문 BUNKER 설정', '', 'g5_helpme', $idx);
        }

        // 등급포인트 - 게시글 등록 시 5NM 적립
        gradePointInsert($member['mb_id'], '적립', '게시글', '5', '헬프미 글 등록', '', 'g5_helpme', $idx);
    }

    alert('질문이 등록되었습니다', G5_BBS_URL.'/help_view.php?idx='.$idx, false);
}
else if($w == 'u') { // 수정
    if(empty($he_category) || empty($he_subject) || empty($he_contents)) {
        alert('오류가 발생하였습니다.\n다시 진행해 주세요.');
    }

    // 답변 여부 확인
    $a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = '{$idx}' and del_yn is null; ")['count'];
    if(!empty($a_count)) {
        alert('답변이 등록되어 수정할 수 없습니다.', G5_BBS_URL.'/help_view.php?idx='.$idx, false);
    }

    // 벙커 수정할 수 있게 되면 아래 주석 해제하여 사용
    /*$he = sql_fetch(" select * from g5_helpme where idx = '{$idx}' ");
    if($he_bunker != $he['he_bunker']) { // 벙커 변경 시 벙커 되돌렸다가 다시 지급
        // 벙커를 원래대로 되돌림
        $info = sql_fetch(" select * from g5_bunker_history where mb_id = '{$member['mb_id']}' and mode = '차감' and rel_idx = '{$idx}' order by idx desc limit 1  "); // 헬프미 질문 벙커 설정 시 차감된 벙커 종류 확인
        bunkerHistory($member['mb_id'], '정정', $he['he_bunker'], '헬프미 질문 BUNKER 수정으로 인한 정정', '', 'g5_helpme', $idx, '', $info['normal'], $info['bonus']);

        // BUNKER HISTORY(질문 등록에 대한 BUNKER 차감)
        bunkerHistory($member['mb_id'], '차감', $he_bunker, '헬프미 질문 BUNKER 수정 ('.$he['he_bunker'].'→'.$he_bunker.')', '', 'g5_helpme', $idx);
    }*/

    $sql = " update g5_helpme set he_category = '{$he_category}', he_subject = '{$he_subject}', 
             he_contents = '{$he_contents}', he_hashtag = '{$he_hashtag}', he_bunker = '{$he_bunker}', up_datetime = '".G5_TIME_YMDHIS."' where idx = '{$idx}'; ";
    sql_query($sql);

    alert('질문이 수정되었습니다', G5_BBS_URL.'/help_view.php?idx='.$idx, false);
}
else if($w == 'd') { // 삭제
    // 헬프미 정보
    $help = sql_fetch(" select * from g5_helpme where idx = '{$idx}' ");

    // 헬프미 정보 UPDATE (삭제하지않고 상태변경)
    $result = sql_query(" update g5_helpme set del_yn = 'Y', del_mb_id = '{$member['mb_id']}' where idx = {$idx}; ");
    sql_query(" update g5_helpme_answer set del_yn = 'Y', del_mb_id = '{$member['mb_id']}' where helpme_idx = {$idx}; ");

    if($member['mb_level'] != 10) { // 관리자 제외
        // 글 삭제 시 포인트 차감
        gradePointInsert($member['mb_id'], '차감','게시글', '5', '헬프미 글 삭제', '', 'g5_helpme', $idx);

        if(!empty($help['he_bunker'])) {
            // 글 삭제 시 벙커 설정하였으면 회수
            bunkerHistory($member['mb_id'], '적립', $help['he_bunker'], '헬프미 질문 삭제 BUNKER 회수', '', 'g5_helpme', $idx, 'correct');
        }
    }

    alert('질문이 삭제되었습니다.', G5_BBS_URL.'/help_list.php', false);
}
?>
