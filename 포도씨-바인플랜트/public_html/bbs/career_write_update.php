<?php
include_once('./_common.php');
/**
 * 채용공고 액션
 */

//$cr_contents = addslashes($cr_contents);
$sql_common = "cr_subject = '{$cr_subject}', 
               cr_site = '{$cr_site}', 
               cr_stdate = '{$cr_stdate}', 
               cr_eddate = '{$cr_eddate}', 
               cr_always = '{$cr_always}', 
               cr_work_type = '{$cr_work_type}', 
               cr_work_position = '{$cr_work_position}', 
               cr_work_salary = '{$cr_work_salary}', 
               cr_work_addr = '{$cr_work_addr}', 
               cr_contents = '{$cr_contents}', 
               cr_manager = '{$cr_manager}', 
               cr_hp = '{$cr_hp}', 
               cr_email = '{$cr_email}', 
               cr_addr = '{$cr_addr}',
               cr_addr2 = '{$cr_addr2}',
               cr_hashtag = '{$cr_hashtag}', 
               cr_zip = '{$cr_zip}',
               cr_addr_lat = '{$cr_addr_lat}',
               cr_addr_lng = '{$cr_addr_lng}'";

if($w == "") { // 등록
    $sql = " insert into g5_career_recruit set 
             mb_id = '{$member['mb_id']}', 
             wr_datetime = '".G5_TIME_YMDHIS."', {$sql_common} ";
    sql_query($sql);

    alert('채용공고가 등록되었습니다', G5_BBS_URL.'/career.php', false);
}
else if($w == 'u') { // 수정
    $sql = " update g5_career_recruit set 
             up_datetime = '".G5_TIME_YMDHIS."', {$sql_common} 
             where idx = '{$idx}'; ";
    sql_query($sql);

    alert('채용공고가 수정되었습니다', G5_BBS_URL.'/career.php', false);
}
else if($w == 'd') { // 삭제
    $sql = sql_query(" delete from g5_career_recruit where idx = '{$idx}' ");

    alert('채용공고가 삭제되었습니다.', G5_BBS_URL.'/career.php', false);
}
else if($w == 'e') { // 마감
    $sql = sql_query(" update g5_career_recruit set cr_state = '마감' where idx = '{$idx}' ");

    alert('채용공고가 마감되었습니다.', G5_BBS_URL.'/career.php', false);
}
?>