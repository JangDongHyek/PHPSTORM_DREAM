<?php
$sub_id = "search_page";
include_once('./_common.php');
include_once(G5_LIB_PATH . "/thumbnail.lib.php");

$g5['title'] = '검색 결과';
include_once('./_head.php');

$option = $_REQUEST['option'];
$stx = $_REQUEST['stx'];
$table_name = 'new_'.$option;
$title_name = "";
$category_name = "";
$file_name = "";
//카테고리 선택 시 GET으로 받아오는 값
$ctg = $_REQUEST['ctg'];

if ($option == 'talent'){
    $title = 'ta_title';
    $title_name = '재능';
    $idx = 'ta_idx';
    $url = "/item_view.php?idx=";
    $category_name = 'ta_category1';
    $file_name = $option;

    //임시저장값 걸러냄
    $imsi_sql = " and ta_imsi = 'N' ";

}else if($option == 'video_lecture'){
    $title = 'wr_subject';
    $table_name = 'g5_write_'.$option;
    $title_name = '지식재능강의';
    $idx = 'wr_id';
    $url = "/board.php?bo_table=video_lecture&wr_id=";
    $category_name = 'ca_name';
    $file_name = "";
}else if($option == 'competition'){
    $title = 'cp_title';
    $title_name = '공모전';
    $idx = 'cp_idx';
    $url = "/contest_view.php?idx=";
    $category_name = 'cp_category1';
    $file_name = "competition_main";


}

if ($ctg != ""){
    $ctg_sql = "and {$category_name} = '{$ctg}'";
}
if ($option != 'video_lecture'){
    $code_use_sql = "and cd1.code_use = '1'";
}

$made_qstr = 'option='.$option.'&stx='.$stx.'&ctg='.$ctg;

//카테고리 생성
$sql = "select {$category_name},count({$category_name}) cnt from {$table_name} ta
        left join new_code as cd1 on cd1.code_idx = ta.{$category_name}
        where {$title} like '%{$stx}%' {$code_use_sql} {$imsi_sql} group by {$category_name} order by code_number";
$ctg1_result = sql_query($sql);
$ctg_html = "";

if ($ctg == '' || empty($ctg)){
    $empty_class = "check";
}
$ctg_html .= "<li class='".$empty_class."'><a href='" . G5_BBS_URL . '/search.php?option=' . $option . "&stx=" . $stx . "&page=" . $page . "'>전체</a></li>";

for ($i = 0; $ctg1_arr = sql_fetch_array($ctg1_result); $i++){
    $href = G5_BBS_URL."/search.php?option=".$option."&stx=".$stx."&ctg=".$ctg1_arr[$category_name];
    $ctg1_code = common_code($ctg1_arr[$category_name], 'code_idx', 'json')[0]['name'];
    $class = "";
    if ($ctg == $ctg1_arr[$category_name]){
        $class = "check";
    }

    if ($category_name != "ca_name") {
        $ctg_html .= "<li class='".$class."'><a href='".$href."'>" . $ctg1_code . "(" . number_format($ctg1_arr['cnt']) . ")</a></li>";
    }else{
        $ctg_html .= "<li class='".$class."'><a href='".$href."'>" .$ctg1_arr[$category_name]. "(" . number_format($ctg1_arr['cnt']).")</a></li>";
    }
}


$sql = "select count(ta.wr_datetime) cnt from {$table_name} ta
        left join new_code as cd1 on cd1.code_idx = ta.{$category_name}
        where {$title} like '%{$stx}%' {$ctg_sql} {$code_use_sql} {$imsi_sql} order by ta.wr_datetime desc";
$result_cnt = sql_fetch($sql)['cnt'];

$total_count = $result_cnt;

$rows = 12;
//$rows = 1;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = "select * from {$table_name} ta
        left join new_code as cd1 on cd1.code_idx = ta.{$category_name}
        where {$title} like '%{$stx}%' {$ctg_sql} {$code_use_sql} {$imsi_sql} order by ta.wr_datetime desc limit {$from_record}, {$rows}";
$result = sql_query($sql);

include_once($search_skin_path.'/search.skin.php');

include_once('./_tail.php');
?>
