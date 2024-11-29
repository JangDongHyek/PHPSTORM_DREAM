<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 100);
?>
<style>
html{ max-width:100% !important; overflow-x:hidden;}
body{ /*background:url(<?php echo $member_skin_url ?>/img/bg01.jpg) no-repeat center 26% / 100%*/ background:#231f20;}
#top_back{ padding:20px 15px;}
#top_back i{ font-size:2em; color:#fff;}
@media screen and (max-width:1000px) {
body{ background-size:400%; background-position:30% 30%;}
}
</style>
<style>
.signin-button > div > div > svg {
  height: 50px;
  width: 100%;
}
.save {
    display: inline-block;
    color: #eee;
    border: 0;
    background: none;
    /* text-decoration: underline; */
    font-size: 0.9em;
    font-weight: 500;
    line-height: 1.5em;
    padding: 0 7px;
    margin-bottom: 10px;
}
</style>
<script type="text/javascript" src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>

<!--<div id="top_back" class="visible-xs">
    <a href="javascript:history.back();">
    <i class="fal fa-arrow-left"></i><span class="sound_only">뒤로</span>
    </a>
</div>-->

<!-- 로그인 시작 { -->
<div id="mb_login_wrap">
    <div id="mb_login" class="mbskin">
        <h1>
            <img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>" class="logo">
        </h1>

        <!--<h2>로그인 안내</h2>-->

        <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post" autocomplete="off">
        <input type="hidden" name="url" value="<?php echo $login_url ?>">
        <input type="hidden" name="token" id="token"> <!-- 21.02.04 푸시알림 -->

        <fieldset id="login_fs">
            <legend>로그인</legend>
            <label for="login_id" class="login_id">회원이이디<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" placeholder="ID">
            <label for="login_pw" class="login_pw">비밀번호<strong class="sound_only"> 필수</strong></label>
            <input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20" placeholder="PW">
            <!--<span class="save_id"><input type="checkbox" name="save_id" id="save_id" style="margin-bottom: 12px;"><label class="save" onclick="save_check('save_id')">아이디 저장</label></span>
            <span class="save_pw"><input type="checkbox" name="save_pw" id="save_pw" style="margin-bottom: 12px;"><label class="save" onclick="save_check('save_pw')">비밀번호 저장</label></span>-->
            <input type="submit" value="LOGIN" class="btn_submit">
            <!--<input type="button" class="btn_submit" value="" style="opacity: 0;" onclick="login_check();">-->
            <!--<div class="chk_ico">
                <input type="checkbox" name="auto_login" id="login_auto_login">
                <label for="login_auto_login" class="auto_login">자동로그인</label>
            </div>-->
        </fieldset>

        <aside id="login_info" class="visible-xs">
            <?php /*?><h2>회원로그인 안내</h2>
            <p>
                회원아이디 및 비밀번호가 기억 안나실 때는 아이디/비밀번호 찾기를 이용하십시오.<br>
                아직 회원이 아니시라면 회원으로 가입 후 이용해 주십시오.
            </p><?php */?>
            <div>
                <?php /*?><a href="<?php echo G5_BBS_URL ?>/password_lost.php" id="login_password_lost" class="btn02">아이디 비밀번호 찾기</a><?php */?>
                <a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="btn02">아이디/비밀번호 찾기</a><br />
                <a href="./register_form.php" class="btn01">회원가입</a>
            </div>
        </aside>

        <?php /*?><div class="btn_confirm">
            <a href="<?php echo G5_URL ?>/">메인으로 돌아가기</a>
        </div><?php */?>

        </form>
    </div>

    <!--아카데미 지점현황-->
    <div class="academy visible-xs"><a href="<?php echo G5_BBS_URL ?>/family_site.php">아카데미 지점현황 <i class="fal fa-long-arrow-right"></i></a></div>


    <!--sns링크-->
    <div id="sns_wrap" class="visible-xs">
    	<a href="http://www.jngk.co.kr"<?php echo 0 < strpos($_SERVER['HTTP_USER_AGENT'],'OSJNGK')?'':' target="_blank"';?>><img src="<?php echo $member_skin_url ?>/img/sns01.gif"><span class="sound_only">홈페이지</span></a>
    	<a href="http://www.facebook.com/jngk"<?php echo 0 < strpos($_SERVER['HTTP_USER_AGENT'],'OSJNGK')?'':' target="_blank"';?>><img src="<?php echo $member_skin_url ?>/img/sns02.gif"><span class="sound_only">페이스북</span></a>
    	<a href="http://blog.naver.com/jngolf"<?php echo 0 < strpos($_SERVER['HTTP_USER_AGENT'],'OSJNGK')?'':' target="_blank"';?>><img src="<?php echo $member_skin_url ?>/img/sns03.gif"><span class="sound_only">네이버블로그</span></a>
    	<a href="http://YouTube.com/JNGK"<?php echo 0 < strpos($_SERVER['HTTP_USER_AGENT'],'OSJNGK')?'':' target="_blank"';?>><img src="<?php echo $member_skin_url ?>/img/sns04.gif"><span class="sound_only">유튜브</span></a>
    	<a href="http://www.instagram.com/jngk__golfacademy"<?php echo 0 < strpos($_SERVER['HTTP_USER_AGENT'],'OSJNGK')?'':' target="_blank"';?>><img src="<?php echo $member_skin_url ?>/img/sns05.gif"><span class="sound_only">인스타그램</span></a>
    </div>
    <?php
			//if(0 < strpos($_SERVER['HTTP_USER_AGENT'],"OSJNGK")){?>
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
					clientId : 'jngk.itforone.co.kr',
					scope : 'name email',
					redirectURI: 'https://www.jngk.kr/bbs/apple.login.php',
					state : 'DE'
				});
					//애플로 로그인 성공 시.
//Listen for authorization success
document.addEventListener('AppleIDSignInOnSuccess', (data) => {
     //handle successful response
	 alert(1);
});
//Listen for authorization failures
document.addEventListener('AppleIDSignInOnFailure', (error) => {
     //handle error.
});
			</script>
		<?php //}
		?>
</div>

<?php /*?><div class="visible-xs" id="admin_mobile">
	<div class="adb">
        <div class="admin_logo"><img src="<?php echo G5_IMG_URL ?>/logo_color.png" alt="<?php echo $config['cf_title']; ?>" class="logo"></div>
        <div class="admin_tit">
        <strong>관리자로그인</strong> 안내
        <p>관리자페이지는 PC화면에서 이용할 수 있습니다.<br />감사합니다.</p>
        </div>
    </div>
</div>
<?php */?>

<script>
$(function(){
    <?php if(0 < strpos($_SERVER['HTTP_USER_AGENT'], "OSJNGK")) { ?>
    //webkit.messageHandlers.scriptHandler.postMessage(true); // 세로모드
    <?php } ?>

    // *** 21.03.16 아이디, 비밀번호 저장하기
    var key_id = getCookie("key_id"); // 저장된 쿠기값 가져오기
    $("#login_id").val(key_id);

    var key_pw = getCookie("key_pw");
    $("#login_pw").val(key_pw);

    if($('#login_id').val() != ""){ // 그 전에 ID를 저장해서 처음 페이지 로딩
        // 아이디 저장하기 체크되어있을 시,
        $("#save_id").attr("checked", true); // 아이디 저장하기를 체크 상태로 두기.
    }

    if($('#login_pw').val() != ""){ // 그 전에 비밀번호를 저장해서 처음 페이지 로딩
        // 비밀번호 저장하기 체크되어있을 시,
        $("#save_pw").attr("checked", true); // 비밀번호 저장하기를 체크 상태로 두기.
    }

    $(".save_id").click(function(){ // 체크박스에 변화가 있다면,
        if($("#save_id").is(":checked")){ // 아이디 저장하기 체크했을 때,
            setCookie("key_id", $("#login_id").val(), 86400 * 31 * 9999); // 쿠키 보관
        }else{ // 아이디 저장하기 체크 해제 시,
            deleteCookie("key_id");
        }
    });

    $(".save_pw").click(function(){ // 체크박스에 변화가 있다면,
        if($("#save_pw").is(":checked")){ // 비밀번호 저장하기 체크했을 때,
            setCookie("key_pw", $("#login_pw").val(), 86400 * 31 * 9999); // 쿠키 보관
        }else{ // 비밀번호 저장하기 체크 해제 시,
            deleteCookie("key_pw");
        }
    });

    // 아이디 저장하기를 체크한 상태에서 아이디를 입력하는 경우, 이럴 때도 쿠키 저장.
    $("#login_id").keyup(function(){ // 아이디 입력 칸에 아이디를 입력할 때,
        if($("#save_id").is(":checked")){ // 아이디 저장하기를 체크한 상태라면,
            setCookie("key_id", $("#login_id").val(), 86400 * 31 * 9999); // 쿠키 보관
        }
    });

    // 비밀번호 저장하기를 체크한 상태에서 비밀번호를 입력하는 경우, 이럴 때도 쿠키 저장.
    $("#login_pw").keyup(function(){ // 비밀번호 입력 칸에 비밀번호를 입력할 때,
        if($("#save_pw").is(":checked")){ // 비밀번호 저장하기를 체크한 상태라면,
            setCookie("key_pw", $("#login_pw").val(), 86400 * 31 * 9999); // 쿠키 보관
        }
    });
    // *** 21.03.16 아이디, 비밀번호 저장하기

    if('<?=$android_flag?>') {
        window.Android.init_orientation(); // 가로 모드 전환
    }

    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

var is_post = false;
function flogin_submit(f)
{
    if(is_post) { return false; }
    is_post = true;

    return true;
}

// // 21.02.04 푸시알림
// function fcmKey(token){
//     $("input[name='token']").val(token);//토큰값을 필드에 넣기 mb_10일 경우 mb_10으로 하면된다
// }

// *** 21.03.16 아이디, 비밀번호 저장하기
function setCookie(cookieName, value, exdays){
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
    document.cookie = cookieName + "=" + cookieValue;
}

function deleteCookie(cookieName){
    var expireDate = new Date();
    expireDate.setDate(expireDate.getDate() - 1);
    document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
}

function getCookie(cookieName) {
    cookieName = cookieName + '=';
    var cookieData = document.cookie;
    var start = cookieData.indexOf(cookieName);
    var cookieValue = '';
    if(start != -1){
        start += cookieName.length;
        var end = cookieData.indexOf(';', start);
        if(end == -1)end = cookieData.length;
        cookieValue = cookieData.substring(start, end);
    }
    return unescape(cookieValue);
}
// *** 21.03.16 아이디, 비밀번호 저장하기

function save_check(id) {
    if($("#"+id).is(":checked")){
        console.log(1)
        $("#"+id).prop("checked", false);
    } else {
        console.log(2);
        $("#"+id).prop("checked", true);
    }
}
</script>
<!-- } 로그인 끝 -->
