<?php
include_once("./_common.php");
include_once(G5_THEME_PATH.'/head.sub.php');

set_session("intro", 1);
?>
<div id="intro">
    <!-- Swiper -->
    <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
      	<div id="page" class="page1">
            <p class="t1">온 세상 런칭 커뮤니티</p>
            <img src="<?php echo G5_THEME_IMG_URL;?>/renewal/logo.png" class="logo" alt=""/>
            <img src="<?php echo G5_THEME_IMG_URL;?>/renewal/intro.png" class="logo" alt=""/>
            <p class="t2">startup platform</p>
          </div>
        </div>
      <div class="swiper-slide">
      	<div id="page" class="page2">
            <p class="t1">온 세상 런칭 <strong>커뮤니티</strong></p>
            <img src="<?php echo G5_THEME_IMG_URL;?>/renewal/logo.png" class="logo" alt="" style="width:15%"/>
            <a href="<?php echo G5_URL;?>/bbs/register_form.php" class="btn">회원가입 cash적립</a>
            <?php if ($is_member) { ?>
            <a href="<?php echo G5_URL;?>/bbs/loout.php" class="btn">로그아웃</a>
            <?php } else { ?>
            <a href="<?php echo G5_URL;?>/bbs/login.php" class="btn">로그인</a>
            <?php } ?>

            <img src="<?php echo G5_THEME_IMG_URL;?>/renewal/intro_p2_ad.jpg" class="" alt=""/>
            <div class="slg-text">
            	<h3>온세상 런칭 커뮤니티</h3>
                <p>인류의 유익을 위한 시공간 지식정보의 혁신적 제4차산업의 온- 오프라인 창업의 활성, 
                본인사업화 런칭프리미엄, 청년일자리 창출과 각종정보공유 사회적비용절감,
                온산의 길물경제는 금융의 순환거래를 촉진하고 경제적 지위향상과 풍요속의 빈곤탈출의 기회가 됩니다.</p>
            </div>
            <div class="slg-text">
            	<h3>주식회사 대한민국!<br>무료의 세상을 연계한다.</h3>
                <p>위캐시기능별 정보서비스는 광고 홍보 쇼핑 결제등 지역경제 발전과 함께 무료로 제공되며 
                인공위성 GPS 전국 지역정보는 근거리 노출하며 필요한 정보는 검색어로 연계되어있습니다.</p>
            </div>
        </div>
      </div>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    </div>

    <!-- Swiper JS -->
    <script src="../js/swiper.min.js"></script>
    
    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('.swiper-container', {
      pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
      },
    });
    </script>
</div>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>