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
        <strong><?php echo get_text($mb['mb_name']); ?>님</strong><br>회원가입이 완료 되었습니다.
    </h2>

    <?php if ($config['cf_use_email_certify']) {  ?>
    <p>
        회원 가입 시 입력하신 이메일 주소로 인증메일이 발송되었습니다.<br>
        발송된 인증메일을 확인하신 후 인증처리를 하시면 사이트를 원활하게 이용하실 수 있습니다.
    </p>
    <div id="result_email">
        <span>아이디</span>
        <strong><?php echo $mb['mb_id'] ?></strong><br>
        <span>이메일 주소</span>
        <strong><?php echo $mb['mb_email'] ?></strong>
    </div>
    <p>
        이메일 주소를 잘못 입력하셨다면, 사이트 관리자에게 문의해주시기 바랍니다.
    </p>
    <?php }  ?>

    <p>
    	회원가입을 진심으로 축하합니다.<br />
        알차고 다양한 서비스와 정보를 이용해보세요!<br />
        감사합니다.
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
        <!--<a href="<?php /*echo G5_URL */?>/" class="wbtn1">메인으로</a>-->
        <a href="<?php echo G5_BBS_URL ?>/login.php" class="wbtn2" style="width: 100%;">로그인</a>
    </div>

</div>
<!-- } 회원가입결과 끝 -->