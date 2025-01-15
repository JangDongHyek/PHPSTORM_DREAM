<?php
$sub_menu = "910100";

include_once('./_common.php');

include_once(G5_ADMIN_PATH.'/rg_g5_convert/function.lib.php');
include_once(G5_ADMIN_PATH.'/rg_g5_convert/config.php');

auth_check($auth[$sub_menu], 'r');

$sql = "select bbs_id, bbs_name from rg_bbs_cfg ";
$result = sql_query($sql);
$total_count = sql_num_rows($result);

$g5['title'] = 'rgboard 게시판 이전';
include_once (G5_ADMIN_PATH.'/admin.head.php');

?>
<style>
	.tbl_wrap { width:600px; }
	.tbl_wrap td { text-align:center; }
</style>
<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    rgboard 생성된 게시판수 <?php echo number_format($total_count) ?>개
</div>

<form name="fboardlist" id="fboardlist" action="./convert_update.php" onsubmit="return fboardlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="<?php echo $token ?>">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">게시판 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">rgboard TABLE 명</a></th>
        <th scope="col">rgboard TABLE 제목</a></th>
        <th scope="col">rgboard TABLE <br/>파일 갯수</a></th>
        <th scope="col">gnuboard TABLE 명</a></th>
        <th scope="col">gnuboard TABLE 제목</a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i<$row=sql_fetch_array($result); $i++) {
		$rg_table_id = $row['bbs_id']; 
		$rg_table_name = $row['bbs_name']; 
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo $rg_table_id ?></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
			<input type="hidden" name="rg_table_id[]" value="<?php echo $rg_table_id?>">
        </td>
        <td>rg_<?php echo $rg_table_id ?>_body</td>
        <td><?php echo $rg_table_name ?></td>
		<td><input type="text" name="rg_table_file[]" value="2" class="frm_input" size="2" style="text-align:center;"> 개</td>
        <td>
			<select name="bo_table[]">
				<?php
				$gnu_sql = " select * from {$g5['board_table']} a";
				$gnu_result = sql_query($gnu_sql);
				for($j=0; $j<$gnu_row = sql_fetch_array($gnu_result); $j++){ ?>
				<option value="<?php echo $gnu_row['bo_table']?>"><?php echo $gnu_row['bo_table']?>(<?php echo $gnu_row['bo_subject']?>)</option>
				<?php } ?>
			</select>
		</td>
		<td>미구현</td>
    </tr>
    <?php
    }
    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="선택이전" onclick="document.pressed=this.value">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>

<script>
function fboardlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }
    return true;
}

</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>