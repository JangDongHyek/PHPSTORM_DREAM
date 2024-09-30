<?php
$pid = "menu_salad";
include_once("./app_head.php");
/**
 * 메뉴안내 및 주문 - 샐러드팩
 */
?>
<?php include_once("./app_lnb.php"); ?>
<div id="container">
	<div id="menu_info">
	    <!--샐러드팩-->
    	<div class="title">
    	<h3><?=$lnb_name?></h3>
        <p>샐러드팩은 하루전 주문이 가능합니다.</p>
		</div>
        <!--ajax.dosirak_list.php-->
        <ul class="dosi_list"></ul>

        <?php include_once("./menu_modal.php"); // 도시락상세?>
        <!--//샐러드팩-->
    </div>
</div>
<!-- Modal -->

<script>
    $(function() {
        // 도시락 리스트
        dosirakList('menu_salad');
    })
</script>

<?php
include_once ("./app_tail.php");
?>