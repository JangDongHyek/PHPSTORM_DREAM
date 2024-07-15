<?php
$sub_menu = "220100";
include_once('./_common.php');

/**
 * 관리자 - 기업의뢰 - 의뢰전달하기
 */

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

$g5['title'] = '의뢰전달하기';
include_once(G5_PATH.'/head.sub.php');
?>

<form action="<?=G5_ADMIN_URL?>/inquiry_pass.php" method="post" onsubmit="return formCheck(this);">
    <input type="hidden" id="company_inquiry_idx" name="company_inquiry_idx" value="<?=$idx?>">
    <input type="hidden" id="mode" name="mode" value="adm">
    <div class="tbl_frm01 tbl_wrap">
    <h1 class="subj">* 의뢰전달</h1>
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col width="20%">
                <col width="25%">
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="ce_offer_price">견적제안금액<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="ce_offer_price" value="<?php echo $ci['ce_offer_price"'] ?>" id="ce_offer_price" class="frm_input" size="30" onkeyup="comma_number(this);">
                    <select id="ce_unit" name="ce_unit">
                        <option value="원">원</option>
                        <option value="USE">USD</option>
                        <option value="EUR">EUR</option>
                        <option value="JYP">JYP</option>
                        <option value="CNY">CNY</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="ce_contents">고객님께 드릴 말씀<?php echo $sound_only ?></label></th>
                <td>
                    <textarea name="ce_contents" id="ce_contents" class="frm_input" style="resize: unset;"><?php echo $ci['ce_contents"'] ?></textarea>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="btn_confirm01 btn_confirm">
        <input type="submit" value="완료" class="btn_submit">
        <a href="javascript:window.close();">취소</a>
    </div>
</form>

<script>
// 폼체크
var is_post = false;
function formCheck(f) {
    if(is_post) {
        is_post = false;
    }
    is_post = true;

    if(f.ce_offer_price.value == '') {
        swal('견적제안금액을 입력해 주세요.');
        is_post = false;
        return false;
    }

    if(f.ce_contents.value == '') {
        swal('고객님께 드릴 말씀을 입력해 주세요.');
        is_post = false;
        return false;
    }

    return true;
}
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>