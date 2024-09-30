<?php
$pid = "cal_order_list";
include_once("./app_head.php");
/**
 * 22.05.20
 * 주문내역 (new) (정기배달/행사도시락 구분)
 * 정기배달도시락 주문내역 상세보기 ==> app/cal_order_details.php
 * 행사용도시락 주문내역 상세보기 ==> app/cal_order_details2.php
 * 샐러드팩은 정기배달 메뉴로 통합
 * 작업 완료 시 app/order_list.php 사용 X
 */

loginCheck($member['mb_id']);
?>
<div id="container">
    <div id="order_link">
        <div class="text">
        해당 주문내역을 확인하세요
        </div>
        <div class="btn_set">
        <input type="button" value="정기배달도시락" onclick="location.href='./cal_order_details.php'">
        <input type="button" value="행사용도시락" onclick="location.href='./cal_order_details2.php'">
        </div>
    </div>
    <!--<div id="order_list">
        <ul class="ord_list v2">
        	<li>
            	<span class="date">주문날짜 2022.05.20</span>
            	<h3><strong>행사용도시락 주문내역</strong> <a href="#">상세보기<i class="fa-regular fa-angle-right"></i> </a></h3>
                <p class="menu"><span>일반정기도시락 외 10개</span> <strong>210,000원</strong></p>
            </li>
        	<li>
            	<span class="date">주문날짜 2022.05.20</span>
            	<h3><strong>정기도시락 주문내역</strong> <a href="#">상세보기<i class="fa-regular fa-angle-right"></i> </a></h3>
                <p class="menu"><span>일반정기도시락 외 10개</span> <strong>210,000원</strong></p>
            </li>
        </ul>
        <div id="paging"></div>
    </div>-->
</div>

<?php
include_once ("./app_tail.php");
?>
