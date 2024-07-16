<?php
include_once('./_common.php');

// co_open ==> open : 전체공개 / private : 비공개

//$co_contents = addslashes($co_contents);
if($w == "") { // 등록
    $sql = " insert into g5_community set mb_id = '{$member['mb_id']}', co_category = '{$co_category}', co_subject = '{$co_subject}', 
             co_contents = '{$co_contents}', co_hashtag = '{$co_hashtag}', co_open = '{$co_open}', wr_datetime = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);
    $idx = sql_insert_id();

    // 등급포인트 - 게시글 등록 시 5NM 적립
    gradePointInsert($member['mb_id'], '적립', '게시글', '5', 'Community post registration', '', 'g5_community', $idx);

    alert('Post has been registered.', G5_BBS_URL.'/community.php', false);
}
else if($w == 'u') { // 수정
    $sql = " update g5_community set co_category = '{$co_category}', co_subject = '{$co_subject}', 
             co_contents = '{$co_contents}', co_hashtag = '{$co_hashtag}', co_open = '{$co_open}', up_datetime = '".G5_TIME_YMDHIS."' where idx = '{$idx}'; ";
    sql_query($sql);

    alert('Post has been edited.', G5_BBS_URL.'/community.php', false);
}
else if($w == 'd') { // 삭제
    // 커뮤니티 게시글 정보 UPDATE (삭제하지않고 상태변경)
    $result = sql_query(" update g5_community set del_yn = 'Y' where idx = {$idx}; ");
    $result = sql_query(" update g5_community_answer set del_yn = 'Y' where community_idx = {$idx}; ");

    // 글 삭제 시 포인트 차감
    gradePointInsert($member['mb_id'], '차감','게시글', '5', 'Community post delete', '', 'g5_community', $idx);

    alert('Post has been deleted.', G5_BBS_URL.'/community.php', false);
}
?>