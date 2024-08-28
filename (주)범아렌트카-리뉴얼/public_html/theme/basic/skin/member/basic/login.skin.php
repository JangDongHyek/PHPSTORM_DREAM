<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

// 아이디 자동저장
$ck_id_save = get_cookie("ck_id_save");

if ($ck_id_save) {
    $ch_id_save_chk = "checked";
}

//네이버 로그인
$client_id = "zLJRPBj6a8ai5kXgCYb4";

$redirectURI =  urlencode(G5_BBS_URL."/callback_naver.php");
$state = "RAMDOM_STATE";
$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;

?>
<head>
<meta name ="google-signin-client_id" content="640202496325-1kd8c7e0e6q949qca0vglfgc3b97uef7.apps.googleusercontent.com">
</head>


<style>
/*html, body{width:100%;height:100%;min-height:500px;background:url(<?php echo $member_skin_url ?>/img/bg2.jpg) no-repeat center fixed ; background-size:cover; overflow-y:hidden; overflow-x:hidden;}*/
html, body{ width:100%;height:100%;min-height:500px; background:#f5f5f5;}
</style>

<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <h1><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.svg" alt="로고"></a></h1>

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">
    <input type="hidden" name="token" id="token"> <!-- 푸시알림 -->

    <fieldset id="login_fs">
        <legend>회원로그인</legend>
        <label for="login_id" class="login_id">회원아이디<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" required class="frm_input required"  value='<?=$ck_id_save?>' placeholder="아이디를 입력해 주세요" size="20" maxLength="50">
        <label for="login_pw" class="login_pw">비밀번호<strong class="sound_only"> 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" required class="frm_input required" placeholder="비밀번호를 입력해 주세요" size="20" maxLength="20">
       <!--  <div class="t_margin10 b_margin10"><input type='checkbox' id='id_save' name='id_save' <?=$ch_id_save_chk?>> 아이디 저장</div> -->
        <input type="submit" value="로그인" class="btn_submit">
        <? /*<input type="checkbox" name="auto_login" id="login_auto_login">
        <label for="login_auto_login">자동로그인</label> */?>
    </fieldset>
<!--
    <aside id="login_info">
        <h2>회원로그인 안내</h2>
        <p class="id"><a href="<?php echo G5_BBS_URL ?>/password_lost.php">아이디·비밀번호를 잊으셨나요?</a></p>
        <div class="join"><a href="./register.php"><strong><?=$config['cf_title']?></strong> 회원가입</a></div>
    </aside>-->

    

    <div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/"><i class="fal fa-home"></i>&nbsp;&nbsp;홈 화면으로 가기</a>
    </div>

    </form>

</div>



<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    return true;
}
</script>
<!-- } 로그인 끝 -->