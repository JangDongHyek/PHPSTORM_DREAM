<?php
$sub_id = "search_tes_view";
include_once('./_common.php');

include_once('./_head.php');
$te_no =$_REQUEST['te_no'];
//$te_no = 2;

//장소정보, 이미지
$sql = " select te.*,fi.fi_file,fi.fi_folder from g5_tes te left join g5_file fi on te.te_no = fi.tb_no where te_no = '{$te_no}' and fi_table = 'g5_tes' order by fi.fi_no limit 1 ";
$view = sql_fetch($sql);

//평가 손가락 수
$f_sql = "select ";
for ($i = 1; $i <= 5; $i++) {
    $f_sql .= "COUNT(if(finger_option = '{$i}', finger_option, NULL)) as fo_cnt_{$i},";
}
$f_sql .= "COUNT(finger_option) ";
$f_sql .= "from {$g5['eval_table']} ev where te_no = '{$te_no}' and category = '평가' ";

$finger_option = sql_fetch($f_sql);
$arr = [];

//큰수 찾아서 색칠
for ($i = 1; $i <= 5; $i++) {
    array_push($arr,$finger_option['fo_cnt_'.$i]);
}
$max_int_v = (max($arr));
$min_int_v = (min($arr));

if ($max_int_v != $min_int_v ) {
    $max_int_v_key = array_keys($arr ,$max_int_v );
}

$mb = get_member_no($view['mb_no']);

$register_action_url = G5_BBS_URL.'/search_tes_view.php';
include_once($member_skin_path.'/search_tes_view.skin.php');

include_once('./_tail.php');
?>
