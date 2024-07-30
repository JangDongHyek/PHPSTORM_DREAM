<?php
$sub_id = "my_reser";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$id = "mb_id";

//$sql = "select * from {$g5['car_wash_table']} where ".$id." = '{$member['mb_id']}' and (cw_step = 0 or cw_step = 1) order by cw_idx desc ";
//$reser_result = sql_query($sql);
$sql = "select *,cw.cw_idx cw_idx,cw.wr_datetime cw_datetime,cw.complete_datetime cw_complete_datetime from {$g5['car_wash_table']} cw
LEFT join new_re_car_wash rw on cw.rw_idx = rw.rw_idx
where ".$id." = '{$member['mb_id']}' and (cw_step = 1 or cw_step = 0 or(rw_step = 1 and is_turn_yn = 'N')) order by cw.complete_datetime DESC,rw_date DESC, car_w_date asc ";
$reser_result = sql_query($sql);



//5일 후 데이터 받아오기 mb_id myodrer꺼는 ma_id wc
$sql = "select * from new_car_wash WHERE mb_id = '{$member['mb_id']}' and now() >= date_add(complete_datetime, interval +5 day) ";
$complete_result = sql_query($sql);

for ($i = 0; $row = sql_fetch_array($complete_result); $i++) {

//정기세차(매월관리) or 정기세차(월4회) complete_cnt가 4회 미만일 경우 완료일로 부터5 일 후 진행작업으로 감.
    if (($row['car_date_type'] == 2 or $row['car_date_type'] == 1 && $row['complete_cnt'] < 4) ) {
        $sql = "update new_car_wash set cw_step = 1, rw_idx = 0 where cw_idx = {$row['cw_idx']} ";
        sql_query($sql);

        $sql = "update new_re_car_wash set is_turn_yn ='Y' where cw_idx = {$row['cw_idx']} and is_turn_yn = 'N' ";
        sql_query($sql);
    }
}

$sql = "select * from new_re_car_wash where cw_idx = '{$view["cw_idx"]}' and rw_step = 2 order by complete_datetime asc";
$re_result_array = sql_query($sql);
$sql = "select * from new_re_car_wash where rw_idx = {$view["rw_idx"]}  order by complete_datetime asc";
$re_result = sql_fetch($sql);

$is_mypage = "my_reser";
$g5['title'] = '예약내역';
include_once('./_head.php');

include_once($member_skin_path.'/my_reser.skin.php');

include_once('./_tail.php');
?>
