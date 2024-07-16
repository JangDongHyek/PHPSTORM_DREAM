<?php
include_once('./_common.php');

/** 기업검색 - 기업리뷰 (ajax) **/

$mb = sql_fetch(" select * from g5_member where mb_no = '{$mb_no}' "); // 기업정보

// 페이징
$sql = " select count(*) as cnt from g5_company_inquiry_result where estimate_mb_id = '{$mb['mb_id']}' ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$rlt = sql_query(" select * from g5_company_inquiry_result where estimate_mb_id = '{$mb['mb_id']}' order by idx desc limit {$from_record}, {$rows} "); // 리뷰리스트
while($row = sql_fetch_array($rlt)) {
    // 아이디 * 처리
    $str = iconv_substr($row['inquiry_mb_id'], 0, 1, "utf-8");
    for ($a = 0; $a < (mb_strlen($row['inquiry_mb_id'], "utf-8") -1); $a++) {
        $str .= '*';
    }
    $writer = $str;

    // 후기
    $review = explode(',', $row['review']);
?>
<li>
    <div class="area_top">
        <div class="area_star">
            <div class="img_star v<?=$row['star_score']?>">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <span><?=$row['star_score']?> star</span>
        </div>
        <div class="area_cont">
            <?php
            for($i=0; $i<count($review); $i++) {
                if($review[$i] == '5') {
                ?>
                <p><?=$row['review_etc']?></p>
                <?php
                } else {
                ?>
                <p><?=$company_review[$review[$i]]?></p>
                <?php
                }
            ?>
            <?php
            }
            ?>
        </div>
        <div class="">

        </div>
    </div>
    <div class="list_info">
        <span class="name"><?=$writer?></span>
        <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span>
    </div>
</li>
<?php
}
if($total_count == 0) {
?>
<li class="nodata" style="background: unset;">There are no company reviews.</li>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>