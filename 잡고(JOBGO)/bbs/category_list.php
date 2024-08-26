<?php
$sub_id = "category_list";
include_once('./_common.php');

$g5['title'] = '재능 카테고리';
include_once('./_head.php');

// 회원이 아닌 경우 접속하실 수 없습니다.
//if (!$is_member){
//    alert('로그인 후 이용하여 주십시오.', G5_BBS_URL.'/login.php');
//}


$area = $_GET['area'];
$category = $_GET['category'];
$category2 = $_GET['category2'];
$category3 = $_GET['category3'];

if ($category2 == "전체"){
    $category2 = "";
}
if ($category3 == "전체"){
    $category3 = "";
}

if ($category == "" ){
    alert("카테고리를 입력해주세요.", G5_URL.'/index.php');
}

//1차 카테고리 idx 받아오기
$p_code = common_code($category,'code_name','json','and code_p_idx = 0');
$category_key = $p_code[0]['idx'];

//배너 카테고리 지정해주기. 제일 마지막 카테고리 idx만 받아오면됨.
$ba_category = $category_key;

//2차 카테고리 idx 받아오기
$code2 = common_code($category2, 'code_name', 'json', 'and code_p_idx = ' . $category_key);

if ($code2[0]['idx'] != ""){
    $code3_ctg = common_code($code2[0]['idx'], 'code_p_idx', 'json');
}
//3차 카테고리

//GET 뒤에 붙은 3차 카테고리 idx받아와서 쿼리 넣는용도
$code3_request = common_code($category3,'code_name','json',' and code_p_idx = '.$code2[0]['idx']);

if ($category2 != ""){
    $ba_category = $code2[0]['idx'];
    $code2_sql = " and ta_category2 = '{$code2[0]['idx']}' ";
}
if ($category3 != ""){
    $ba_category = $code3_request[0]['idx'];
    $code3_sql = " and ta_category3 = '{$code3_request[0]['idx']}' ";
}
if ($area != ""){
    //콤마로 구분되서 복수개 담겨서 like 써줌
    $area_aql = " and ctg_option2 like '%{$area}%' ";
}

$sql = " select count(*) as cnt from {$g5['talent_table']} 
  where ta_imsi = 'N' and ta_category1 = {$category_key} ".$code2_sql.$code3_sql;

$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 16;
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
//$rows = 1;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $rows; // 시작 열을 구함

//메뉴명 링크에서 잘못 입력되었을 경우 틩김.
//if (empty($category_key) || empty($ctg2_result['code_idx']) ){
//    alert("올바른 경로로 들어와주세요", G5_URL.'/index.php');
//}

// 검색 필터
$filter = $_GET['filter'];
if(empty($filter) || $filter == "인기 순") {
    $filter = "인기 순";
    $orderby = " like_count desc ";
}
else if($filter == "신규등록 순") {
    $orderby = " ta.wr_datetime desc ";
}
else if($filter == "추천 순") {

}
else if($filter == "평점 순") {
    $orderby = " review_avg desc ";
}
else if($filter == "응답 순") {
    $orderby = " review_count desc ";
}

//리스트 쿼리(code_use => 카테고리 사용중인것만 데이터 표출)
$sql = "SELECT ta.*,
        (select pta_pay from new_pay_talent WHERE ta.ta_idx = ta_idx and pta_info = 1 ) as pta_pay,
        (select count(*) from new_payment_review where ta.ta_idx = ta_idx) as review_count,
        (select avg(rating) from new_payment_review where ta.ta_idx = ta_idx) as review_avg,
        (select count(*) from new_like where ta.ta_idx = ta_idx) as like_count        
        FROM {$g5['talent_table']} as ta
        left join {$g5['category_service_table']} as ctg on ctg.ta_idx = ta.ta_idx
        left join new_code as cd2 on cd2.code_idx = ta.ta_category2
        left join new_code as cd3 on cd3.code_idx = ta.ta_category3
        where ta_imsi = 'N' and ta_category1 = {$category_key} ".$code2_sql.$code3_sql.$area_aql."
        and cd2.code_use = '1' and cd3.code_use = '1'
        order by {$orderby} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);
//잡고 플러스 광고 출력
$sql = "select * from new_talent_ad where ad_category = '{$ba_category}'
        and date_format(ad_start_date, '%Y-%m-%d') >= '".G5_TIME_YMD."'
        AND date_format(ad_end_date, '%Y-%m-%d') <= '".G5_TIME_YMD."' order by ad_number desc";
$ad_result = sql_query($sql);
if (sql_num_rows($ad_result) == 0){
    $ba_p_code = p_common_code($ba_category);
    $sql = "select * from new_talent_ad where ad_category = '{$ba_p_code['idx']}' and date_format(ad_start_date, '%Y-%m-%d') >= '".G5_TIME_YMD."'
        AND date_format(ad_end_date, '%Y-%m-%d') <= '".G5_TIME_YMD."' order by ad_number desc";
    $ad_result = sql_query($sql);
    if (sql_num_rows($banner_result) == 0){
        $sql = "select * from new_talent_ad where ad_category = '{$ba_p_code['idx']}' and date_format(ad_start_date, '%Y-%m-%d') >= '".G5_TIME_YMD."'
        AND date_format(ad_end_date, '%Y-%m-%d') <= '".G5_TIME_YMD."' order by ad_number desc";
        $ad_result = sql_query($sql);
    }
}


// 페이지 클릭 할 때 뒤에 GET데이터 붙이기 위해서 만듬
$made_qstr = '';
$made_qstr .= '&amp;filter=' .$filter.'&amp;category=' .$category. '&amp;category2='.$category2. '&amp;category3='.$category3;

if ($category2 == ""){
    $category2 = "전체";
}

$now_url = $_SERVER['REQUEST_URI'];
$now_url =  explode('&area',$now_url);
$now_url = $now_url[0];


include_once($member_skin_path.'/category_list.skin.php');

include_once('./_tail.php');
?>