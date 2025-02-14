<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 100);
?>
<style>
.signin-button > div > div > svg {  
  height: 50px;  
  width: 100%;  
} 
</style>
<script type="text/javascript" src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>
<style>
body{background:#fff;}
</style>


<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <h1><img src="<?php echo G5_THEME_IMG_URL ?>/app/logo_img.png" class="logo"></h1>

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">
    <input type="hidden" name="token" id="token"> <!-- 21.03.08 푸시알림 -->

    <fieldset id="login_fs">
        <legend>회원로그인</legend>
        <label for="login_id" class="login_id">회원아이디<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" placeholder="아이디">
        <label for="login_pw" class="login_pw">비밀번호<strong class="sound_only"> 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20" placeholder="비밀번호">
        <input type="submit" value="로그인" class="btn_submit lgn"><br/>
		
        <!--<div class="chk_ico">
            <input type="checkbox" name="auto_login" id="login_auto_login">
            <label for="login_auto_login" class="auto_login">자동로그인</label>
        </div>-->
    </fieldset>
	
    <aside id="login_info">
        <?php /*?><h2>회원로그인 안내</h2>
        <p>
            회원아이디 및 비밀번호가 기억 안나실 때는 아이디/비밀번호 찾기를 이용하십시오.<br>
            아직 회원이 아니시라면 회원으로 가입 후 이용해 주십시오.
        </p><?php */?>
        <div>
            <?php /*?><a href="<?php echo G5_BBS_URL ?>/password_lost.php" id="login_password_lost" class="btn02">아이디 비밀번호 찾기</a><?php */?>
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php">내정보찾기</a>
            <a href="<?php echo G5_BBS_URL ?>/register.php" class="btn01"><i class="fas fa-heart"></i> 회원가입</a>
        </div>
    </aside>
	<?php
			if(0 < strpos($_SERVER['HTTP_USER_AGENT'],"OSnaim")){?>
			<!--<a href="javascript:;" onclick="appleLogin()">애플로그인</a>
			<script type="text/javascript">
				function appleLogin(){
					$.ajax({
						url:"<?=G5_BBS_URL?>/apple.login.php",
						data:{"ketId":"9FC7HLR4T7","teamId":"P83L57QHT9","clientId":"co.kr.itforone.naimwedding"},
						dataType:"html",
						Type:"POST",
						success:function(data){
							alert(data);
							console.log(data);
						}
					});
				}
			</script>-->
			<!--<div id="appleid-signin" data-color="white" data-border="true" data-type="sign in" style="height:50px;margin-top:20px"></div>-->
			<script type="text/javascript">
				AppleID.auth.init({
					clientId : 'naimwedding.itforone.co.kr',
					scope : 'email',
					redirectURI: 'https://www.cwsignal.com/bbs/apple.login.php',
					state : 'DE'
				});
			</script>
		<?php }
		?>
    <?php /*?><div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/">메인으로 돌아가기</a>
    </div><?php */?>

    </form>

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

// 21.03.08 푸시알림
function fcmKey(token){
    $("input[name='token']").val(token);//토큰값을 필드에 넣기 mb_10일 경우 mb_10으로 하면된다
}
</script>
<!-- } 로그인 끝 -->