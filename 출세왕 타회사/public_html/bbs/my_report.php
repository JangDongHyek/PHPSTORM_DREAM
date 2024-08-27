<?php
$sub_id = "my_report";
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$sql = "select cw.car_date_type car_date_type,cw.car_size car_size,rv.re_content re_content,ma.mb_name ma_name,
       mb.mb_name mb_name,cw.complete_datetime cw_complete_datetime,rv.wr_datetime wr_datetime,
       cw.cw_idx cw_idx

from {$g5['review_table']} rv
LEFT join g5_member mb on mb.mb_id = '{$member['mb_id']}'
LEFT join g5_member ma on ma.mb_id = rv.ma_id
LEFT join new_car_wash cw on cw.cw_idx = rv.cw_idx
where rv.mb_id = '{$member['mb_id']}' order by rv.wr_datetime DESC ";
$review_result = sql_query($sql);



$is_mypage = "my_report";
$g5['title'] = '내 건의함';
include_once('./_head.php');

include_once($member_skin_path.'/my_report.skin.php');

include_once('./_tail.php');
?>
