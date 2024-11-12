<?php
$sub_id = "register_tes_form";
include_once('./_common.php');
include_once(G5_BBS_PATH.'/qrcode.php');

$mb_no = $_SESSION['ss_mb_no'];

$sql = " select count(*) as count from g5_tes where te_category = 'tes' and mb_no = {$_SESSION['ss_mb_no']}";
$sql_count = sql_fetch($sql);
$sql_count = $sql_count['count'];

$w = '';
if($sql_count > 0) {
    $w = 'u';
    $g5['title'] = '내 상점 수정';

    $sql = " select * from g5_tes where te_category = 'tes' and mb_no = {$mb_no} ";
    $row = sql_fetch($sql);

    // 영업시간
    $te_start = explode('~', $row['te_time'])[0];
    $te_start_hour = explode(':', $te_start)[0];
    $te_start_minute = explode(':', $te_start)[1];
    $te_end = explode('~',$row['te_time'])[1];
    $te_end_hour = explode(':', $te_end)[0];
    $te_end_minute = explode(':', $te_end)[1];

    // tes 등록 상태
    $te_reg_state = '';
    if(strpos($row['te_reg_state'],'요청') !== false) {
        $te_reg_state = '요청';
    } else if(strpos($row['te_reg_state'], '보류') !== false) {
        $te_reg_state = '보류';
    } else if(strpos($row['te_reg_state'], '승인') !== false) {
        $te_reg_state = '승인';
    }

    // tes 해지 상태
    $te_cancel = '';
    if(strpos($row['te_cancel'],'요청') !== false) {
        $te_cancel = '요청';
    } else if(strpos($row['te_cancel'], '보류') !== false) {
        $te_cancel = '보류';
    } else if(strpos($row['te_cancel'], '완료') !== false) {
        $te_cancel = '완료';
    }

    // 파일
    $file_count_sql = " select count(*) as count from g5_file where fi_table='g5_tes' and mb_no = {$mb_no} and tb_no = {$row['te_no']} ";
    $file_count = sql_fetch($file_count_sql);
    $file_count = $file_count['count'];

    if($file_count > 0) {
        $file_sql = " select * from g5_file where fi_table='g5_tes' and mb_no = {$mb_no} and tb_no = {$row['te_no']} order by fi_datetime";
        $file_result = sql_query($file_sql);
    }

    // qr 코드
    $qr = new QR_BarCode();
    $qr->text(G5_BBS_URL.'/qr_pay.php?te_no='.$row['te_no']."&mb_no=".$row['mb_no']);

} else {
    $g5['title'] = '내 상점 등록';
}

include_once('./_head.php');

$register_action_url = G5_BBS_URL.'/register_tes_form.php';
include_once($member_skin_path.'/register_tes_form.skin.php');

include_once('./_tail.sub.php');
?>