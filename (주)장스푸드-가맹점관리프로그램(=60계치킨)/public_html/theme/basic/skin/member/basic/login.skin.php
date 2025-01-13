<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
		<input type="hidden" name="url" value="<?php echo $login_url ?>">
		
		<div class="login-skin">
			<dl>
				<dt class="login-line"><img src="<?php echo G5_THEME_IMG_URL;?>/logo.png"></dt>
				<dd class="login-tbl">
					<table>
						<caption>
							<col width="20%">
							<col width="50%">
							<col width="auto">
						</caption>
						<tbody>
							<tr>
								<td><label for="login_id" class="login_id">ID<strong class="sound_only"> 필수</strong></label></td>
								<td><input type="text" name="mb_id" id="login_id" required class="log-input required" size="20" maxLength="20" tabindex="1"></td>
								<td rowspan="2" class="text-right"><input type="submit" value="로그인" class="btn btn-default" tabindex="3"></td>
							</tr>
							<tr>
								<td><label for="login_pw" class="login_pw">PW<strong class="sound_only"> 필수</strong></label></td>
								<td><input type="password" name="mb_password" id="login_pw" required class="log-input required" size="20" maxLength="20" tabindex="2"></td>
							</tr>
						</tbody>
					</table>
				</dd>
				<dd class="login-tail">
					<input type="hidden" name="auto_login" id="login_auto_login" value="" tabindex="4">
					<p id="auto_login">
						<i class="fa fa-square-o"></i> 자동로그인
					</p>
					<!--
					<p class="text-right">
						<a href="./register.php" tabindex="5">회원가입</a>
					</p>
					-->
				</dd>
			</dl>
		</div>
    </form>
</div>

<script>
$(function(){
    $("#auto_login").click(function(){
		var lal = $("#login_auto_login");
		var fa = $(this).find("i");

        if (!lal.val()) {
            if(confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?")){
				fa.removeClass("fa-square-o").addClass("fa-check-square");
				lal.val("1");
				return false;
			}
        }
		fa.removeClass("fa-check-square").addClass("fa-square-o");
		lal.val("");
    });
});

function flogin_submit(f)
{
    return true;
}
</script>
<!-- } 로그인 끝 -->