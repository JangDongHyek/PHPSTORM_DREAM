<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
/*
html, body{width:100%;height:100%;min-height:500px;background:url(<?php echo $member_skin_url ?>/img/bg.png) #f0f0f0; overflow-y:hidden; overflow-x:hidden;}
*/
</style>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

<!-- 로그인 시작 { -->
<div class="icons" style="position: absolute; right: 10px; top: 10px;">
		<?/*
		<a href="<?php echo G5_URL ?>"><i class="fa fa-home"></i><span class="sound_only">홈으로</span></a>
		<a href="#"><i class="fa fa-cog"></i><span class="sound_only">설정</span></a>
		*/?>
		<a href="javascript:history.back();" class="closed"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/menu_close.png"><span class="sound_only">닫기</span></a>
	</div> 
<div class="m_input_title">
      <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_input_title1.png">
</div>


<div class="m_input_bo">
	<div class="" style="height: 200px;">
	 <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_input_title2.png">
	
	<ul class="gender">		  
	    <li id="girl"class="a" onclick="on_girl();"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_girl.png" ></li>
		<li id="boy" class="b" onclick="on_boy();"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_boy.png" ></li>
	</ul>
	</div>

	<div class="" style="height: 200px;">
	 <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_input_title3.png">
	<ul class="age">		  
	    <li class="c" value="10">10대</li>
        <li class="c" value="20">20대</li>
		<li class="c" value="30">30대</li>
		<li class="c" value="40">40대</li>
		<li class="c" value="50">50대</li>
	</ul>
 </div>

<div class="m_check" onclick="save()">확인</div>
</div>	

<script>

var gen = -1;
var age = -1;

function on_girl(){
	$("#girl").addClass("a_on").removeClass("a");
	$("#boy").addClass("b").removeClass("b_on");
	gen = 1;
}

function on_boy(){
	$("#girl").addClass("a").removeClass("a_on");
	$("#boy").addClass("b_on").removeClass("b");
	gen = 2;
}

$(".c").click(function(){
	$(".c_on").addClass("c").removeClass("c_on");
	$(this).addClass("c_on").removeClass("c");
	age = $(this).val();
});

function save(){
	if(gen == -1){
		alert("성별을 선택해주세요.");
		return;
	}

	if(age == -1){
		alert("나이를 선택해주세요.");
		return;
	}

	$.get( "<?=G5_URL?>/bbs/ajax_member_input.php?gen="+gen+"&age="+age, function( data ) {
		location.replace(data);
	});

}

</script>
<!-- } 로그인 끝 -->