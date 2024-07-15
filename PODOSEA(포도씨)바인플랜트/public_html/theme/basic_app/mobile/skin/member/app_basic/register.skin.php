<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . $member_skin_url . '/style.css">', 0);

/**
 * 네이버로그인 API
 */
// 네이버 로그인 접근 토큰 요청
$client_id = "YIwCexowJCYPErjJiSOC";
$redirectURI = urlencode(G5_BBS_URL."/naver_callback.php");
$state = "RAMDOM_STATE";
$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state; // 재인증 필요 시 뒤에 &auth_type=reauthenticate 붙임

$_SESSION['join_check'] = 'join'; // 로그인/회원가입 구분
?>

<!--구글로그인-->
<head>
    <meta name ="google-signin-client_id" content="752286861662-bo2rr3jfqbg27t37qc6t4g7dqdh69oed.apps.googleusercontent.com">
</head>

<style>
	#ft{display:none;}
    .sns img.facebook {width: 15px !important;}
</style>

<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="snsCheckModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <input type="hidden" id="join_sns" name="join_sns" value="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="txt confirm">
                       <h3>간편가입 시 일반회원으로 가입됩니다.</h3>
                    </div>
                    <ul class="madal_btn">
                        <li data-dismiss="modal">취소</li>
                        <li class="ok" onclick="snsLogin();">가입</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mbskin join_type">
	<div class="inr">
		<form name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
			<h1 class="logo">
				<img src="<?php echo G5_THEME_IMG_URL ?>/app/logo2.svg" alt="PODOSEA">
				<span class="title_top"><strong class="point">회원가입</strong>을 환영합니다.</span>
			</h1>

			<?php if(empty($sns)) { ?>
            <ul id="sns_join" style="margin-bottom: 20px;">
                <li class="sns kakao"><a href="javascript:snsCheck('kakao');"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_kakao.svg" class="카카오"></span></a></li>
                <li class="sns naver"><a href="javascript:snsCheck('naver');"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_naver.svg" class="네이버"></span></a></li>
                <!--<li class="sns google"><a href="javascript:snsCheck('google');"><span class="ico"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/icon_google.svg" class="구글"></span></a></li>-->
                <!--<li id="GgCustomLogin" style="display: none"></li>--> <!--구글로그인버튼-->
                <!--<li class="sns face"><a href="javascript:snsCheck('facebook');"><span class="ico"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/icon_facebook.svg" class="facebook"></span></a></li>-->
                <!--<li class="sns apple"><a href="javascript:snsCheck('apple');"><span class="ico"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/icon_apple.svg" class="apple"></span></a></li>-->
            </ul>
			<?php } ?>

			<div class="join_type cf">


                <div id="member1" onclick="add_class(this.id);" class="type client"><!--선택하면 일반회원 가입화면으로 넘어감-->
                    <a href="<?php echo G5_BBS_URL ?>/register_form.php?id=<?=$id?>&email=<?=$email?>&name=<?=$name?>&mobile=<?=$_GET['mobile']?>&sns=<?=$sns?>">
                        <img alt="일반회원" src="<?php echo G5_THEME_IMG_URL ?>/app/icon_join01.svg">
                        <div class="title">
                            <span>조선, 해양 관련 어떤 것이든 <br>포도씨와 함께 소통하세요! </span>
                        </div>
                        <div class="btn_join">일반회원 가입하기</div>
                    </a>
                </div>
                <div id="member2" onclick="add_class(this.id);" class="type client general_noshow">
                    <a href="<?php echo G5_BBS_URL ?>/register_company_form.php?id=<?=$id?>&email=<?=$email?>&name=<?=$name?>&mobile=<?=$_GET['mobile']?>&sns=<?=$sns?>">
                        <img alt="기업회원" src="<?php echo G5_THEME_IMG_URL ?>/app/icon_join02.svg">
                        <div class="title">
                            <span>기업홈피 + 온라인광고 + 고객연결까지 <br>포도씨에서 한번에 해결하세요</span>
                        </div>
                        <div class="btn_join">기업회원 가입하기</div>
                    </a>
                </div>
			</div><!--join_type-->


		   <!-- <div class="btn_confirm">
				<input type="submit" class="btn_submit btn btn-primary btn-lg" value="가입신청하기">
			</div>-->

		</form>
	</div>
</div>

<!--<form id="register1" name="register1" method="post" action="./register_form.php">
    <input type="hidden" id="id" name="id" value="<?/*=$id*/?>">
    <input type="hidden" id="email" name="email" value="<?/*=$email*/?>">
    <input type="hidden" id="sns" name="sns" value="<?/*=$sns*/?>">
</form>-->

<!--카카오 로그인-->
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<!--구글 api 사용을 위한 스크립트-->
<script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>
<!--페이스북 로그인-->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

<script>
function add_class(w) {
    $('.type').removeClass('action');
    $('#'+w).addClass('action');
}

// sns 가입은 일반회원으로만 가입 가능
function snsCheck(sns) {
    $('#join_sns').val(sns);
    $('#snsCheckModal').modal('show');
    /*swal('간편가입 시 일반회원으로만 가입할 수 있습니다.')
    .then(() => {
       if(sns == 'naver') {
           location.href = '<?=$apiURL?>';
       }
       else if(sns == 'kakao') {
           loginKakao();
       }
       else if(sns == 'google') {
           loginGoogle();
       }
    });*/
}

// sns 가입
function snsLogin() {
    var sns = $('#join_sns').val();
    if(sns == 'naver') {
        location.href = '<?=$apiURL?>';
    }
    else if(sns == 'kakao') {
        loginKakao();
    }
    else if(sns == 'google') {
        loginGoogle();
    }
    else if(sns == 'facebook') {
        loginFacebook();
    }
    else if(sns == 'apple') {
        loginApple();
    }
    $('#snsCheckModal').modal('hide');
}
</script>

<script>
/** sns 로그인/회원가입 **/
/** 카카오 **/
// 발급받은 앱 키 - JavaScript 키 (내 애플리케이션 > 앱 설정 > 앱 키)
Kakao.init('<?=$kakao_javascript_key_new?>');
console.log(Kakao.isInitialized()); // sdk 초기화여부판단

//카카오로그인
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
        // console.log(name);
        callBackData(id, name, email);
    })
    .fail(function(e){
        console.log(e);
    });
}

// 구글로그인 실패
function onSignInFailure(t){
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
