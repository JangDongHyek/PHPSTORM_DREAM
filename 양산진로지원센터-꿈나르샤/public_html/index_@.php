<?php
include_once('./_common.php');



define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_PATH.'/head.php');
?>


<div id="mvisual_wrap">
  <script src="<?php echo G5_JS_URL ?>/jquery.slides.min.js"></script>
    <!--메인 슬로건 이미지 애니메이션-->
  <script>
	$(document).ready(function(){
			$('#m_slogan').animate({
				 height:'251px',
				 width:'572px',
				 top:'96px',
				 <!--marginLeft:'-535px'-->
			     },1500);	
		});	
    </script>
    
    <!--.메인롤링관련-->
  <script>
    $(function(){ // 실행문의 시작
    
        // 슬라이더명령 시작
        $("#slider").slidesjs({
                navigation:{ // 좌우버튼 세팅
                        active:true, // 사용하면 true, 미사용이면 false
                        effect:"slide" // 좌우버튼을 눌렀을때 발생되는 효과. 
                                                 // "slide" 또는 "fade"
                },pagination:{ // 페이저버튼 세팅
                        active:true, // 사용하면 true, 미사용이면 false
                        effect:"slide" // 페이저버튼을 눌렀을때 발생되는 효과. 
                                                 // "slide" 또는 "fade"
                },play:{ // 스탑,플레이버튼 세팅
                        active:false, // 사용하면 true, 미사용이면 false
                        effect:"slide", // 버튼을 눌렀을때 효과. "slide" 또는 "fade" 
                        auto:true,	// 자동재생 설정					 
                        interval:4000 // 이미지 전환되는 간격.1초=1000 
                },effect:{ // 화면전환효과
                        slide: {
                            speed:800	// 슬라이드 넘어가는 속도를 설정
                        }
                }
        }) // 슬라이더명령 끝
            
    }) // 실행문의 끝
    </script>

    <!--div id="m_slogan">
       <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=g_chilling"><img src="<?php echo G5_IMG_URL ?>/main_text.png"></a>
    </div-->
    <div id="mvisual">
          <div id="slider">
              <div class="s1"><img src="<?php echo G5_IMG_URL ?>/main_img_1.png" border="0"/></div>
              <div class="s2"><img src="<?php echo G5_IMG_URL ?>/main_img_2.png" border="0"/></div>
              <div class="s3"><img src="<?php echo G5_IMG_URL ?>/main_img_3.png" border="0"/></div>
          </div><!-- #slider -->
    </div><!--#mvisual-->  
</div><!--#mvisual_wrap-->


<div id="mcont">
	<div id="cont01">
            	<h2>새소식</h2>
      		<p class="mainP">양산진로교육지원센터의 새로운 소식을 전해드립니다.</p>
		<!--<div class="button">
        	<img src="img/button.jpg" alt="" border="0" usemap="#Map2" />
            <map name="Map2" id="Map2">
              <area shape="rect" coords="3,3,149,78" href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel" />
              <area shape="rect" coords="155,4,302,76" href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel&mode=identify" />
            </map>
        </div>-->
      <div class="bbs">
            <div style="<?php echo $lt_style ?>">
            	<h1>공지사항</h1><br />
					<?php
                    echo latest("basic", noticee, 4, 20,"...");
                    ?>
           </div>
        </div>
        <div class="bbs2">
            <div style="<?php echo $lt_style ?>">
            	<h1>갤러리</h1><br />
		<div style="<?php echo $lt_style ?>">
				<?php echo latest("thum_gal", "galleryy",3, 15,"..."); ?>
	   </div>
           </div>
        </div>
        <div class="m_call">
        <img src="<?php echo G5_IMG_URL ?>/m_call.jpg" border="0" usemap="#Map3" />
        <map name="Map" id="Map3">
          <area shape="rect" coords="2,2,172,99" href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel" />
          <area shape="rect" coords="175,2,344,100" href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel&mode=identify" />
        </map>
      </div>
    	<!--<div class="p4">
          <h1>CS Center</h1>
            <p>Tel. 055-327-2011~2012</p>
            <p>Fax. 055-327-2079</p>
            <p>E-mail. hssms2@hanmail.net</p>
       	</div>-->
      </div><!--/cont01-->
      
      <div id="cont02">
      	<div class="subject">
        	<h2>진로/직업체험</h2>
      		<p class="mainP">청소년들이 다양한 진로와 직업을 이해하고 체험합니다.</p>
              
              <div class="p3">
              <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=experience02">
              <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon12.png" /></div>
              <h1>자유학기제 프로그램</h1>
              <p>다양한 직업분야를 체험하고 전문직업인들의
                특강을 통해 진로탐색과 꿈을 발견할 수 있는
                정보를 제공합니다.</p>       </a>
            </div>
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education03">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon11.png" /></div>
              <h1>진로코치 심화연수</h1>
              <p>진로코치들의 역량강화를 위한 진로코칭 교육 
                창작프로그램연수와 새로운 직업을 위한
                다양한 정보를 제공합니다.</p>       </a>
            </div>
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=experience03">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon10.png" /></div>
              <h1>진로캠프</h1>
              <p>학교로 찾아가는 진로캠프를 통해 자신의 적성과 흥미를 파악하여 구체적인 자신의 진로로드맵을 설계해보는 기회를 제공합니다.</p>        </a>
            </div>
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=experience04">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon09.png" /></div>
              <h1>창작진로캠프</h1>
              <p>자신의 강점을 알아보고 매래의 나만의<br />
              직업을  디자인해 봅니다.</p>
            </a>
            </div>        
            </div>
      	</div><!--/subject-->
      </div><!--cont2-->
      
      <div id="cont03">
      	<div class="subject">
        	<h2>진로교육</h2>
      		<p class="mainP">학생 및 학부모를 대상으로 진로 방향을 제시하고 직업관을 형성합니다.</p>
              
              <div class="p1">
              <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education02">
              <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon05.png" /></div>
              <h1>진로진학 상담교실</h1>
              <p>진로탐색과 활동을 통해 자기이해 및<br />
              다양한 직업세계를 이해하고 직업선택의<br />
              폭을 넓힙니다.</p>  
              </a>     
            </div>
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=program07">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon06.png" /></div>
              <h1>유형별 학과 검사</h1>
              <p>검사자의 학습유형을 파악하고, 그에 따른 부족요소가 무엇인지 파악함으로써 유형별 
맞춤 학습법을 제시해주는 검사입니다.</p>       </a>
            </div>
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=program06">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon07.png" /></div>
              <h1>학과계열 선정검사</h1>
              <p>실질적이고 과학적인 분석으로 본인의 적성에 맞는 고등학교 계열과 대학 학과(전공)를 알려주는 검사입니다.</p>        </a>
            </div>
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=program05">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon08.png" /></div>
              <h1>특목고 적합도검사</h1>
              <p>목고 진학 결정 시, 개인의 적성이 특목고 교육환경의 특수성과 얼마나 잘 맞는지를 과학적으로 진단하는 검사입니다.</p></a>
            </div>        
            </div>
      	</div><!--/subject-->
      </div><!--cont3-->

</div><!--#mcont-->





<?php
include_once(G5_PATH.'/tail.php');
?>