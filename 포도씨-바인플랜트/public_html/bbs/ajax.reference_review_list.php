<?php
include_once ("./_common.php");

/**
 * 자료실 - 리뷰 목록
 */

// 정렬
$sql_orderby = " ORDER BY wr_datetime DESC ";
if($orderby == '최신순') { // 최신순
    $sql_orderby = " ORDER BY wr_datetime DESC ";
}
else if($orderby == '별점 높은순') { // 별점 높은순
    $sql_orderby = " ORDER BY score DESC ";
}
else { // 별점 낮은순
    $sql_orderby = " ORDER BY score ASC ";
}

// 페이징
$sql = " SELECT COUNT(*) AS cnt FROM g5_reference_room_review WHERE reference_idx = '{$idx}' ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$review_sql = " SELECT * FROM g5_reference_room_review WHERE reference_idx= '{$idx}' {$sql_orderby}  LIMIT {$from_record}, {$rows} ";
$review_rlt = sql_query($review_sql);
for($i=0; $review=sql_fetch_array($review_rlt); $i++) {
    // 아이디 마스킹 처리
    $length = strlen($review['mb_id']) - 2;
    $firstId = substr($review['mb_id'], 0, 2);
    $starTxt = "";
    for ($a = 0; $a<$length; $a++) {
        $starTxt .= "*";
    }
    $review_mb_id = $firstId . $starTxt;
?>
    <li>
        <p class="name"><?=$review_mb_id?></p>
        <p class="star"><strong><i class="fas fa-star"></i> <?=sprintf("%0.1f", $review['score'])?></strong> <span><?=substr($review['wr_datetime'], 0, 10)?></span></p>
        <p class="cont"><?=nl2br($review['review'])?></p>
    </li>
    <?php
}
if($i==0) {
    ?>
    <li class="empty">이 자료에 대해 작성된 후기가 없습니다.</li>
    <?php
}
?>
