<?php
$sub_id = "my_review";
include_once('./_common.php');

$g5['title'] = '받은 평가';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    //alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/register.php');
}

$sql = " select mb.*, ta.ta_idx from g5_member as mb left join new_talent as ta on ta.mb_id = mb.mb_id where mb.mb_id = '{$_SESSION['ss_mb_id']}' ";
$result = sql_query($sql);

$ta_idx = '';
for($i=0; $row=sql_fetch_array($result); $i++) { // 본인이 등록한 재능 다 불러옴
    $ta_idx .= $row['ta_idx'].',';
}
$ta_idx = substr($ta_idx, 0, -1);

$review_count = sql_fetch(" select count(*) as count from new_payment_review as re left join g5_member as mb on mb.mb_id = re.mb_id where re.ta_idx in ({$ta_idx}) ")['count'];

$sql = " select re.*, mb.mb_nick from new_payment_review as re left join g5_member as mb on mb.mb_id = re.mb_id where re.ta_idx in ({$ta_idx}) order by re.wr_datetime desc limit 0, 9 ";
$result = sql_query($sql);

include_once($member_skin_path.'/my_review.skin.php');

include_once('./_tail.php');
?>