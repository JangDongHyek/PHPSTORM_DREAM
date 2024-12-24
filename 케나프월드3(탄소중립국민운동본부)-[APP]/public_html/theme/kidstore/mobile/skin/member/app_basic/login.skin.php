<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 3);
?>
<style>
html, body{ height:100%; background:/*#009975url(<?php echo G5_THEME_IMG_URL ?>/app/main_bg.jpg) no-repeat center top/cover*/;}
</style>
<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <h1>
        <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/logo.png" alt="<?php echo $config['cf_title']; ?>" class="logo">
    </h1>

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">

    <fieldset id="login_fs">
        <legend>회원로그인</legend>
        <label for="login_id" class="login_id">회원아이디<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" placeholder="회원아이디">
        <label for="login_pw" class="login_pw">비밀번호<strong class="sound_only"> 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20" placeholder="비밀번호">
        <input type="submit" value="로그인" class="btn_submit">
        <!--<div class="chk_ico">
            <input type="checkbox" name="auto_login" id="login_auto_login">
            <label for="login_auto_login" class="auto_login">자동로그인</label>
        </div>-->
    </fieldset>

    <aside id="login_info">
        <!--<h2>회원로그인 안내</h2>
        <p>
            회원아이디 및 비밀번호가 기억 안나실 때는 아이디/비밀번호 찾기를 이용하십시오.<br>
            아직 회원이 아니시라면 회원으로 가입 후 이용해 주십시오.
        </p>-->
        <div class="box">
            <?php /*?><a href="<?php echo G5_BBS_URL ?>/password_lost.php" id="login_password_lost" class="btn02">아이디 비밀번호 찾기</a><?php */?>
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="btn02">아이디 비밀번호 찾기</a>
            <a href="./register_form.php" class="btn01">회원 가입</a>
        </div>
    </aside>

    <!--<div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/">메인으로 돌아가기</a>
    </div>
-->
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