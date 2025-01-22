<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>

</div><!-- container End -->
</div><!-- wrapper End -->


<div id="footerWrap">
		<div class="ft_top">
			<div class="inr">
				<p class="btmBtn">
					<span class="btmBtnBox">
						<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
						<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">이용약관</a>
						<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a>
						<a href="<?php echo G5_URL; ?>/adm">관리자</a>
					</span>
				</p>
			</div>
		</div>
	<div class="left">
		<div class="adrBox">
			<div class="inr">
				<p>
					<span class="company"><?php echo $default['de_admin_company_name']; ?></span>
					<span><b>주소</b> <?php echo $default['de_admin_company_addr']; ?></span><br class="hidden-xs">
					<span><b>대표</b> <?php echo $default['de_admin_company_owner']; ?></span>
					<span><b>사업자 등록번호</b> <?php echo $default['de_admin_company_saupja_no']; ?></span><br class="hidden-xs">
					<span><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></span><br class="hidden-xs">
					<span><b>TEL</b> <?php echo $default['de_admin_company_tel']; ?></span>
					<span><b>FAX</b> <?php echo $default['de_admin_company_fax']; ?></span><br class="hidden-xs">
					<span><b>MAIL</b> <?php echo $default['de_admin_info_email']; ?></span>
					<!--
					<?php if ($default['de_admin_buga_no']) echo '<span><b>부가통신사업신고번호</b> '.$default['de_admin_buga_no'].'</span>'; ?><br>
					-->
				</p>
				<p class="copy">
					COPYRIGHT(C)2022. 식품나라 CO.,LTD. ALL RIGHTS RESERCED.
				</p>
			</div>	
		</div>
		<div class="visible-xs" id="ft_login">
			<!--로그인/로그아웃-->
			<ul>
				<?php if ($is_member) { ?>
				<?php if ($is_admin) {  ?>
				<?php /*?><li><a href="<?php echo G5_ADMIN_URL ?>/shop_admin/"><i class="fas fa-cog"></i> 관리자</a></li><?php */?>
				<?php } else { ?>
				<?php } ?>
				<li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop"><i class="fas fa-unlock"></i> 로그아웃</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php"><i class="fas fa-user"></i> 정보수정</a></li>
				<?php } else { ?>
				<!-- <li><a href="<?php echo G5_BBS_URL; ?>/login.php"><i class="fas fa-lock"></i> 로그인</a></li> -->
				<!-- <li><a href="<?php echo G5_BBS_URL ?>/register.php" id="snb_join"><i class="fas fa-user"></i> 회원가입</a></li> -->

				<?php } ?>
			</ul>
		</div><!--#ft_login-->



    <!--하단정보-->
	</div>
	<div class="right">

			<div class="accBox">
				<h4>입금계좌</h4>
					<div class="account">
						<h6 class="accnum">100-036-098531</h6>
					</div>
					<p class="txt">신한은행 식품산업지원센터 주식회사 장동익</p>

			</div>
			<div class="telBox">
				<h4>고객센터</h4>
				<h6 class="telN"><?php echo $default['de_admin_company_tel']; ?></h6>
				<p class="txt">평일/금요일 09:00 ~ 17:00<span></span>일요일/공휴일 휴무</p>
			</div>
	</div>

        
	<div id="ft_fixed">
		<a href="#hd" class="goHd pcVer"><span></span>브라우저 최상단으로 이동합니다</a>

<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	
	<!-- <a href="#footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a> -->
</div>
	</div>
	<!-- /ft_fixed -->

</div><!--#footer-->      
    
       
        
        
        
        





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
<a href="tel:051-936-4239" id="ft_to_call"><i class="fas fa-phone"></i></a>



<script>
//    $(function() {
//        $("#ft_to_top").on("click", function() {
//            $("html, body").animate({scrollTop:0}, '500');
//            return false;
//        });
//    });
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


<!--
	<ul class="b_menu">
	    <li><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/b_menu01.png">홈</a></li>
	    <li><a href="#hash-menu"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/b_menu02.png">카테고리</a></li>
        <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/b_menu03.png">브랜드소개</a></li>
        <li><a href="<?php echo G5_SHOP_URL; ?>/cart.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/b_menu04.png">장바구니</a></li>
        <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/b_menu05.png">마이페이지</a></li>
	</ul>
-->
	
<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
