<div id="left_menu">
    <div class="logo">
        <img src="/img/common/logo.png" alt="">
    </div>
    
    <div class="user_info">
        <i class="fa-duotone fa-circle-user"></i>
        <p><strong>정비업체</strong> 님 안녕하세요!</p>
        <div class="log_btn">
            <a href="<?=base_url('/jungbi/member_write')?>">정보수정</a>
            <a href="">로그아웃</a>
        </div>
    </div>

    <ul class="adm_menu">
        <li <?php if($pid == "member_list" || $pid == "member_write") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/jungbi/member_list')?>">
            <i class="fa-duotone fa-user-tie"></i> 거래처 관리
            </a>
        </li>
        <li <?php if($pid == "reserv_list") { echo "class='active'"; } ?>>
            <a href="<?=base_url('/jungbi/reserv_list')?>">
            <i class="fa-duotone fa-calendar"></i> 예약 관리
            </a>
        </li>
        <li>
            <a onclick="comingsoon_modal()">
            <i class="fa-duotone fa-file-contract"></i> 정산 관리
            </a>
        </li>
    </ul>
</div>