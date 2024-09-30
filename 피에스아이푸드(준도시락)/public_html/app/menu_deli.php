<?php
$pid = "menu_deli";
include_once("./app_head.php");
/**
 * 메뉴안내 및 주문 - 정기배달도시락
 */
?>
<?php include_once("./app_lnb.php"); ?>
<div id="container">
	<div id="menu_info">
	    <!--정기배달도시락-->
    	<div class="title">
    	<h3><?=$lnb_name?></h3>
        <!--<p>정기 배달 도시락은 최소 4개부터 배달 가능합니다.</p>-->
        </div>

        <!--ajax.dosirak_list-->
        <ul class="dosi_list"></ul>
	    <!--//정기배달도시락-->

        <?php include_once("./menu_modal.php"); // 도시락상세?>
    </div>
</div>
<!-- Modal -->

<script>
    $(function() {
        // 도시락 리스트
        dosirakList('menu_deli');
    })

    // 메뉴 이동 시
    // function moveMenu(menu) {
    //     dosirakList(menu);
    // }
</script>

<?php
include_once ("./app_tail.php");
?>