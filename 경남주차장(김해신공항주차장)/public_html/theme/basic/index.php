<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<script src="<?php echo G5_JS_URL ?>/jquery.slides.min.js"></script>

<div id="mvisual_wrap" style="background:url(<?php echo G5_THEME_IMG_URL ?>/main_bg.jpg) no-repeat center top; ">
    <div id="m_slogan">
        <a href="<?php echo G5_BBS_URL; ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/main_banner_text.png" border="0" usemap="#m_slogan_link" /></a>
    </div>

    <div id="mvisual">
          <div id="slider">
              <div class="s1" style="background:url(<?php echo G5_THEME_IMG_URL ?>/main_product01.png) no-repeat center top;"></div>
              <div class="s2" style="background:url(<?php echo G5_THEME_IMG_URL ?>/main_product01.png) no-repeat center top;"></div>
          </div><!-- #slider -->
    </div><!--#mvisual-->  
</div><!--#mvisual_wrap-->

<div id="mcont">
	<p class="p1"><img src="<?php echo G5_THEME_IMG_URL ?>/main_banner1.gif" border="0"></p>
	<p class="p2"><img src="<?php echo G5_THEME_IMG_URL ?>/main_banner2.gif" border="0"></p>
	<div class="bbs">
		<div style="<?php echo $lt_style ?>">
			<img src="<?php echo G5_THEME_IMG_URL ?>/notice_line.gif" />
				<?php echo latest("basic", "board1_1", 4, 29); ?>
			<img src="<?php echo G5_THEME_IMG_URL ?>/qna_line.gif" />
				<?php echo latest("basic", "board2_1", 4, 29); ?>
	   </div>
	</div>
</div><!--#mcont-->

<!--메인 슬로건 이미지 애니메이션-->
<script>
	$(document).ready(function(){
		$('#m_slogan').animate({
			 height:'200px',
			 width:'456px',
			 top:'130px',
			 /*marginLeft:'-535px'*/
		},1500);	
	});	

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
					speed:1500	// 슬라이드 넘어가는 속도를 설정
				}
			}
		}) // 슬라이더명령 끝
	}) // 실행문의 끝
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>