<?php
$sub_menu = "400000";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');
$sql = "select * from g5_request where idx='$idx'";

$row = sql_fetch($sql);
$sql="select mb_hp from g5_member where mb_id='$row[mb_id]'";
$mem = sql_fetch($sql);

$g5['title'] = "견적서 보기";
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
                <th scope="row"><label for="mb_id">아이디/이름</label></th>
                <td>
                    <?php echo $row[mb_id]?>/<?php echo $row[mb_name]?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_id">연락처</label></th>
                <td>
                    <?php echo $mem[mb_hp]?> &nbsp;
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="mb_id">제품명</label></th>
                <td>
                    <?php echo $row[wr_subject]?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_id">내용<?php echo $sound_only ?></label></th>
                <td>
                    <?php echo nl2br($row[content])?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_id">등록일<?php echo $sound_only ?></label></th>
                <td>
                    <?php echo $row[regdate]?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="btn_confirm01 btn_confirm">
        <a href="./request_list.php?<?php echo $qstr ?>">목록</a>
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
