<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<script type="text/javascript">
	
</script>
<!-- 회원가입결과 시작 { -->
<div id="reg_result" class="mbskin">
	<h1><i class="fal fa-check-circle"></i></h1>

    <h2>
        <strong><?php echo get_text($mb['mb_name']); ?>, </strong><br>Your membership has been registered.
    </h2>

    <?php if ($config['cf_use_email_certify']) {  ?>
    <p>
        A verification email has been sent to the email address you entered when you joined the membership.<br>
        You can use the website smoothly if you check the sent authentication mail and process it.
    </p>
    <div id="result_email">
        <span>ID</span>
        <strong><?php echo $mb['mb_id'] ?></strong><br>
        <span>E-mail</span>
        <strong><?php echo $mb['mb_email'] ?></strong>
    </div>
    <p>
        If you entered the wrong email address, please contact the site administrator.
    </p>
    <?php }  ?>

    <p>
    	Congratulations on your membership.<br />
        Use a variety of services and information!<br />
        Thank you.
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
        <a href="<?php echo G5_URL ?>/" class="wbtn1">Go to Main page</a>
        <a href="<?php echo G5_BBS_URL ?>/login.php" class="wbtn2">Login</a>
    </div>

</div>
<!-- } 회원가입결과 끝 -->