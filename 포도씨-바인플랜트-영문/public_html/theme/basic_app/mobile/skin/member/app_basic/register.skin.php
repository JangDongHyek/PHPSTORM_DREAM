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
?>

<!--구글로그인-->
<head>
    <meta name ="google-signin-client_id" content="752286861662-bo2rr3jfqbg27t37qc6t4g7dqdh69oed.apps.googleusercontent.com">
</head>

<style>
	#ft{display:none;}
</style>

<div class="mbskin join_type">
	<div class="inr">
		<form name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
			<h1 class="logo">
				<img src="<?php echo G5_THEME_IMG_URL ?>/app/logo2.svg" alt="PODOSEA">
				<span class="title_top">Thank you for becoming a member of podosea.</span>
			</h1>

			<?php if($private && empty($sns)) { ?>
                <!--일반회원만 SNS 가입 가능하면 버튼 위치 옮겨야 함-->
				<div id="box_sns">
					<h3>SNS sign up</h3>
					<ul id="sns_login">
						<!--<li class="sns kakao"><a href="javascript:loginKakao();"><span class="ico"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/icon_kakao.svg" class="카카오로그인"></span>KAKAO</a></li>
						<li class="sns naver"><a href="<?/*=$apiURL*/?>"><span class="ico"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/icon_naver.svg" class="네이버로그인"></span>NAVER</a></li>-->
						<li class="sns google"><a href="javascript:loginGoogle();"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_google.svg" class="구글로그인"></span>GOOGLE</a></li>
                        <li id="GgCustomLogin" style="display: none"></li> <!--구글로그인버튼-->
                        <li class="sns face"><a href="javascript:;"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_facebook.svg" class="구글로그인"></span>FACEBOOK</a></li>
                    </ul>
				</div>
			<?php } ?>

			<div class="join_type cf">
                <!--선택하면 일반회원 가입화면으로 넘어감-->
                <!--<div id="member1" onclick="add_class(this.id);" class="type client">
                    <a href="<?php /*echo G5_BBS_URL */?>/register_form.php?id=<?php /*=$id*/?>&email=<?php /*=$email*/?>&name=<?php /*=$name*/?>&mobile=<?php /*=$_GET['mobile']*/?>&sns=<?php /*=$sns*/?>">
                        <img alt="general" src="<?php /*echo G5_THEME_IMG_URL */?>/app/icon_join01.svg">
                        <div class="title">
                            <span>Podosea will be your gateway to all thing related to maritime business!</span>
                        </div>
                        <div class="btn_join">Sign up as general member</div>
                    </a>
                </div>-->
                <div id="member2" onclick="add_class(this.id);" class="type client"><!--선택하면 기업회원 가입화면으로 넘어감-->
                    <a href="<?php echo G5_BBS_URL ?>/register_company_form.php?id=<?=$id?>&email=<?=$email?>&name=<?=$name?>&mobile=<?=$_GET['mobile']?>&sns=<?=$sns?>">
                        <img alt="corporate" src="<?php echo G5_THEME_IMG_URL ?>/app/icon_join02.svg">
                        <div class="title">
                            <span>Corporate Homepage + online advertising + speedy customer service, take care of everything with Podosea's all-in-one package</span>
                        </div>
                        <div class="btn_join">Sign Up as Podosea Member</div>
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
<script>
// 발급받은 앱 키 - JavaScript 키 (내 애플리케이션 > 앱 설정 > 앱 키)
Kakao.init('<?=$kakao_javascript_key?>');
console.log(Kakao.isInitialized()); // sdk 초기화여부판단

//카카오로그인
function loginKakao() {
    Kakao.Auth.authorize({
        redirectUri: '<?=G5_BBS_URL?>/kakao_callback.php'
    });
}

/********구글 로그인(Not a valid origin for the client 어쩌구 뜨면 인터넷 캐쉬 및 이미지 삭제 전부 해주면 됨)*********/
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

// 구글로그인 성공 시 넘어오는 데이터
function callBackData(id, name, email) {
    location.href = g5_bbs_url+'/google_callback.php?id='+id+'&name='+name+'&email='+email;
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
        })
}

// 구글로그인 실패
function onSignInFailure(t){
    console.log(t);
}
/********구글 로그인( Not a valid origin for the client 어쩌구 뜨면 인터넷 캐쉬 및 이미지 삭제 전부 해주면 됨)*********/

function add_class(w){
    $('.type').removeClass('action');
    $('#'+w).addClass('action');
}
</script>
