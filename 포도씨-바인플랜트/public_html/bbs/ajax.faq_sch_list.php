<?php
include_once("./_common.php");

/** 자주묻는질문 - 검색 결과 (ajax) **/

// 검색 (검색어 입력)
if(!empty($search)) {
    $sql_search .= " and (subject like '%{$search}%' or strip_tags(contents) like '%{$search}%') ";
}

// 페이징
$sql = " select count(*) as cnt from g5_cs_faq where 1=1 {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 공지 우선 정렬
$rlt = sql_query(" select * from g5_cs_faq where 1=1 {$sql_search} order by notice = 'Y' desc, idx desc limit {$from_record}, {$rows} ");
while($row = sql_fetch_array($rlt)) {
?>
<li>
<a href="<?=G5_BBS_URL?>/faq_view.php?idx=<?=$row['idx']?>">
    <div class="subject"><h3><?=$row['subject']?></h3></div>
    <span class="contents"><?=strip_tags($row['contents'])?></span>
    <div class="list_info">
        <span class="id">고객센터</span>
        <span class="data"><?=$row['category']?></span>
    </div>
</a>
</li>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
<span id="total_count" name="total_count" style="display: none;"><?=$total_count?></span>