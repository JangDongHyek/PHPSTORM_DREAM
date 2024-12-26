<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fa-light fa-bars"></i>
</a>
<nav id="sidebar" class="sidebar-wrapper">

    <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="./">
                <img src="<?=base_url()?>img/common/logo_white.svg" alt="부산이사몰">
                <p>ADMIN</p>
            </a>
            <div id="close-sidebar">
                <i class="fa-sharp fa-light fa-xmark"></i>
            </div>
        </div>

        <div class="sidebar-menu">
            <!-- sidebar-content  -->
            <div id="side-icon1">
                <ul>
                    <li class="header-menu">
                        <span></span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="<?= base_url()?>adm/member" <?php if($pid == "adm_member"  || $pid == "adm_member_form") { echo "class='active'"; }?>>
                            <i class="fa-sharp fa-light fa-address-book"></i>
                            <!--<i class="fa-light fa-user"></i>-->
                            <span>회원 관리</span>
                        </a>
                        <!--<div class="sidebar-submenu" <?php /*if($pid == "adm_member" || $pid == "adm_member_form") { echo "style='display: block'"; }*/?>>
                            <ul>
                                <li <?php /*if($pid == "adm_member") { echo "class='active'"; }*/?>>
                                    <a href="./member">일반 회원</a>
                                </li>
                                <li <?php /*if($pid == "adm_business") { echo "class='active'"; }*/?>>
                                    <a href="./business">사업자회원</a>
                                </li>
                            </ul>
                        </div>-->
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="<?= base_url()?>adm/ad" <?php if($pid == "adm_ad"  || $pid == "adm_ad_form") { echo "class='active'"; }?>>
                            <i class="fa-light fa-rectangle-ad"></i>
                            <span>광고 신청 관리</span>
                        </a>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="<?= base_url()?>adm/adPayment" <?php if($pid == "adm_ad_payment") { echo "class='active'"; }?>>
                            <i class="fa-light fa-credit-card"></i>
                            <span>결제 내역</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="sidebar-dropdown">
                        <a href="<?= base_url()?>adm/company" <?php if($pid == "adm_company" || $pid == "adm_company_form") { echo "class='active'"; }?>>
                            <i class="fa-light fa-truck-ramp-box"></i>
                            <span>광고 현황 관리</span>
                        </a>
                    </li>
                    <!--<li class="sidebar-dropdown">
                        <a href="<?/*= base_url()*/?>adm/service" <?php /*if($pid == "adm_service" || $pid == "adm_service_view") { echo "class='active'"; }*/?>>
                            <i class="fa-light fa-vacuum"></i>
                            <span>이사 홈서비스 관리</span>
                        </a>
                    </li>-->
                </ul>
                <ul>
                    <li class="sidebar-dropdown">
                        <a href="<?= base_url()?>adm/estimate" <?php if($pid == "adm_estimate") { echo "class='active'"; }?>>
                            <i class="fa-light fa-memo-circle-check"></i>
                            <span>견적신청 관리</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="sidebar-dropdown">
                        <a href="<?= base_url()?>adm/cs" <?php if($pid == "adm_cs") { echo "class='active'"; }?>>
                            <i class="fa-light fa-memo-circle-check"></i>
                            <span>CS 게시판</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="sidebar-dropdown">
                        <a href="<?= base_url()?>adm/callStat" <?php if($pid == "adm_callStat") { echo "class='active'"; }?>>
                            <i class="fa-light fa-memo-circle-check"></i>
                            <span>안심번호 통계</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="sidebar-dropdown">
                        <a href="<?= base_url()?>adm/smsService" <?php if($pid == "adm_sms_service") { echo "class='active'"; }?>>
                            <i class="fa-light fa-envelope"></i>
                            <span>문자서비스</span>
                        </a>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="<?= base_url()?>adm/phoneBook" <?php if($pid == "adm_phone_book") { echo "class='active'"; }?>>
                            <i class="fa-light fa-mobile"></i>
                            <span>연락처관리</span>
                        </a>
                    </li>
                </ul>
                <?/*<ul>
                    <li class="sidebar-dropdown">
                        <a href="<?= base_url()?>adm/banner" <?php if($pid == "adm_banner"  || $pid == "adm_banner_form") { echo "class='active'"; }?>>
                            <i class="fa-light fa-browsers"></i>
                            <span>광고 배너 관리</span>
                        </a>
                    </li>
                </ul>
                */?>
            </div>
        </div>


        <!-- sidebar-menu  -->
    </div>

</nav>