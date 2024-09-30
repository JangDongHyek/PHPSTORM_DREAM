<?php
$pid = "menu_warm";
include_once("./app_head.php");
/**
 * 메뉴안내 및 주문 - 발열도시락
 */
?>
<?php include_once("./app_lnb.php"); ?>
<div id="container">
	<div id="menu_info">
	    <!--발열도시락-->
    	<div class="title">
    	<h3><?=$lnb_name?></h3>
        <p>분리발열 식품용기로 따뜻한 음식과 찬음식을 가장 맛있는 온도로 제공해 드립니다.</p>
		</div>
        <!--ajax.dosirak_list.php-->
        <ul class="dosi_list">
        	<li>
            	<div class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/menu03_01.jpg" /></div>
                <p>정기배달 발열도시락
                <strong>+1,000원(부가세별도)</strong></p>
            </li>
        	<li>
            	<div class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/menu03_02.jpg" /></div>
                <p>일반 행사용 발열도시락
                <strong>+1,000원(부가세별도)</strong></p>
            </li>
        	<li>
            	<div class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/menu03_03.jpg" /></div>
                <p>명품 행사용 발열도시락
                <strong>추가금액없음</strong></p>
            </li>
        </ul>

        <?php //include_once("./menu_modal.php"); // 도시락상세?>
        <!--//발열도시락-->
    </div>
</div>
<!-- Modal -->

<script>
    $(function() {
        // 도시락 리스트
        //dosirakList('menu_warm');
    })
</script>

<?php
include_once ("./app_tail.php");
?>