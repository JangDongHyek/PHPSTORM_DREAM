<?php
$sub_id = "pro_step01";
include_once('./_common.php');


if(!$is_member){
	alert("회원만 사용가능한 페이지입니다. 로그인 후 다시 이용해주세요");
}

//$option_name = 'holiday';
if(!empty($_GET['ta_idx'])) {
    $ta_idx = $_GET['ta_idx'];

    $sql = " select * from {$g5['talent_table']} ta left join {$g5['category_service_table']} ctg on ta.ta_ctg_idx = ctg.ctg_idx where ta.ta_idx = {$ta_idx} ";
    $ta = sql_fetch($sql);

    if (!$ta && $ta['ta_imsi'] == 'N'){
        alert('존재하지 않는 글 입니다.', G5_URL);
    }

    if ($member['mb_id'] != $ta['mb_id']){
        alert('올바른 접근 방식이 아닙니다.', G5_URL);
    }



    if ($ta['ta_category1'] != 5 && $ta['ta_category1'] != 6) {
//        $option_name = 'holiday';
    }else if ($ta['ta_category1'] == 5 ){
//        $option_name = 'trans';
    }else if ($ta['ta_category1'] == 6 ){
//        $option_name = 'education';
    }
}

//common.php 에서 option_cnt
$option_cnt = $option_cnt;

//확인해서 옵션별로 배열만들기
for ($a = 0; $a < $option_cnt; $a++) {
    $arr[$a] = '';
    for ($b = 0; $b < count($ta['ctg_option'.($a+1)]);$b++){
        $arr[$a] .=  $ta['ctg_option'.($a+1)].',';
    }
    $arr[$a] = substr($arr[$a], 0, -1);
    $arr[$a] = explode(',',$arr[$a]);
}

$ctg_service_html = "";
for ($i = 0; $i < count($arr); $i++){
    $option_name_arr = explode('_',$arr[$i][0]);
    $option_name=$option_name_arr[0];

    //주말은 공통항목이라서 제외
    if ($option_name == 'holiday' || $option_name == ''){
        continue;
    }
    $ctg_service_html .= '<div class="bx">';
    $ctg_service_html .= '<h3 class="tit">' . $option_list[$option_name][0] . '</h3>';
    $ctg_service_html .= '<div class="chk cf">';
    for ($a = 1; $a < count($option_list[$option_name]); $a++){

        $ctg_service_html .= '<div class="chk_co">
                            <input type="checkbox" name="option2[]" value="' . $option_name . "_" . $a . '" id="' . $option_name . "_" . $a . '">
                            <label for="' . $option_name . "_" . $a . '">' . $option_list[$option_name][$a] . '</label>
                            </div>';
    }
    $ctg_service_html .= '</div>';
}

$is_mypage = "pro_step01";
$g5['title'] = '재능상품 등록';
include_once('./_head.php');

include_once($member_skin_path.'/pro_step01.skin.php');

include_once('./_tail.php');
?>
