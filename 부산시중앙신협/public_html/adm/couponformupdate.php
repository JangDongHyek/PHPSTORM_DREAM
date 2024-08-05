<?php
$sub_menu = '400800';
include_once('./_common.php');

auth_check($auth[$sub_menu], "w");

check_admin_token();

$_POST = array_map('trim', $_POST);

if(!$_POST['cp_subject'])
    alert('쿠폰이름을 입력해 주십시오.');

if(!$_POST['cp_start'] || !$_POST['cp_end'])
    alert('사용 시작일과 종료일을 입력해 주십시오.');

if($_POST['cp_start'] > $_POST['cp_end'])
    alert('사용 시작일은 종료일 이전으로 입력해 주십시오.');

if($_POST['cp_end'] < G5_TIME_YMD)
    alert('종료일은 오늘('.G5_TIME_YMD.')이후로 입력해 주십시오.');

if(empty($cp_finish))
    $cp_finish = "F";

$mb_id = "";
if($w == '') {
    $chk_general = $_POST['chk_general'];
    $chk_vip = $_POST['chk_vip'];
    $chk_vvip = $_POST['chk_vvip'];
    $chk_union = $_POST['chk_union'];

    if(empty($chk_general) && empty($chk_vip) && empty($chk_vvip) && empty($chk_union)) {
        $sql = " select mb_id from {$g5['member_table']} where mb_id = '{$_POST['mb_id']}' and mb_leave_date = '' and mb_intercept_date = '' ";
        $row = sql_fetch($sql);
        if(!$row['mb_id'])
            alert('입력하신 회원아이디는 존재하지 않거나 탈퇴 또는 차단된 회원아이디입니다.');

        $mb_id = $_POST['mb_id'];
    } else {
        if($chk_general){
            $mb_id = "2";
        }

        if($chk_union){
            if(empty($mb_id)) $mb_id = "3";
            else $mb_id = ",3";
        }

        if($chk_vip){
            if(empty($mb_id)) $mb_id = "34";
            else $mb_id = ",4";
        }

        if($chk_vvip){
            if(empty($mb_id)) $mb_id = "5";
            else $mb_id = ",5";
        }

    }

    $cp_id = get_uniqid();
    $sql = "insert into `v5_coupon` set 
                    `cp_id` = '$cp_id', 
                    `mb_id`       = '$mb_id',
                    `cp_subject`  = '$cp_subject', 
                    `cp_start`    = '$cp_start',
                    `cp_end`      = '$cp_end',
                    `cp_finish` = '$cp_finish'";
    sql_query($sql);
} else if($w == 'u') {
    $sql = " select * from `v5_coupon` where cp_id = '$cp_id' ";
    $cp = sql_fetch($sql);

    if(!$cp['cp_id'])
        alert('쿠폰정보가 존재하지 않습니다.', './couponlist.php');

    if(empty($chk_general) && empty($chk_vip) && empty($chk_vvip) && empty($chk_union)) {
        $sql = " select mb_id from {$g5['member_table']} where mb_id = '{$_POST['mb_id']}' and mb_leave_date = '' and mb_intercept_date = '' ";
        $row = sql_fetch($sql);
        if(!$row['mb_id'])
            alert('입력하신 회원아이디는 존재하지 않거나 탈퇴 또는 차단된 회원아이디입니다.');

        $mb_id = $_POST['mb_id'];
    } else {
        if($chk_general){
            $mb_id = "2";
        }

        if($chk_union){
            if(empty($mb_id)) $mb_id = "3";
            else $mb_id = ",3";
        }

        if($chk_vip){
            if(empty($mb_id)) $mb_id = "4";
            else $mb_id = ",4";
        }

        if($chk_vvip){
            if(empty($mb_id)) $mb_id = "5";
            else $mb_id = ",5";
        }


    }

    $sql = " update `v5_coupon`
                set `mb_id`       = '$mb_id',
                    `cp_subject`  = '$cp_subject', 
                    `cp_start`    = '$cp_start',
                    `cp_end`      = '$cp_end',
                    `cp_finish` = '$cp_finish'
                where `cp_id` = '$cp_id' ";
    sql_query($sql);
}

goto_url('./couponlist.php');
?>