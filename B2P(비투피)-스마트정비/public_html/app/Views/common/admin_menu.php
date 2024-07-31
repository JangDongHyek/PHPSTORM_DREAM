<div id="left_menu">
    <div class="logo">
        <img src="/img/common/logo.png" alt="">
    </div>
    
    <div class="user_info">

        <p><i class="fa-duotone fa-circle-user"></i> <strong><?=$member['mb_name']?></strong> 님 안녕하세요!</p>
        <div class="log_btn">
            <a href="<?= base_url("member/member_form?w=u&mb_no={$member['mb_no']}"); ?>">정보수정</a>
            <a href="<?= base_url('common/logout'); ?>">로그아웃</a>
        </div>
    </div>

    <ul class="adm_menu">
        <? if($member['mb_level'] == 10) { ?>
            <li <?php if($pid == "member_list" || $pid == "member_wrtie") { echo "class='active'"; } ?>>
                <a href="<?=base_url("member/list?member_type=other")?>">
                    <i class="fa-duotone fa-user-tie"></i> 거래처 관리
                </a>
            </li>
        <?}?>

        <li <?php if($pid == "goods_list" || $pid == "goods_write" || $pid == "manager_stock_list" || $pid == "manager_stock_write") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/goods/')?>">
                <i class="fa-duotone fa-box"></i> 제품 현황
            </a>
        </li>
        <li <?php if($pid == "goods_upload") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/goods/upload')?>">
                <i class="fa-duotone fa-boxes-stacked"></i> 제품 일괄등록
            </a>
        </li>
        <li <?php if($pid == "order_search" || $pid == "waiting_list" || $pid == "new_list" || $pid == "send_list"|| $pid == "deliver_list" || $pid == "confirm_list"||  $pid == "state_list"|| $pid == "cancel_list"|| $pid == "return_list"|| $pid == "exchange_list") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/order/new')?>">
                <i class="fa-duotone fa-truck-fast"></i> 판매 관리
            </a>
        </li>
        <li <?php if($pid == "reserv_list" || $pid == "calcul_list") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/admin/reserv')?>">
                <i class="fa-duotone fa-calendar"></i> 예약 관리
            </a>
        </li>
        <li <?php if($pid == "address_book_list" || $pid == "address_book_form" || $pid == "address_delivery_list" || $pid == "address_delivery_form" || $pid == "delivery_charge_list" || $pid == "delivery_charge_form" || $pid == "shipping_policy_list" || $pid == "shipping_policy_form") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/delivery/addressList')?>">
                <i class="fa-duotone fa-address-book"></i> 배송정보 관리
            </a>
        </li>
        <li>
            <a onclick="comingsoon_modal()">
                <i class="fa-duotone fa-money-bill-trend-up"></i> 매출 관리
            </a>
        </li>
        <li <?php if( $pid == "calculate_view") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/calculate')?>">
                <i class="fa-duotone fa-file-contract"></i> 정산 관리
            </a>
        </li>
        <li <?php if($pid == "notice_list" || $pid == "qna_list" || $pid == "qna_view" || $pid == "msg_list" || $pid == "msg_write" || $pid == "lms_log_list") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/admin/notice')?>">
                <i class="fa-duotone fa-bullhorn"></i> 고객 센터
            </a>
        </li>
    </ul>
</div>