<?php
include_once ("./_common.php");
/**
 * 마이페이지 - 자료실 (ajax)
 */

if($like == 'like') { // 찜한 자료만 보기
    $like_reference = sql_fetch(" select group_concat(reference_idx) as like_reference from g5_like_reference where mb_id = '{$member['mb_id']}' ")['like_reference'];
    $sql_search .= " and reference_idx in ({$like_reference}) ";
}

if(!empty($filter)) { // 유료/무료 필터
    $filter = explode(',', $filter);
    if(count($filter) > 1) $filter = "'".$filter[0]."','".$filter[1]."'";
    else $filter = "'".$filter[0]."'";

    $sql_search .= " and rr_is_free in ({$filter}) ";
}

// 검색 (검색어 입력) 내용/제목/태그
if(!empty(trim($search))) {
    $sql_search .= " and (rr_subject like '%{$search}%' or strip_tags(rr_contents) like '%{$search}%' or rr_hashtag like '%{$search}%' or FIND_IN_SET('{$search}', rr_hashtag)) ";
}

// 페이징
if($mode == 'b') { // 다운로드
    $sql = " select count(distinct reference_idx) as cnt from g5_reference_room_download as a left join g5_reference_room as b on a.reference_idx = b.idx where 1=1 and a.mb_id = '{$member['mb_id']}' {$sql_search} ";
} else if($mode == 's') { // 판매
    $sql = " select count(distinct reference_idx) as count from g5_reference_room_sale where sale_mb_id = '{$member['mb_id']}' {$sql_search} ";
} else if($mode == 'l') { // 찜한 자료
    $sql = " select count(*) as cnt from g5_like_reference as a inner join g5_reference_room as b on a.reference_idx = b.idx where 1=1 and a.mb_id = '{$member['mb_id']}' {$sql_search} ";
}
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 자료실 판매구매 리스트
if($mode == 'b') { // 다운로드
    $sql = " select b.*, max(a.wr_datetime) AS buy_date from g5_reference_room_download as a left join g5_reference_room as b on a.reference_idx = b.idx where 1=1 and a.mb_id = '{$member['mb_id']}' {$sql_search} group by a.reference_idx order by a.idx desc limit {$from_record}, {$rows} ";
} else if($mode == 's') { // 판매
    $sql = " select b.*, max(a.wr_datetime) AS sale_date from g5_reference_room_sale as a left join g5_reference_room as b on a.reference_idx = b.idx where 1=1 and sale_mb_id = '{$member['mb_id']}' {$sql_search} group by a.reference_idx order by a.idx desc limit {$from_record}, {$rows} ";
} else if($mode == 'l') { // 찜한 자료
    $sql = " select b.* from g5_like_reference as a inner join g5_reference_room as b on a.reference_idx = b.idx where 1=1 and a.mb_id = '{$member['mb_id']}' {$sql_search} ";
}
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    // 자료 idx
    $reference_idx = $row['idx'];

    // 파일 정보
    $file = sql_fetch(" SELECT * FROM g5_reference_room_file WHERE mode = 'file' AND reference_idx = '{$reference_idx}' ORDER BY idx LIMIT 1 ");

    // 썸네일
    $thumb_img = sql_fetch("SELECT * FROM g5_reference_room_file WHERE reference_idx = '{$reference_idx}' AND mode = 'thumb' ORDER BY idx limit 1")['img_file'];
    $thumb_src = G5_DATA_URL.'/file/reference/'.$thumb_img;

    $rr_cls = '';
    $gubun = 'add';
    // 찜 목록에 있음
    $cnt = sql_fetch(" SELECT COUNT(*) AS cnt from g5_like_reference WHERE reference_idx = '{$reference_idx}' AND mb_id = '{$member['mb_id']}' ")['cnt'];
    if($cnt > 0) {
        $rr_cls = 'on';
        $gubun = 'del';
    }

    if($mode == 's') {
        // 총 판매 횟수
        $total_sale_cnt = sql_fetch(" select count(*) as cnt from g5_reference_room_sale where reference_idx = '{$reference_idx}' ")['cnt'];
        // 마지막 판매일
        $sale_date = sql_fetch(" select wr_datetime as sale_date from g5_reference_room_sale where reference_idx = '{$reference_idx}' order by idx desc limit 1 ")['sale_date'];
    }

    $code = base64_encode("refer".rand(0,100).'_'.$row['idx']);
?>
<li>
    <a href="<?=G5_BBS_URL?>/shop_view.php?code=<?=$code?>">
    <div class="img_wrap">
        <img src="<?=$thumb_src?>">
        <p class="wish <?=$rr_cls?>" onclick="event.preventDefault();likeReference('<?=$reference_idx?>', '<?=$gubun?>');likeCount()"><i class="fal fa-heart"></i></p>
        <?php if($row['rr_is_free']=='N') { ?><p class="coin">유료</p><?php } ?>
    </div>
    </a>
    <div class="text" onclick="location.href='<?=G5_BBS_URL?>/shop_view.php?code=<?=$code?>'">
        <p class="cate"><?=$row['rr_category']?></p>
        <h4 class="title"><?=$row['rr_subject']?></h4>
        <div class="exp"><?=nl2br(strip_tags($row['rr_contents']))?></div>
        <div class="price"><?php if($row['rr_is_free']=='N') { ?><strong><?=number_format($row['rr_price'])?></strong>원<?php } else { ?>무료<?php } ?></div>
    </div>
    <div class="btn_wrap">
        <?php if($mode == 'l') { // 찜한 자료 ?>
        <?php if($row['mb_id'] != $member['mb_id']) { // 내 자료면 채팅 x ?>
        <button class="btn_chat" onclick="chatting('<?=$row['mb_id']?>');"><i class="fal fa-comments-alt"></i>  판매자와 1:1채팅하기</button>
        <?php } ?>
        <button style="display: none;"></button>
        <button style="display: none;"></button>
        <?php } else { ?>
        <?php if($mode == 'b') { ?>
        <p class="date">구매일 <?=substr($row['buy_date'], 0, 10)?></p>
        <?php if($row['mb_id'] != $member['mb_id']) { // 내 자료면 채팅 x ?>
        <button class="btn_chat" onclick="chatting('<?=$row['mb_id']?>');"><i class="fal fa-comments-alt"></i>  판매자와 1:1채팅하기</button>
        <?php } ?>
        <button class="btn_down" onclick="downloadHistory('<?=$row['idx']?>');fileDownload('reference', '<?=$file['img_file']?>', '<?=$file['img_source']?>')"><i class="fal fa-arrow-to-bottom"></i> 파일 다운로드</button>
        <button class="btn_review" onclick="reviewModal('<?=$row['idx']?>')"><i class="fal fa-comment-smile"></i> 리뷰 작성</button>
        <?php } else { ?>
        <p class="date">판매일 <?=substr($sale_date, 0, 10)?></p> <!--마지막 판매일-->
        <dl class="total">
            <dt>총 판매 횟수</dt>
            <dd><strong><?=number_format($total_sale_cnt)?></strong>회</dd>
        </dl>
        <?php } ?>
        <?php } ?>
    </div>
</li>
<?php
}
if($i==0) {
?>
<li class="nodata" style="text-align: center;">등록된 내용이 없습니다.</li>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>

