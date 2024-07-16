<?php
include_once ("./_common.php");
/**
 * 자료실 목록
 */

$sql_orderby = " order by wr_datetime desc ";

// 카테고리
if(!empty($tab)) {
    $sql_search .= " and rr_category = '{$tab}' ";
} else {
    $sql_orderby = " order by download desc "; // 인기자료는 다운로드 많은 순
}

// 검색 (검색어 입력) 내용/제목/태그
if(!empty(trim($search))) {
    $sql_search .= " and (rr_subject like '%{$search}%' or strip_tags(rr_contents) like '%{$search}%' or rr_hashtag like '%{$search}%' or FIND_IN_SET('{$search}', rr_hashtag)) ";
}

// 정렬
if(empty($orderby) || $orderby == '최신순') { // 최신순
    if(!empty($sql_orderby)) $sql_orderby .= " , wr_datetime desc ";
    else $sql_orderby = " order by wr_datetime desc ";
}
else if($orderby == '별점 높은순') { // 별점 높은순
    if(!empty($sql_orderby)) $sql_orderby .= " , idx desc ";
    else $sql_orderby = " order by idx desc ";
}

// 무료 자료만 보기
if($is_free == "Y") $sql_search .= " and rr_is_free = 'Y' ";

// 페이징
$sql = " SELECT COUNT(*) AS cnt FROM g5_reference_room WHERE del_yn = 'N' {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 12;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select a.*, (select count(idx) from g5_reference_room_download where reference_idx = a.idx) as download from g5_reference_room as a where a.del_yn = 'N' {$sql_search} {$sql_orderby} LIMIT {$from_record}, {$rows} ";
// echo $sql;
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    //해시태그
    $hashtag = '';
    if(!empty($row['rr_hashtag'])) {
        $tag = explode(',',$row['rr_hashtag']);
        for($j=0; $j<count($tag); $j++) {
            $hashtag .= '<li onclick="tag_search(\''.$tag[$j].'\');">'.$tag[$j].'</li>';
        }
    }
    $thumb_img = sql_fetch("SELECT * FROM g5_reference_room_file WHERE reference_idx = '{$row['idx']}' AND mode = 'thumb' ORDER BY idx limit 1")['img_file'];
    $thumb_src = G5_DATA_URL.'/file/reference/'.$thumb_img;

    $rr_cls = '';
    $mode = 'add';
    // 찜 목록에 있음
    $cnt = sql_fetch(" SELECT COUNT(*) AS cnt from g5_like_reference WHERE reference_idx = '{$row['idx']}' AND mb_id = '{$member['mb_id']}' ")['cnt'];
    if($cnt > 0) {
        $rr_cls = 'on';
        $mode = 'del';
    }

    // 구매 수
    $buy_count = sql_fetch(" select count(*) as cnt from g5_reference_room_sale where reference_idx = '{$row['idx']}' ")['cnt'];

    // 리뷰 (최신 후기 중 별점 제일 높은 것)
    $review = sql_fetch("SELECT score, review from g5_reference_room_review WHERE reference_idx = '{$row['idx']}' order by score desc, wr_datetime desc limit 1 ");
    if(empty($review['socre'])) $review['socre'] = '0.0';

    $code = base64_encode("refer".rand(0,100).'_'.$row['idx']);
?>
<li>
    <a href="<?=G5_BBS_URL?>/shop_view.php?code=<?=$code?>">
    <div class="img">
        <p class="img_wrap"><img src="<?=$thumb_src?>"></p>
        <p class="wish <?=$rr_cls?>" onclick="event.preventDefault();likeReference('<?=$row['idx']?>', '<?=$mode?>')"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
        <?php if($row['rr_is_free']=='N') { ?><p class="coin">유료</p><?php } ?>
    </div>
    <div class="text">
        <ul class="tag"><?=$hashtag?></ul>
        <p class="title"><?=$row['rr_subject']?></p>
        <p class="gray">구매 <?=number_format($buy_count)?>건</p>
        <p class="price"><?php if($row['rr_is_free']=='N') { ?><strong><?=number_format($row['rr_price'])?></strong>원<?php } else { ?>무료<?php } ?></p>
    </div>
    <div class="review">
        <strong><i class="fas fa-star"></i><?=sprintf("%0.1f", $review['score'])?></strong>
        <?=$review['review']?>
    </div>
    </a>
</li>
<?php
}
if($i==0) {
?>
<li class="nodata">자료가 없습니다.</li>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
