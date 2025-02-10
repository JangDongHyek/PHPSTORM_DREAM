<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>

</div><!-- container End -->
</div><!-- wrapper End -->



<div id="footerWrap">
	<div class="ft_top ">
		<div class="inr">
			<div class="notiBox">
				<h4>NOTICE</h4>
				<!--  사진 최신글2 { -->
					<?php
					// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
					// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
					// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
					echo latest('theme/shop_basic','notice',  1, 23);
					?>
			</div>
			<p class="btmBtn">
				<span class="btmBtnBox">
					<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">BRAND</a>
					<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">이용약관</a>
					<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy" class="yellow"><strong>개인정보처리방침</strong></a>
					<a href="<?php echo G5_URL; ?>/adm">관리자</a>
				</span>
			</p>
		</div>
	</div>
    <?php if($_SERVER['REMOTE_ADDR']=="183.103.22.103"){ ?>
        <ul class="sns_icon">
            <li><a><img src=""><i class="fa-brands fa-instagram"></i></a></li>
            <li><a><img src=""><i class="fa-brands fa-facebook"></i></a></li>
            <li><a><img src=""><i class="fa-brands fa-twitter"></i></a></li>
            <!--<li><a><img src=""><i class="fa-brands fa-youtube"></i></a></li>-->
        </ul>
    <?php }?>
	<div class="ft_info">
	<div id="newft">
        <div class="ftTop">
            <div class="inr flex">
                <div class="accBox">
                    <h4>BANK INFO</h4>
                    <ul class="account">
                        <!--li>
                            <p>농협
                            <span class="accnum"></span></p>
                        </li-->
                        <li>
                            <p>국민은행
                                <span class="accnum">122101-04-122229</span></p>
                        </li>
                    </ul>
                    <span class="txt">예금주 : 예성코리아(김순애)</span>

                </div>
                <div class="telBox">
                    <h4>CS CENTER</h4>
                    <p class="telN"><?php echo $default['de_admin_company_tel']; ?></p>
                    <p class="txt">평일 AM09:00 ~ PM18:00 <br>(주말 & 공휴일 휴무)</p>
                    <!--a href="http://pf.kakao.com/_xdbxgxbb" target="_blank" class="btn"><i class="fas fa-comment"></i> 카카오톡 문의하기</a-->
                </div>
                <div class="snsBox">
                    <div>
                        <h4>예성코리아 공식 SNS</h4>
                        <ul>
                            <!--<li><a><img src="<?php /*echo G5_THEME_IMG_URL; */?>/icon/ft_snsicon01.png" title="유튜브"></a></li>-->
                            <li><a><img src="<?php echo G5_THEME_IMG_URL; ?>/icon/ft_snsicon02.png" title="인스타"></a></li>
                            <li><a><img src="<?php echo G5_THEME_IMG_URL; ?>/icon/ft_snsicon03.png" title="카카오친구플러스"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="appDawn">
                    <h4>예성코리아 APP</h4>
                    <!--<a href="https://apps.apple.com/kr/app/%EB%8C%80%EC%84%B1%EA%B3%A8%ED%94%84/id6449326204" target="_blank"><i class="fab fa-google-play"></i> Google Play Download</a>-->
                    <a href="javascript:alert('준비중입니다.')"><i class="fab fa-google-play"></i> Google Play Download</a>			
                    <a href="javascript:alert('준비중입니다.')"><i class="fab fa-apple"></i> App Store Download</a>
                </div>
            </div>
        </div>
        <div class="adrBox">
            <div class="inr">
                <div class="flex js">
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/common/flogo.png">
                    <a class="toggle_btn">사업자정보 <i class="far fa-angle-down"></i></a>
                </div>
                <div class="toggle">
                <p>
                    <span><b><?php echo $config['cf_title']; ?></b></span>
                    <span><b>주소</b> <?php echo $default['de_admin_company_addr']; ?></span><br>
                    <span><b>사업자등록번호</b> <?php echo $default['de_admin_company_saupja_no']; ?></span>
                    <span><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></span><br>
                    <span><b>전화</b> <?php echo $default['de_admin_company_tel']; ?></span>
                    <span><b>이메일</b> <?php echo $default['de_admin_info_email']; ?></span><br>
                    <span><b>대표</b> <?php echo $default['de_admin_company_owner']; ?></span>
                    <!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span><br> -->
                    <span><b>개인정보 보호책임자</b> <?php echo $default['de_admin_info_name']; ?></span>
                    <span><b></b> </span>
                    <!--
                    <?php if ($default['de_admin_buga_no']) echo '<span><b>부가통신사업신고번호</b> '.$default['de_admin_buga_no'].'</span>'; ?><br>
                    -->
                </p>
                <p class="copy">
                    COPYRIGHT &copy; 2023 <b><?php echo $config['cf_title']; ?></b>. ALL RIGHTS RESERVED.
                </p>
                </div>
            </div>
		</div>
	</div>
	<!-- /newft -->
        <script>
            $(".toggle_btn").click(function(e){
                $(".toggle").toggle();
            })
        </script>

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
<a href="tel:070-4066-3148" id="ft_to_call"><i class="fas fa-phone"></i></a>



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
