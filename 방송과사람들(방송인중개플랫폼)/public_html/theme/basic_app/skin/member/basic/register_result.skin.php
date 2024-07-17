<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>



<style>
	#ft_copy{ display:none;}
	#ft_menu{ display:none;}
	@media screen and (min-width:767px) {
	#ft_copy{ display:block;}
	}
</style>

<!-- 회원가입결과 시작 { -->
<div id="reg_result" class="mbskin">
	<h1></h1>

    <h2><?php echo get_text($mb['mb_id']); ?>님, 회원가입이 완료 되었습니다.</h2>

    <p>
    	지금 프로필을 업데이트하시고 <br>서비스를 이용하세요!
    </p>
    
  

    <div class="btn_confirm2 ft_btn">
        <a href="" class="wbtn1">지금바로하기</a>
        <a href="<?php echo G5_URL ?>" class="wbtn2">다음에 할게요 ~</a>
    </div>

</div>
<!-- } 회원가입결과 끝 -->

