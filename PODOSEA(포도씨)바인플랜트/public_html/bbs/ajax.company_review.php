<?php
include_once('./_common.php');

/** 기업검색 - 기업리뷰 (ajax) **/

$mb = sql_fetch(" select * from g5_member where mb_no = '{$mb_no}' "); // 기업정보

// 차단한 회원
if($member['mb_id'] == 'test') {
    $block_cnt = sql_fetch(" select count(*) as cnt from g5_block where mb_id = '{$member['mb_id']}' ")['cnt'];
    if($block_cnt) {
        $rlt = sql_query(" select * from g5_block where mb_id = '{$member['mb_id']}' ");
        $block = '';
        while($tmp = sql_fetch_array($rlt)) {
            $block .= "'".$tmp['target_mb_id']."',";
        }
        $block = substr($block, 0, -1);
        $sql_add = " and inquiry_mb_id not in ($block) ";
    }
}

// 페이징
$sql = " select count(*) as cnt from g5_company_inquiry_result where estimate_mb_id = '{$mb['mb_id']}' {$sql_add} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$rlt = sql_query(" select * from g5_company_inquiry_result where estimate_mb_id = '{$mb['mb_id']}' {$sql_add} order by idx desc limit {$from_record}, {$rows} "); // 리뷰리스트
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
            <span><?=$row['star_score']?>점</span>
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
        <?php if($member['mb_id'] == 'test') { ?>
        <span style="cursor: pointer;" onclick="reportOpen('<?=$row['inquiry_mb_id']?>', 'g5_company_inquiry_result', '<?=$row['idx']?>')"><i class="fa-solid fa-ban"></i>신고</span>
        <span style="cursor: pointer;" onclick="blockReview('<?=$row['inquiry_mb_id']?>', 'g5_company_inquiry_result', '<?=$row['idx']?>');"><i class="fa-solid fa-ban"></i>차단</span>
        <?php } ?>
    </div>
</li>
<?php
}
if($total_count == 0) {
?>
<li class="nodata" style="background: unset;">기업리뷰가 없습니다.</li>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>