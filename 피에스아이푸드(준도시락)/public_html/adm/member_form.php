<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $sound_only = '<strong class="sound_only">필수</strong>';
    $html_title = '추가';
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    $html_title = '정보';

    $sns = '';
    if($mb['sns'] == 'naver') {
        $sns = '네이버';
    } else if($mb['sns'] == 'kakao') {
        $sns = '카카오';
    }
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

$g5['title'] .= '회원'.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<style>
    .bg_gray { background-color: lightgrey; }
</style>

<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col width="8%">
        <col width="*">
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" class="frm_input bg_gray" size="40" minlength="3" readonly>
        </td>
    </tr>
    <?php if(empty($sns)) { ?>
    <tr>
        <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
        <td><input type="password" name="mb_password" id="mb_password" class="frm_input" size="40"></td>
    </tr>
    <?php } ?>
    <tr>
        <th scope="row"><label for="mb_name">업체명&현장명<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" class="frm_input" size="40" minlength="2"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_hp">휴대번호</label></th>
        <td><input type="tel" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input" size="40" maxlength="13"></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_addr">주문배송지</label></th>
        <td>
            <input type="text" name="mb_addr1" value="<?php echo empty($mb['mb_zip1']) ? '' : '['.$mb['mb_zip1'].'] '; ?><?=$mb['mb_addr1']?>" id="mb_addr1" class="frm_input" size="70"><br>
            <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="70" style="margin-top: 2px;">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="send_email">명세서수신이메일</label></th>
        <td><input type="text" name="send_email" value="<?php echo $mb['send_email'] ?>" id="send_email" class="frm_input" size="40"></td>
    </tr>
    <tr>
        <th scope="row"><label for="send_email">결제방법</label></th>
        <td>
            <input type="radio" class="frm_input" value="카드결제" id="pay1" name="payment" <?=$mb['payment'] == '카드결제' ? 'checked' : '';?>><label for="pay1">카드결제</label>
            <input type="radio" class="frm_input" value="계좌입금" id="pay2" name="payment" <?=$mb['payment'] == '계좌입금' ? 'checked' : '';?>><label for="pay2">계좌입금</label>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="sns">SNS가입</label></th>
        <td><input type="text" name="sns" value="<?php echo $sns ?>" id="sns" class="frm_input bg_gray" size="40" readonly></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_datetime">가입일</label></th>
        <td><input type="text" name="mb_datetime" value="<?php echo substr($mb['mb_datetime'],0,10) ?>" id="mb_datetime" class="frm_input bg_gray" size="40" readonly></td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="수정" class="btn_submit" accesskey='s'>
    <a href="./member_list.php?<?php echo $qstr ?>">목록</a>
</div>
</form>

<script>
$(function() {
    // $('input').attr("readonly", true);
    // 휴대번호 체크
    $("#mb_hp").keydown(function (event) {
        var mb_hp = $(this);
        var key = event.charCode || event.keyCode || 0;
        if (key !== 8 && key !== 9) {
            if (mb_hp.val().length === 3) {
                mb_hp.val(mb_hp.val() + '-');
            }
            if (mb_hp.val().length === 8) {
                mb_hp.val(mb_hp.val() + '-');
            }
        }

        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });
});

function fmember_submit(f) {
    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
