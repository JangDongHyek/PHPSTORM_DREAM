<?php
$sub_id = "my_profile01";
include_once('./_common.php');

/*
if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}
*/

$mb_id = "";
if(!empty($_SESSION['ss_mb_id'])) {
    $mb_id = $_SESSION['ss_mb_id'];
} else {

    $mb_id = $_GET['mb_id'];
//    $_SESSION['ss_mb_id'] = $mb_id;
}

if ($mb_id == ""){
    alert("올바른 방식으로 접근해주세요",G5_URL);
}

$sql = "select * from g5_member_hope where mb_id = '{$mb_id}' ";
$mh = sql_fetch($sql);
$mh_job = explode(",",$mh["mh_job"]);
$mh_height = explode(",",$mh["mh_height"]);
$mh_school = explode(",",$mh["mh_school"]);
$mh_salary = explode(",",$mh["mh_salary"]);
$mh_type = explode(",",$mh["mh_type"]);
$mh_marry_yn = explode(",",$mh["mh_marry_yn"]);

$mb = get_member($mb_id);

$is_mypage = "my_profile01";
$g5['title'] = '기본정보';
include_once('./_head.php');

include_once($member_skin_path.'/my_profile01.skin.php');

include_once('./_tail.php');
?>
