<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
html, body{width:100%;height:100%;min-height:500px;background:#fff; overflow-y:hidden; overflow-x:hidden;}
</style>

    <!-- 로그인 시작 { -->
    <div id="mb_login" class="mbskin">
        <h6>연인 서비스<br>이용 전<br>로그인이 필요해요</h6>
        <a href="http://www.yeonincompany.com/"><span><i class="fas fa-question"></i></span></a>
        <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
            <input type="hidden" name="url" value="<?php echo $login_url ?>">

            <fieldset id="login_fs">
                <legend>회원로그인</legend>
                <div class="login-box login-id">
                    <div class="login-input"><span class="placeholder" style="width:100%"><input type="text" name="mb_id" id="login_id" required class="i_text required" maxlength="20" placeholder="아이디를 입력해 주세요" /><!--<label for="login_id">아이디를 입력해 주세요.</label>--></span></div>
                </div>
                <div class="login-box login-pwd">
                    <div class="login-input"><span class="placeholder" style="width:100%"><input type="password" name="mb_password" id="login_pw" required class="i_text required" maxlength="20" placeholder="패스워드를 입력해 주세요" /><!--<label for="login_pw">패스워드를 입력해 주세요.</label>--></span></div>
                </div>
                <input type="submit" value="로그인하고 인연찾기" class="btn_submit">
            </fieldset>

            <aside id="login_info">
                <div class="login_cate">
                    <ul>
                        <li><a href="<?=G5_BBS_URL?>/register_form.php">회원 가입</a></li>
                        <li><a href="<?=G5_BBS_URL?>/password_lost_cert.php">ID/PW 찾기</a></li>
                    </ul>
                </div>
                <button class="hugi" onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=review'">커플후기</button>
            </aside>


        </form>

    </div>
<?/*php } else {?>
<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <h1><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" /><span class="sound_only"><?php echo $g5['title'] ?></span></h1>

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">

    <fieldset id="login_fs">
        <legend>회원로그인</legend>
			<div class="login-box login-id">
				<div class="login-input"><i class="fa fa-user"></i><span class="placeholder" style="width:80%"><input type="text" name="mb_id" id="login_id" required class="i_text required" maxlength="20" placeholder="아이디를 입력해 주세요" /><!--<label for="login_id">아이디를 입력해 주세요.</label>--></span></div>
			</div>
			<div class="login-box login-pwd">
				<div class="login-input"><i class="fa fa-lock"></i><span class="placeholder" style="width:80%"><input type="password" name="mb_password" id="login_pw" required class="i_text required" maxlength="20" placeholder="패스워드를 입력해 주세요" /><!--<label for="login_pw">패스워드를 입력해 주세요.</label>--></span></div>
			</div>
        <input type="submit" value="로그인" class="btn_submit">
        <!--<input type="checkbox" name="auto_login" id="login_auto_login" style="margin:0;"> 
        <label for="login_auto_login">자동로그인</label>-->
    </fieldset>

    <aside id="login_info">
        <!--<h2>회원로그인 안내</h2>
        <p>
            회원아이디 및 비밀번호는 고객센터로 문의바랍니다.<br>
            회원가입 또한 고객센터(관리자)를 통해 가능합니다.
        </p>-->
        <div class="login_cate">
            <ul> 
                 <li><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/btn_mem01.png" /><a href="./register_form.php">회원 가입</a></li>
                 <li><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/btn_mem02.png" /><a href="<?=G5_BBS_URL?>/password_lost_cert.php">ID/PW 찾기</a></li>
            </ul>
        </div>
    </aside>
    

    <?php /*?><div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/">메인으로 돌아가기</a>
    </div><?php /?>

    </form>

</div>
<?php }*/?>

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