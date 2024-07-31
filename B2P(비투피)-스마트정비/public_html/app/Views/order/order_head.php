<div class="tit_wrap">
    <h6 class="menu01">판매 관리</h6>
    <div class="menu02">
        <!--
        <a href="<?=base_url('order/waiting')?>" <?php if($pid == "waiting_list" || $pid == "") { echo "class='active'"; } ?>>입금확인중</a>
        <a href="<?=base_url('order/state')?>" <?php if($pid == "state_list" || $pid == "") { echo "class='active'"; } ?>>발송처리현황</a>
        <a href="<?=base_url('order/search')?>" <?php if($pid == "order_search") { echo "class='active'"; } ?>>주문통합검색</a>
        -->
        <a href="<?=base_url('order/new')?>" <?php if($pid == "new_list") { echo "class='active'"; } ?>>신규주문 관리</a>
        <a href="<?=base_url('order/send')?>" <?php if($pid == "send_list") { echo "class='active'"; } ?>>발송 관리</a>
        <a href="<?=base_url('order/deliver')?>" <?php if($pid == "deliver_list") { echo "class='active'"; } ?>>배송 현황 </a>
        <a href="<?=base_url('order/confirm')?>" <?php if($pid == "confirm_list") { echo "class='active'"; } ?>>구매결정완료</a>
        <a href="<?=base_url('order/cancel')?>" <?php if($pid == "cancel_list") { echo "class='active'"; } ?>>취소 관리</a>
        <a href="<?=base_url('order/return')?>" <?php if($pid == "return_list") { echo "class='active'"; } ?>>반품 관리</a>
        <a href="<?=base_url('order/exchange')?>" <?php if($pid == "exchange_list" ) { echo "class='active'"; } ?>>교환 관리</a>
    </div>
</div>