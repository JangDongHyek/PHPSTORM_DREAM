<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>
            </div><!--//container-->
    	</div><!--//row(부트)-->
    </div><!--//container(부트)-->
</div><!--//wrapper-->

<!-- } 콘텐츠 끝 -->

<hr>
<div id="ft_partner">
    <div class="container">
    <!-- Swiper -->
      <div class="swiper-container-ft">
        <div class="swiper-wrapper">
          <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ps01.gif" alt="신라대학교"></div>
          <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ps02.gif" alt="부산외국어대학교"></div>
          <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ps03.gif" alt="한진중공업"></div>
          <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ps04.gif" alt="POONGSAN"></div>
          <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ps05.gif" alt="삼성웰스토리"></div>
          <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ps06.gif" alt="New huacheng"></div>
          <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ps07.gif" alt="롯데관광"></div>
          <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ps08.gif" alt="AJU TOURS"></div>
          <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ps09.gif" alt="cruise gallery"></div>
          <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ps10.gif" alt="pang's travel service. co,ltd"></div>
          <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ps11.gif" alt="RYE Tour Co.,Ltd"></div>
          <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ps12.gif" alt=""></div>
        </div>
      </div>

	</div>
</div>
 <script>
    var swiper = new Swiper('.swiper-container-ft', {
      slidesPerView: 8,
	  spaceBetween: 10,
	  loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        clickable: true,
      },
    });
  </script>

  
  <!--<div id="fs">
    <div class="container">
    	<ul>
        	<li class="title">Family Brand</li>
        	<li><a href="http://www.chunjabeer.com/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/fs01.gif" alt="오춘자비어"></a></li>
        	<li><a href="http://www.sumbisori.co.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/fs02.gif" alt="숨비소리"></a></li>
        	<li><a href="http://www.pighouse.co.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/fs03.gif" alt="뚱보집"></a></li>
        	<li><a href="http://www.xn--o39a0so33dnmo.com/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/fs04.gif" alt="원가회원"></a></li>
        </ul>
    </div>
</div> -->

<!-- 하단 시작 { -->
	<div id="ft_menu" class="hidden-xs">
    	<div class="container">
            <ul>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=about01">회사소개</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=about05">오시는 길</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=medical01">테마여행</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=car01">차량소개</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항</a></li>            
                <?php if ($is_member) {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                <?php if ($is_admin) {  ?>
                <!--<li><a href="<?php echo G5_ADMIN_URL ?>"><b>관리자</b></a></li>-->
                <?php }  ?>
                <?php } else {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
                <?php }  ?>
            </ul>
        </div>
    </div><!--foot_menu-->
	<div id="footer">
    	<div class="container">
            <!-- address -->
			<address>
            	<h1><img src="<?php echo G5_IMG_URL ?>/ft_logo.png" alt="<?php echo $config['cf_title']; ?>"></h1>
				<p><span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span> <span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?></span> <span><strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?></span></p>
				<p><span><strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?></span> <span><strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?></span> <span><strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?></span> <span><strong><?php echo $config['cf_7_subj']; ?></strong> <?php echo $config['cf_7']; ?></span></p>
                <p><span><strong><?php echo $config['cf_8_subj']; ?></strong> <?php echo $config['cf_8']; ?></span> <span><strong><?php echo $config['cf_9_subj']; ?></strong> <?php echo $config['cf_9']; ?></span> <span><strong><?php echo $config['cf_10_subj']; ?></strong> <?php echo $config['cf_10']; ?></span></p>
				<p class="co">COPYRIGHT(c) 2019 <strong>SILLA TOUR</strong> ALL RIGHTS RESERVED</p>
			</address>	
			<!-- //address -->
        </div>
	</div><!--footer--> 
    
</div><!--wrap--> 
   
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
</div>
<!-----Comodo SEAL Start---------->
<img src="https://www.ucert.co.kr/image/trustlogo/comodo_secure_113x59_white.png" width="113" height="59" align="absmiddle" border="0" style="cursor:pointer;" Onclick="javascript:window.open('https://www.ucert.co.kr/trustlogo/sseal_comodo.html?sealnum=bd7b5c45a5601ef3&sealid=6ae438d732d97336d7e1d64f94454efb', 'mark', 'scrollbars=no, resizable=no, width=400, height=500');">
<!-----Comodo SEAL End---------->


<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>