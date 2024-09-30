<?php
$pid = "menu_event";
include_once("./app_head.php");
/**
 * 메뉴안내 및 주문 - 행사용도시락
 */
?>
<?php
include_once("./app_lnb.php");
?>
<div id="container">
	<div id="menu_info">
	    <!--행사용도시락-->
    	<div class="title">
    	<h3><?=$lnb_name?></h3>
        <p>행사용 도시락은 하루전 주문이 가능합니다<br />
        단, 명품도시락은 이틀전 주문가능합니다.<br />
        (*배송비는 별도입니다)</p>
        </div>
        
        <!--ajax.dosirak_list.php-->
        <ul class="half dosi_list"></ul>
	    <!--//행사용도시락-->

        <?php include_once("./menu_modal.php"); // 도시락상세?>
   </div>
</div>
<!-- Modal -->

<script>
    $(function() {
        // 도시락 리스트
        dosirakList('menu_event');
    })
</script>

<?php
include_once ("./app_tail.php");
?>