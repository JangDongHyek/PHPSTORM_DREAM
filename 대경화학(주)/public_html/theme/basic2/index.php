<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<div id="carousel-generic" class="carousel slide">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-generic" data-slide-to="1"></li>
            <li data-target="#carousel-generic" data-slide-to="2"></li>
            <li data-target="#carousel-generic" data-slide-to="3"></li>          
          </ol>
  
           <!-- Carousel items -->
           <div class="carousel-inner">
           	  <p class="mtxt"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_txt.png" /></p>
              <div class="item active">
                 <img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img01.jpg" alt="First slide">
              </div>
              <div class="item">
                 <img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img02.jpg" alt="Second slide">              
              </div>
              <div class="item">
                 <img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img03.jpg" alt="Third slide">               
              </div>
              <div class="item">
                 <img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img04.jpg" alt="Third slide">               
              </div>                           
           </div>
          <!-- Controls -->
            <a class="left carousel-control" href="#carousel-generic" data-slide="prev">
               <img src="<?php echo G5_THEME_IMG_URL ?>/main/left.png" class="control">
            </a>
            <a class="right carousel-control" href="#carousel-generic" data-slide="next">
              <img src="<?php echo G5_THEME_IMG_URL ?>/main/right.png" class="control">
            </a>
</div>

<!--메인슬라이더 시작-->
<script type="text/javascript">
       $('.carousel').carousel()
       $('.carousel2').carousel({interval: 3000 }) 
</script>
<!--//메인슬라이드 끝-->


<div id="main_ban" class="container">
	<div class="main_ban_in">
    	<h2>에코하이(주) 사업소개</h2>
        <p class="con">에코하이(주)는 다양한 공사를 통해 축적된 시공노하우와 신뢰할 수 있는 기술력을 바탕으로 최상의 만족을 제공해 드립니다. </p>
        <ul class="box_list cf">
        	<div class="title">토목사업</div>
            <a href=""><li class="col-xs-6 col-md-3">
                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/con_banner01.jpg" alt="토목사업"/></div>
            </li></a>
            <a href=""><li class="col-xs-6 col-md-3">
                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/con_banner02.jpg" alt="토목사업"/></div>
            </li></a>
            <a href=""><li class="col-xs-6 col-md-3">
                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/con_banner03.jpg" alt="토목사업"/></div>
            </li></a>
            <a href=""><li class="last col-xs-6 col-md-3">
                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/con_banner04.jpg" alt="토목사업"/></div>
            </li></a>
        </ul><!--토목사업-->
        <ul class="box_list cf">
        	<div class="title">제조업</div>
            <a href=""><li class="col-xs-6 col-md-3">
                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/con_banner05.jpg" alt="제조업"/></div>
            </li></a>
            <a href=""><li class="col-xs-6 col-md-3">
                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/con_banner06.jpg" alt="제조업"/></div>
            </li></a>
            <a href=""><li class="col-xs-6 col-md-3">
                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/con_banner07.jpg" alt="제조업"/></div>
            </li></a>
            <a href=""><li class="last col-xs-6 col-md-3">
                <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/con_banner08.jpg" alt="제조업"/></div>
            </li></a>
        </ul><!--제조업-->
    </div><!--main_ban_in-->
</div><!--main_ban-->

<ul class="com_ban cf container">
	<li class="a col-xs-12 col-md-4" >
    	<h2>에코하이(주) 회사소개 <img src="<?php echo G5_THEME_IMG_URL ?>/main/con_title01.gif" alt="회사소개"/></h2>
        <div>저희 에코하이(주)는 생산과 설계 시공으로<br />보강토시공과 조경석 콘크리트옹벽, 패널식옹벽 등을<br />전문적인 신기술로 시공하고 있습니다.</div>
        <a href="<?php echo G5_URL ?>/bbs/content.php?co_id=greet01">바로가기 ▶</a>
    </li>
    <li class="b col-xs-12 col-md-4">
    	<h2>시공실적 <img src="<?php echo G5_THEME_IMG_URL ?>/main/con_title01.gif" alt="시공실적"/></h2>
        <div>최고의 기술력과 생산설비를 바탕으로 최고의 제품을<br />만들기 위해 끊임없이 연구하고 개발하여 최상의<br />품질을 갖추고  있습니다.</div>
        <a href="<?php echo G5_URL ?>/bbs/content.php?co_id=result01">바로가기 ▶</a>
    </li>
    <li class="c col-xs-12 col-md-4">
    	<h2>기술보유현황 <img src="<?php echo G5_THEME_IMG_URL ?>/main/con_title01.gif" alt="기술보유현황"/></h2>
        <div>지속적인 연구와 차별화된 전략을 통한<br />제품 기술력 향상과 발빠른 대처로 많은 기술력을<br />보유하고 있습니다.</div>
        <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=inn">바로가기 ▶</a>
    </li>
</ul><!--com_ban-->


<?php
include_once(G5_PATH.'/tail.php');
?>