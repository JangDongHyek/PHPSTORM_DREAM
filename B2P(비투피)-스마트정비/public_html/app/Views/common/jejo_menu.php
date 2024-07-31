<div id="left_menu">
    <div class="logo">
        <img src="/img/common/logo.png" alt="">
    </div>
    
    <div class="user_info">
        <i class="fa-duotone fa-circle-user"></i>
        <p><strong>제조사</strong> 님 안녕하세요!</p>
        <div class="log_btn">
            <a href="<?=base_url('/jejo/member_write')?>">정보수정</a>
            <a href="">로그아웃</a>
        </div>
    </div>

    <ul class="adm_menu">
        <li <?php if($pid == "member_list" || $pid == "member_write") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/jejo/member_list')?>">
            <i class="fa-duotone fa-user-tie"></i> 거래처 관리
            </a>
        </li>
        <li <?php if($pid == "manager_product_list" || $pid == "manager_product_write" || $pid == "manager_stock_list" || $pid == "manager_stock_write") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/jejo/manager_product_list')?>">
            <i class="fa-duotone fa-boxes-stacked"></i> 제품 관리
            </a>
        </li>
        <li <?php if($pid == "sell_list" || $pid == "ship_list" || $pid == "cancel_list") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/jejo/sell_list')?>">
            <i class="fa-duotone fa-truck-fast"></i> 판매 관리
            </a>
        </li>
        <li>
            <a onclick="comingsoon_modal()">
            <i class="fa-duotone fa-money-bill-trend-up"></i> 매출 관리
            </a>
        </li>
        <li <?php if($pid == "calculate_view") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/calculate')?>">
            <i class="fa-duotone fa-file-contract"></i> 정산 관리
            </a>
        </li>
        <li <?php if($pid == "notice_list" || $pid == "qna_list" || $pid == "qna_view" || $pid == "qna_write") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/jejo/notice_list')?>">
            <i class="fa-duotone fa-bullhorn"></i> 게시판
            </a>
        </li>
    </ul>
</div>