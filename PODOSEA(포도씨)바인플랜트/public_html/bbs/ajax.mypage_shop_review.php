<?php
include_once ("./_common.php");
/**
 * 마이페이지 - 자료실 - 리뷰작성 모달
 */

$mode = 'r'; // 등록
$cnt = sql_fetch(" select count(*) as cnt from g5_reference_room_review where reference_idx = '{$reference_idx}' and mb_id = '{$member['mb_id']}' ")['cnt'];
if($cnt > 0) {
    $mode = 'u'; // 수정
    $sql = " select * from g5_reference_room_review where reference_idx = '{$reference_idx}' and mb_id = '{$member['mb_id']}' ";
    $review = sql_fetch($sql);
}
?>
<div id="star_rating">
    <p class="star_rating">
        <?php
        for($i=1; $i<=5; $i++) {
        ?>
        <a href="#" name="score_<?=$i?>" <?php echo $i <= $review['score'] || empty($review['score']) ? 'class="on"' : ''; ?>><i class="fas fa-star"></i></a>
        <?php
        }
        ?>
    </p>
</div>
<!--star_rating-->

<div class="area_check">
    <form i="freview" name="freview">
        <ul class="check_list">
            <li>
                <textarea id="review" name="review" <?=$readonly?> placeholder="리뷰를 입력해 주세요."><?=$review['review']?></textarea>
            </li>
        </ul>
    </form>
</div>
<div class="area_btn popup col02">
    <a class="btn_send" href="javascript:reviewRegister('<?=$reference_idx?>', '<?=$mode?>');">작성완료</a>
    <a href="#" class="btn_send v2" data-dismiss="modal">닫기</a>
</div>
