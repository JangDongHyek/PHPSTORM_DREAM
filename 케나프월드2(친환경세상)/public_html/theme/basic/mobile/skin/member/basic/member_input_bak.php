<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
/*
html, body{width:100%;height:100%;min-height:500px;background:url(<?php echo $member_skin_url ?>/img/bg.png) #f0f0f0; overflow-y:hidden; overflow-x:hidden;}
*/
</style>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

<!-- 로그인 시작 { -->
<div class="icons" style="position: absolute; right: 10px; top: 10px;">
		<?/*
		<a href="<?php echo G5_URL ?>"><i class="fa fa-home"></i><span class="sound_only">홈으로</span></a>
		<a href="#"><i class="fa fa-cog"></i><span class="sound_only">설정</span></a>
		*/?>
		<a href="javascript:history.back();" class="closed"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/menu_close.png"><span class="sound_only">닫기</span></a>
	</div> 
<div class="m_input_title">
      <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_input_title1.png">
</div>


<div class="m_input_bo">
	<div class="" style="height: 200px;">
	 <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_input_title2.png">
	
	<ul class="gender">		  
	    <li class="a"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_girl.png" ></li>
		<li class="b"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_boy.png" ></li>
	</ul>
	</div>
	<div class="" style="height: 200px;">
	 <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/m_input_title3.png">
	<ul class="age">		  
	    <li class="c">10대</li>
        <li class="c">20대</li>
		<li class="c">30대</li>
		<li class="c">40대</li>
		<li class="c">50대</li>
	</ul>
 </div>

<div class="m_check">확인</div>
</div>	





<script>

// 사용할 앱의 JavaScript 키를 설정해 주세요.
Kakao.init('3bfe886e9d30ed2f5ee69606d4b0a7d5');
// 카카오 로그인 버튼을 생성합니다.
function loginWithKakao() {
	// 로그인 창을 띄웁니다.
	Kakao.Auth.login({
		throughTalk : false,
		success: function(authObj) {
			location.href='<?php echo G5_PLUGIN_URL;?>/oauth/login_with_kakao.php?mb_token='+authObj.access_token;
		},
		fail: function(err) {
			alert("서버가 혼잡하오니 잠시 후 다시 시도해주세요.");
			//alert(JSON.stringify(err));
		}
	});
};

$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

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
		//$("#mb_email").val(response.email);
		location.href='<?php echo G5_PLUGIN_URL;?>/oauth/login_with_facebook.php?mb_token='+response.id;
	});
}
	
function flogin_submit(f)
{
    return true;
}
</script>
<!-- } 로그인 끝 -->