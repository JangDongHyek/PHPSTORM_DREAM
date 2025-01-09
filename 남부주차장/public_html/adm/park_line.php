<?php
$sub_menu = "400000";
include_once('./_common.php');
include_once('./admin.head.php');

$sql="select * from park_line order by line_order asc";
$result=sql_query($sql);
?>

<style>
.mb_tbl table {text-align: center;}
</style>



<div class="tbl_head02 tbl_wrap mb_tbl">
	<table>
		<tbody>
			<tr>
				<td>주차라인명</td>
				<td><input type="text" name="line_name" value="" id="line-name" class="frm_input"></td>
				<td><button type="button" class="btn_submit" id="ok" style="padding:10px">확인</button></td>
			</tr>
		</tbody>
	</table>
<form name="form" id="form" action="./park_line_update.php" onsubmit="return fmemberlist_submit(this);" method="post">

    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
	<tr>
		<th>주차라인</th>
		<th>정렬순서</th>
		<th>삭제</th>
	</tr>

    </thead>
    <tbody id="park-list">
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        
    ?>
	<tr>
		<td>
			<input type="hidden" name="idx[]" value="<?=$row[idx]?>">
			<input type="text" name="line_name[]" value="<?=$row[line_name]?>" class="frm_input">
		</td>
		<td><input type="number" name="line_order[]" value="<?=$row[line_order]?>" class="frm_input"></td>
		<td><a href="javascript:;" onclick="parkRemove('<?=$row[idx]?>')">삭제하기</a></td>
	</tr>
    <?php
    }?>
    
    </tbody>
    </table>

</div>

<div class="btn_list01 btn_list">
    <input type="submit" name="act_button" value="최종확인">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
document.querySelector("#ok").addEventListener('click',function(){
	var strHtml="<tr>";
	strHtml+="<td><input type='hidden' name='idx[]' value=''><input type='text' name='line_name[]' value='"+document.getElementById("line-name").value+"'></td>";
	strHtml+="<td><input type='number' name='order[]' value='0'>";
	strHtml+='<td><a href="javascript:;" onclick="remove(this)">삭제하기</a></td>';
	strHtml+="</tr>";
	$("#park-list").append(strHtml);
	$("#line-name").val("");

});
function remove(t){
	if(confirm("주차라인을 삭제하시겠습니까?")){
		$(t).parent().parent().remove();
	}
}

function parkRemove(idx){
	if(confirm("주차라인을 삭제하시겠습니까?")){
		location.href="park_remove.php?idx="+idx;
	}else{
		
	}
}
</script>

<?php
include_once ('./admin.tail.php');
?>
