<?php
include_once("./_common.php");

// 자주묻는질문 등록/수정

// 저장 후 보여줄 카테고리 화면
if($category == '일반회원 자주묻는 질문') {
    $param = '?g=m';
} else if($category == '기업회원 자주묻는 질문') {
    $param = '?g=c';
} else {
    $param = '';
}

//$contents = addslashes($contents);
if($w == '') {
    $msg = '등록';
    $sql = " insert into g5_cs_faq set notice = '{$notice}', category = '{$category}', subject = '{$subject}', contents = '{$contents}', wr_datetime = '".G5_TIME_YMDHIS."' ";
}
else if($w == 'u') {
    $msg = '수정';
    $sql = " update g5_cs_faq set notice = '{$notice}', category = '{$category}', subject = '{$subject}', contents = '{$contents}', up_datetime = '".G5_TIME_YMDHIS."' where idx = '{$idx}' ";
}
else {
    $msg = "삭제";
    $sql = " delete from g5_cs_faq where idx = '{$idx}' ";
}
$result = sql_query($sql);

if($result) {
    alert('자주묻는질문이 '.$msg.'되었습니다.', G5_BBS_URL.'/faq_list.php'.$param);
}