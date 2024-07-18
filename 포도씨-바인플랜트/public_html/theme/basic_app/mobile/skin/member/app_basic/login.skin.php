<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 100);

/**
 * 네이버로그인 API
 */
// 네이버 로그인 접근 토큰 요청
$client_id = "OYo_HAmkzC766_xvReqe";
$redirectURI = urlencode("https://www.podosea.kr/bbs/naver_callback.php");
$state = "RAMDOM_STATE";
$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state; // 재인증 필요 시 뒤에 &auth_type=reauthenticate 붙임

$_SESSION['join_check'] = 'login'; // 로그인/회원가입 구분
?>

<!--구글로그인-->
<head>
    <meta name ="google-signin-client_id" content="752286861662-bo2rr3jfqbg27t37qc6t4g7dqdh69oed.apps.googleusercontent.com">
</head>

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
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/logo2.svg" alt="PODOSEA" class="logo">
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
        <div class="join"><a href="./register.php"><strong><?/*=$config['cf_title']*/?>podosea</strong> 회원가입</a></div>
    </aside>

    <ul id="sns_login">
        <li class="sns kakao"><a href="javascript:loginKakao();"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_kakao.svg" class="카카오로그인"></span>카카오 로그인</a></li>
        <li class="sns naver"><a href="<?=$apiURL?>"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_naver.svg" class="네이버로그인"></span>네이버 로그인</a></li>
        <!--<li class="sns google"><a href="javascript:loginGoogle();"><span class="ico"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/icon_google.svg" class="구글로그인"></span>구글 로그인</a></li>-->
        <!--<li id="GgCustomLogin" style="display: none"></li>--> <!--구글로그인버튼-->
        <!--<li class="sns face"><a href="javascript:loginFacebook();"><span class="ico"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/icon_facebook.svg" class="페이스북로그인"></span>페이스북 로그인</a></li>-->
        <!--<li class="sns apple"><a href="javascript:loginApple();"><span class="ico"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/icon_apple.svg" class="애플로그인"></span>애플로그인 로그인</a></li>-->
    </ul>

    <div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/"><i class="fal fa-home"></i>&nbsp;홈 화면으로 가기</a>
    </div>

    </form>
</div>
</div>

<!--카카오 로그인-->
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<!--구글 api 사용을 위한 스크립트-->
<script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>
<!--페이스북 로그인-->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

<script>
function flogin_submit(f) {
    return true;
}
</script>

<script>
/** sns 로그인/회원가입 **/
/** 카카오 **/
// 발급받은 앱 키 - JavaScript 키 (내 애플리케이션 > 앱 설정 > 앱 키)
Kakao.init('<?=$kakao_javascript_key_new?>');
console.log(Kakao.isInitialized()); // sdk 초기화여부판단

// 카카오로그인
function loginKakao() {
    Kakao.Auth.authorize({
        redirectUri: '<?=G5_BBS_URL?>/kakao_callback.php'
    });
}

/** 구글 **/
// 구글로그인
function loginGoogle() {
    //var os = iOSaOS_check(); // os 체크
    if('<?=$_SESSION['ss_agent']?>' == 'AOS') { // aOS
        window.Android.loginGoogle();
    } else if('<?=$_SESSION['ss_agent']?>' == 'IOS') { // iOS
        window.webkit.messageHandlers.loginGoogle.postMessage("");
    }
    else { // 웹
        $("#GgCustomLogin").trigger("click");
    }
}

// sns 로그인 성공 시 넘어오는 데이터
function callBackData(id, name, email, sns) {
    if(sns == 'facebook') {
        location.href = g5_bbs_url+'/facebook_callback.php?id='+id+'&name='+name+'&email='+email;
    } else if(sns == 'apple') {
        location.href = g5_bbs_url+'/apple_callback.php?id='+id+'&name='+name+'&email='+email;
    } else {
        location.href = g5_bbs_url+'/google_callback.php?id='+id+'&name='+name+'&email='+email;
    }
}

// 구글로그인 (웹) - 초기화
function init() {
    gapi.load('auth2', function() {
        gapi.auth2.init();
        options = new gapi.auth2.SigninOptionsBuilder();
        options.setPrompt('select_account');
        // 추가는 Oauth 승인 권한 추가 후 띄어쓰기 기준으로 추가
        options.setScope('email profile openid https://www.googleapis.com/auth/user.birthday.read');
        // 인스턴스의 함수 호출 - element에 로그인 기능 추가
        // GgCustomLogin은 li태그안에 있는 ID, 위에 설정한 options와 아래 성공, 실패시 실행하는 함수들
        gapi.auth2.getAuthInstance().attachClickHandler('GgCustomLogin', options, onSignIn, onSignInFailure);
    })
}

// 구글로그인 - 프로필 정보 얻기
function onSignIn(googleUser) {
    var access_token = googleUser.getAuthResponse().access_token;
    $.ajax({
        // people API를 이용, 프로필 및 생년월일에 대한 선택 동의 후 가져옴
        url: 'https://people.googleapis.com/v1/people/me'
        // key - 구글 클라우드 콘솔 - API 및 서비스 - 사용자 인증 정보 - API 키 - Browser key의 API 키
        , data: {personFields: 'names', key: 'AIzaSyANP71I46y0dHsOtlRHslUlq4rh0NwudKg', 'access_token': access_token}
        , method:'GET'
    })
    .done(function(e){
        // 프로필 가져옴
        var profile = googleUser.getBasicProfile();
        //console.log(profile);
        var id = profile.getId(); // ID
        var name = profile.getFamilyName()+profile.getGivenName(); // 이름
        var email = profile.getEmail(); // 이메일
        // console.log(id);
        // console.log(email);
        //console.log(name);
        callBackData(id, name, email);
    })
    .fail(function(e){
        console.log(e);
    });
}

// 구글로그인 실패
function onSignInFailure(t) {
    console.log(t);
}

/** 페이스북 **/
window.fbAsyncInit = function () {
    FB.init({
        appId: '<?=$face_app_id?>',
        cookie: true,
        xfbml: true,
        version: 'v10.0'
    });

    FB.AppEvents.logPageView();
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) { return; }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function loginFacebook() {
    //var os = iOSaOS_check(); // os 체크
    if('<?=$_SESSION['ss_agent']?>' == 'AOS') { // aOS
        window.Android.loginFacebook();
    } else if('<?=$_SESSION['ss_agent']?>' == 'IOS') { // iOS
        window.webkit.messageHandlers.loginFacebook.postMessage("");
    }
    else { // 웹
        FB.login(function(response) {
            if (response.status === 'connected') {
                FB.api('/me', 'get', {fields: 'email, name'}, function(r) {
                    // console.log(r);
                    // console.log('email', r.email);
                    // console.log('name', r.name);
                    // console.log('id', r.id);

                    var id = r.id;
                    var name = r.name;
                    var email = r.email;

                    location.href = g5_bbs_url+'/facebook_callback.php?id='+id+'&name='+name+'&email='+email;
                });
            }
        }, {scope: 'public_profile, email'}); // 이메일 받아오기 위해서 scope (앱에서 사용할 권한 목록) 추가 필요
    }
}

/** 애플로그인 **/
function loginApple() {
    window.webkit.messageHandlers.loginApple.postMessage("");
}

// 버전체크 - 애플로그인은 13.0 버전부터 가능
function versionCheck() {
    swal("iOS 버전을 업데이트 해주세요.\n(필요 버전 : iOS 13.0 이상)");
    return false;
}
</script>
