<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
	
$bo_table = "practice";

//날짜 없을때
if(!$year) $year = date("Y");
if(!$month) $month = date("m");
if(!$day) $day = date("d");

//오늘 날짜 구하는 함수
function toWeekNum($timestamp) { 
    $w = date('w', mktime(0,0,0, date('n',$timestamp), 1, date('Y',$timestamp))); 
    return ceil(($w + date('j',$timestamp) -1) / 7); 
} 

$st = mktime(0, 0, 0, $month, $day, $year);
$week = toWeekNum($st);

$sd = $year."-".$month."-".$day;
$sunday = date('w', $st);

$str_date = strtotime($sd." -".$sunday."days");

include_once(G5_THEME_MOBILE_PATH.'/head.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
?>



	<!--이미지 롤링-->
	    <div id="rolling_mtab" class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/img_roll.jpg" style="width:100%">
            </div>
            <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/img_roll2.jpg" style="width:100%">
            </div>
			<div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/img_roll2.jpg" style="width:100%">
            </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
<!--이미지 롤링-->



<div id="m_wrap" class="container">	
	<!--탑배너시작-->
	<div class="topban row">
        <div class="col-xs-4 wow bounceIn" style="padding: 0 3px;" data-wow-delay="0.1s">
            <a href="<?php echo G5_BBS_URL ?>/practice.php?bo_table=practice"><div class="tban s1">
                <div class="txt">
                    <h2><img src="http://www.dreamforone.com/~ddcheon/theme/basic/img/mobile/board_ico3.png"> 페이스북 소식</h2>
					<div class="board_bg1"></div>
                    <p>응답하라 동두천 페이스북 소식!</p>
                </div>
        	</div></a>
        </div>
        <div class="col-xs-4 wow bounceIn" style="padding: 0 3px;" data-wow-delay="0.2s">
            <a href="<?php echo G5_BBS_URL ?>/practice.php?bo_table=ensemble"><div class="tban s2">
                <div class="txt">
                    <h2><img src="http://www.dreamforone.com/~ddcheon/theme/basic/img/mobile/board_ico2.png"> 후기게시판</h2>
					<div class="board_bg2"></div>
                    <p>남자친구와 달콤아이스 다녀왔어요!!</p>
                </div>
        	</div></a>
        </div>
        <div class="col-xs-4 wow bounceIn" style="padding: 0 3px;" data-wow-delay="0.3s">
            <a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=event"><div class="tban s3">
                <div class="txt">
                    <h2><img src="http://www.dreamforone.com/~ddcheon/theme/basic/img/mobile/board_ico1.png"> 이벤트 게시판</h2>
					<div class="board_bg3"></div> 
                    <p>DR헤어 5주년 이벤트 12시 이전 50%</p>
                </div>
        	</div></a>
        </div>
    </div><!--.topban.row-->
    <!--탑배너끝-->
</div><!--m_wrap-->


<!--메인탭메뉴-->

<style>
	html{background: rgb(101, 92, 137);font-family: "Lato", sans-serif;}
   ul,li {margin:0;padding:0;list-style:none;background: transparent;}

   a:active,a:focus {outline: expression(hideFocus='true');}

p {margin-bottom: 0px;}

#wrapper {width: 100%;margin: 0 auto;margin-top: 0;    background: linear-gradient(to right,#a5c9de,#a09fed);}
#tabs,#tabs2,#tabs3,#tabs4,#tabs5 {width:96%;margin: 0 auto;margin-bottom: 40px;}

#tabs li,#tabs2 li,#tabs3 li,#tabs4 li,#tabs5 li {float: left;width: 20%;}

#tabs li a,#tabs2 li a,#tabs3 li a,#tabs4 li a,#tabs5 li a {display: block;text-align: center; border-radius: 5px 5px 0 0; padding: 5px 0;}

#tabs li a:hover,#tabs2 li a:hover,#tabs3 li a:hover,#tabs4 li a:hover,#tabs5 li a:hover {background: rgb(78, 74, 99);}

#tabs_container {padding: 15px;overflow: hidden;position: relative;background: white;}
#tabs_container div {margin-right: 0;}

.transition {
	-webkit-transition: all .3s ease-in-out;
	-moz-transition: all .3s ease-in-out;
	-o-transition: all .3s ease-in-out;
	-ms-transition: all .3s ease-in-out;
	transition: all .3s ease-in-out;

	-webkit-transition-delay: .3s;
	-moz-transition-delay: .3s;
	-o-transition-delay: .3s;
	-ms-transition-delay: .3s;
	transition-delay: .3s;
}

.make_transist {
	-webkit-transition: all .3s ease-in-out;
	-moz-transition: all .3s ease-in-out;
	-o-transition: all .3s ease-in-out;
	-ms-transition: all .3s ease-in-out;
	transition: all .3s ease-in-out;
}

.hidescale {
	-webkit-transform: scale(0.9);
	-moz-transform: scale(0.9);
	-o-transform: scale(0.9);
	-ms-transform: scale(0.9);
	transform: scale(0.9);
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
	filter: alpha(opacity=0);
	filter: alpha(opacity=0);
	opacity: 0;
}

.showscale {
	-webkit-transform: scale(1);
	-moz-transform: scale(1);
	-o-transform: scale(1);
	-ms-transform: scale(1);
	transform: scale(1);
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
	filter: alpha(opacity=100);
	opacity: 1;

	-webkit-transition-delay: .3s;
	-moz-transition-delay: .3s;
	-o-transition-delay: .3s;
	-ms-transition-delay: .3s;
	transition-delay: .3s;
}

.hideleft {
	-webkit-transform: translateX(-100%);
	-moz-transform: translateX(-100%);
	-o-transform: translateX(-100%);
	-ms-transform: translateX(-100%);
	transform: translateX(-100%);
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
	filter: alpha(opacity=0);
	opacity: 0;
}

.showleft {
	-webkit-transform: translateX(0px);
	-moz-transform: translateX(0px);
	-o-transform: translateX(0px);
	-ms-transform: translateX(0px);
	transform: translateX(0px);
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
	filter: alpha(opacity=100);
	opacity: 1;

	-webkit-transition-delay: .3s;
	-moz-transition-delay: .3s;
	-o-transition-delay: .3s;
	-ms-transition-delay: .3s;
	transition-delay: .3s;
}

.hidescaleup {
	-webkit-transform: scale(1.1);
	-moz-transform: scale(1.1);
	-o-transform: scale(1.1);
	-ms-transform: scale(1.1);
	transform: scale(1.1);
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
	filter: alpha(opacity=0);
	opacity: 0;
}

.showscaleup {
	-webkit-transform: scale(1);
	-moz-transform: scale(1);
	-o-transform: scale(1);
	-ms-transform: scale(1);
	transform: scale(1);
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
	filter: alpha(opacity=100);
	opacity: 1;

	-webkit-transition-delay: .3s;
	-moz-transition-delay: .3s;
	-o-transition-delay: .3s;
	-ms-transition-delay: .3s;
	transition-delay: .3s;
}

.hideflip {
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
	filter: alpha(opacity=0);
	opacity: 0;

	-webkit-transform: rotatey(-90deg) scale(1.1);
	-moz-transform: rotatey(-90deg) scale(1.1);
	-o-transform: rotatey(-90deg) scale(1.1);
	-ms-transform: rotatey(-90deg) scale(1.1);
	transform: rotatey(-90deg) scale(1.1);

	-webkit-transform-origin: 50% 50%;
	-moz-transform-origin: 50% 50%;
	-o-transform-origin: 50% 50%;
	-ms-transform-origin: 50% 50%;
	transform-origin: 50% 50%;
}

.showflip {
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
	filter: alpha(opacity=100);
	opacity: 1;

	-webkit-transition-delay: .3s;
	-moz-transition-delay: .3s;
	-o-transition-delay: .3s;
	-ms-transition-delay: .3s;
	transition-delay: .3s;

	-webkit-transform: rotatey(0deg) scale(1);
	-moz-transform: rotatey(0deg) scale(1);
	-o-transform: rotatey(0deg) scale(1);
	-ms-transform: rotatey(0deg) scale(1);
	transform: rotatey(0deg) scale(1);

	-webkit-transform-origin: 50% 50%;
	-moz-transform-origin: 50% 50%;
	-o-transform-origin: 50% 50%;
	-ms-transform-origin: 50% 50%;
	transform-origin: 50% 50%;
}

.tabulous_active {
	background: white !important;
	color: #655c89 !important;
}

.tabulousclear {
	display: block;
	clear: both;
}</style>







<div id="wrapper">

				<div id="tabs">
		<ul>
			<li><a href="#tabs-1" title="">배달</a></li>
			<li><a href="#tabs-2" title="">먹거리</a></li>
			<li><a href="#tabs-3" title="">놀거리</a></li>
			<li><a href="#tabs-4" title="">꾸밀거리</a></li>
			<li><a href="#tabs-5" title="">생활편의</a></li>
		</ul>

		<div id="tabs_container">
			



		<div id="tabs-1">
			   <img src="http://www.dreamforone.com/~ddcheon/theme/basic/img/mobile/main_food.png" style="width:96%; height: auto; ">
		</div>

		<div id="tabs-2">
			    <img src="http://www.dreamforone.com/~ddcheon/theme/basic/img/mobile/main_food.png" style="width:96%; height: auto; ">
	
		</div>

		<div id="tabs-3">
			    <img src="http://www.dreamforone.com/~ddcheon/theme/basic/img/mobile/main_food.png" style="width:96%; height: auto; ">
		</div>
			
		<div id="tabs-4">
			    <img src="http://www.dreamforone.com/~ddcheon/theme/basic/img/mobile/main_food.png" style="width:96%; height: auto; ">
		</div>
			
		<div id="tabs-5">
			    <img src="http://www.dreamforone.com/~ddcheon/theme/basic/img/mobile/main_food.png" style="width:96%; height: auto; ">
		</div>

		</div><!--End tabs container-->
		
	</div><!--End tabs-->

	</div>


<script type="text/javascript">
$(document).ready(function($) {
    

    $('#tabs').tabulous({
    	effect: 'scale'
    });

});

</script>

<!--메인탭메뉴끝-->
   <!-- Swiper JS -->
    <script src="<?php echo G5_THEME_JS_URL ?>/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('#rolling_mtab', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
		speed: 1200,
        spaceBetween: 0,
        autoplay: 5000,
		loop:true,
    });	      
    </script>
    <!--//이미지 롤링-->	

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>