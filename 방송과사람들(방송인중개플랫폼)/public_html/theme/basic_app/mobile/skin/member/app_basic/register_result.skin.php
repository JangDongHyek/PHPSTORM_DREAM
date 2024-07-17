<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<script type="text/javascript">
	
</script>

<style>
#ft_copy{ display:none;}
@media screen and (min-width:767px) {
#ft_copy{ display:block;}
}
</style>

<!-- 회원가입결과 시작 { -->
<div id="reg_result" class="mbskin">
	<h1></h1>

    <h2>회원가입이 완료 되었습니다.</h2>

    <p>
    	지금 프로필을 업데이트하시고 <br>맞춤 서비스를 이용하세요!
    </p>
    
    <!--<p>
        회원님의 비밀번호는 아무도 알 수 없는 암호화 코드로 저장되므로 안심하셔도 좋습니다.<br>
        아이디, 비밀번호 분실시에는 회원가입시 입력하신 이메일 주소를 이용하여 찾을 수 있습니다.
    </p>

    <p>
        회원 탈퇴는 언제든지 가능하며 일정기간이 지난 후, 회원님의 정보는 삭제하고 있습니다.<br>
        감사합니다.
    </p>-->

    <div class="btn_confirm2 ft_btn">
        <?php if($member['mb_category'] == '일반') { ?>
        <a href="<?php echo G5_BBS_URL ?>/profile_update01.php" class="wbtn1">지금바로하기</a>
        <?php } else { ?>
        <a href="<?php echo G5_BBS_URL ?>/profile_company_update01.php" class="wbtn1">지금바로하기</a>
        <?php } ?>
        <a href="<?php echo G5_URL ?>" class="wbtn2">다음에 할게요 ~</a>
    </div>

</div>
<!-- } 회원가입결과 끝 -->