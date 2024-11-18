<?php
define('_INDEX_', true);
//if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//if (G5_IS_MOBILE) {
//    include_once(G5_THEME_MOBILE_PATH.'/index.php');
//    return;
//}




include_once(G5_LIB_PATH.'/latest.tabs.lib.php'); //최근글
?>


<div id="idx_wrapper" style="display:none">
	<div class="container">
	    <!--<div id="idx_cus">
        	<ul>
            	<li>주문전화<strong>1566-3366</strong></li>
            	<li>가맹문희<strong>02)6011-7042</strong></li>
            </ul>
        </div> -->
        <div id="idx_ad">
            <!--<div class="ad_title">
                <h2>인기폭팔 고추 윙&amp;봉</h2>
                <span>이미 많은 치킨 덕후들에게 인정받고 있습니다!</span>
            </div>
            <div class="embed-container">
            <iframe width="100%" height="720" src="https://www.youtube.com/embed/RE_h8KCcRSg?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div> -->
            <div id="movieSlide">
             <ul class="movie">
			 
			 



              <!--간지순살 -->
              <li>
              	<div class="movie_box">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_gan_1.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_gan_2.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_gam_m_1.png" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_gam_m_2.png" class="visible-xs" style="width:35px; height:147px" alt="">
                <iframe id="yt3" width="636" height="358" src="https://www.youtube.com/embed/qc3S6bX_kaA" frameborder="0" allowfullscreen></iframe>                
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_gam_m_3.png" class="visible-xs" style="width:35px; height:147px" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_gam_m_4.png" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_gan_3.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_gan_4.png" class="hidden-xs" alt="">
                </div>
              </li>
              <!--//간지순살 -->
			  
			  
			  
			  
              
              <!--이영자영상 추가 -->
              <li>
              	<div class="movie_box">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc7-1.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc7-2.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile7-1.png" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile7-2.png" class="visible-xs" style="width:35px" alt="">
                <iframe id="yt3" width="636" height="358" src="https://www.youtube.com/embed/h8Hm9huGsBo" frameborder="0" allowfullscreen></iframe>                
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile7-3.png" class="visible-xs" style="width:35px" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile7-4.png" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc7-3.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc7-4.png" class="hidden-xs" alt="">
                </div>
              </li>
              <!--//이영자영상 추가 -->

              <!--밥블레스유 추가 -->
              <!--li>
              	<div class="movie_box">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc8-1.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc8-2.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile8-1.png" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile8-2.png" class="visible-xs" style="width:35px" alt="">
                <iframe id="yt4" width="636" height="358" src="https://www.youtube.com/embed/x0fHL5o4yQo?ecver=2" frameborder="0" allowfullscreen></iframe>
               
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile8-3.png" class="visible-xs" style="width:35px" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile8-4.png" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc8-3.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc8-4.png" class="hidden-xs" alt="">
                </div>
              </li-->
              <!--//밥블레스유 추가 -->

              <li>
              	<div class="movie_box">
                	<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event02&wr_id=18">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_event01_190123_PC.JPG" alt="" class="hidden-xs">
					 <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/idx_menu_event01_190123m.jpg" alt="" class="visible-xs">
                    
                    </a>
                </div>
              </li>
              
			  <li>
              	<div class="movie_box">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc1-1.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc1-2.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile1-1.png" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile1-2.png" class="visible-xs" style="width:35px" alt="">
                <iframe id="yt1" width="636" height="358" src="https://www.youtube.com/embed/05_Sp5ZOLN0" frameborder="0" allowfullscreen></iframe>
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile1-3.png" class="visible-xs" style="width:35px" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile1-4.png" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc1-3.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc1-4.png" class="hidden-xs" alt="">
                </div>
              </li>			  

              <li>
              	<div class="movie_box">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc2.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile2.png" alt="" class="visible-xs">
                </div>
              </li>
			  
			  
			  <!--li>
              	<div class="movie_box">
			
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc_crispy.jpg" class="hidden-xs" alt="크리스피">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_m_crispy.jpg" class="visible-xs" alt="크리스피">
			
                </div>
              </li-->
			  
			  
			  
              <li>
              	<div class="movie_box">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile3-1.png" alt="" style="width:100%" class="visible-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile3-2.png" alt="" style="width:68px" class="visible-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc3-1.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc3-2.png" alt="" class="hidden-xs">
                    <iframe id="yt2" width="520" height="295" src="https://www.youtube.com/embed/ACHHS86Vahs?enablejsapi=1" frameborder="0" allowfullscreen></iframe>
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc3-3.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile3-3.png" alt="" style="width:68px" class="visible-xs">
                    <a href="https://play.google.com/store/apps/details?id=com.jangs.sixtychicken&rdid=com.jangs.sixtychicken&pli=1" target="_blank">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc3-4.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile3-4.png" alt="" style="width:100%" class="visible-xs">
                    </a>
                </div>
               <!--<a href="https://play.google.com/store/apps/details?id=com.jangs.sixtychicken&rdid=com.jangs.sixtychicken&pli=1" target="_blank" class="ms_btn01">60계 어플 다운받고 CCTV확인하기 <i class="fa fa-arrow-right"></i></a> -->
              </li>
			  
              <li>
              	<div class="movie_box">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc4.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile4.png" alt="" class="visible-xs">
                </div>
              </li>
			  
              <li>
              	<div class="movie_box">
				    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=share">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc5.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile5.png" alt="" class="visible-xs">
					</a>
                </div>
              </li>
			  
              <!--li>
              	<div class="movie_box">
                    <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=after">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc6.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile6.png" alt="" class="visible-xs">
                    </a>
                </div>
              </li-->
			  
             </ul>
              <script type="text/javascript">
				   $(function(){
					var slider =  $('.movie').bxSlider({
					 autoControls: true,
					 stopAutoOnClick: true,
					 pager: true,
					 slideWidth:1130,
					 onSlideNext:function($e,p,n){
					  if(tgs[p]){
					   tgs[p].stopVideo();
					  }
					 },
					 onSlidePrev:function($e,p,n){
					  if(tgs[p]){
					   tgs[p].stopVideo();
					  }
					 }
					});
				   });
				   // 유투브 스크립트
				   var ids = ["yt1","yt2","yt3","yt4"];  // 각 iframe의 아이디 
				   var tgs = []; // 로딩된 iframe의 값을 저장
				   var tag; 
				   var firstScriptTag; 
				   tag = document.createElement('script'); 
				   tag.src = "https://www.youtube.com/iframe_api"; 
				   firstScriptTag = document.getElementsByTagName('script')[0]; 
				   firstScriptTag.parentNode.insertBefore(tag, firstScriptTag); 
				   
				   function onYouTubeIframeAPIReady(){ 
					for(var i = 0 ; i < ids.length ; i++){ // 
					 var player = new YT.Player(ids[i], {  
					  events: {'onReady':onPlayerReady} 
					 }); 
					}
				   
				   }
				
				   function onPlayerReady(event) { 
					tgs.push(event.target);
					if(tgs.length == ids.length){
					 tgs.sort(function(a,b){return a.g-b.g});
					 tgs[0].playVideo();
					}
				   }
              </script>
            </div><!-- //visual -->
            <!-- 광고영역시작 { 
            <ul class="ad_list">
                <li>
                	<a href="">
                    <div class="col-xs-9">
                    	<div class="text">
                        <p>60계치킨 메뉴 &amp; 가격 8800원!!</p>
                        <span>드뎌 방학이다 방학 배달음식이 있어 감사한 요즘 괌 갔다가 돌아온 날 왜이리 땡기는게 많은지 파티를 했더랬다 제일 먼저 땡긴건 60계치킨! 하루 60마리만 튀겨서...</span>
                        </div>
                        <div class="from">
                            <i></i> 아기볼링<span class="date">2017.10.26</span>
                        </div>
                    </div>
                    <div class="col-xs-3 img">
                    <img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxNzA4MDRfMjQ2%2FMDAxNTAxODU4NjgxNzY3.uexrDcB3WcsXLXH4p4vqlx83HJqR1tELCUcWUek1Mq8g.-7QD5ih-OjE1vO4KXDfSykX0k7YcGkvpOznJD7vTzDgg.JPEG.hwayoonee%2FIMG_5698.jpg&type=m100_100" alt="">
                    </div>
                    </a>

                </li>
                <li>
                	<a href="">
                    <div class="col-xs-9">
                    	<div class="text">
                        <p>60계치킨 메뉴 &amp; 가격 8800원!!</p>
                        <span>드뎌 방학이다 방학 배달음식이 있어 감사한 요즘 괌 갔다가 돌아온 날 왜이리 땡기는게 많은지 파티를 했더랬다 제일 먼저 땡긴건 60계치킨! 하루 60마리만 튀겨서...</span>
                        </div>
                        <div class="from">
                            <i></i> 아기볼링<span class="date">2017.10.26</span>
                        </div>
                    </div>
                    <div class="col-xs-3 img">
                    <img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxNzA4MDRfMjQ2%2FMDAxNTAxODU4NjgxNzY3.uexrDcB3WcsXLXH4p4vqlx83HJqR1tELCUcWUek1Mq8g.-7QD5ih-OjE1vO4KXDfSykX0k7YcGkvpOznJD7vTzDgg.JPEG.hwayoonee%2FIMG_5698.jpg&type=m100_100" alt="">
                    </div>
                    </a>
                </li>
                <li>
                	<a href="">
                    <div class="col-xs-9">
                    	<div class="text">
                        <p>60계치킨 메뉴 &amp; 가격 8800원!!</p>
                        <span>드뎌 방학이다 방학 배달음식이 있어 감사한 요즘 괌 갔다가 돌아온 날 왜이리 땡기는게 많은지 파티를 했더랬다 제일 먼저 땡긴건 60계치킨! 하루 60마리만 튀겨서...</span>
                        </div>
                        <div class="from">
                            <i></i> 아기볼링<span class="date">2017.10.26</span>
                        </div>
                    </div>
                    <div class="col-xs-3 img">
                    <img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxNzA4MDRfMjQ2%2FMDAxNTAxODU4NjgxNzY3.uexrDcB3WcsXLXH4p4vqlx83HJqR1tELCUcWUek1Mq8g.-7QD5ih-OjE1vO4KXDfSykX0k7YcGkvpOznJD7vTzDgg.JPEG.hwayoonee%2FIMG_5698.jpg&type=m100_100" alt="">
                    </div>
                    </a>
                </li>
                <li>
                	<a href="">
                    <div class="col-xs-9">
                    	<div class="text">
                        <p>60계치킨 메뉴 &amp; 가격 8800원!!</p>
                        <span>드뎌 방학이다 방학 배달음식이 있어 감사한 요즘 괌 갔다가 돌아온 날 왜이리 땡기는게 많은지 파티를 했더랬다 제일 먼저 땡긴건 60계치킨! 하루 60마리만 튀겨서...</span>
                        </div>
                        <div class="from">
                            <i></i> 아기볼링<span class="date">2017.10.26</span>
                        </div>
                    </div>
                    <div class="col-xs-3 img">
                    <img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxNzA4MDRfMjQ2%2FMDAxNTAxODU4NjgxNzY3.uexrDcB3WcsXLXH4p4vqlx83HJqR1tELCUcWUek1Mq8g.-7QD5ih-OjE1vO4KXDfSykX0k7YcGkvpOznJD7vTzDgg.JPEG.hwayoonee%2FIMG_5698.jpg&type=m100_100" alt="">
                    </div>
                    </a>
                </li>
                <li>
                	<a href="">
                    <div class="col-xs-9">
                    	<div class="text">
                        <p>60계치킨 메뉴 &amp; 가격 8800원!!</p>
                        <span>드뎌 방학이다 방학 배달음식이 있어 감사한 요즘 괌 갔다가 돌아온 날 왜이리 땡기는게 많은지 파티를 했더랬다 제일 먼저 땡긴건 60계치킨! 하루 60마리만 튀겨서...</span>
                        </div>
                        <div class="from">
                            <i></i> 아기볼링<span class="date">2017.10.26</span>
                        </div>
                    </div>
                    <div class="col-xs-3 img">
                    <img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxNzA4MDRfMjQ2%2FMDAxNTAxODU4NjgxNzY3.uexrDcB3WcsXLXH4p4vqlx83HJqR1tELCUcWUek1Mq8g.-7QD5ih-OjE1vO4KXDfSykX0k7YcGkvpOznJD7vTzDgg.JPEG.hwayoonee%2FIMG_5698.jpg&type=m100_100" alt="">
                    </div>
                    </a>
                </li>
                <li>
                	<a href="">
                    <div class="col-xs-9">
                    	<div class="text">
                        <p>60계치킨 메뉴 &amp; 가격 8800원!!</p>
                        <span>드뎌 방학이다 방학 배달음식이 있어 감사한 요즘 괌 갔다가 돌아온 날 왜이리 땡기는게 많은지 파티를 했더랬다 제일 먼저 땡긴건 60계치킨! 하루 60마리만 튀겨서...</span>
                        </div>
                        <div class="from">
                            <i></i> 아기볼링<span class="date">2017.10.26</span>
                        </div>
                    </div>
                    <div class="col-xs-3 img">
                    <img src="https://search.pstatic.net/common/?src=http%3A%2F%2Fblogfiles.naver.net%2FMjAxNzA4MDRfMjQ2%2FMDAxNTAxODU4NjgxNzY3.uexrDcB3WcsXLXH4p4vqlx83HJqR1tELCUcWUek1Mq8g.-7QD5ih-OjE1vO4KXDfSykX0k7YcGkvpOznJD7vTzDgg.JPEG.hwayoonee%2FIMG_5698.jpg&type=m100_100" alt="">
                    </div>
                    </a>
                </li>
            </ul>
            <!-- } 광고영역끝 -->
        </div>
        
        

        <div id="idx_container" style="display:none">
		
		    <div class="main_banner">
        	  <a href="https://m.map.naver.com/search2/search.nhn?query=60%EA%B3%84%EC%B9%98%ED%82%A8" target="_blank">
              <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/search_mobile.png" alt="" style="width:100%; margin-bottom:10px;">
              </a>
			</div>
			 
            <div id="idx_tab">
                <!-- 탭타이틀 { -->
                <ul class="idx_tab">
                    <li><a class="selected" href="#idx_tab1"><p>60계치킨</p><span>Menu&amp;Event</span></a></li>
                    <li><a href="#idx_tab2"><p>60계치킨</p><span>Brand Story</span></a></li>
                </ul>
                <!-- } 탭타이틀-->
                <!-- 탭컨텐츠패널 { -->
                <ul class="idx_panel">
                    <li id="idx_tab1">
                    <!-- 메뉴&이벤트 { -->
                    <div id="tab_menu">
                    	<!--<div class="tab_menu_title">
                            <span>인기메뉴 왕중왕</span>
                            <h3>고추봉 &amp; 간지윙</h3>
                        </div> -->
						<!--a href="http://www.60chicken.co.kr/bbs/board.php?bo_table=event02&wr_id=15">
						<img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_event01_181126.png" alt="">
						</a-->
						<!--<img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_event180802.jpg" alt=""> -->
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_event01.jpg" alt="">
                    </div>
                    <!-- } 메뉴&이벤트 -->
                    <!--img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_event02.png" alt="할인 이벤트 및 광고"-->
                   <img src="<?php echo G5_THEME_IMG_URL ?>/main/open_img.jpg" alt="오픈안내">
                    <!-- 지점별 주문 및 CCTV { -->
                    <div id="tab_store">
                    	<div class="tab_store_title">
                        	<a href="http://map.naver.com/index.nhn?query=NjDqs4Q&enc=b64&tab=1"><i class="fa fa-search"></i> 내 주변의 60계치킨 매장찾기</a> 
                        </div>						                        
						<?=latest_tabs('latest_cate', "cctv", 200, 50); ?> 
                    </div>
                    <!-- } 지점별 주문 및 CCTV -->
                    </li>
                    <li id="idx_tab2">
                    
                        <div id="tab_story">
                        	
                            <div class="story_title">
                                <h3 class="row">
                                    <p class="col-sm-5 col-xs-12">
                                    <img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>" class="logo">
                                    </p>
                                    <p class="col-sm-7 col-xs-12">
                                     매일 새 기름(18L)으로!<br>
                                     깨끗하고 맛있는 60계치킨!
                                    </p>
                                </h3>
                                <div class="video embed-container">
                                	<iframe width="1280" height="720" src="https://www.youtube.com/embed/qy0Y_Vz1jCY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                	<!--<img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_video.jpg" alt="">-->
                                </div>
                                <span>
                        
                                <strong>60계치킨은</strong> 그날 사용한 기름은 모두 폐기하고, 매일 깨끗한 새 기름(18L) 으로 60마리만(뼈닭+순살 1마리 기준) 조리하고 있습니다.
                                </span>
                            </div>
							
                            <div class="news_img">
							<dd class="contents">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/1.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/2.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/3.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/4.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/5.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/6.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/7.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/8.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/9.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/10.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/11.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/12.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/13.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/14.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/15.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/16.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/17.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/18.jpg" alt="">
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/19.jpg" alt="">
							</dd>
							</div>
							
                            <div class="story">
                            	<h4>왜? 기름을 매일 교체해야 하나요?</h4>
                                <dl>
                                	<dt>1. 기름이 오랫동안 '열' 받으면 몸에 해로운 '발암' 물질이 생긴다!</dt>
                                    <dd>치킨을 60마리를 넘게 튀긴 기름은 산패도가 높아지면서 인체 유해물질을 생성합니다.<br>
                                    때문에! 60계치킨은 무조건 새 기름으로 교체하고 있습니다!</dd>
                                    <dd class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story01.jpg" alt=""></dd>
                                </dl>
                                <dl>
                                	<dt>2. 사용한 기름을 '버리지 않으면' 밤 사이 기름에 '벌레'가 빠진다!</dt>
                                    <dd>그날 사용한 기름을 버리지 않으면 밤 사이 벌레들이 기름 통으로 빠지게 됩니다.<br>
                                    그래서! 60계치킨은 60마리를 튀기지 못 해도 그 날 사용한 기름은 그날 폐기합니다!<br>
                                    (본사에서 기름 1통을 매일 제공하기 때문에 치킨 가격에 영향을 주지 않습니다.)</dd>
                                    <dd class="cartoon">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_01.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_02.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_03.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_04.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_05.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_06.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_07.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_08.jpg" alt="">
                                    </dd>
                                </dl>
                                
                            	<h4>왜? 주방 CCTV를 공개하고 있나요?</h4>
                                <dl>
                                	<dt>1. 고객을 위해! 우리 스스로를 감시하자!</dt>
                                    <dd>고객님께서 매 순간마다 지켜보고 있다는 마음을 스스로 가지고<br class="hidden-xs">
                                    항상 깨끗하고 건강한 치킨을 고객님께 전달 드리고 있습니다!</dd>
                                    <dd class="video embed-container">
                                    <iframe width="1280" height="720" src="https://www.youtube.com/embed/ACHHS86Vahs" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    <!--<img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story03.jpg" alt=""> -->
                                    </dd>
                                </dl>
                                <dl>
                                	<dt>2. 천번 말하기 보다 한번 보여드리자!</dt>
                                    <dd>하루가 멀다 하고 터지는 먹거리 위생 문제! 말로만 깨끗하게 만든다고 하면 안심되시나요?<br>
                                    그래서! 60계치킨은 고객님께서 주문하신 치킨의 조리과정을 직접 보실 수 있도록 국내 최초로 주방 내부 CCTV를 24시간 공개하고 있습니다! 
                                    직접 확인해 보세요!</dd>
                                </dl>
                                <a href="https://play.google.com/store/apps/details?id=com.jangs.sixtychicken&rdid=com.jangs.sixtychicken&pli=1
" target="_blank" class="btn btn-default btn-lg"> 60계치킨 CCTV 어플 <i class="fa fa-download" aria-hidden="true"></i></a>
                            </div>
                        
                        </div>
                        <!--//tab_story-->
                    
                    </li>
                </ul>
                <!-- } 탭컨텐츠패널 -->
            </div>
        
        
        </div><!-- #idx_container -->

    </div>
    
</div><!--  #idx_wrapper -->

