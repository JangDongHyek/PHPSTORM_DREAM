<?php
global $pid;
$pid = "my_item";
$sub_id = "my_item";
include_once('./_common.php');

$g5['title'] = '재능 관리';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    //alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php');
}

// 탭 설정
$tab = $_REQUEST['tab'];
//아무것도 안들어왔을 경우 tab 1로 설정
if (empty($tab)) { $tab = 1; }
//설정한 탭이 아닐경우 팅겨냄
if ($tab != 1 && $tab != 2 && $tab != 3) {
    alert("올바른 방식으로 접근해주세요",G5_URL);
}

// 진행 상태 정보
$op = $_REQUEST['op'];
if (empty($op)) { $op = 1; }
$sql_add = ' and (pa.charge != "Y" or pa.charge is null) '; // 캐시 충전 데이터 제외
if($op == 2) { $sql_add .= ' and pa.status = "진행대기" '; }
else if($op == 3) { $sql_add .= ' and pa.status = "진행중" '; }
else if($op == 4) { $sql_add .= ' and pa.status = "완료" '; }
else if($op == 5) { $sql_add .= ' and pa.status = "취소" '; }

/*************탭별 페이지(찜한 재능)************/
$total_count = 0;
$rows = 12;
//탭별 페이지
$like_sql = " select count(li_idx) cnt from {$g5['like_table']} where mb_id = '{$member['mb_id']}' and li_table = 'talent' ";
$like_total = sql_fetch($like_sql)['cnt'];

$talent_sql = " select count(ta_idx) cnt from new_talent where mb_id = '{$member['mb_id']}' ";
$talent_total = sql_fetch($talent_sql)['cnt'];

$payment_count = sql_fetch(" select count(*) as count from new_payment as pa where pa.userId = '{$_SESSION['ss_mb_id']}' {$sql_add} ")['count'];
$sale_count = sql_fetch(" select count(*) as count from new_payment as pa left join new_talent as ta on ta.ta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', 1) where ta.mb_id = '{$_SESSION['ss_mb_id']}' {$sql_add} ")['count'];


//등록된 공모전 페이징
if ($tab == '1') {
    if ($member['mb_division'] == 2) {
        $write_cnt = $talent_total;
    }else{
        $write_cnt = $like_total;
    }
}elseif ($tab == '2'){
    if ($member['mb_division'] == 2){
        $write_cnt = $sale_count;
    }else {
        $write_cnt = $payment_count;
    }
}else{

    if ($member['mb_division'] == 2) {
        $write_cnt = $like_total;
    }else{
        $write_cnt = $payment_count;

    }
}

$total_count = $write_cnt;

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
/*************탭별 페이지(찜한 재능)************/

// 구매 재능, 결제 내역
//$payment_count = sql_fetch(" select count(*) as count from new_payment as pa where pa.userId = '{$_SESSION['ss_mb_id']}' {$sql_add} ")['count'];

//$rows = 16;
//$payment_total_page  = ceil($payment_count / $rows);  // 전체 페이지 계산
//if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
//$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select pa.*, mb.mb_id, mb.mb_nick, ta.ta_idx, ta.ta_title, pta.pta_pay, pta.pta_title, pta.pta_content, pta.pta_select1, mbs.mb_id as sale_mb_id, mbs.mb_nick as sale_mb_nick
         from new_payment as pa 
         left join g5_member as mb on mb.mb_id = pa.userId
         left join new_talent as ta on ta.ta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', 1)
         left join new_pay_talent as pta on pta.pta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', -1)
         left join g5_member as mbs on mbs.mb_id = ta.mb_id
         where pa.userId = '{$_SESSION['ss_mb_id']}' {$sql_add} and (ResultCode = 3001 or ResultCode = 4000) order by pa.wr_datetime desc limit {$from_record}, {$rows} ";
//echo $sql;
$payment_result = sql_query($sql);
$payment_result2 = sql_query($sql);

// 결제 내역 진행상태
$pay_status1 = sql_fetch(" select count(*) as count from new_payment where userId = '{$_SESSION['ss_mb_id']}' and (charge != 'Y' or charge is null) and (ResultCode = 3001 or ResultCode = 4000) ")['count'];
$pay_status2 = sql_fetch(" select count(*) as count from new_payment where userId = '{$_SESSION['ss_mb_id']}' and (charge != 'Y' or charge is null) and (ResultCode = 3001 or ResultCode = 4000) and status = '진행대기' ")['count'];
$pay_status3 = sql_fetch(" select count(*) as count from new_payment where userId = '{$_SESSION['ss_mb_id']}' and (charge != 'Y' or charge is null) and (ResultCode = 3001 or ResultCode = 4000) and status = '진행중' ")['count'];
$pay_status4 = sql_fetch(" select count(*) as count from new_payment where userId = '{$_SESSION['ss_mb_id']}' and (charge != 'Y' or charge is null) and (ResultCode = 3001 or ResultCode = 4000) and status = '완료' ")['count'];
$pay_status5 = sql_fetch(" select count(*) as count from new_payment where userId = '{$_SESSION['ss_mb_id']}' and (charge != 'Y' or charge is null) and (ResultCode = 3001 or ResultCode = 4000) and status = '취소' ")['count'];
// == 구매 재능, 결제 내역


// 판매 재능
//$sale_count = sql_fetch(" select count(*) as count from new_payment as pa left join new_talent as ta on ta.ta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', 1) where ta.mb_id = '{$_SESSION['ss_mb_id']}' {$sql_add} ")['count'];

//$rows = 16;
//$sale_total_page  = ceil($sale_count / $rows);  // 전체 페이지 계산
//if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
//$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select pa.*, mb.mb_id, mb.mb_nick, ta.ta_idx, ta.ta_title, pta.pta_pay, pta.pta_title, pta.pta_content, pta.pta_select1, mbs.mb_id as sale_mb_id, mbs.mb_nick as sale_mb_nick
         from new_payment as pa 
         left join g5_member as mb on mb.mb_id = pa.userId
         left join new_talent as ta on ta.ta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', 1)
         left join new_pay_talent as pta on pta.pta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', -1)
         left join g5_member as mbs on mbs.mb_id = ta.mb_id
         where ta.mb_id = '{$_SESSION['ss_mb_id']}' {$sql_add} order by pa.wr_datetime desc limit {$from_record}, {$rows} ";
$sale_result = sql_query($sql);

// 판매 재능 진행상태
$sale_status1 = sql_fetch(" select count(*) as count from new_payment pa left join new_talent as ta on ta.ta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', 1) where ta.mb_id = '{$_SESSION['ss_mb_id']}' and (charge = '' or charge is null) ")['count'];
$sale_status2 = sql_fetch(" select count(*) as count from new_payment pa left join new_talent as ta on ta.ta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', 1) where ta.mb_id = '{$_SESSION['ss_mb_id']}' and (charge = '' or charge is null) and status = '진행대기' ")['count'];
$sale_status3 = sql_fetch(" select count(*) as count from new_payment pa left join new_talent as ta on ta.ta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', 1) where ta.mb_id = '{$_SESSION['ss_mb_id']}' and (charge = '' or charge is null) and status = '진행중' ")['count'];
$sale_status4 = sql_fetch(" select count(*) as count from new_payment pa left join new_talent as ta on ta.ta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', 1) where ta.mb_id = '{$_SESSION['ss_mb_id']}' and (charge = '' or charge is null) and status = '완료' ")['count'];
$sale_status5 = sql_fetch(" select count(*) as count from new_payment pa left join new_talent as ta on ta.ta_idx = substring_index(substring_index(pa.Moid, '-', -2), '-', 1) where ta.mb_id = '{$_SESSION['ss_mb_id']}' and (charge = '' or charge is null) and status = '취소' ")['count'];
// == 판매 재능


//$tab = $_REQUEST['tab'];
//print_r($tab);
//if (empty($tab)) $tab = 'like'; // 텝이 없으면 첫 페이지 (1 페이지)




/*******정은 작업 ********/



//전문인일때 등록한 재능
if ($member['mb_division'] == 2) {

    $sql = " select count(ta_idx) cnt from {$g5['talent_table']} where mb_id = '{$member['mb_id']}' and ta_imsi != 'Y' ";
    $talent_cnt = sql_fetch($sql);

    $sql = "SELECT ta.*, (select pta_pay from new_pay_talent where pta_info = 1 and ta_idx = ta.ta_idx) pta_pay FROM {$g5['talent_table']} as ta
        where mb_id = '{$member['mb_id']}' and ta_imsi != 'Y'
        order by ta_idx desc limit {$from_record}, {$rows} ";
    $talent_result = sql_query($sql);
}

//일반인 일 때 찜한 재능

$sql = "select *, ta.ta_idx ta_idx from {$g5['like_table']} li
        left join {$g5['talent_table']} ta on li.ta_idx = ta.ta_idx
         where li.mb_id = '{$member['mb_id']}' and li.li_table = 'talent' GROUP by ta.ta_idx order by li.wr_datetime desc limit {$from_record}, {$rows}";
//print_r($sql);
$like_list_result = sql_query($sql);


/*******정은 작업 끝끝*******/


include_once($member_skin_path.'/my_item.skin.php');

include_once('./_tail.php');
?>