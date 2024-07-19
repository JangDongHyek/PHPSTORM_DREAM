<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$name = "login";
include_once('./_head.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 100);

/**
 * 네이버로그인 API
 */
// 네이버 로그인 접근 토큰 요청
$client_id = "YIwCexowJCYPErjJiSOC";
$redirectURI = urlencode(G5_BBS_URL."/naver_callback.php");
$state = "RAMDOM_STATE";
$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state; // 재인증 필요 시 뒤에 &auth_type=reauthenticate 붙임
?>
<style>
html, body{ width:100%;height:100%;min-height:500px; background:#f5f5f5;}
</style>

<? if($name=="login") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="login">
<?}?>


<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
	<div id="mb_login_wrap">


    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">

    <fieldset id="login_fs">
        <legend>로그인</legend>
        <label for="login_id" class="login_id">아이디<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" placeholder="아이디를 입력해 주세요.">
        <label for="login_pw" class="login_pw">비밀번호<strong class="sound_only"> 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20" placeholder="비밀번호를 입력해 주세요.">
        <input type="submit" value="로그인" class="btn_submit">
		<p class="id"><a href="<?php echo G5_BBS_URL ?>/password_lost.php">비밀번호를 잊으셨나요?</a></p>
        <!--<div class="chk_ico">
            <input type="checkbox" name="auto_login" id="login_auto_login">
            <label for="login_auto_login" class="auto_login">자동로그인</label>
        </div>-->
    </fieldset>
	
	<div class="area_sns">
		<span>SNS계정으로 간편하게 로그인하세요.</span>
		<ul id="sns_login">
			<li class="sns naver"><a href="<?=$apiURL?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_naver.svg" class="네이버로그인"></a></li>
			<li class="sns kakao"><a href=""><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_kakao.svg" class="카카오로그인"></a></li>
			<li class="sns google"><a href=""><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_google.svg" class="구글로그인"></a></li>
		</ul>
	</div>

     <aside id="login_info">
        <div class="join"><a href="./register.php">아직 방송과사람들 회원이 아니세요? <strong>회원가입</strong></a></div>
    </aside>
    </form>
</div>
</div>

<!--카카오 로그인-->
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script>
// 발급받은 앱 키 - JavaScript 키 (내 애플리케이션 > 앱 설정 > 앱 키)
Kakao.init('<?=$kakao_js_key?>');
console.log(Kakao.isInitialized()); // sdk 초기화여부판단

//카카오로그인
function loginKakao() {
    Kakao.Auth.authorize({
        redirectUri: '<?=G5_BBS_URL?>/kakao_callback.php'
    });
}

function flogin_submit(f) {
	return true;
}
</script>
<!-- } 로그인 끝 -->