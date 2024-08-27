<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
$text = $mb['mb_nick'] ? $mb['mb_nick'] : $mb['mb_name'];
?>
<script type="text/javascript">

</script>
<!-- 회원가입결과 시작 { -->
<div id="reg_result" class="mbskin">
	<h1><i class="fad fa-check fa-2x"></i></h1>

    <h2>

        <strong><?php echo $text ?>님</strong><br>반갑습니다.
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

    <!--<p class="scom">
        프로필을 작성하시면<br /><?=$config['cf_title']?>에서 제공하는<br />
        <strong>모든 컨텐츠 이용</strong>이 가능합니다.
        <div class="add"><i class="fas fa-camera-retro"></i> <span>얼굴 정면사진</span>과 <span>전신사진</span>을 준비해주세요.<br />입력하신 프로필은 <span>전체공개</span>입니다.</div>
    </p>-->

    <!--<p>
        회원님의 비밀번호는 아무도 알 수 없는 암호화 코드로 저장되므로 안심하셔도 좋습니다.<br>
        아이디, 비밀번호 분실시에는 회원가입시 입력하신 이메일 주소를 이용하여 찾을 수 있습니다.
    </p>

    <p>
        회원 탈퇴는 언제든지 가능하며 일정기간이 지난 후, 회원님의 정보는 삭제하고 있습니다.<br>
        감사합니다.
    </p>-->


    <div class="btn_confirm2 ft_btn">
        <!--<a href="<?php echo G5_BBS_URL ?>/profile.php" class="btn02"><i class="fal fa-user-alt fa-2x"></i><br />프로필 작성하기</a>-->
        <a href="<?php echo G5_URL ?>/index.php" class="btn01">메인으로 가기</a>
    </div>

</div>
<!-- } 회원가입결과 끝 -->
<script>
    // $(document).ready(function() {
    //     document.location.replace("")
    // });

</script>