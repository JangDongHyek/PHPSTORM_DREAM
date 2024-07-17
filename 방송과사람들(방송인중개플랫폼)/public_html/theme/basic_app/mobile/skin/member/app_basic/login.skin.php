<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 100);
?>
<style>
html, body{ width:100%;height:100%;min-height:500px; background:#f5f5f5;}
</style>
<!--
<div id="top_back" class="visible-xs">
    <a href="javascript:history.back();">
    <i class="fal fa-arrow-left"></i><span class="sound_only">뒤로</span>
    </a>
</div>
-->
<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
	<div id="mb_login_wrap">
	<div class="logo_box">
        <h1>
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/logo.png" alt="<?php echo $config['cf_title']; ?>" class="logo">
        </h1>
    </div><!--.logo_box-->
    

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">

    <fieldset id="login_fs">
        <legend>로그인</legend>
        <label for="login_id" class="login_id">아이디<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" placeholder="아이디">
        <label for="login_pw" class="login_pw">패스워드<strong class="sound_only"> 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20" placeholder="패스워드">
        <input type="submit" value="로그인" class="btn_submit">
        <!--<div class="chk_ico">
            <input type="checkbox" name="auto_login" id="login_auto_login">
            <label for="login_auto_login" class="auto_login">자동로그인</label>
        </div>-->
    </fieldset>
	
     <aside id="login_info">
        <h2>회원로그인 안내</h2>
        <p class="id"><a href="<?php echo G5_BBS_URL ?>/password_lost.php">아이디·비밀번호를 잊으셨나요?</a></p>
        <div class="join"><a href="./register.php"><strong><?=$config['cf_title']?></strong> 회원가입</a></div>
    </aside>

    <ul id="sns_login">
        <li class="sns naver"><a href="<?=$apiURL?>"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_naver.svg" class="네이버로그인"></span>네이버 로그인</a></li>
        <li class="sns kakao"><a href="javascript:loginWithKakao();"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_kakao.svg" class="카카오로그인"></span>카카오 로그인</a></li>
        <li class="sns google"><a href=""><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_google.svg" class="카카오로그인"></span>구글 로그인</a></li>	
        <li class="sns face"><a href="javascript:;"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_facebook.svg" class="페이스북로그인"></span>페이스북 로그인</a></li>
    </ul><!--lg_btn-->

    

    <div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/"><i class="fal fa-home"></i>&nbsp;홈 화면으로 가기</a>
    </div>

    </form>
</div>
</div>




<?php /*?><div class="visible-xs" id="admin_mobile">
	<div class="adb">
        <div class="admin_logo"><img src="<?php echo G5_IMG_URL ?>/logo_color.png" alt="<?php echo $config['cf_title']; ?>" class="logo"></div>
        <div class="admin_tit">
        <strong>관리자로그인</strong> 안내
        <p>관리자페이지는 PC화면에서 이용할 수 있습니다.<br />감사합니다.</p>
        </div>
    </div>
</div>
<?php */?>

<script>
$(function(){
    // $("#login_auto_login").click(function(){
    //     if (this.checked) {
    //         this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
    //     }
    // });
});

function flogin_submit(f)
{
    /*var referrer = document.referrer;
	var change_url = g5_url;
	var obj = {};
	obj.url = f.url.value;
	obj.mb_id = f.mb_id.value;
	obj.mb_password = f.mb_password.value;
	//obj.token = f.token.value;

	if (referrer != "" && referrer.indexOf("login.php") < 0) change_url = referrer;

	$.post(g5_bbs_url + "/ajax.login_check.php", obj).done(function(json) {
		var data = JSON.parse(json);
		if (data.result) {
			history.replaceState({data: "loginReplaceState"}, "", change_url);
            var url_de = decodeURI(data.url);

			<?php if ($is_inapp) { // 안드로이드 인앱이면 ?>
            saveMemberInfo(obj.mb_id);
            var split = url_de.split("/~");
            if (split[1] == "skmachine") url_de += "/index.php";
            <?php } ?>

			location.href = url_de;

		} else {
			alert(data.msg);
		}
	}, "json").fail(function() {
		alert("로그인에 실패하였습니다. 다시 시도해 주세요.");
	});*/

	return true;
}

</script>
<!-- } 로그인 끝 -->