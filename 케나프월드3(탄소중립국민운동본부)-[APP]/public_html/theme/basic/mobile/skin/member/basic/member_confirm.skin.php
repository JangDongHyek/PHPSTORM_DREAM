<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="mb_confirm" class="mbskin" style="display:none;">
    <h1><?php echo $g5['title'] ?></h1>

    <p>
        <strong>비밀번호를 한번 더 입력해주세요.</strong>
        <?php if ($member['mb_sns_type']) { ?>
        비밀번호를 입력하시면 회원탈퇴가 완료됩니다.
        <?php }else{ ?>
        회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.
        <?php }  ?>
    </p>

    <form name="fmemberconfirm" action="<?php echo $url ?>" onsubmit="return fmemberconfirm_submit(this);" method="post">
    <input type="hidden" name="mb_id" id="mb_id" value="<?php echo $member['mb_id'] ?>">
    <input type="hidden" name="w" value="u">

    <fieldset>
        회원아이디
        <span id="mb_confirm_id"><?php echo $member['mb_id'] ?></span>
        <input type="password" name="mb_password" id="mb_confirm_pw" placeholder="비밀번호(필수)" required class="frm_input" size="15" maxLength="20">
        <input type="submit" value="확인" id="btn_submit" class="btn_submit">
    </fieldset>

    </form>

    <div class="btn_confirm">
        <a href="<?php echo G5_URL ?>">메인으로 돌아가기</a>
    </div>

</div>

<script>
$("#mb_confirm_pw").val($("#mb_id").val());
document.getElementById("btn_submit").disabled = true;
document.fmemberconfirm.submit();

function fmemberconfirm_submit(f)
{
    document.getElementById("btn_submit").disabled = true;

    return true;
}
</script>
