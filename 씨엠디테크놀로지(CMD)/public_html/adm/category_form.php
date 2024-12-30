<?php
$sub_menu = "300200";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');
if ($w == 'u') {
    $sql = "select * from g5_write_category where wr_id='$wr_id'";
    $row = sql_fetch($sql);
}


$g5['title'] = $w == "u" ? "분류 수정" : "분류 등록";
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>

<form name="fmember" id="fmember" action="<?php echo G5_BBS_URL ?>/write_update.php" onsubmit="return fmember_submit(this);"
      method="post" enctype="multipart/form-data">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="bo_table" value="category">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col class="grid_4">
                <col>

            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_id">1차 분류명</label></th>
                <td>
                    <input type="text" name="wr_subject" value="<?php echo $row['wr_subject'] ?>"
                           id="wr_subject" <?php echo $required_mb_id ?>
                           class="frm_input <?php echo $required_mb_id_class ?>" size="50" minlength="3" maxlength="50">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_id">내용<?php echo $sound_only ?></label></th>
                <td>
                    <textarea class="frm_info" name="wr_content" style="padding: 10px"><?php echo $row[wr_content]?></textarea>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_id">2차 분류명</label></th>
                <td>
                    <input type="text" name="wr_1" value="<?php echo $row['wr_1'] ?>"
                           id="wr_subject" <?php echo $required_mb_id ?>
                           class="frm_input <?php echo $required_mb_id_class ?>" minlength="3"
                           style="width:50%"
                    >
                    "(,)콤마로 구분하여 2차 분류명을 입력하여 주세요"
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="btn_confirm01 btn_confirm">
        <input type="submit" value="확인" class="btn_submit" accesskey='s'>
        <a href="./category_list.php?<?php echo $qstr ?>">목록</a>
    </div>
</form>

<script>
    function fmember_submit(f) {
        return true;
    }
</script>

<?php
include_once('./admin.tail.php');
?>
