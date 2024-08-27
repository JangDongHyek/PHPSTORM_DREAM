<?php
$sub_id = "my_order";
include_once('./_common.php');
$is_mypage = "my_order";
/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/
$filter = $_REQUEST['filter'];
if($filter==""){$filter = 3;}

$id = "ma_id";
$sql_where = "";
if ($filter == 3){
    $sql_where = "car_date_type = 3";
}else if ($filter == 5){
    $sql_where = "car_date_type = 5";
}else if ($filter == 6){
    // 기업세차를 임의로 6
    $sql_where = "";
}else{
    //정기세차는 1,2
    $sql_where = "car_date_type < 3" ;
}


// 23.05.08 재작업건만
$rw_idx_check = $_REQUEST['rw_idx_check'];
if($rw_idx_check){
    $filter = 99;
    $sql_where = "car_date_type <= 5" ;
    $sql_where .= " and ( cw.rw_idx <> 0  )" ;

}else{
    $sql_where .= " and ( cw.rw_idx = 0  ) " ;
}

// 23.04.13 차량번호, 지역필터 추가
$sfl = $_REQUEST['sfl']; //구분
$stx = $_REQUEST['stx']; //검색어
if($stx){
    $sql_where .= " and ( cw.".$sfl. " LIKE '%".$stx."%' )";
}

// 23.04.13 완료날짜별로 오름차순 내림차순
$complete_datetime_order = $_REQUEST['complete_datetime_order']; //구분
if($complete_datetime_order){
    $sql_order .= ' order by cw.complete_datetime ASC,rw_date DESC, car_w_date asc ';
}else{
    $sql_order .= ' order by cw.complete_datetime DESC,rw_date DESC, car_w_date asc ';
}

if($filter==6)
{
    $sql = "SELECT * from new_company_car_wash where ".$id." = '{$member['mb_id']}'";
    $order_result = sql_query($sql);
}
else
{
    $sql = "select *,cw.cw_idx cw_idx,cw.wr_datetime cw_datetime,cw.complete_datetime cw_complete_datetime from {$g5['car_wash_table']} cw
    LEFT join new_re_car_wash rw on cw.rw_idx = rw.rw_idx
    where ".$id." = '{$member['mb_id']}' and (cw_step = 1 or (rw_step = 1 and is_turn_yn = 'N')) and {$sql_where} {$sql_order} ";

    $order_result = sql_query($sql);



//5일 후 데이터 받아오기
    $sql = "select * from new_car_wash WHERE ma_id = '{$member['mb_id']}' and now() >= date_add(complete_datetime, interval +5 day) ";
    $complete_result = sql_query($sql);

    for ($i = 0; $row = sql_fetch_array($complete_result); $i++) {

//정기세차(매월관리) or 정기세차(월4회) complete_cnt가 4회 미만일 경우 완료일로 부터5 일 후 진행작업으로 감.
        //if (($row['car_date_type'] == 2 or $row['car_date_type'] == 1 && $row['complete_cnt'] < 4) ) {
            if (($row['car_date_type'] == 2 or $row['car_date_type'] == 1) ) {            
            $sql = "update new_car_wash set cw_step = 1, rw_idx = 0 where cw_idx = {$row['cw_idx']} ";
            sql_query($sql);

            $sql = "update new_re_car_wash set is_turn_yn ='Y' where cw_idx = {$row['cw_idx']} and is_turn_yn = 'N' ";
            sql_query($sql);
        }
    }
}



$is_mypage = "my_order";
$g5['title'] = '진행작업';
include_once('./_head.php');

include_once($member_skin_path.'/my_order.skin.php');

include_once('./_tail.php');
?>
