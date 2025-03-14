<?php
$sub_menu = "500100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$html_title = '설문조사';
if ($w == '')
    $html_title .= ' 생성';
else if ($w == 'u')  {
    $html_title .= ' 수정';
    $sql = " select * from {$g5['poll_table']} where po_id = '{$po_id}' ";
    $po = sql_fetch($sql);
} else
    alert('w 값이 제대로 넘어오지 않았습니다.');

$g5['title'] = $html_title;
include_once('./admin.head.php');
?>

<form name="fpoll" id="fpoll" action="./poll_form_update.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="po_id" value="<?php echo $po_id ?>">
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
    <tbody>
    <tr>
        <th scope="row" style="width:120px;"><label for="po_subject">설문조사 제목<strong class="sound_only">필수</strong></label></th>
        <td><input type="text" name="po_subject" value="<?php echo $po['po_subject'] ?>" id="po_subject" required class="required frm_input" size="80" maxlength="125"></td>
    </tr>

    <?php
    for ($i=1; $i<=9; $i++) {
        $required = '';
        if ($i==1 || $i==2) {
            $required = 'required';
            $sound_only = '<strong class="sound_only">필수</strong>';
        }

        $po_poll = get_text($po['po_poll'.$i]);
    ?>

    <tr>
        <th scope="row"><label for="po_poll<?php echo $i ?>">항목 <?php echo $i ?><?php echo $sound_only ?></label></th>
        <td>
            <input type="text" name="po_poll<?php echo $i ?>" value="<?php echo $po_poll ?>" id="po_poll<?php echo $i ?>" <?php echo $required ?> class="frm_input <?php echo $required ?>" maxlength="125">
            <label for="po_cnt<?php echo $i ?>">항목 <?php echo $i ?> 투표수</label>
            <input type="text" name="po_cnt<?php echo $i ?>" value="<?php echo $po['po_cnt'.$i] ?>" id="po_cnt<?php echo $i ?>" class="frm_input" size="3">
       </td>
    </tr>

    <?php } ?>

    <?php if ($w == 'u') { ?>
    <tr>
        <th scope="row">설문조사등록일</th>
        <td><?php echo $po['po_date']; ?></td>
    </tr>
    <tr>
        <th scope="row"><label for="po_ips">설문조사참가 IP</label></th>
        <td><textarea name="po_ips" id="po_ips" readonly rows="10"><?php echo preg_replace("/\n/", " / ", $po['po_ips']) ?></textarea></td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_ids">설문조사참가 회원</label></th>
        <td><textarea name="mb_ids" id="mb_ids" readonly rows="10"><?php echo preg_replace("/\n/", " / ", $po['mb_ids']) ?></textarea></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>

</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="./poll_list.php?<?php echo $qstr ?>">목록</a>
</div>

</form>

<?php
include_once('./admin.tail.php');
?>
