<?php
$pid = "guide";
include_once("./app_head.php");
/**
 * 주문전 사전안내사항
 */

if(!$private) {
    orderCheck(date('H:i')); // 주문가능시간 체크
}

//$do = sql_fetch(" select * from g5_dosirak where idx = '{$idx}' ");
//if($do['do_category'] == '정기배달') {
//    $go_url = APP_URL.'/cal_order.php';
//} else {
//    $go_url = APP_URL.'/order_event.php?idx='.$idx;
//}
$go_url = APP_URL.'/cal_order.php'; // 정기배달도시락 주문페이지로 이동 (행사용 링크는 필요없다고 함)
?>

<div id="guide">

	<h3>준도시락 이용시, 사전안내사항</h3>
    <ul>
        <li><span class="num">1.</span> 준도시락 이용시, 사전안내사항
            <dl>
                <dt>정기도시락</dt>
                <dd>부산지역만 배송가능</dd>
                <dd><strong>일 4개</strong> 이상, <strong>주 4회</strong> 이상 주문시에만 배송가능</dd>
                <dd>도시락 <strong>배송 날짜 하루 전 날 까지</strong> 주문가능 </dd>
                <dd>도시락 <strong>주문 수정</strong>은 배송 전날 또는 <strong>당일 오전 8시 전 까지</strong>만 가능</dd>
                <dd>도시락 <strong>수거</strong>는 배송일 다음 날 진행되오니 식사 후 배송된 가방에 잘 정리하여 넣어주시기 바랍니다.</dd>
            </dl>
            <dl>
                <dt>행사용도시락</dt>
                <dd><a href="tel:15333473">1533-3473</a> → 전화 문의 부탁드립니다.</dd>
                <dd>도시락 주문 및 수정은 배송일 기준 2일 전까지만 가능 </dd>
                <dd>※<strong>수거 요청시</strong>, 행사용 도시락은 개당 수거 비용이 발생하오니, 참고바랍니다.</dd>
            </dl>
        </li>
        <li><span class="num">2.</span>
            배송 날짜 및 메뉴 주문 관련 실수에 대해선 해당 주문자의 권한이므로, 업체 측 책임이 없음을 미리 숙지하여 주시기 바랍니다.
            (※<strong>주문시, 반드시 해당년도/월/일/수량/주소/메뉴를 재확인 바랍니다</strong>)
        </li>
        <li><span class="num">3.</span>
            배송시간 관련하여 최대한 시간을 맞춰드리고자 하오나, 도로 교통 상황 및 기상악화 등 여러 변수로 인하여 정확한 배송시간 지정이 힘든 점 양해 부탁드립니다.
        </li>
        <li><span class="num">4.</span>
            배송완료 후 2시간 이내 섭취 권유, 미 섭취 시 냉장보관 후 당일 섭취권유
        </li>
        <li><span class="num">5.</span>
            결제 관련 및 상세사항은 공지사항을 반드시 참고해주시기 바랍니다.
        </li>


    </ul>
    <div class="ft_btn">
    <p>상기의 내용을 모두 동의하시면 <!--<strong>체크 및 동의 후</strong>,<br />-->
    다음 주문 단계로 이동하겠습니다.</p>
    <button onclick="location.href='<?=$go_url?>'">상기의 내용을 모두 동의하겠습니다</button>
    </div>
</div>

<?php
include_once ("./app_tail.php");
?>
