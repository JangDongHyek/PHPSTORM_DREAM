<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_PATH."/jl/Jl.php");
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

try {
    $jl = new Jl();
}catch (Exception $e) {
    echo $e;
}
$redirect = $jl->URL."/bbs/callback_kakao.php";
$kakao_key = "93bb7b776fef8ab69a652712a974e09b";
$kakaoURL = "https://kauth.kakao.com/oauth/authorize?client_id={$kakao_key}&response_type=code&redirect_uri={$redirect}";

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
    <h1><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고"></a></h1>

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">
    <input type="hidden" name="token" id="token"> <!-- 푸시알림 -->

    <fieldset id="login_fs">
        <legend>회원로그인</legend>
        <label for="login_id" class="login_id">회원아이디<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" required class="frm_input required"  value='<?=$ck_id_save?>' placeholder="아이디를 입력해 주세요" size="20" maxLength="50">
        <label for="login_pw" class="login_pw">비밀번호<strong class="sound_only"> 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" required class="frm_input required" placeholder="비밀번호를 입력해 주세요" size="20" maxLength="20">
        <div class="t_margin10 b_margin10"><input type='checkbox' id='id_save' name='id_save' <?=$ch_id_save_chk?>> 아이디 저장</div>
        <input type="submit" value="로그인" class="btn_submit">
        <? /*<input type="checkbox" name="auto_login" id="login_auto_login">
        <label for="login_auto_login">자동로그인</label> */?>
    </fieldset>

    <aside id="login_info">
        <h2>회원로그인 안내</h2>
        <p class="id"><a href="<?php echo G5_BBS_URL ?>/password_lost.php">아이디·비밀번호를 잊으셨나요?</a></p>
            <div class="join"><a href="./register_new.php"><strong><?=$config['cf_title']?></strong> 회원가입</a></div>
        <?php /*?>
            <div class="join"><a href="./register.php"><strong><?=$config['cf_title']?></strong> 회원가입</a></div>
        <?php */?>
    </aside>
    <ul id="sns_login">
        <li class="sns naver"><a href="<?=$apiURL?>"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_naver.png" class="네이버로그인"></span>네이버 로그인</a></li>
        <li class="sns kakao"><a href="<?=$kakaoURL?>"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_kakao.png" class="카카오로그인"></span>카카오 로그인</a></li>
        <!--<li class="sns kakao"><a onclick="alert('아직 준비중입니다.')"><span class="ico"><img src="--><?php //echo G5_THEME_IMG_URL ?><!--/common/sns_kakao.png" class="카카오로그인"></span>카카오 로그인</a></li>-->
        <li class="sns google"><a href="javascript:google_login(<?if($mb_1) echo $mb_1; else echo 0;?>);"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_google.png" class="구글로그인"></span>구글 로그인</a></li>
        <li class="sns face"><a href="javascript:fnFbCustomLogin(<?if($mb_1) echo $mb_1; else echo 0;?>);"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_face.png" class="페이스북로그인"></span>페이스북 로그인</a></li>
    </ul><!--lg_btn-->

    <div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/"><i class="fal fa-home"></i>&nbsp;&nbsp;홈 화면으로 가기</a>
    </div>

    </form>

<!--    <div class="g-signin2" onclick="onSignIn();"></div>-->
    <li id="GgCustomLogin" style="display: none">
    </li>
</div>

<!--페이스북 로그인-->
<form id="formdata" name="formdata" method="post" action="<?=G5_BBS_URL?>/register_form.php">
    <input type="hidden" id="mb_name" name="mb_name">
    <input type="hidden" id="email" name="email">
    <input type="hidden" id="certify" name="certify">
    <input type="hidden" id="ss_sns" name="ss_sns" value="facebook">
</form>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

<!--카카오 로그인-->
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>

<!--구글로그인-->
<script src="https://apis.google.com/js/platform.js?onload=init" async defer ></script>

<script>

/********구글 로그인( Not a valid origin for the client 어쩌구 뜨면 인터넷 캐쉬 및 이미지 삭제 전부 해주면 됨)*********/

//처음 실행하는 함수
function init() {
    gapi.load('auth2', function() {
        gapi.auth2.init();
        options = new gapi.auth2.SigninOptionsBuilder();
        options.setPrompt('select_account');
        // 추가는 Oauth 승인 권한 추가 후 띄어쓰기 기준으로 추가
        options.setScope('email profile openid https://www.googleapis.com/auth/user.birthday.read');
        // 인스턴스의 함수 호출 - element에 로그인 기능 추가
        // GgCustomLogin은 li태그안에 있는 ID, 위에 설정한 options와 아래 성공,실패시 실행하는 함수들
        gapi.auth2.getAuthInstance().attachClickHandler('GgCustomLogin', options, onSignIn, onSignInFailure);
    })
}

function onSignIn(googleUser) {
    var access_token = googleUser.getAuthResponse().access_token
    $.ajax({
        // people api를 이용하여 프로필 및 생년월일에 대한 선택동의후 가져온다.
        url: 'https://people.googleapis.com/v1/people/me'
        // key에 자신의 API 키를 넣습니다.
        , data: {personFields:'birthdays', key:'AIzaSyD2m6x-kNQIfnA0cG8--KWR3Ppe8sMCLZs', 'access_token': access_token}
        , method:'GET'
    })
        .done(function(e){
            //프로필을 가져온다.
            var profile = googleUser.getBasicProfile();
            birth = "";
            //09로 안오고 1글자일 경우 9로 받아와서 0붙여줌
            if (e.birthdays[0].date['month'].length != 2){
                e.birthdays[0].date['month'] = "0"+e.birthdays[0].date['month'];
            }

            var birth = e.birthdays[0].date['year']+""+e.birthdays[0].date['month']+""+e.birthdays[0].date['day']
            console.log('dgdgd')
           callback_ajax(profile.getEmail(),profile.Ue,birth);

        })
        .fail(function(e){
            console.log(e);
        })
}
function onSignInFailure(t){
    console.log(t);
}
function callback_ajax(email,name,birth) {

    $.ajax({
        url: g5_bbs_url+"/callback_google.php",
        type: "POST",
        data: {
            "id": email,
            "mb_name": name,
            "mb_birthday": birth
        },
        success: function(data) {
            <?php if ($android == true) { ?>
            window.Android.updateLoginInfo(email);
            <?php } ?>
            location.href = data;
        }
    });
}

function google_login(mb_no) {

        if (mobilecheck() && '<?= strpos($user_agent, $aos_app_user_agent) ?>' != 0) {
            //안드로이드
            window.Android.login_google(mb_no);

        } else if ('<?=$user_agent?>' == '/ioshappy100'){
            webkit.messageHandlers.googleLogin.postMessage(mb_no);
        } else{
            //PC
            $("#GgCustomLogin").trigger("click");
        }
    }

    /********구글 로그인 끝 *********/

    //카카오 로그인
    <?php if($config['cf_kakao_js_apikey'] != "") { ?>

$(document).ready(function() {
    Kakao.init('<?= $config['cf_kakao_js_apikey']?>');
   Kakao.isInitialized();
});
function loginWithKakao(){
   Kakao.Auth.authorize({
       redirectUri: g5_bbs_url + '/register_form.php'
   });
}



<?php } ?>
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

// == 페이스북 로그인 시작
$(function() {
    // FB.init 호출 (FB에서 여러 가지 로그인에 관한 상태를 설정하고 체크할 수 있는 메서드가 들어있음)
    window.fbAsyncInit = function() {
        FB.init({
            appId      : <?=$app_id?>, // 내 앱 ID를 입력한다.
            cookie     : true,
            xfbml      : true,
            version    : 'v11.0'
        });
        FB.AppEvents.logPageView();
    };
});

function fnFbCustomLogin(mb_no){

    if ('<?=$user_agent?>' == '/ioshappy100'){
        webkit.messageHandlers.faceLogin.postMessage(mb_no);
    }else{
        FB.login(function(response) {
            //alert(response.status);
            //alert('login');
            if (response.status === 'connected') {
                FB.api('/me', 'get', {fields: 'email, name'}, function(r) {
                    console.log('email', r.email);
                    console.log('name', r.name);
                    console.log('id', r.id);
                    console.log(r);

                    $('#email').val(r.id);
                    $('#mb_name').val(r.name);
                    $('#certify').val('facebook');

                    <?php if ($android == true) { ?>
                    window.Android.updateLoginInfo(r.id);
                    <?php } ?>
                });

                setTimeout(function(){
                    $('#formdata').submit(); // 회원가입 폼으로 넘김
                }, 1000);
            }
        }, {scope: 'public_profile'}); // 이메일 받아오기 위해서 scope (앱에서 사용할 권한 목록) 추가 필요
    }
}

function callback_face_ajax(email,name) {

    $.ajax({
        url: g5_bbs_url+"/callback_face.php",
        type: "POST",
        data: {
            "id": email,
            "mb_name": name,
        },
        success: function(data) {
            <?php if ($android == true) { ?>
            window.Android.updateLoginInfo(email);
            <?php } ?>
            location.href = data;
        }
    });
}
// == 페이스북 로그인 끝

// 푸시알림
function fcmKey(token){
    $("input[name='token']").val(token);//토큰값을 필드에 넣기 mb_10일 경우 mb_10으로 하면된다
}
</script>
<!-- } 로그인 끝 -->