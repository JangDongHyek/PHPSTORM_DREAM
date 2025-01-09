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
              <div class="s1">
			  
			 <iframe width="510" height="288" src="https://www.youtube.com/embed/mFzyyD7fkug" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="position:absolute; right:10px; top:10px;"></iframe><img src="<?php echo G5_IMG_URL ?>/main_img_1.png" border="0"/></div>
              <div class="s2"><img src="<?php echo G5_IMG_URL ?>/main_img_2.png" border="0"/></div>
              <div class="s3"><img src="<?php echo G5_IMG_URL ?>/main_img_3.png" border="0"/></div>
			  <div class="s4"><img src="<?php echo G5_IMG_URL ?>/main_img_4.png" border="0"/></div>
          </div><!-- #slider -->
    </div><!--#mvisual-->  
</div><!--#mvisual_wrap-->

<!--div class="req_bn">
	<a href="" onclick="window.open('<?php echo G5_BBS_URL ?>/write.php?bo_table=request', 'pop_privacy', 'resizable=yes, scrollbars=yes, width=740, height=800')">
		<img src="<?php echo G5_IMG_URL ?>//request/request_bn.jpg" alt="2017년 1회 BEST 양산 진로 진학 박람회 신청">
    </a>
</div-->

<div id="mcont">
	<div id="cont01">

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
                    echo latest("basic", noticee, 5, 20,"...");
                    ?>
           </div>
        </div>
        <div class="bbs2">
            <div style="<?php echo $lt_style ?>">
            	<h1>포토뉴스</h1>
            	<br />
		<div style="<?php echo $lt_style ?>">
				<?php echo latest("thum_gal", "galleryy",3, 10,"..."); ?>
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
     
	 <div style="height:30px;"></div>
	 
	 <!-- 
      <div id="cont02">
      	<div class="subject">
        	<h2>체험프로그램</h2>
      		<p class="mainP">청소년들이 다양한 진로와 직업을 이해하고 체험합니다.</p>
              
              <div class="p3">
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=experience08">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon11.png" /></div>
              <h1>찾아가는 직업인 특강</h1>
              <p>학교로 찾아가는 진로캠프를 통해 자신의 적성과 흥미를 파악하여 구체적인 자신의 진로로드맵을 설계해보는 기회를 제공합니다.</p>       </a>
            </div>
              <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education09">
              <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon12.png" /></div>
              <h1>찾아오는 창직 진로캠프</h1>
              <p>다양한 직업분야를 체험하고 전문직업인들의
                특강을 통해 진로탐색과 꿈을 발견할 수 있는
                정보를 제공합니다.</p>       </a>
            </div>
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education10">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon10.png" /></div>
              <h1>가족캠프 (붕어빵)</h1>
              <p>가족간의 원활한 소통과 자녀의 진로를 함께 탐색하세요.</p>        </a>
            </div>
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education11">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon09.png" /></div>
              <h1>창의적 활동프로그램</h1>
              <p>창업동아리, 진로포토폴리오, 대학원생 맨토링, 스포츠지원프로그램 등의 프로그램을 신청하세요.</p>
            </a>
            </div>        
            </div>
      	</div>
      </div><!--cont2-->

	
	<!--  
      <div id="cont03">
      	<div class="subject">
        	<h2>교육 프로그램</h2>
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
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education05">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon06.png" /></div>
              <h1>진로코치 심화연수</h1>
              <p>진로코치들의 역량강화를 위한 진로코칭<br />
                교육으로 창직 프로그램 연수와<br />새로운 직업 발견을 위합니다.</p>       </a>
            </div>
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education08">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon07.png" /></div>
              <h1>드림매니저 연수</h1>
              <p>진로교육을 위한 매니저 연수 과정입니다. <br />아이들의 꿈과 희망을 지원합니다.</p>        </a>
            </div>
            <div class="conticon"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education07">
            <div class="img"><img src="<?php echo G5_IMG_URL ?>/conticon08.png" /></div>
              <h1>수시 All Kill 특강 </h1>
              <p>수시를 위한 이해와<br />진로와 연계한 대학진학 준비<br />등을 위한 특강입니다.</p></a>
            </div>        
            </div>
      	</div>
      </div><!--cont3-->

</div><!--#mcont-->





<?php
include_once(G5_PATH.'/tail.php');
?>