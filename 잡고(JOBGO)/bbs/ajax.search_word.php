<?php
include_once('./_common.php');

$option = $_POST['option'];
$category = $_POST['category'];
$stx = $_POST['stx'];

if(empty($option))  // 검색어 DB 저장
{
    $count = sql_fetch(" select count(*) as count from new_search_word where search_category = '{$category}' and search_word = '{$stx}'; ")['count'];
    if($count > 0) {
        $sql = " update new_search_word set search_count = search_count + 1 where search_category = '{$category}' and search_word = '{$stx}' ";
    } else {
        $sql = " insert into new_search_word set search_category = '{$category}', search_word = '{$stx}', search_count = search_count + 1 ";
    }
    sql_query($sql);
}
else { // 인기 검색어 조회
    $sql = " select * from new_search_word where search_category = '{$category}' and search_word like '%{$stx}%' order by search_count desc limit 0,10 ";
    $result = sql_query($sql);

    $array = array();
    for($i=0; $row = sql_fetch_array($result); $i++) {
        array_push($array, $row);
    }

    echo json_encode($array);
}
?>