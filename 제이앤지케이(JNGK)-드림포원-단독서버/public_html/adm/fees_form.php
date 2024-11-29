<?php
$sub_menu = "220100";
include_once('./_common.php');

$sql = " select * from g5_center_fees where center_code = '{$_GET['center_code']}' ";
$fee = sql_fetch($sql);

$w = '';
if(!empty($fee['idx'])) {
    $w = 'u';
}

//if ($is_admin != 'super')
//    alert_close('최고관리자만 접근 가능합니다.');

$g5['title'] = '카드 수수료 관리';
include_once(G5_PATH.'/head.sub.php');
?>

<div id="menu_frm" class="new_win">
    <div class="metf"><?php echo $g5['title']; ?></div>

    <form name="ffeeform" id="ffeeform" method="post" action="fees_form_update.php" onsubmit="return ffeeform_submit(this);" autocomplete="off">
        <input type="hidden" name="w" id="w" value="<?=$w?>">
        <input type="hidden" name="center_code" id="center_code" value="<?=$_GET['center_code']?>">

        <div class="tbl_head01 tbl_wrap">
            <table>
                <colgroup>
                    <col width="50%">
                    <col width="%">
                </colgroup>
                <tbody>
                    <tr>
                        <td><label for="chk">신용카드 수수료(%)</label></td>
                        <td><input type="tel" name="credit_card_fees" id="credit_card_fees" value="<?=$fee['credit_card_fees']?>" required class="required frm_input full_input" onkeyup="number_check(this);add_comma(this.value);" style="text-align: right;"></td>
                    </tr>
                    <tr>
                        <td><label for="chk">체크카드 수수료(%)</label></td>
                        <td><input type="tel" name="check_card_fees" id="check_card_fees" value="<?=$fee['check_card_fees']?>" required class="required frm_input full_input" onkeyup="number_check(this);add_comma(this.value);" style="text-align: right;"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="btn_confirm01 btn_confirm">
            <input type="submit" name="act_button" value="확인" class="btn_submit">
        </div>

    </form>

</div>

<script>
function ffeeform_submit(f)
{
    return true;
}

function number_check(data) {
    $('#'+data.id).val(data.value.replace(/[^0-9\.]+/g, ''));
    $('#'+data.id).val(data.value.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,'));
}

function add_comma(price) {
    price = price.replaceAll(/,/gi, "");
    $('#lesson_price').val(number_format(price));
}
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>