<?php
$sub_id = "finger_eval";
include_once('./_common.php');



$te_no = $_REQUEST['te_no'];
$fo = $_REQUEST['fo'];
$action_url = https_url(G5_BBS_DIR).'/reply_update.php';

$sql = "select * from {$g5['eval_table']} 
        where te_no = '{$te_no}' and finger_option = '{$fo}' and category = '리뷰' ";
$eval_result = sql_query($sql);

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

//tes정보
$te = get_tes_no($te_no);
//print_r($te);
//exit;
$register_action_url = G5_BBS_URL.'/finger_eval.php';

$g5['title'] = $te['te_name'];
include_once('./_head.php');


include_once($member_skin_path.'/finger_eval.skin.php');

include_once('./_tail.php');
?>
