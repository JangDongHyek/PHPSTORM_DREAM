<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

<!-- 로그인 시작 { -->
<div class="icons" style="position: absolute; right: 10px; top: 10px;"></div> 
<div class="m_input_title">
      <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_input_title1.png">
</div>


<div class="m_input_bo">
	<div class="" style="height: 100px;">
		<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_input_title4.png" alt="이름" style="height:30px; width:auto;">
		<p><input type="text" id="mb_name" name="mb_name" value="" style="border:1px solid #DBDBDB; padding:15px 5px; width:100%; max-width:200px; font-size:1.25em;"></p>
	</div>
	
	<div class="" style="height: 100px;">
		<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_input_title5.png" alt="전화번호" style="height:30px; width:auto;">
		<p><input type="tel" id="mb_hp" name="mb_hp" value="" style="border:1px solid #DBDBDB; padding:15px 5px; width:100%; max-width:200px; font-size:1.25em;"></p>
	</div>

	<div class="" style="height: 200px;">
		<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_input_title3.png" style="height:30px; width:auto;">
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

$(".c").click(function(){
	$(".c_on").addClass("c").removeClass("c_on");
	$(this).addClass("c_on").removeClass("c");
	age = $(this).val();
});

function save(){
	var mb_name = $("#mb_name").val();
	var mb_hp = $("#mb_hp").val();
	
	if(!mb_name){
		alert("이름을 작성해주세요.");
		return;
	}
	
	if(!mb_hp){
		alert("전화번호를 작성해주세요.");
		return;
	}

	if(age == -1){
		alert("나이를 선택해주세요.");
		return;
	}

	$.get( "<?=G5_URL?>/bbs/ajax_member_input.php?mb_name="+mb_name+"&mb_hp="+mb_hp+"&age="+age, function( data ) {
		location.replace(data);
	});

}

</script>
<!-- } 로그인 끝 -->