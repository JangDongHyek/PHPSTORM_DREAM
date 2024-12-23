<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>
<style>
.swiper-container {
      width: 100%;
      height: 300px;

    }
    .swiper-slide {

      text-align: center;
      font-size: 18px;
      background: #fff;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
</style>
<link rel="stylesheet" href="<?=G5_CSS_URL?>/swiper.min.css">

<div id="idx_wrapper">
    <!--pc메인슬라이더 시작-->
    <div id="visual">
        <div id="slogan">
            <div class="img01">CHEMICAL SOLUTION LEADER</div>
            <div class="img02">해외 주요 시장에서 최상의 제품과 서비스를 제공하여 고객의 기대에 부흥하고자 최선을 다하겠습니다.</div>
        </div><!--#slogan-->
        <div id="mslogan">
            <div class="img01">CHEMICAL SOLUTION LEADER</div>
            <div class="img02">해외 주요 시장에서 최상의 제품과 서비스를 제공하여 고객의 기대에 부흥하고자 최선을 다하겠습니다.</div>
        </div><!--#mslogan-->
        <ul class="sliderbx">
        	<li class="mv01"></li>
        	<li class="mv02"></li>
        	<li class="mv03"></li>
        </ul><!--.sliderbx-->
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->

<!--제품롤링-->
<div class="pro_roll">
    <div class="container">
         <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-container" >
            <h2 class="pro_title">PRODUCTS</h2>
            <div class="swiper-wrapper">
                 <?php
            // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
            // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
            // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
                    for($i=1;$i<=5;$i++){
                        $j=$i<10?"0".$i:$i;
                        echo latest("theme/product","pro".$j, 3, 10);
                    }
            ?>
                
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div><!--swiper-container-->
    </div>
</div><!--pro_roll-->
<? /*
<div id="roll_banner" class="carousel slide" data-ride="carousel">
		<h2>PRODUCTS</h2>
      <!-- Indicators -->
      <ol class="carousel-indicators">
         <li data-target="#roll_banner" data-slide-to="0" class="active"></li>
         <li data-target="#roll_banner" data-slide-to="1"></li>
      </ol>			
      <!-- Wrapper for slides -->

   <div class="carousel-inner" role="listbox">
             <div class="item active">
                <div class="row">
                    <div class="col-md-2 col-xs-6"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/pro01.jpg" alt="사이트1"></a></div>
                    <div class="col-md-2 col-xs-6"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/pro02.jpg" alt="사이트2"></a></div>
                    <div class="col-md-2 col-xs-6"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/pro03.jpg" alt="사이트3"></a></div>
                    <div class="col-md-2 col-xs-6"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/pro04.jpg" alt="사이트4"></a></div>
                    <div class="col-md-2 col-xs-6"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/pro05.jpg" alt="사이트4"></a></div>
                </div>
             </div>
             <div class="item">
                <div class="row">
                    <div class="col-md-2 col-xs-6"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/pro06.jpg" alt="사이트1"></a></div>
                    <div class="col-md-2 col-xs-6"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/pro07.jpg" alt="사이트2"></a></div>
                    <div class="col-md-2 col-xs-6"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/pro08.jpg" alt="사이트3"></a></div>
                    <div class="col-md-2 col-xs-6"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/pro09.jpg" alt="사이트4"></a></div>
                    <div class="col-md-2 col-xs-6"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/sub/pro10.jpg" alt="사이트4"></a></div>
                </div>
             </div>
   </div>    
    <!-- Controls -->
    <a class="left carousel-control" href="#roll_banner" role="button" data-slide="prev">
    ◀
    <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#roll_banner" role="button" data-slide="next">
    ▶
    <span class="sr-only">Next</span>
    </a>
</div>*/?>
<!--제품롤링-->
<script src="<?=G5_JS_URL?>/swiper.min.js"></script>
<script>
var swiper;
function initSwiper(){
	swiper = new Swiper('.swiper-container', {
			
			slidesPerView: 5,
			slidesPerGroup: 5,
			spaceBetween : 10,
			loop: true,
			loopFillGroupWithBlank: true,
			autoplay: {
				delay: 3000,
			},
			setWrapperSize:true,
			breakpoints:{
				320:{
					slidesPerView: 2,
					slidesPerGroup: 2
				},
				480: {
					slidesPerView: 2,
					slidesPerGroup: 2
				},
				640: {
					slidesPerView: 2,
					slidesPerGroup: 2
				},

			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		});
}
	initSwiper();
	
	
</script>



<div class="main_mov">
	<h2 class="pro_title">PRODUCTS VIDEO</h2>
    <ul>
     	<li class="col-sm-3 col-xs-6"><a href="https://www.youtube.com/watch?v=0iuQXFtQBTE" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mov1.jpg" /></a></li>
        <li class="col-sm-3 col-xs-6"><a href="https://www.youtube.com/watch?v=0iuQXFtQBTE" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mov2.jpg" /></a></li>
        <li class="col-sm-3 col-xs-6"><a href="https://www.youtube.com/watch?v=0iuQXFtQBTE" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mov3.jpg" /></a></li>
        <li class="col-sm-3 col-xs-6"><a href="https://www.youtube.com/watch?v=0iuQXFtQBTE" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mov4.jpg" /></a></li>
    </ul>
</div><!--main_mov-->

<?php
include_once(G5_PATH.'/tail.php');
?>