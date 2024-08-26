<?php
$sub_id = "mypage";
include_once('./_common.php');

$g5['title'] = '마이페이지';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php?url=mypage.php');
}

$talent_result = "";
$talent_result2 = "";
//전문인일때
if ($member['mb_division'] == 2) {

$sql = "select count(*) cnt from new_talent where mb_id = '{$member['mb_id']}' ";
$talent_cnt =sql_fetch($sql)['cnt'];

$sql = "select count(*) cnt from new_competition where mb_id = '{$member['mb_id']}' ";
$comp_cnt =sql_fetch($sql)['cnt'];

$sql = "select count(*) cnt from new_comment where wr_parent = '0' and mb_id = '{$member['mb_id']}' ";
$comm_cnt =sql_fetch($sql)['cnt'];

//관련 재능분야 상품
$sql = "select * from new_profile where mb_id = '{$member["mb_id"]}' ";
$attention_talent = sql_fetch($sql)['pf_pro_ctg3'];
$attention_talent = explode(',',$attention_talent);

$sql = "select *,(select pta_pay from new_pay_talent where pta_info = 1 and ta_idx = ta.ta_idx) pta_pay from new_talent ta
 where ta_category3 = '{$attention_talent[0]}' and ta_imsi != 'Y' order by ta.wr_datetime desc limit 12";
$talent_result = sql_query($sql);


//일반인 일 때
}else{
    $sql2 = "select *,ta.ta_idx,(select pta_pay from new_pay_talent where pta_info = 1 and ta_idx = ta.ta_idx) pta_pay  from new_talent ta
             where ta_imsi != 'Y' order by ta.wr_datetime desc  limit 12";
    $talent_result2 = sql_query($sql2);

}




//include_once($member_skin_path.'/mypage.skin.php');
//2022.07.08변경
include_once($member_skin_path.'/my_item.skin.php');

include_once('./_tail.php');
?>