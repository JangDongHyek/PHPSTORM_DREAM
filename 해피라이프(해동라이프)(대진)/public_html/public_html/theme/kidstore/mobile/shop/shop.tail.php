<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>

</div><!-- container End -->
</div><!-- wrapper End -->

<!--하단정보-->
<div id="bcus_box_wrap">
    <div id="bcus_box">
        <dl>
            <dt>고객센터 안내</dt>
            <div class="tel">
                051.<span>961.0502</span><br />
                <span class="fax">fax 050.4340.4887</span>
                <p>
                <strong>업무시간안내</strong><br />
                평일 09:00~18:00 / 점심 12:00~13:00<br />
                토/일/공휴일 휴무
                </p>
            </div><!--.tel-->
        </dl>
        <dl>
            <dt>계좌번호 안내</dt>
            <div class="bank">
                <p>
                    <strong>한국은행</strong> 
                    <span>예금주 : (주)피원</span>
                </p>
                <p class="bnum">000000-00-000000</p>
                <!--<p>
                    <strong>대한은행</strong> 123-456-7891011<br />
                    <span>주식회사지앤맥스</span>
                </p>-->
                <div class="bpoint">※주문자명과 입금자명을 꼭 확인해주세요! <br />
    ※주문자명과 입금자명이 다른 경우는 게시판이나 고객센터로 연락바랍니다.</div>
                
            </div><!--.bank-->
        </dl>
        <dl>
            <dt>빠른메뉴</dt>
            <ul class="qmbox">
                <li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">
                    <div class="qdong"><img src="<?php echo G5_THEME_IMG_URL ?>/bq_icon01.png" alt="" /></div>
                    <p>배송조회</p>
                </a></li>
                <li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">
                    <div class="qdong"><img src="<?php echo G5_THEME_IMG_URL ?>/bq_icon02.png" alt="" /></div>
                    <p>주문조회</p>
                </a></li>
                <li><a href="<?php echo G5_SHOP_URL; ?>/cart.php">
                    <div class="qdong"><img src="<?php echo G5_THEME_IMG_URL ?>/bq_icon03.png" alt="" /></div>
                    <p>장바구니</p>
                </a></li>
                <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">
                    <div class="qdong"><img src="<?php echo G5_THEME_IMG_URL ?>/bq_icon04.png" alt="" /></div>
                    <p>마이페이지</p>
                </a></li>
            </ul><!--#qmbox-->
            
        </dl>
    </div><!--#bcus_box-->
</div><!--#bcus_box_wrap-->


<div id="ft">
	<div class="ft_com">
        <ul>
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=estimate">견적문의</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a></li>
            <li class="bno"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy" class="point">개인정보처리방침</a></li>
            <?php /*?><li><a href="http://ftc.go.kr/www/bizCommList.do?key=232" target="_blank">사업자정보</a></li><?php */?>
            <p><?php echo $default['de_admin_company_name']; ?>의 제품이미지의 저작권은 <?php echo $default['de_admin_company_name']; ?>에 있음을 알립니다.</p>
        </ul>
     </div>
            
	<div id="ft_box">
                <div id="ft_logo">
                    <img src="<?php echo G5_IMG_URL ?>/logo_gray.jpg" alt="<?php echo $config['cf_title']; ?>">
                </div>
                        
                <div id="ft_copy">
                    <h1><strong><?php echo $default['de_admin_company_name']; ?></strong></h1>
                    <span><b>회사명</b> <?php echo $default['de_admin_company_name']; ?></span>
                    <span><b>주소</b> <?php echo $default['de_admin_company_addr']; ?></span><br />
                    <span><b>사업자 등록번호</b> <?php echo $default['de_admin_company_saupja_no']; ?></span>
                    <span><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></span>
                    <span><b>대표</b> <?php echo $default['de_admin_company_owner']; ?></span>
                    <span><b>전화</b> <?php echo $default['de_admin_company_tel']; ?></span><br />
                    <span><b>팩스</b> <?php echo $default['de_admin_company_fax']; ?></span>
                    <!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span>-->
                    <span><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></span>
                    <span><b>개인정보관리책임자</b> <?php echo $default['de_admin_info_name']; ?></span>
                    <?php if ($default['de_admin_buga_no']) echo '<span><b>부가통신사업신고번호</b> '.$default['de_admin_buga_no'].'</span>'; ?> <br>
                    Copyright &copy; 2019 <strong class="point"><?php echo $default['de_admin_company_name']; ?></strong>. All Rights Reserved.
                </div>
            
	</div><!--#ft_box-->
</div>

<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
</div>
<script>
$(document).ready(function(){
	$("#gobtn").hide();
	 
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#gobtn').fadeIn();
			} else {
				$('#gobtn').fadeOut();
			}
		});
	});
	
	   $('.goHd').click(function($e){
	   $('html, body').animate({scrollTop:0}); return false
	 });
});
</script>




<a href="#" id="ft_to_top">TOP</a>
<a href="tel:051-961-0502" id="ft_to_call"><i class="fas fa-phone"></i></a>

<!--모바일퀵메뉴 시작 {-->
<div id="quick" class="visible-xs">
     <button type="button" id="qv_open" class="hd_opener"><i class="fas fa-chevron-left"></i><span class="sound_only"> 열기</span></button>
    <div id="q_view" class="hd_div">
        <div class="q_box">
        <?php include(G5_MSHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
        <?php include_once(G5_MSHOP_SKIN_PATH.'/boxcart.skin.php'); // 장바구니 ?>
        <?php include_once(G5_MSHOP_SKIN_PATH.'/boxwish.skin.php'); // 위시리스트 ?>
        </div>

        <?php //echo outlogin('theme/shop_basic'); // 아웃로그인 ?>
        <?php //include_once(G5_SHOP_SKIN_PATH.'/boxcategory.skin.php'); // 상품분류 ?>
        <?php //include_once(G5_SHOP_SKIN_PATH.'/boxevent.skin.php'); // 이벤트 ?>
        <?php //include_once(G5_SHOP_SKIN_PATH.'/boxcommunity.skin.php'); // 커뮤니티 ?>
        <?php /*?><!-- 쇼핑몰 배너 시작 { -->
        <?php echo display_banner('왼쪽'); ?>
        <!-- } 쇼핑몰 배너 끝 --><?php */?>
        
        <button type="button" id="qv_close" class="hd_closer"><i class="fas fa-times"></i><span class="sound_only">퀵메뉴</span> 닫기</button>
    </div>
</div>
<!--}끝 모바일퀵메뉴-->

<!--PC퀵메뉴 시작 {-->
<?php /*?><div id="quick" class="hidden-xs">
    <div class="link">
        <a href="<?php echo G5_SHOP_URL; ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/quick_title.gif" alt="퀵메뉴"></a>
		<?php if ($is_member) { ?>
        <?php if ($is_admin) {  ?>
        <a href="<?php echo G5_ADMIN_URL ?>/shop_admin/" class="adm"><b><i class="fas fa-cog"></i> 관리자</b></a>
        <?php } else { ?>
        <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php"><img src="<?php echo G5_THEME_IMG_URL ?>/quick_modify.gif" alt="정보수정"></a>
        <?php } ?>
       	<a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop"><img src="<?php echo G5_THEME_IMG_URL ?>/quick_logout.gif" alt="로그아웃"></a>
        <?php } else { ?>
        <a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/quick_login.gif" alt="로그인"></a>
        <a href="<?php echo G5_BBS_URL ?>/register.php" id="snb_join"><img src="<?php echo G5_THEME_IMG_URL ?>/quick_join.gif" alt="회원가입"></a>
        <?php } ?>
        <a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=20"><img src="<?php echo G5_THEME_IMG_URL ?>/quick_img01.gif" alt="개인결제창"></a>
        <a href="<?php echo G5_SHOP_URL; ?>/wishlist.php"><img src="<?php echo G5_THEME_IMG_URL ?>/quick_img02.gif" alt="위시리스트"></a>
        <a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php"><img src="<?php echo G5_THEME_IMG_URL ?>/quick_img03.gif" alt="주문조회"></a>
        <a href="<?php echo G5_SHOP_URL; ?>/cart.php"><img src="<?php echo G5_THEME_IMG_URL ?>/quick_img04.gif" alt="장바구니"></a>
        <a href="<?php echo G5_SHOP_URL; ?>/mypage.php"><img src="<?php echo G5_THEME_IMG_URL ?>/quick_img05.gif" alt="마이페이지"></a>
        <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice"><img src="<?php echo G5_THEME_IMG_URL ?>/quick_img06.gif" alt="고객센터"></a>
        <a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/quick_top.png" alt="맨위로"></a>
    </div>
</div><?php */?>
<!--}끝 PC퀵메뉴-->


<script>
    $(function() {
        $("#ft_to_top").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });
    });
</script>
<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>



<?php /*?><div align="center"><script language = "JavaScript" src = "https://pgweb.dacom.net/WEB_SERVER/js/escrowValid.js" type="text/javascript"></script><a onClick="goValidEscrow('si_sehyuninter');"><img src="<?=G5_URL?>/theme/kidstore2/img/escro.jpg" width="227" border="0" style="cursor:hand" /></a></div><?php */?>



<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
