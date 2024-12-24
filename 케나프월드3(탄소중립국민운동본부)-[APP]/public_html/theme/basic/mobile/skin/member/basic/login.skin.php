<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

$mobile_app = get_cookie("mobile_app");

$login_kaction_url = G5_URL."/bbs/kakao_join_check.php";
$login_action_url = G5_HTTPS_BBS_URL."/login_check.php";

?>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<div id="mb_login" class="mbskin">
    <h1><img src="<?php echo G5_THEME_IMG_URL ?>/common/zeros_logo.png" class="logo" alt="로고"/></h1>
	
	<form name="flogin" id="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
		<input type="hidden" name="url" value="<?php echo $login_url ?>">
		<fieldset id="login_fs">
			<legend>회원로그인</legend>
			<label for="login_id" class="sound_only">회원아이디<strong class="sound_only"> 필수</strong></label>
			<input type="text" name="mb_id" id="login_id" placeholder="아이디 입력(필수)" required class="frm_input required" size="20" maxLength="20">
			<label for="login_pw" class="sound_only">비밀번호<strong class="sound_only"> 필수</strong></label>
			<input type="password" name="mb_password" id="login_pw" placeholder="비밀번호 입력(필수)" required class="frm_input required" size="20" maxLength="20">
            <div class="flex">
			<input type="submit" value="로그인" class="btn_submit">
			<a href="<?php echo G5_BBS_URL;?>/register_form.php" class="btn_reg">회원가입</a>
            </div>
			<a href="<?php echo G5_BBS_URL ?>/password_lost.php" <? /*id="ol_password_lost" */ ?>class="btn_reg" style="margin-top:5px; width:100%;" target="_self">비밀번호 찾기</a>
			<input type="hidden" name="auto_login" id="login_auto_login" value="1">
		</fieldset>
    </form>

	<?php if(false){ ?>
	<form name="klogin" id="klogin" action="<?php echo $login_kaction_url ?>" onsubmit="return flogin_submit(this);" method="post">
		<input type="hidden" name="url" value="<?php echo $login_url ?>">
		<input type="hidden" name="mb_id" id="mb_kid" value="">
		<input type="hidden" name="mb_profile" id="mb_kprofile" value="">
		<input type="hidden" name="mb_thumb_profile" id="mb_kthumb_profile" value="">
		<input type="hidden" name="mb_nick" id="mb_knick" value="">

		<article class="login_sns" style="padding:6px 30px;">
		<!-- 카카오톡 회원가입 -->
			<div class="smt-kakao text-center">
				<a class="btn-submit" onclick="loginWithKakao();">
					<img src="<?php echo $member_skin_url; ?>/img/join_kaka.png" alt="카카오로그인"> 카카오톡 로그인
				</a> 
			</div>
		</article>
	</form>
	<?php } ?>
</div>

<script>
Kakao.init('<?php echo $config['cf_kakao_js_apikey'];?>');

function loginWithKakao() {
	$("#mb_login").css("display", "none");
  Kakao.Auth.login({
	success: function(authObj) {
		Kakao.API.request({
          url: '/v1/user/me',
          success: function(res) {
			var json = JSON.stringify(res);
			var parsed = JSON.parse(json);
			var arr = [];
			for(var x in parsed){
			  arr[x] = (parsed[x]);
			}
			$("#mb_kid").val(arr['id']);
			$("#mb_kprofile").val(arr['properties']['profile_image']);
			$("#mb_kthumb_profile").val(arr['properties']['thumbnail_image']);
			$("#mb_knick").val(arr['properties']['nickname']);
			$("#klogin").submit();
          },
          fail: function(error) {
            alert(JSON.stringify(error));
          }
        });
	},
	fail: function(err) {
	  alert(JSON.stringify(err));
	}
  });
};

function joinCheck(mb_id, mb_profile, mb_thumb_profile, mb_nick){
	$.post( "<?=G5_URL?>/bbs/kakao_join_check.php",{"mb_id":mb_id, "mb_profile":mb_profile,"mb_thumb_profile":mb_thumb_profile,"mb_nick":mb_nick}, function( data ) {
		location.replace(data);
	});
}

function flogin_submit(f)
{
    return true;
}

</script>
<!-- } 로그인 끝 -->