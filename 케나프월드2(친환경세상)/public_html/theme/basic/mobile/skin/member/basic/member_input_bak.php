<?php
if (!defined('_GNUBOARD_')) exit; // ���� ������ ���� �Ұ�

// add_stylesheet('css ����', ��¼���); ���ڰ� ���� ���� ���� ��µ�
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
/*
html, body{width:100%;height:100%;min-height:500px;background:url(<?php echo $member_skin_url ?>/img/bg.png) #f0f0f0; overflow-y:hidden; overflow-x:hidden;}
*/
</style>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

<!-- �α��� ���� { -->
<div class="icons" style="position: absolute; right: 10px; top: 10px;">
		<?/*
		<a href="<?php echo G5_URL ?>"><i class="fa fa-home"></i><span class="sound_only">Ȩ����</span></a>
		<a href="#"><i class="fa fa-cog"></i><span class="sound_only">����</span></a>
		*/?>
		<a href="javascript:history.back();" class="closed"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/menu_close.png"><span class="sound_only">�ݱ�</span></a>
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
	    <li class="c">10��</li>
        <li class="c">20��</li>
		<li class="c">30��</li>
		<li class="c">40��</li>
		<li class="c">50��</li>
	</ul>
 </div>

<div class="m_check">Ȯ��</div>
</div>	





<script>

// ����� ���� JavaScript Ű�� ������ �ּ���.
Kakao.init('3bfe886e9d30ed2f5ee69606d4b0a7d5');
// īī�� �α��� ��ư�� �����մϴ�.
function loginWithKakao() {
	// �α��� â�� ���ϴ�.
	Kakao.Auth.login({
		throughTalk : false,
		success: function(authObj) {
			location.href='<?php echo G5_PLUGIN_URL;?>/oauth/login_with_kakao.php?mb_token='+authObj.access_token;
		},
		fail: function(err) {
			alert("������ ȥ���Ͽ��� ��� �� �ٽ� �õ����ּ���.");
			//alert(JSON.stringify(err));
		}
	});
};

$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("�ڵ��α����� ����Ͻø� �������� ȸ�����̵�� ��й�ȣ�� �Է��Ͻ� �ʿ䰡 �����ϴ�.\n\n������ҿ����� ���������� ����� �� ������ ����� �����Ͽ� �ֽʽÿ�.\n\n�ڵ��α����� ����Ͻðڽ��ϱ�?");
        }
    });
});

/* ��� ȸ������ */
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
/* ��� ȸ������ */

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
<!-- } �α��� �� -->