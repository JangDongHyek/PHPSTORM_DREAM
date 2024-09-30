<?php
include_once("../common.php");
/**
 * 메뉴안내 및 주문 - 도시락 메뉴 상세 모달 데이터 (ajax)
 */

$do = sql_fetch(" select * from g5_dosirak where idx = '{$idx}' ");
$img = sql_fetch(" select * from g5_dosirak_img where dosirak_idx = '{$idx}' ");
?>
<div class="modal-header">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php
            $rlt = sql_query(" select * from g5_dosirak_img where dosirak_idx = '{$do['idx']}' order by idx ");
            while($file = sql_fetch_array($rlt)) { ?>
                <div class="swiper-slide"><img src="<?php echo G5_DATA_URL ?>/file/dosirak/<?=$file['img_file']?>" /></div>
            <?php } ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
    </div>
    <h4 class="modal-title" id="myModalLabel">
        <?=$do['do_name']?> <strong><?=number_format($do['do_price'])?>원</strong> <!--도시락이름/도시락가격-->
    </h4>
</div>
<div class="modal-body">
    <!--도시락설명-->
    <?=nl2br($do['do_contents'])?>
</div>
<div class="modal-footer">
    <div class="ft_btn">
        <!--<a href="<?php /*echo G5_URL */?>/app/guide.php?idx=<?/*=$do['idx']*/?>" type="button" class="b02">주문하기</a>-->
        <?php if($do['do_category'] == '행사용') { ?>
        <a href="<?php echo G5_URL ?>/app/order_event.php?idx=<?=$do['idx']?>" type="button" class="b02">주문하기</a>
        <?php } else { ?>
        <!--<a href="<?php /*echo G5_URL */?>/app/order_deli.php?idx=<?/*=$do['idx']*/?>" type="button" class="b02">주문하기</a>-->
        <a href="<?php echo G5_URL ?>/app/cal_order.php" type="button" class="b02">주문하기</a>
        <?php } ?>
    </div>
</div>
