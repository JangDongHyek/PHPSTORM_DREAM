<?php
$sub_menu = "300100";
include_once("./_common.php");


$g5['title'] = '보류사유 추가';
include_once(G5_PATH.'/head.sub.php');

$write_mode = $_REQUEST['wm'];
$sql = "select * from new_request_pay where rp_idx = '{$_REQUEST['rp_idx']}' ";
$result = sql_fetch($sql);

?>

<script src="<?php echo G5_ADMIN_URL ?>/admin.js"></script>

<div class="new_win">
    <h1><?php echo $g5['title']; ?></h1>

    <form name="fboardcopy" id="fboardcopy" action="./adm.ajax.controller.php" onsubmit="return fboardcopy_check(this);" method="post">
    <input type="hidden" name="mode" value="delay_reason_update">
    <input type="hidden" name="write_mode" value="<?=$write_mode?>">
    <input type="hidden" name="rp_idx" value="<?=$_REQUEST['rp_idx']?>">
    <input type="hidden" name="mb_id" value="<?=$result['mb_id']?>">
    <input type="hidden" name="request_amt" value="<?=$result['rp_amt']?>">

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption><?php echo $g5['title']; ?></caption>
        <tbody>
        <tr>
            <th scope="col">보류사유</th>
            <td><textarea name="rp_memo"><?=$result['rp_memo']?></textarea></td>
        </tr>
        </tbody>
        </table>
    </div>

    <div class="btn_confirm01 btn_confirm">
        <input type="submit" class="btn_submit" value="확인">
        <input type="button" class="btn_cancel" value="창닫기" onclick="tab_close();">
    </div>

    </form>

</div>

<script>
function fboardcopy_check(f)
{
    if ($('[name = rp_memo]').val() == ""){
        swal('보류사유를 입력해주세요.');
        return false;

    }

    return true;
}

 function tab_close() {

    opener.document.location.href = g5_admin_url + "/payment_list.php?"+ "<?= $qstr ?>";
     self.close();
 }
</script>


<?php
include_once(G5_PATH.'/tail.sub.php');
?>
