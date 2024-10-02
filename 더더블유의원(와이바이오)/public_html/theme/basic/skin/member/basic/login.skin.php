<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
html, body{width:100%;height:100%;min-height:500px;background:url(<?php echo $member_skin_url ?>/img/bg3.jpg) no-repeat center fixed ; background-size:cover; overflow-y:hidden; overflow-x:hidden;}
</style>

<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <h1><?php echo $config['cf_title']; ?> <?php echo $g5['title'] ?></h1>

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">

    <fieldset id="login_fs">
        <legend>회원로그인</legend>
        <label for="login_id" class="login_id">회원아이디<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" required class="frm_input required" placeholder="아이디를 입력해 주세요" size="20" maxLength="20">
        <label for="login_pw" class="login_pw">비밀번호<strong class="sound_only"> 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" required class="frm_input required" placeholder="비밀번호를 입력해 주세요" size="20" maxLength="20">
        <input type="submit" value="로그인" class="btn_submit">
        <?/*<input type="checkbox" name="auto_login" id="login_auto_login">
        <label for="login_auto_login">자동로그인</label>*/?>
    </fieldset>

    <aside id="login_info">
        <h2>회원로그인 안내</h2>
        <p>
            회원아이디 및 비밀번호가 기억 안나실 때는 아이디/비밀번호 찾기를 이용하십시오.<br>
            아직 회원이 아니시라면 회원으로 가입 후 이용해 주십시오.
        </p>
        <div>
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="btn02">아이디 비밀번호 찾기</a>
            <a href="./register.php" class="btn01">회원 가입</a>
        </div>
    </aside>

    <div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/"><i class="fas fa-home"></i>&nbsp;&nbsp;메인으로 돌아가기</a>
    </div>
	
    </form>

    <div id="sns_login">
        <!-- 카카오 로그인 시작 -->
        <div style="text-align:center">
        <script src="https://t1.kakaocdn.net/kakao_js_sdk/2.1.0/kakao.min.js"
          integrity="sha384-dpu02ieKC6NUeKFoGMOKz6102CLEWi9+5RQjWSV0ikYSFFd8M3Wp2reIcquJOemx" crossorigin="anonymous"></script>
        <script>
          Kakao.init('4c88db29a4e8a2730cddeaef14e23951'); // 사용하려는 앱의 JavaScript 키 입력
        </script>

        <a class="sns_btn kakao" id="kakao-login-btn" href="javascript:loginWithKakao()">
          <img src="<? echo $member_skin_url ?>/img/sns_kakao.png"> 카카오로그인
        </a>
        <p id="token-result"></p>


        </div>
        <!-- 카카오 로그인 끝 -->
        <!-- 네이버로그인 시작 -->
        <div style="text-align:center">
            <?php
            // 네이버 로그인 접근토큰 요청 예제
            $naver_state = md5(microtime() . mt_rand());
            $_SESSION['naver_state'] = $naver_state;
            $naver_apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".NAVER_CLIENT_ID."&redirect_uri=".urlencode(NAVER_CALLBACK_URL)."&state=".$naver_state;
            ?>
            <a class="sns_btn naver" href="<?=$naver_apiURL;?>"><img src="<? echo $member_skin_url ?>/img/sns_naver.png"> 네이버로그인</a>

        </div>
        <!-- 네이버로그인 끝 -->
        <!-- 구글 로그인 시작 -->
        <a class="sns_btn google ready" onclick="onSignIn()"><img src="<? echo $member_skin_url ?>/img/sns_google.png"> 구글로그인<!-- <p class="bubble">준비 중!</p> --> </a>
		<div id="login-google"></div>
        <!-- 구글 로그인 끝 -->
    </div>
	<form name="snsform" method="post" action="<?php echo G5_BBS_URL?>/google_login.php">
		<input type="hidden" name="mb_id" value="" id="mb_id">
		<input type="hidden" name="mb_name" value="" id="mb_name">
		<input type="hidden" name="mb_email" value="">
	</form>
	<script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://unpkg.com/jwt-decode/build/jwt-decode.js"></script>

	<script>
	//카카오로그인 시작
	  function loginWithKakao() {
		Kakao.Auth.authorize({
		  redirectUri: 'https://www.thewclinic.co.kr/bbs/kakao_login.php',
		});
	  }

	  // 아래는 데모를 위한 UI 코드입니다.
	  displayToken()
	  function displayToken() {
		var token = getCookie('authorize-access-token');

		if(token) {
		  Kakao.Auth.setAccessToken(token);
		  Kakao.Auth.getStatusInfo()
			.then(function(res) {
			  if (res.status === 'connected') {
				document.getElementById('token-result').innerText
				  = 'login success, token: ' + Kakao.Auth.getAccessToken();
			  }
			})
			.catch(function(err) {
			  Kakao.Auth.setAccessToken(null);
			});
		}
	  }

	  function getCookie(name) {
		var parts = document.cookie.split(name + '=');
		if (parts.length === 2) { return parts[1].split(';')[0]; }
	  }
	  //카카오로그인끝
	  //구글 로그인 시작
	  function onSignIn() {
		console.log(google.accounts.id);
	    google.accounts.id.initialize({
	        client_id: "772637742961-q1hjpfcu42k3r946n82k90n2fcjo99lo.apps.googleusercontent.com",
			context:'use',
	        callback: handleCredentialResponse
	    });
		
	    google.accounts.id.prompt((notification) => {
			
		  if (notification.isNotDisplayed() || notification.isSkippedMoment()) {

			document.cookie =  `g_state=i_l:0;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT`;
			if(notification.l==='opt_out_or_no_session'){
				alert("구글 로그인을 먼저 하셔야 합니다.");
				location.href='https://accounts.google.com/InteractiveLogin/signinchooser';
				//location.reload();
				return;
			}else if(notification.l==='browser_not_supported'){
				alert('이 브라우저에서는 구글 로그인이 지원되지 않습니다.');
				return;
			}
			
            google.accounts.id.prompt();
			// continue with another identity provider.
		  }
		});
	}

	function handleCredentialResponse(response) {
	    var profile = jwt_decode(response.credential);
		console.log("ID: " + profile.sub);
		console.log('Name: ' + profile.name);
	    console.log("Image URL: " + profile.picture);
	    console.log("Email: " + profile.email);    
		
		const f=document.snsform;
		f.mb_id.value=profile.sub;
		f.mb_name.value=profile.name;
		f.mb_email.value =profile.email;
		f.submit();

		
	}
	function signOut() {
	    google.accounts.id.disableAutoSelect();
	  
	}
	  //구글 로그인 끝

	</script>
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