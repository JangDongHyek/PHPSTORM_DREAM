<?php
$sub_id = "my_contest";
include_once('./_common.php');

$g5['title'] = '공모전 관리';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
if (!$is_member){
    alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php');
}


$write_cnt_sql = "select count(cp_idx) cnt from new_competition where mb_id = '{$member['mb_id']}' ";
$write_total = sql_fetch($write_cnt_sql)['cnt'];

//count 쿼리 이상하게 찍혀서 numrow로 파악
$write_cnt_sql = "select ap_idx from new_competition_apply ap left join new_competition cp on ap.ap_cp_idx = cp.cp_idx where ap.mb_id = '{$member['mb_id']}' group by ap_cp_idx ";
$apply_total = sql_query($write_cnt_sql);
$apply_total = sql_num_rows($apply_total);

$write_cnt_sql = "select count(li_idx) cnt from new_like where mb_id = '{$member['mb_id']}' and li_table = 'competition' ";
$like_total = sql_fetch($write_cnt_sql)['cnt'];


$rows = 3;
$tab = $_REQUEST['tab'];
//아무것도 안들어왔을 경우 tab 1로 설정
if (empty($tab)){$tab = 1;}
//설정한 탭이 아닐경우 팅겨냄
if ($tab != 1 && $tab != 2&&$tab != 3){
    alert("올바른 방식으로 접근해주세요",G5_URL);
}

//등록된 공모전 페이징
if ($tab == '1') {
    $write_cnt = $write_total;
}elseif ($tab == '2'){
    $write_cnt = $apply_total;
}else{
    $write_cnt = $like_total;
}

$total_count = $write_cnt;

$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함



//등록한 공모전
$sql = "select * from new_competition where mb_id = '{$member['mb_id']}' order by cp_idx desc limit {$from_record}, {$rows}";
$write_comp = sql_query($sql);

//참여한 공모전
$sql = "select cp.* ,ap.ap_cp_idx,ap_idx from new_competition_apply ap left join new_competition cp on ap.ap_cp_idx = cp.cp_idx where ap.mb_id = '{$member['mb_id']}' group by ap_cp_idx order by ap_idx desc limit {$from_record}, {$rows} ";
$apply_comp = sql_query($sql);

//찜한 공모전
$sql = "select * from new_like li left join new_competition cp on li.ta_idx = cp.cp_idx where li.mb_id = '{$member['mb_id']}'and li_table = 'competition'  order by li_idx desc limit {$from_record}, {$rows} ";
$like_comp = sql_query($sql);


include_once($member_skin_path.'/my_contest.skin.php');

include_once('./_tail.php');
?>