<?php
$pid = "cal_order_view";
include_once("./app_head.php");
/**
 * 사용안함
 */
?>
<div>
</div>
<div id="container">
    <div id="order_view">
        <h3><strong>행사용도시락 주문내역</strong> <span>22.11.12</span></h3>
        <div class="menu">
            <dl>
                <?php /*?><dt><i class="fa-light fa-calendar-check"></i> 5월 14일 (토요일)</dt><?php */?>
                <dd><span>(일반) 미트볼스파게타 도시락 10개</span><strong>99,000원</strong></dd>
                <dd><span>(일반) 훈제삼겹도시락 10개</span><strong>99,000원</strong></dd>
            </dl>
        </div>
        <div class="total">
            <span>합계</span> <strong>594,000원</strong>
        </div>

        <br />

        <h3>배송지정보</h3>
        <div class="info">
            <dl class="addr">
                <dt>주문배송지</dt>
                <dd>[48059] 부산 해운대구 센텀동로 6(우동)</dd>
            </dl>
            <dl class="date">
                <dt>받는사람</dt>
                <dd>홍길동</dd>
            </dl>
            <dl class="date">
                <dt>연락처</dt>
                <dd>010-1111-1111</dd>
            </dl>
            <dl class="memo">
                <dt>메모</dt>
                <dd>메모메모메모</dd>
            </dl>
        </div>

        <div class="ft_btn">
            <!--<a href="" class="btn edit">정보변경</a>-->
            <a class="btn ing">주문접수</a>
            <!--
            주문접수/배송중 class:ing
            배달완료 class:end
            -->
        </div>

    </div>
</div>

<?php
include_once ("./app_tail.php");
?>
