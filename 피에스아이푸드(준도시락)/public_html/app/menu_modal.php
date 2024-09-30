<?php
include_once("../common.php");
/**
 * 메뉴안내 및 주문 - 도시락 메뉴 상세 모달
 */
?>
<!--<div class="dosirak_view"></div>-->
<div class="modal fade" id="info01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <a type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?php echo G5_THEME_IMG_URL ?>/common/close_white.png" /></a>
        <!--ajax.dosirak_view.php-->
        <div class="modal-content"></div>
    </div>
</div>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        pagination: {
            el: ".swiper-pagination",
        },
    });
</script>