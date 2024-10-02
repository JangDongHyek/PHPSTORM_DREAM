<?php
include_once("./_common.php");
include_once("../head.sub.php");

$co_id = $_GET['co_id'];

$sql_search = "";
if($co_id)
	$sql_search .= " and co_id = '{$co_id}' ";

$sql = " select count(*) as cnt from {$g5['content_save_table']} where (1=1) {$sql_search}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sst) {
    $sst  = "co_datetime";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = "select * from {$g5['content_save_table']} where (1=1) {$sql_search} {$sql_order} limit {$from_record}, {$rows}";
$result = sql_query($sql);

if($co_id)	
	$qstr .= "&co_id=".$co_id;
?>

<form name="fsavelist" id="fsavelist" action="./contentform_save_update.php" onsubmit="return fsavelist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="<?php echo $token ?>">
<input type="hidden" name="co_id" value="<?php echo $co_id ?>">

<div style="padding:10px;">
	<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn_02 btn">
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">내용저장 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col"><?php echo subject_sort_link('co_id') ?>ID</a></th>
        <th scope="col">제목</th>
        <th scope="col">내용</th>
        <th scope="col"><?php echo subject_sort_link('co_datetime') ?>날짜</a></th>
        <th scope="col">적용</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['bo_subject']) ?></label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
		<td>
            <input type="hidden" name="co_no[<?php echo $i ?>]" value="<?php echo $row['co_no'] ?>">
			<?php echo $row['co_id']?>
		</td>
		<td><?php echo $row['co_subject']?></td>
		<td>
			<div style="max-height:200px; overflow:auto;"><?php echo $row['co_content']?></div>
		</td>
		<td><?php echo $row['co_datetime']?></td>
		<td>
			<input type="button" value="적용" class="btn btn_submit" onclick="setContent('<?php echo $row['co_no'];?>')">
		</td>
	</tr>
	<?php } ?>
	</tbody>
</table>
</div>
<?php echo get_paging($rows, $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>

<div style="padding:0 10px 10px 10px;">
	<input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn_02 btn">
</div>
</form>

<script>
function fsavelist_submit(f)
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

function setContent(co_no){
	$.get("<?php echo G5_ADMIN_URL;?>/ajax.content_save.php", {"co_no":co_no}, function (e){
		window.opener.document.getElementById("co_subject").value = e.co_subject;
		opener.setContent("co_content", e.co_content);
		opener.setContent("co_mobile_content", e.co_mobile_content);
		
		window.close();
	}, "json");
}
</script>

<?php
include_once('./admin.tail.php');
?>