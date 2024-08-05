<?
include_once("./_common.php");

$token = clean_xss_tags(trim($_POST['token']));
$cjax_token = get_session('ss_cjax_use_point_token');
set_session('ss_cjax_use_point_token', '');
if (!($token && $cjax_token == $token)) {
	echo -1;
	exit;
}

if($member == "" || $member == null){
	echo -1;
	exit;
}

if($member[mb_level] < 8) {
	echo -1;
	exit;
}

if($use_point == null || $use_point == ""){
	echo -1;
	exit;
}	

$mb = get_member($mb_id);
if($mb == null || $mb == ""){
	echo -1;
	exit;
}

if($mb[mb_point] < $use_point){
	echo -1;
	exit;
}

if($is_app == false){
	echo -1;
	exit;
}

$po_content = "카페 이용";

insert_point($mb_id, $use_point*-1, $po_content, '@passive', $mb_id, $member['mb_id'].'-'.uniqid(''), $expire);

?>