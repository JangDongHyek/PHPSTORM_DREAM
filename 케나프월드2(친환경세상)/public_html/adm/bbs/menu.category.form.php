<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.sub.php');
$table="g5_write_".$bo_table;
$sql="select wr_subject from $table where wr_id='$wr_id'";
$row=sql_fetch($sql);
?>
<script type="text/javascript">
	var no=0;
	function addCategory(){
		no++;
		var strHtml='<tr>';
			strHtml+='<td colspan="2">';
				strHtml+='<input type="text" name="cat_name[]" value="" class="frm_input" style="width:95%;margin-left:2%" placeholder="분류명을 입력하세요" required> ';
			strHtml+='</td>';
		strHtml+='</tr>	';
		$("#cat-table").append(strHtml);
		
	}
	function removeCategory(){
		var last=$("#cat-table tr").size();
		if(3<last){
			$("#cat-table tr").eq(last-1).remove();
			no--;
		}
	}
</script>
<div style="padding:10px">
<form name="form" method="post" action="./menu.category.form.update.php">

<table>
	<input type="hidden" name="bo_table" value="<?=$bo_table?>">
	<input type="hidden" name="wr_id" value="<?=$wr_id?>">
	<tbody id="cat-table">
	<tr>
		<td colspan="2" style="font-weight:bold;font-size:20px;text-align:center"><?=$row[wr_subject]?> <?=$catTitleArr[$bo_table]?>분류 설정</td>
	</tr>
	<tr>
		<td>메뉴 분류</td>
		<td><a href="javascript:;" onclick="addCategory()">추가</a> <a href="javascript:;" onclick="removeCategory()">삭제</a></td>
	</tr>
	<?
		$sql="select * from g5_dmenu_category where bo_table='$bo_table' and wr_id='$wr_id' order by idx asc";
		$result=sql_query($sql);
		while($row=sql_fetch_array($result)){
	?>
	<tr>
		<td colspan="2">
			<input type="hidden" name="idx[]" value="<?=$row[idx]?>">
			<input type="text" name="cat_name[]" value="<?=$row[cat_name]?>" class="frm_input" style="width:95%;margin-left:2%" placeholder="분류명을 입력하세요" required> 
		</td>
	</tr>
	<? }?>
	<tr>
		<td colspan="2">
			<input type="text" name="cat_name[]" value="" class="frm_input" style="width:95%;margin-left:2%" placeholder="분류명을 입력하세요" required> 
		</td>
	</tr>
	</tbody>
	<tbody>
	<tr>
		<td colspan="2">
			<button type="submit" style="background-color:#000;color:#fff;font-weight:bold;border:0px;width:100%;height:20px;">확인</button>
		</td>
	</tr>
	</tbody>

	
</table>
	</form>

<?
include_once(G5_PATH.'/tail.sub.php');
?>

