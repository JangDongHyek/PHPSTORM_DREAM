<?php
include_once APPPATH."Views/template/head.sub.php";
helper('header');

$headerData = getAppPageSettings($pid ?? '');
$header_type = $headerData['header_type'];       // 헤더타입
$footer_type = $headerData['footer_type'];       // 푸터타입
$header_name = $headerData['header_name'];      // 상단페이지명
$lnb_type = $headerData['lnb_type'];            // 좌측메뉴 디자인
$sub_type = $headerData['sub_type'];            // 상단메뉴명 디자인

$member = session()->get('member') ?? [];
$lev = $member['mb_level'] ?? 0;

$title = '';
$service = $_GET['service'] ?? '';
$boardName = $_GET['bo'] ?? '';
$uri = service('uri');
$lastSegment = $uri->getSegment(1);
if(!empty($service)){
    $title = SERVICE_TYPE[$service];
}elseif (!empty($boardName)){
    $title = BOARD_NAME[$boardName];
}else{
    $title = LASTSEGMENT[$lastSegment];
}
$today = date('Y-m-d');

?>
<?php if ($header_type == 0) { ?>
    <!--헤더없음-->
<?php } else if ($header_type == 1) { ?>
<!--pc header-->
<header id="hd">
    <div class="inner flex ai-c jc-sb">
        <h1><a href="<?=base_url()?>"><img src="<?=base_url()?>img/common/logo.svg" alt="부산이사몰"></a></h1>
        <nav id="gnb">
            <div class="mobile_my">
                <div class="flex ai-c jc-sb">
                    <ul class="flex gap5">

                    <?php if (empty($member)) {?>
                        <li><a href="<?=base_url()?>login" class="btn btn_line">로그인/가입</a></li>
                        <!--<li><a href="<?/*=base_url()*/?>signUp" class="btn btn_color">회원가입</a>-->
                    <?php } else { ?>
                        <li><a href="<?=base_url()?>logout" class="btn btn_line">로그아웃</a></li>
                        <li><a href="<?=base_url()?>mypage" class="btn btn_color">마이페이지</a></li>
                    <?php }?>
                    <? if ($member['mb_level'] == '10'):?>
                        <li><a class="btn btn_black" href="<?=base_url()?>adm" target="_blank">관리자 페이지</a></li>
                    <?endif;?>
                    </ul>
                    <div class="close-btn"><i class="fa-sharp fa-light fa-xmark"></i></div>

                </div>
                <div class="lnb">


                    <?php if ($lev >= '5'): ?>
                        <!--사업자회원-->
                        <div class="mypage">
                            <p class="txt_color" onclick="location.href='<?=base_url()?>mypage'"><i class="fa-duotone fa-buildings"></i> <strong><?=$member['company_name']?><!--회사명--></strong><span>(<?=$member['mb_id']?>)<!--아이디--></span></p>
                            <div class="flex ai-c jc-c">
                                <!--광고회원-->
                                <a href="<?=base_url()?>ad" class="<?php if($pid =="app_ad") { echo ' active'; } ?>">광고 정보</a>
                                <a href="<?=base_url()?>adPayment" class="<?php if($pid =="app_ad_payment") { echo ' active'; } ?>">결제 내역</a>
                                <a href="<?=base_url()?>callStat" class="<?php if($pid =="app_call_stat") { echo ' active'; } ?>">전화연결 통계</a>
                                <!--//광고회원-->
                                <a href="<?=base_url()?>estimate" class="<?php if($pid =="app_estimate") { echo ' active'; } ?>">이사견적 열람</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($lev === '2' || $lev === '10'): ?>
                        <!--일반회원-->
                        <div class="mypage">
                            <p class="txt_color" onclick="location.href='<?=base_url()?>mypage'"><i class="fa-duotone fa-user"></i> <strong><?=$member['mb_name']?><!--이름--></strong> <span>(<?=$member['mb_id']?>)<!--아이디--></span></p>
                            <div class="flex ai-c jc-c">
                                <a href="./estimateMy" class="<?php if($pid =="app_estimate_my") { echo ' active'; } ?>">나의 이사견적</a>
                                <a href="<?=base_url()?>estimateForm" class="<?php if($pid =="app_estimate_form") { echo ' active'; } ?>">견적 신청</a>
                                <!--<a href="<?/*=base_url()*/?>wish" class="<?php /*if($pid =="app_wish") { echo ' active'; } */?>">관심 업체</a>-->
                            </div>
                        </div>
                        <br>
                    <?php endif; ?>

                </div>
            </div>
            <ul class="depth1">
                <li><a href="<?=base_url()?>company?type=bus&service=P&reg=강서구">포장이사</a></li>
                <li><a href="<?=base_url()?>company?type=bus&service=H&reg=강서구">반포장이사</a></li>
                <li><a href="<?=base_url()?>company?type=bus&service=C&reg=강서구">일반이사</a></li>
                <li><a href="<?=base_url()?>company?type=bus&service=O&reg=강서구">원룸이사</a></li>
                <li><a href="<?=base_url()?>company?type=bus&service=L&reg=강서구">사다리차</a></li>
                <li>
                    <a href="<?=base_url()?>board?bo=info">이사관련정보</a>
                    <div class="depth2-wrapper">
                        <ul class="depth2">
                            <li><a href="<?=base_url()?>board?bo=info">이사관련정보</a></li>
                            <li><a href="<?=base_url()?>board?bo=partner">관련업체소개</a></li>
                            <!--<li><a href="<?/*=base_url()*/?>board?bo=reviews">이사후기</a></li>-->
                            <li><a href="<?=base_url()?>faq">FAQ</a></li>
                        </ul>
                    </div>
                </li>
                <!--<li>
                    <a href="<?/*=base_url()*/?>service">이사 홈서비스</a>
                    <div class="depth2-wrapper">
                        <ul class="depth2">
                            <li><a href="<?/*=base_url()*/?>service">에어컨 서비스</a></li>
                            <li><a href="<?/*=base_url()*/?>service">이사 청소 서비스</a></li>
                            <li><a href="<?/*=base_url()*/?>service">부산 지역 부동산</a></li>
                            <li><a href="<?/*=base_url()*/?>service">부산 추천 업소</a></li>
                        </ul>
                    </div>
                </li>-->
                <li>
                    <a href="<?=base_url()?>board?bo=topic">새소식안내</a>
                    <div class="depth2-wrapper">
                        <ul class="depth2">
                            <li><a href="<?=base_url()?>board?bo=topic">새소식안내</a></li>
                            <!--<li><a href="<?/*=base_url()*/?>board?bo=tidings">부산경남소식</a></li>
                            <li><a href="<?/*=base_url()*/?>board?bo=job">이사업체 구인구직</a></li>
                            <li><a href="<?/*=base_url()*/?>board?bo=golf_yard">골프마당</a></li>-->
                        </ul>
                    </div>
                </li>
                <? if ($member['mb_level'] !== '5'):?>
                    <!--일반-->
                    <li><a class="txt_color" href="<?=base_url()?>estimateForm">견적신청</a></li>
                <? endif;?>
                <? if ($member['mb_level'] === '5' || $member['mb_level'] === '10'):?>
                    <!--사업자-->
                    <li><a  class="txt_color" href="<?=base_url()?>estimate">이사견적 열람</a></li>
                <? endif;?>
                <? if($member['mb_level'] !== '2'):?>
                    <li><a  class="txt_color" href="<?=base_url()?>adGuide">광고 문의</a></li>
                <? endif;?>
            </ul>
        </nav>
        <div class="tnb dot_list flex ai-c">
            <ul class="flex ai-c">

            <?php if (empty($member)) {?>
                <li><a href="<?=base_url()?>login">로그인/회원가입</a></li>
                <!--<li><a href="<?/*=base_url()*/?>signUp">회원가입</a></li>-->
            <?php } else { ?>

                <li><a href="<?=base_url()?>logout">로그아웃</a></li>
                <li><a href="<?=base_url()?>mypage">마이페이지</a></li>
            <?php }?>
            </ul>
            <? if ($member['mb_level'] == '10'):?>
                <a class="btn btn_line" href="<?=base_url()?>adm" target="_blank">관리자 페이지</a>
            <?endif;?>
            <div class="hd_count">
                <ul class="txt_down">
                    <li>TODAY <strong class="txt_color"><?=number_format($response['todayCount'] ?? 0)?></strong></li>
                    <li>TOTAL <strong class="txt_color"><?=number_format($response['totalCount'] ?? 0) ?></strong></li>
                </ul>
            </div>
            <a class="mobile_menu"><i class="fa-regular fa-bars"></i></a>
        </div>
    </div>
    <div class="inner mobile">
        <? if ($member['mb_level'] !== '5'):?>
            <!--일반-->
            <a class="btn btn_colorline mobile" href="<?=base_url()?>estimateForm"><i class="fa-duotone fa-memo-circle-check"></i> 견적신청</a>
        <? endif;?>
        <? if ($member['mb_level'] === '5' || $member['mb_level'] === '10'):?>
            <!--사업자-->
            <a class="btn btn_colorline mobile" href="<?=base_url()?>estimate"><i class="fa-duotone fa-phone-volume"></i> 이사견적 열람</a>
        <? endif;?>
        <? if($member['mb_level'] !== '2'):?>
            <a class="btn btn_orenge mobile" href="<?=base_url()?>adGuide"><i class="fa-light fa-rectangle-ad"></i> 광고 문의</a>
        <? endif;?>
    </div>
</header>
<!--//pc header-->
<!--mobile header-->
<!--//mobile header-->
    <?php if ($sub_type == 1) { ?>
        <?php if($pid != "app_faq" && $pid != "app_board" && $pid != "app_board_view" ) { ?>
            <div class="sub_banner banner">
                <a href="<?=base_url()?>/adGuide">
                    <img src="<?=base_url()?>img/sub_banner01.jpg" alt="부산이사몰" class="pc">
                    <img src="<?=base_url()?>img/sub_banner_m01.jpg" alt="부산이사몰" class="mobile">
                </a>
            </div>
        <?php } ?>

        <?php if ($lnb_type == 1) { ?>
        <div id="wrapper" class="lnb_wrapper">
            <div class="lnb">
                <!--일반회원-->
                <?php if ($lev === '2' || $lev === '10'): ?>
                    <div class="mypage">
                        <p class="txt_color"><i class="fa-duotone fa-user"></i> <strong><?=$member['mb_name']?><!--이름--></strong></p>
                        <span>(<?=$member['mb_id']?>)<!--아이디--></span>
                    </div>
                    <ul>
                        <li><a href="./mypage" class="<?php if($pid =="app_mypage") { echo ' active'; } ?>">정보 관리</a></li>
                        <li><a href="./estimateMy" class="<?php if($pid =="app_estimate_my") { echo ' active'; } ?>">나의 이사견적</a></li>
                        <li><a href="./estimateForm" class="<?php if($pid =="app_estimate_form") { echo ' active'; } ?>">이사견적 신청</a></li>
                        <!--<li><a href="./wish" class="<?php /*if($pid =="app_wish") { echo ' active'; } */?>">관심 업체</a></li>-->
                    </ul>
                    <br>
                <?php endif; ?>

                <?php if ($lev === '5' || $lev === '10'): ?>
                    <!--사업자회원-->
                    <div class="mypage">
                        <p class="txt_color"><i class="fa-duotone fa-buildings"></i> <strong><?=$member['company_name']?><!--회사명--></strong></p>
                        <span>(<?=$member['mb_id']?>)<!--아이디--></span>
                    </div>
                    <ul>
                        <li><a href="./mypage" class="<?php if($pid =="app_mypage") { echo ' active'; } ?>">정보 관리</a></li>
                        <!--광고 회원 메뉴-->
                        <li><a href="./ad" class="<?php if($pid =="app_ad") { echo ' active'; } ?>">광고 정보</a></li>
                        <li><a href="./adPayment" class="<?php if($pid =="app_ad_payment") { echo ' active'; } ?>">결제 내역</a></li>
                        <li><a href="./callStat" class="<?php if($pid =="app_call_stat") { echo ' active'; } ?>">전화연결 통계</a></li>
                        <!--//광고 회원 메뉴-->
                        <li><a href="./estimate" class="<?php if($pid =="app_estimate") { echo ' active'; } ?>">이사견적 열람</a></li>
                    </ul>
                <?php endif; ?>
            </div>
        <?php } else { ?>
        <div id="wrapper">
        <?php }  ?>
            <div class="container">
                <div class="area_top flex ai-c jc-sb">
                    <h2><?=$title?></h2>
                    <div class="location">
                        <i class="fa-light fa-house-blank"></i> 홈 <i class="fa-light fa-angle-right"></i> <strong><?=$title?></strong>
                    </div>
                </div>
    <?php } ?>



<?php } else { ?>
<?php } ?>


<script>
    // 모바일 햄버거 메뉴
    document.addEventListener("DOMContentLoaded", function () {
        const mobileMenuBtn = document.querySelector(".mobile_menu");
        const gnb = document.getElementById("gnb");
        const closeBtn = document.querySelector(".close-btn");

        // overlay 생성
        const overlay = document.createElement("div");
        overlay.classList.add("overlay");

        // overlay를 #gnb 바로 아래에 삽입
        gnb.insertAdjacentElement('afterend', overlay);

        // 메뉴 닫기 함수
        function closeMenu() {
            gnb.classList.remove("open");
            overlay.classList.remove("show");
        }

        // 햄버거 메뉴 클릭 이벤트
        mobileMenuBtn.addEventListener("click", function () {
            gnb.classList.toggle("open");
            overlay.classList.toggle("show");
        });

        // 닫기 버튼 및 overlay 클릭 시 메뉴 닫기
        closeBtn.addEventListener("click", closeMenu);
        overlay.addEventListener("click", closeMenu);
    });
</script>
