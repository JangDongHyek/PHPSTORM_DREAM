<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원 비밀번호 확인 시작 { -->
<div id="mb_confirm" class="mbskin">

    <a href="javascript:history.back();" class="btn_back"><i class="fa-solid fa-left"></i></a>
    <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_color.svg" alt="임마누엘 교회">
    <br><br>
    <p>
        비밀번호를 한번 더 입력해주세요.
        <?php if ($url == 'member_leave.php') { ?>
        <br>비밀번호를 입력하시면 회원탈퇴가 완료됩니다.
        <?php }else{ ?>
        <?php }  ?>
    </p>

    <form name="fmemberconfirm" action="<?php echo $url ?>" onsubmit="return fmemberconfirm_submit(this);" method="post">
        <input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
        <input type="hidden" name="w" value="u">

        <fieldset>
            <div>
                아이디
                <span id="mb_confirm_id"><?php echo $member['mb_id'] ?></span>
                <hr>
                비밀번호<strong class="sound_only">필수</strong>
                <input type="password" name="mb_password" id="confirm_mb_password" required class="frm_input" size="15" maxLength="20">
            </div>
            <input type="submit" value="확인" id="btn_submit" class="btn_submit">
        </fieldset>

    </form>

</div>

<script>
function fmemberconfirm_submit(f)
{
    document.getElementById("btn_submit").disabled = true;

    return true;
}
</script>
<!-- } 회원 비밀번호 확인 끝 -->