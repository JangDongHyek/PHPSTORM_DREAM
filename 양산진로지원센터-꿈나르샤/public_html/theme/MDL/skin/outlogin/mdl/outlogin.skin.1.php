<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);
?>

<!-- 로그인 전 아웃로그인 시작 { -->

<form name="foutlogin" action="<?php echo $outlogin_action_url ?>" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">
<fieldset>
	<input type="hidden" name="url" value="<?php echo $outlogin_url ?>">
	<div class="mdl-textfield mdl-js-textfield" style="width:80px;">
		<input class="mdl-textfield__input" type="text" name="mb_id" required maxlength="20">
		<label class="mdl-textfield__label" for="sample1">&nbsp;아이디</label>
	</div>
	<div class="mdl-textfield mdl-js-textfield" style="width:100px;">
		<input class="mdl-textfield__input" type="password" name="mb_password" required maxlength="20">
		<label class="mdl-textfield__label" for="sample1">&nbsp;비밀번호</label>
	</div>
	
	<input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" value="로그인" style="width:80px; height:27px; line-height:27px; font-weight:bolder; margin-top:-2px;">
	<input type="checkbox" name="auto_login" value="1" id="auto_login">
	<label for="auto_login" id="auto_login_label">자동로그인</label>
</fieldset>
</form>

<a class="mdl-navigation__link" href="<?php echo G5_BBS_URL ?>/register.php"><b>회원가입</b></a>
<a class="mdl-navigation__link" href="<?php echo G5_BBS_URL ?>/password_lost.php" id="ol_password_lost">정보찾기</a>
<script>
$omi = $('#ol_id');
$omp = $('#ol_pw');
$omp.css('display','inline-block').css('width',104);
$omi_label = $('#ol_idlabel');
$omi_label.addClass('ol_idlabel');
$omp_label = $('#ol_pwlabel');
$omp_label.addClass('ol_pwlabel');

$(function() {
    $omi.focus(function() {
        $omi_label.css('visibility','hidden');
    });
    $omp.focus(function() {
        $omp_label.css('visibility','hidden');
    });
    $omi.blur(function() {
        $this = $(this);
        if($this.attr('id') == "ol_id" && $this.attr('value') == "") $omi_label.css('visibility','visible');
    });
    $omp.blur(function() {
        $this = $(this);
        if($this.attr('id') == "ol_pw" && $this.attr('value') == "") $omp_label.css('visibility','visible');
    });

    $("#auto_login").click(function(){
        if ($(this).is(":checked")) {
            if(!confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?"))
                return false;
        }
    });
});

function fhead_submit(f)
{
    return true;
}
</script>
<!-- } 로그인 전 아웃로그인 끝 -->
