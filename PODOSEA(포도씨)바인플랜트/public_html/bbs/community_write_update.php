<?php
include_once('./_common.php');

// co_open ==> open : 전체공개 / private : 비공개

//$co_contents = addslashes($co_contents);
if($w == "") { // 등록
    if(empty($co_category) || empty($co_subject) || empty($co_contents)) {
        alert('오류가 발생하였습니다.\n다시 진행해 주세요.');
    }

    $sql = " insert into g5_community set mb_id = '{$member['mb_id']}', co_category = '{$co_category}', co_subject = '{$co_subject}', 
             co_contents = '{$co_contents}', co_hashtag = '{$co_hashtag}', co_open = '{$co_open}', wr_datetime = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);
    $idx = sql_insert_id();

    if($member['mb_level'] != 10) { // 관리자 제외
        // 등급포인트 - 게시글 등록 시 5NM 적립
        gradePointInsert($member['mb_id'], '적립', '게시글', '5', '커뮤니티 글 등록', '', 'g5_community', $idx);
    }

    alert('게시글이 등록되었습니다', G5_BBS_URL.'/community_view.php?idx='.$idx, false);
}
else if($w == 'u') { // 수정
    if(empty($co_category) || empty($co_subject) || empty($co_contents)) {
        alert('오류가 발생하였습니다.\n다시 진행해 주세요.');
    }

    $sql = " update g5_community set co_category = '{$co_category}', co_subject = '{$co_subject}', 
             co_contents = '{$co_contents}', co_hashtag = '{$co_hashtag}', co_open = '{$co_open}', up_datetime = '".G5_TIME_YMDHIS."' where idx = '{$idx}'; ";
    sql_query($sql);

    alert('게시글이 수정되었습니다', G5_BBS_URL.'/community_view.php?idx='.$idx, false);
}
else if($w == 'd') { // 삭제
    // 커뮤니티 게시글 정보 UPDATE (삭제하지않고 상태변경)
    $result = sql_query(" update g5_community set del_yn = 'Y' where idx = {$idx}; ");
    $result = sql_query(" update g5_community_answer set del_yn = 'Y' where community_idx = {$idx}; ");

    if($member['mb_level'] != 10) { // 관리자 제외
        // 글 삭제 시 포인트 차감
        gradePointInsert($member['mb_id'], '차감','게시글', '5', '커뮤니티 글 삭제', '', 'g5_community', $idx);
    }

    alert('게시글이 삭제되었습니다.', G5_BBS_URL.'/community.php', false);
}
?>
