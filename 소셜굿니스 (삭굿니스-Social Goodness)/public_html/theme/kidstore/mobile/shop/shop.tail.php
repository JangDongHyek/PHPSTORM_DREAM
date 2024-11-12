<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>

</div><!-- container End -->
</div><!-- wrapper End -->



<!--하단정보-->
<?php /*?><div id="bcus_box_wrap">
    <div id="bcus_box">
        <dl>
            <dt>고객센터</dt>
            <div class="tel">
                <h3><?php echo $default['de_admin_company_tel']; ?></h3>
                <p>08:30~17:30  토·일·공휴일 휴무</p>
				<script language = "javascript" src = "https://pgweb.dacom.net/WEB_SERVER/js/escrowValid.js"></script>
				<a class="escrow" onClick="goValidEscrow('iljinanc');"> 
				<img src="https://pgweb.dacom.net/WEB_SERVER/escyn/banner_400.gif">
				</a>
            </div><!--.tel-->
			<ul class="area_sns">
				<li><a class="cs_btn" href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=faq"><span>FAQ 바로가기</span></a></li>
				<li class="naver"><a href=""><span>네이버 톡톡</span></a></li>
				<li class="kakao"><a href=""><span>일진에이엔씨</span></a></li>
			</ul>
        </dl>
        <dl>
            <dt>입금계좌</dt>
            <div class="bank">
                <p>255-086571-01-025</p>
                <div class="bpoint"><em>기업은행</em><em>예금주 : (주)일진에이엔씨</em></div>
				<a class="cs_btn" href="<?php echo G5_SHOP_URL; ?>/mypage.php"><span>입금자 확인하기</span></a>
            </div><!--.bank-->
        </dl>
        <dl>
      <dt>공지사항</dt>
            <div><?php echo latest('theme/shop_basic', 'notice', 4, 26);  ?></div>
        </dl>
        <!--<dl>
            <dt>Store Guide <span>쇼핑가이드</span></dt>
            <ul class="bcus_ul">
            	<li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice"><div class="dong"><i class="fas fa-tv"></i></div><p>새소식</p></a></li>
            	<li><a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=10"><div class="dong"><i class="fas fa-align-justify"></i></div><p>판매식품</p></a></li>
            	<li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=qa"><div class="dong"><i class="fas fa-edit"></i></div><p>Q&amp;A</p></a></li>
                <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php"><div class="dong"><i class="fas fa-shopping-cart"></i></div><p>MY PAGE</p></a></li>
            </ul>
        </dl>-->
    </div><!--#bcus_box-->
</div><!--#bcus_box_wrap-->
<?php */?>


<div id="ft">
	<ul class="foot_menu">
        <div class="fm">
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a></li>   
            <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice">공지사항</a></li>         
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a></li>       
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy" class="point">개인정보처리방침</a></li>
			
            <!--li><a onclick="alert('준비 중입니다');return false;">서비스운영정책</a></li>
			<li><a onclick="alert('준비 중입니다');return false;">참여가이드</a></li>
			<li><a onclick="alert('준비 중입니다');return false;">공시자료</a></li>
			<li><a onclick="alert('준비 중입니다');return false;">참여이용약관</a></li>
            <li><a onclick="alert('준비 중입니다');return false;">포인트정책</a></li-->
        </div>
    </ul>
    
    <div class="ft_info">
    	<div class="cus">
        	<dl>
            	<dt><i class="fas fa-phone"></i> </dt>
                <dd><strong>고객센터</strong> 052-257-7575</dd>
            </dl>
        </div><!--.cus-->	
        <ul id="ft_sns" class="ft_sns">
            <li class="s_facebook"><a href="https://www.facebook.com/people/Social-Goodness/61557170576898/" target="_blank"><i class="fab fa-facebook-f"></i><span class="sound_only">페이스북</span></a></li>
            <li class="s_twitter"><a href="https://www.instagram.com/socialgoodness07/" target="_blank"><i class="fab fa-instagram"></i><span class="sound_only">트위터</span></a></li>
            <!--li class="s_google"><a onclick="alert('준비 중입니다');return false;"><i class="fab fa-google"></i><span class="sound_only">구글</span></a></li-->
        </ul>
    
    </div><!--.ft_info-->
    
	<div id="ft_box">
        <div id="ft_copy" >
            <span>상호명 : <?php echo $default['de_admin_company_name']; ?></span>
            <span>대표 : <?php echo $default['de_admin_company_owner']; ?></span>
            <span>본사주소 : <?php echo $default['de_admin_company_addr']; ?></span><br>
            <span>지사 : 울산광역시 남구 삼산로 57,7층(윤영빌딩, 신정동)</span><br>
            <span>전화번호 : <?php echo $default['de_admin_company_tel']; ?></span>
            <span>팩스번호 : <?php echo $default['de_admin_company_fax']; ?></span>
            <span>이메일 : <?php echo $default['de_admin_info_email']; ?></span><br>
            <span>사업자 등록번호 : <?php echo $default['de_admin_company_saupja_no']; ?></span>
            <span>통신판매업신고번호 : <?php echo $default['de_admin_tongsin_no']; ?></span>
            <span>개인정보관리자 : <?php echo $default['de_admin_info_name']; ?></span>
        </div>
        
        <div class="ft_txt" style="display:none">
        대출금리 연 19% 이내 (연체금리 연 22%이내) 채무의 조기상환수수료율 등 조기상환조건 없으며 플랫폼 이용료, 법무비 등 부대비용 별도 부담입니다.<br />
중개수수료를 요구하거나 받는 행위는 불법입니다. 대출 시 귀하의 신용등급 또는 개인신용평점이 하락할 수 있습니다. 과도한 빚은 당신에게 큰 불행을 안겨 줄 수 있습니다.<br />
<?php echo $default['de_admin_company_name']; ?>는 투자원금과 수익을 보장하지 않으며, 투자손실에 대한 책임은 모두 투자자에게 있습니다.
        </div>
        
        <p class="copy">Copyright &copy; 2020 <?php echo $default['de_admin_company_name']; ?>. All rights reserved <br class="visible-xs" />/ designed by ITFORONE </p>
        
	</div><!--#ft_box-->
    
</div>



<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#ft" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
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
<a href="tel:052-257-7575" id="ft_to_call"><i class="fas fa-phone"></i></a>

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
