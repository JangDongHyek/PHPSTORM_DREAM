<?php
$sub_menu = "300610";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');
$sql_common = " from {$g5['group_content_table']} ";
$sql_order = " order by gc_id asc ";

$sql = " select * {$sql_common} {$sql_order} ";
$res = sql_query($sql);
$total_count = sql_num_rows($res);
$g5['title'] = '내용그룹설정';
include_once('./admin.head.php');

?>

<div class="local_ov01 local_ov">
    전체그룹 <?php echo number_format($total_count) ?>개
</div>
<form name="fcontentgrouplist" id="fcontentgrouplist" action="./contentgroup_list_update.php" method="post">
<input type="hidden" name="w" value="u">
<div class="tbl_head01 tbl_wrap" style="width:500px;">
    <table>
		<caption><?php echo $g5['title']; ?> 추가</caption>
		<thead>
		<tr>
			<th scope="col">그룹아이디</th>
			<th scope="col">그룹명</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><input type="text" name="gc_name" value="" class="frm_input" maxlength="10" style="width:100%;" required></td>
			<td><input type="text" name="gc_subject" value="" class="frm_input" maxlength="10" style="width:100%;" required></td>
			<td><input type="submit" value="내용 그룹 추가" style="background:#FAFAFA; border:1px solid #CCC; padding:8px 15px 10px 15px;"></td>
		</tr>
		</tbody>
	</table>
</div>
</form>

<form name="fcontentgrouplist" id="fcontentgrouplist" action="./contentgroup_list_update.php" onsubmit="return fcontentgrouplist_submit(this);" method="post">

<div class="tbl_head01 tbl_wrap" style="width:600px;">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">그룹 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">그룹아이디</th>
        <th scope="col">제목</th>
        <th scope="col">그룹 삭제</th>
    </tr>
    </thead>
    <tbody>
	<?php for($i=0; $i<$row=sql_fetch_array($res);$i++){ ?>
	<tr>
		<td style="text-align:center; width:50px;">
		
            <input type="hidden" name="group_id[<?php echo $i ?>]" value="<?php echo $row['gc_id'] ?>">
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
			<?php echo ($i+1)?>
		
		</td>
		<td style="text-align:center;"><?php echo $row['gc_name']?></td>
		<td style="text-align:center;"><?php echo $row['gc_subject']?></td>
		<td style="text-align:center; width:100px;">
			<a href="./contentgroup_list_update.php?w=d&gc_id=<?php echo $row['gc_id']?>">
			<input type="button" value="그룹 삭제" style="background:#FAFAFA; border:1px solid #CCC; padding:8px 15px 10px 15px;" onclick="">
			</a>
		</td>
	</tr>
	<?php } ?>
    <?php
    if ($i == 0)
        echo '<tr><td colspan="4" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </table>
</div>

<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" onclick="document.pressed=this.value" value="선택삭제">
</div>
</form>

<script>
function fcontentgrouplist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once('./admin.tail.php');
?>
