<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>
<link href='https://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/scroll.css"> <!-- Resource style -->
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/mouse.css"> <!-- mouse animate style -->
<script src="<?php echo G5_THEME_JS_URL ?>/modernizr.js"></script> <!-- Modernizr -->

<!--메인페이지-->

<!--cate-->
<nav class="cd-vertical-nav">
	<ul>
		<li><a href="#section1"><span class="label">Intro</span></a></li>
		<li><a href="#section2"><span class="label">BUSINESS</span></a></li>
		<li><a href="#section3"><span class="label">PORTFOLIO</span></a></li>
		<li><a href="#section4"><span class="label">CUSTOMER</span></a></li>
	</ul>
</nav>
<!--//cate-->

<!--section--><button class="cd-nav-trigger cd-image-replace" style="width:auto"><span aria-hidden="true"></span></button>

<section id="section1" class="cd-section">
	<div class="content-wrapper">
        
        <!--<canvas id="canvas" class="" style="width:100%; height:100%"></canvas>//dot animation-->
        
		<h2 class="hidden">INTRO</h2>
        <div class="slogan wow fadeInDown" data-wow-delay="0.2s">
           <p class="t0 text-center">CREATIVE</p>
           <p class="t1 text-center">아이티포원이 고객님께 드리는 믿음과 의지입니다.</p>
           <p class="t2 text-center"><span>정도를 걷는기업</span><br />아이티포원이 지향하는 길입니다.</p>
        </div>
		<a href="#section2" class="cd-scroll-down cd-image-replace wow bounceIn" data-wow-delay="1.0s"><div class="mouse"></div><p class="t_padding10 hidden-sm hidden-xs" style="font-size:1.30em; font-weight:600; line-height:1.0em">Scroll<br />Down</p></a>
	</div>
</section><!-- cd-section -->

<article>
   <div class="hidden-lg hidden-md m_call wow fadeInUp" data-wow-delay="0.4s">
           <p class="t1 text-center"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company" class="" style="color:#fff !important" data-transition="slide">웹사이트 및 프로그램 제작문의&nbsp;<i class="fa fa-phone-square"></i></a></</p>
           <p class="t0 text-center">051.891.0087</p>
           <p class="t1 text-center">수정관련상담 : 051-891-0088</p>
        </div>
</article>


<section id="section2" class="cd-section wow fadeInUp" data-wow-delay="0.1s">
	<div class="content-wrapper">
		<h2 class="wow bounceIn" data-wow-delay="0.3s">WEB Business</h2>
        <p class="ht wow fadeInDown t_padding30" data-wow-delay="0.5s">고객님의 성공을 함께합니다.</p>
		<p class="wow fadeInUp">아이티포원은 보다 전문화되고 안정된 온라인 서비스를 제공하고 오랜 경험과 노하우를 바탕으로<br />
비즈니스 환경에 맞추어 컨설팅 및 서비스에 최선을 다하고 있습니다.</p>
    
  <div class="m_content02 clearfix t_margin50 b_margin50">
  
     <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp"  data-wow-delay="0.2s"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img01.png" class="imgWidth" style="height:100px"><br />
     <p class="title text-center t_margin20">CREATIVE IDEAS</p>
     <p class="cont text-center">끊임없이 변화하는 디지털 기술과 크리에이티브를 <br />혁신적으로 융합해 고객님에게 경쟁력 있는 <br />브랜드 디자인과 마케팅을 통합 서비스 해드립니다.</p>
     <div class="b_margin20 visible-xs"></div>
     </div>
     
     
     <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp" data-wow-delay="0.4s"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img02.png" class="imgWidth" style="height:100px"><br />
     <p class="title text-center t_margin20">BRAND BUILDER</p>
     <p class="cont text-center">고객님의 웹사이트의 제작부터 관리까지 웹대행사로서<br /> 차별화된 고객님의 온라인 브랜드를<br /> 제시해 드리고 있습니다.</p>
     <div class="b_margin20 visible-xs"></div>
     </div>

     
     <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp" data-wow-delay="0.6s"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img03.png" class="imgWidth" style="height:100px"><br />
     <p class="title text-center t_margin20">WEB/MARKETING</p>
     <p class="cont text-center">고객의 니즈와 사용자의 니즈를 조절하여 사이트의 방향성을<br /> 함께 고민하고 철저한 일정관리를 통해<br /> 성공적인 웹사이트 제작을 진행하고 있습니다.</p>
     <div class="b_margin20 visible-xs"></div>
     </div>

     
     <div class="col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp" data-wow-delay="0.8s"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img04.png" class="imgWidth" style="height:100px"><br />
     <p class="title text-center t_margin20">E-BUSINESS GROUP</p>
     <p class="cont text-center">체계적인 홈페이지 관리를 통한안정된 서비스 유지와<br /> 지속적인 트렌드에 맞는 제안으로<br /> 고객님의 E-BUSINESS에 날개를 달아 드리고 있습니다.</p>
     </div>
     
  </div>


	</div>
</section><!-- cd-section -->

<section id="section3" class="cd-section">
	<div class="content-wrapper">
		<h2 class="hidden">PORTFOLIO</h2>
	</div>
</section><!-- cd-section -->

<section id="section4" class="cd-section">
	<div class="content-wrapper">
		<h2 class="wow bounceIn" data-wow-delay="0.3s">Customer</h2>
        <p class="ht_g wow fadeInDown t_padding30" data-wow-delay="0.5s">철저한 사후관리/ 체계적인 유지보수 </p>
		<p class="wow fadeInUp" data-wow-delay="0.8s">아이티포원은 고객과 새로운 만남을 매우 소중하게 생각합니다.<br />합리적인 가격과 최상의 디자인 퀄리티로 항상 고객만족에 힘쓰고 있습니다. </p>
        
        <!--고객지원 박스-->
        <div class="m_comm_area t_margin50">
            <div class="mcomm-wrap">
				<div class="mcomm-sec">
					<a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=b_online" class="ico04">
						<h4 class="ctit">웹사이트/프로그램 제작문의</h4>
						<p class="stxt">아이티포원의 새소식!!<br />살기좋은 지역사회를 위해 노력하겠습니다.</p>
					</a>
				</div>
                <div class="mcomm-sec">
						<form name='signform' method='post' action='./sms_send_process.php'>
							   <div class="content">
									<div>
										<textarea name="sms_content" class="placeholder" style="border:none; background:rgba(46, 168, 237); border-radius:5px;-msborder-radius:5px; padding:3%; color:#fff !important; width:100%;" rows="4" placeholder="방문주소와 연락처를 남겨주세요.&#10;빠른시간내에 회신드리겠습니다." onkeyup="fnChkByte(this);"></textarea>
									</div>
									<div style="padding:5px 0 0">
										<input name="phone_number" type="text" maxlength="11" style="border:1px solid #999; background:#fff; border-radius:3px;-msborder-radius:3px; padding:3%; color:#555; width:100%;ime-mode:disabled;" placeholder="회신번호 입력" onkeypress="onlyNumber()">&nbsp;&nbsp;
										<input type="button" value="전송하기" style="border:none; background:#ff6c00; border-radius:3px;-msborder-radius:3px; padding:3%; color:#fff; font-weight:bold; letter-spacing:-.055em; width:100%; opacity:1;" onClick="sendMsg()">
									</div>
							   </div>
						   </form>
				</div>
				<div class="mcomm-sec">
					<a class="ico02">
						<h4 class="ctit">아이티포원 고객센터</h4>
						<p class="stxt">아이티포원의 새소식!!<br />살기좋은 지역사회를 위해 노력하겠습니다.</p>
					</a>
				</div>
				<div class="mcomm-sec">
					<a class="ico03">
						<h4 class="ctit">공지사항</h4>
						<p class="stxt">아이티포원의 새소식!!<br />살기좋은 지역사회를 위해 노력하겠습니다.</p>
					</a>
				</div>
			</div>
          </div>
        <!--//고객지원 박스-->
        
	</div>
</section><!-- //cd-section -->
<!--//section-->

<!--//메인페이지-->
<script src="<?php echo G5_THEME_JS_URL ?>/circle_animate.js"></script> <!-- 애니메이션 -->
<script src="<?php echo G5_THEME_JS_URL ?>/main.js"></script> <!-- Resource jQuery -->

<?php
include_once(G5_PATH.'/tail.php');
?>