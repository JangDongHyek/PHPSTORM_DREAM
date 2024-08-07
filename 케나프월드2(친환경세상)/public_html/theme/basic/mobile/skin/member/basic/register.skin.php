<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 네이버 로그인 접근토큰 요청 예제
$client_id = "lXK9MVveA6g2QiDzGrhz";
$redirectURI = urlencode(G5_PLUGIN_URL."/oauth_login/naver/login.php");
$state = generate_state();
$apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;

function generate_state() {
	$mt = microtime();
	$rand = mt_rand();
	return md5($mt . $rand);
}

$sql = "select * from g5_content where co_id = 'lbs'";
$row = sql_fetch($sql);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

<div class="mbskin join">

    <form name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
	<input type="hidden" name="mb_type" id="mb_type" value="">
	<input type="hidden" name="mb_sns_type" id="mb_sns_type" value="">
	<input type="hidden" name="mb_nickname" id="mb_nickname" value="">
	<input type="hidden" name="mb_email" id="mb_email" value="">
	<input type="hidden" name="mb_token" id="mb_token" value="">

	<article class="box-article bottom">
		<div class="text-muted box-title">
			<i class="fa fa-file-text-o" aria-hidden="true"></i></i><small>&nbsp;&nbsp;회원가입약관</small>
		</div>
		
		<div class="agree-text" style="overflow:auto;"><?php echo nl2br(get_text($config['cf_stipulation'])); ?></div>
		<div class="agree-label text-right">
			<small><label for="agree11">·&nbsp;&nbsp;회원가입약관의 내용에 동의합니다.</label></small>&nbsp;&nbsp;
			<input type="checkbox" name="agree" value="1" id="agree11">
		</div>
	</article>
    
    <article class="box-article bottom">
		<div class="text-muted box-title">
			<i class="fa fa-file-text-o" aria-hidden="true"></i></i><small>&nbsp;&nbsp;위치기반서비스이용동의</small>
		</div>
		
		<div class="agree-text" style="overflow:auto;"><?php echo $row['co_content'];?></div>
		<div class="agree-label text-right">
			<small><label for="agree31">·&nbsp;&nbsp;위치기반서비스 내용에 동의합니다.</label></small>&nbsp;&nbsp;
			<input type="checkbox" name="agree3" value="1" id="agree31">
		</div>
	</article>

	<article class="box-article">
		<div class="text-muted box-title">
			<i class="fa fa-file-text-o" aria-hidden="true"></i></i><small>&nbsp;&nbsp;개인정보처리방침안내</small>
		</div>
		
		<div class="agree-text" style="overflow:auto;"><?php echo nl2br(get_text($config['cf_privacy'])) ?></div>
		<div class="agree-label text-right">
			<small><label for="agree21">·&nbsp;&nbsp;개인정보처리방침안내의 내용에 동의합니다.</label></small>&nbsp;&nbsp;
			<input type="checkbox" name="agree2" value="1" id="agree21">
		</div>
	</article>

	<article class="box-article clearfix">
        <!-- 카카오톡 회원가입 -->
		<div id="smt-kakao" class="smt-kakao text-center">
			<a onclick="loginWithKakao()" class="btn-submit" >
				<img src="<?php echo $member_skin_url; ?>/img/join_kaka.png" alt="카카오 로고" style="margin-bottom:7px;">&nbsp;&nbsp;카카오톡 회원가입
			</a> 
		</div>
		<!-- 카카오톡 회원가입 -->
		
		<!-- 네이버 회원가입 -->
		<div class="smt-naver text-center">
			<a href="<?php echo $apiURL ?>" class="btn-submit_naver">
				<img src="<?php echo $member_skin_url; ?>/img/join_naver.png" alt="네이버 로고" style="margin-bottom:7px;">&nbsp;&nbsp;네이버로 회원가입
			</a> 
		</div>
		<!-- 네이버 회원가입 -->
		
		<!-- 페이스북 회원가입 -->
		<div class="smt-facebook text-center" id="btn_face">
			<a class="btn-submit_naver" onclick="FB_Login();" style="cursor:pointer;">
				<img src="<?php echo $member_skin_url; ?>/img/join_facebook.png" alt="페이스북 로고" style="margin-bottom:7px;">&nbsp;&nbsp;페이스북으로 회원가입
			</a> 
		</div>

		<!-- 페이스북 회원가입 -->
	</article>

	<article class="box-article clearfix">
		<div class="col-xs-6" onclick="setType('일반')" style="padding:0;">
			<div class="smt-default left text-center">
				<p><i class="fa fa-users" aria-hidden="true"></i></p>
				<p>일반 회원가입</p>
			</div>
		</div>
		<div class="col-xs-6" onclick="setType('사장님')" style="padding:0;">
			<div class="smt-default right text-center">
				<p><i class="fa fa-building-o" aria-hidden="true"></i></p>
				<p>사장님 회원가입</p>
			</div>
		</div>
	</article>

    </form>

    <script>

	function setType(t){
		var f = document.fregister;

		if(fregister_submit(f)){
			$("#mb_type").val(t);
			f.submit();
		}
	}

    function fregister_submit(f)
    {
        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        if (!f.agree3.checked) {
            alert("위치기반서비스의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree3.focus();
            return false;
        }

        if (!f.agree2.checked) {
            alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

        return true;
    }

	/* 카카오 회원가입 */
	//<![CDATA[
	// 사용할 앱의 JavaScript 키를 설정해 주세요.
	Kakao.init('3bfe886e9d30ed2f5ee69606d4b0a7d5');
	// 카카오 로그인 버튼을 생성합니다.
	function loginWithKakao() {
		var f = document.fregister;
        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        if (!f.agree3.checked) {
            alert("위치기반서비스의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree3.focus();
            return false;
        }

        if (!f.agree2.checked) {
            alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

		// 로그인 창을 띄웁니다.
		Kakao.Auth.login({
			throughTalk : false,
			success: function(authObj) {
				$("#mb_sns_type").val("kakao");
				$("#mb_token").val(authObj.access_token);
				f.action = "<?php echo G5_PLUGIN_URL;?>/oauth/register_with_kakao.php";
				f.submit();
			},
			fail: function(err) {
				alert("서버가 혼잡하오니 잠시 후 다시 시도해주세요.");
				//alert(JSON.stringify(err));
			}
		});
	};
	//]]>
	/* 카카오 회원가입 */
	
	/* 페북 회원가입 */
	window.fbAsyncInit = function() {
	FB.init({
		appId      : '180638805811082',
		cookie     : true,
		xfbml      : true,
		version    : 'v2.8'
	});
	FB.AppEvents.logPageView();   
	};

	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	/* 페북 회원가입 */
	
	function FB_Login(){
		var f = document.fregister;

		if (!f.agree.checked) {
			alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
			f.agree.focus();
			return false;
		}

		if (!f.agree3.checked) {
			alert("위치기반서비스의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
			f.agree3.focus();
			return false;
		}

		if (!f.agree2.checked) {
			alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
			f.agree2.focus();
			return false;
		}

		FB.login(function(response) {
			if (response.status === 'connected') {
				fbAPI();
			} else if (response.status === 'not_authorized') {
			} else {
			}
		}, { scope: 'public_profile,email' });
	}
	
	function fbAPI() {
		FB.api('/me', function(response) {
			$("#mb_sns_type").val("facebook");
			$("#mb_nickname").val(response.name);
			$("#mb_token").val(response.id);
			//$("#mb_email").val(response.email);
			document.fregister.action = "<?php echo G5_PLUGIN_URL;?>/oauth/register_with_facebook.php";
			document.fregister.submit();
		});
	}
	
    </script>

</div>
