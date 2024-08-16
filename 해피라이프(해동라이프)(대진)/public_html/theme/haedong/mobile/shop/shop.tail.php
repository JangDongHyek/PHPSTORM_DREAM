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
            <dt>CS Center <span>고객센터</span></dt>
            <div class="tel">
               
<? if($pid == "benepia"){ ?>
<h3><i class="fas fa-phone"></i> 1877-9950</h3>
<? }else if($pid == "benecafe"){ ?>
<h3><i class="fas fa-phone"></i> 1899-2919</h3>
<? }else { ?>
<h3><i class="fas fa-phone"></i> <?php echo $default['de_admin_company_tel']; ?></h3>
<? } ?> 


                <!--<h4><i class="fas fa-mobile-alt"></i> 010-3285-9797</h4>-->
                <p><strong>FAX</strong><?php echo $default['de_admin_company_fax']; ?></p>
                <p><strong>E-mail</strong><?php echo $default['de_admin_info_email']; ?></p>
                <p><strong>All day</strong>24시간 전화상담 가능</p>
            </div><!--.tel-->
        </dl>
        <dl>
            <dt>Bank Info <span>계좌정보</span></dt>
            <div class="bank">
                <p>955901-01-477665</p>
                <div class="bpoint">KB국민은행 / 예금주 : (주)해피라이프</div>
            </div><!--.bank-->
            <!--<div class="bank top">
                <p>00000-00-000000</p>
                <div class="bpoint">국민은행 / 예금주 : 해피라이프</div>
            </div>--><!--.bank-->
        </dl>
        <dl>
      <dt>Notice &amp; News <span>공지사항</span></dt>
            <div><?php echo latest('theme/shop_basic', 'notice', 4, 26);  ?></div>
        </dl>
        <dl>
            <dt>Store Guide <span>쇼핑가이드</span></dt>
            <ul class="bcus_ul">
            	<li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice"><div class="dong"><i class="fas fa-tv"></i></div><p>새소식</p></a></li>
            	<li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=goods01"><div class="dong"><i class="fas fa-align-justify"></i></div><p>상조상품</p></a></li>
            	<li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=qa"><div class="dong"><i class="fas fa-edit"></i></div><p>Q&amp;A</p></a></li>
                <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php"><div class="dong"><i class="fas fa-shopping-cart"></i></div><p>MY PAGE</p></a></li>
            </ul>
        </dl>
    </div><!--#bcus_box-->
</div><!--#bcus_box_wrap-->



<div id="ft">
	<ul class="foot_menu">
        <div class="fm">
            <li class="hidden-xs"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=introduce01">회사소개</a></li>
            <li class="hidden-xs"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=qa">상품문의</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">이용약관</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy" class="point">개인정보처리방침</a></li>
            <li class="lno"><a href="http://www.ftc.go.kr/www/bizCommView.do?key=232&apv_perm_no=2020337006930200110&pageUnit=10&searchCnd=wrkr_no&searchKrwd=2308112052&pageIndex=1" target="_blank">사업자정보확인</a></li> 
        </div>
        <ul class="sns">
        	<li><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sns1.png" /></a></li>
            <li><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sns2.png" /></a></li>
            <li><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sns3.png" /></a></li>
        </ul>
    </ul>
	<div id="ft_box">
        <div class="container">
            <div class="row">
            
                <?php /*?><h2><?php echo $config['cf_title']; ?> 정보</h2>    
                <ul id="ft_sns" class="ft_sns container col-sm-3 hidden-xs">
                    <li class="s_facebook"><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-lg fa-facebook" aria-hidden="true"></i><span class="sound_only">페이스북</span></a></li>
                    <li class="s_twitter"><a href="https://twitter.com/" target="_blank"><i class="fa fa-lg fa-twitter" aria-hidden="true"></i><span class="sound_only">트위터</span></a></li>
                    <li class="s_google"><a href="https://instagram.com/" target="_blank"><i class="fa fa-lg fa-google" aria-hidden="true"></i><span class="sound_only">구글</span></a></li>
                </ul><?php */?>
            </div>
            
            <div class="row">
                <div id="ft_copy" class="col-sm-8 col-xs-12">
                    <h1><strong><?php echo $default['de_admin_company_name']; ?></strong></h1>
                    
                    <span><b>주소</b> <?php echo $default['de_admin_company_addr']; ?></span>
                    <span><b>사업자 등록번호</b> <?php echo $default['de_admin_company_saupja_no']; ?></span>
                    <span><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></span><br />
                    <span><b>대표</b> <?php echo $default['de_admin_company_owner']; ?></span>
                    <span><b>전화(24시간)</b> <?php echo $default['de_admin_company_tel']; ?>, 1833-8886</span>
                    <!--<span><b>휴대폰</b> 010-3285-9797  </span>-->
                    <span><b>팩스</b> <?php echo $default['de_admin_company_fax']; ?></span>
                    <!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span>-->
                    <span><b>개인정보관리책임자</b> <?php echo $default['de_admin_info_name']; ?></span>
                    <p class="copy">Copyright &copy; 2019 <strong class="point"><?php echo $default['de_admin_company_name']; ?></strong>. All rights reserved <br class="visible-xs" /></p>
                </div>
                <!--<div id="ft_icon" class="col-sm-4 hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/ft_icon_img.gif" alt="">
                </div>-->
                        
                
            </div>
            
        </div>
	</div><!--#ft_box-->
    
</div>

<script type="text/javascript">
	(function($) {
	  $.fn.semisticky = function(options) {
		return this.each(function() {
		  new SemiSticky($(this), options);
		});
	  };
	}(jQuery));

	var SemiSticky = function(element, options) {
	  var _this = this;
	  
	  options = $.extend({
		offsetLimit: element.outerHeight(),
		scrollThreshold: 50,
		onScroll: function() {}
	  }, options);
	  
	  this.element = element;
	  this.state = 'fixed';
	  this.currentOffsetAmount = 0;
	  
	  this.init = function() {
		var oldScrollTop = $(document).scrollTop();
		var thresholdCounter = 0;
		
		$(window).on('scroll.semisticky', function() {
		  var newScrollTop = $(document).scrollTop();
		  var delta = oldScrollTop - newScrollTop;
		  thresholdCounter = Math.min(Math.max(thresholdCounter + delta, -options.scrollThreshold), options.scrollThreshold);
		  var newOffset;

		  if (Math.abs(thresholdCounter) >= options.scrollThreshold || _this.state == 'scrolling') {
			if (delta < 0 && _this.state !== 'hidden') {
			  
			  if (_this.currentOffsetAmount > -options.offsetLimit) {
				_this.currentOffsetAmount = Math.max(_this.currentOffsetAmount + delta, -options.offsetLimit);
				_this.element.css('top', _this.currentOffsetAmount);
				_this.state = 'scrolling';
			  } else {
				_this.state = 'hidden';
				thresholdCounter = 0;
			  }
			  
			} else if (delta > 0 && _this.state !== 'fixed') {
			  
			  if (_this.currentOffsetAmount < 0) {
				_this.currentOffsetAmount = Math.min(_this.currentOffsetAmount + delta, 0);
				_this.element.css('top', _this.currentOffsetAmount);
				_this.state = 'scrolling';
			  } else {
				_this.state = 'fixed';
				thresholdCounter = 0;
			  }
			  
			}
		  }
		  
		  options.onScroll.call(_this, delta);
		  
		  oldScrollTop = newScrollTop;
		});
	  };
	  
	  this.die = function() {
		$(window).off('scroll.semisticky');
	  };
	  
	  this.init();
	};
	
	</script>
    
    <script>
      $('#hd').semisticky({
        offsetLimit: $('#hd_wrapper').outerHeight(),
      })
    </script>



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




	<? if(defined('_INDEX_')) {?>
<a href="#" id="ft_to_top">TOP</a>
<a href="tel:18338881" id="ft_to_call"><i class="fas fa-phone"></i></a>
<a href="mailto:Happylife00@happylife1004.shop" id="ft_to_mail"><i class="fas fa-envelope"></i></a>

    <? }else if($pid == "benepia" || $pid == "benecafe"){ ?>
    
    <? }else { ?>
<a href="#" id="ft_to_top">TOP</a>
<a href="tel:18338881" id="ft_to_call"><i class="fas fa-phone"></i></a>
<a href="mailto:Happylife00@happylife1004.shop" id="ft_to_mail"><i class="fas fa-envelope"></i></a>
    
    <? } ?> 


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
