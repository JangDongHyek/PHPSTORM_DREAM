<?php
$sub_menu = "200100";
include_once("./_common.php");

/** 관리자정보 수정 (회원정보 수정 페이지와 별도 사용) **/

if($w == 'u') {
    $mb_id = trim($_POST['mb_id']);

    // 휴대폰번호 체크
    $mb_hp = hyphen_hp_number($_POST['mb_hp']);

    // 기본정보
    $sql_common = " mb_name = '{$_POST['mb_name']}', mb_hp = '{$mb_hp}' ";

    // 비밀번호 변경 시
    if ($mb_password)
        $sql_password = " , mb_password = '".get_encrypt_string($mb_password)."' ";
    else
        $sql_password = "";

    // 기본정보
    $sql = " update {$g5['member_table']} set {$sql_common} {$sql_password} where mb_id = '{$mb_id}' ";
    $result = sql_query($sql);

    if($result) {
        alert('저장되었습니다.', './adm_member_list.php');
    }
}else{

    $sql = "insert into {$g5['member_table']} set mb_level = 9, mb_name = '{$_POST['mb_name']}', mb_id = '{$_POST['mb_id']}', mb_password = '".get_encrypt_string($mb_password)."' ,
            mb_datetime = '".G5_TIME_YMDHIS."' ";
    $result = sql_query($sql);

    if($result) {
        alert('저장되었습니다.', './adm_member_list.php');
    }

}
?>