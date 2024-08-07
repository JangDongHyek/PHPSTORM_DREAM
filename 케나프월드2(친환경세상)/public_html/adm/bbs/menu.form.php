<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.sub.php');
$table="g5_write_".$bo_table;
$sql="select wr_subject from $table where wr_id='$wr_id'";
$row=sql_fetch($sql);
$sql="select * from g5_dmenu_category where bo_table='$bo_table' and wr_id='$wr_id' order by idx asc";
$result=sql_query($sql);
$count=sql_num_rows($result);
if(!$count){
	alert("먼저 분류를 입력하여 주십시오","./menu.category.form.php");
	exit;
}
?>
<script type="text/javascript">
	function fileDragEnter(idx,last,event){
		event.stopPropagation();
		event.preventDefault();
		// 드롭다운 영역 css
		$(this).css('background-color','#E3F2FC');
	}
	function fileDragLeave(idx,last,event){
		 event.stopPropagation();
		event.preventDefault();
		// 드롭다운 영역 css
		$(this).css('background-color','#E3F2FC');
	}
	function fileDragOver(idx,last,event){
		event.stopPropagation();
		event.preventDefault();
		// 드롭다운 영역 css
		$(this).css('background-color','#E3F2FC');
	}
	function fileDrop(idx,last,ev){
		ev.preventDefault();
		// 드롭다운 영역 css
		$(this).css('background-color','#FFFFFF');
		
		
		var files = ev.target.files||ev.dataTransfer.files;
		var reader = new FileReader();
		
		reader.readAsDataURL(files[0]);
		reader.onload = function (e) {
			var strHtml="<img src='"+e.target.result+"'>";
			$("#menu-image"+idx+last).html(strHtml);
			$("#me-image"+idx+last).val(e.target.result);
		}
		var strHtml="<img src="+files[0].name+">";
		
		
		if(files != null){
				if(files.length < 1){
						alert("폴더 업로드 불가");
						return;
				}
				//selectFile(no,cnt,files)
		}else{
				alert("ERROR");
		}
	}
	function addMenu(idx){
		var last=$("#menu-form"+idx+" .menu-form").size();
		var strHtml='<div class="menu-form">';
				strHtml+='<table width="">';
					strHtml+='<tr>';
						strHtml+='<td>';
							strHtml+='<div class="menu-image" id="menu-image'+idx+last+'" ondragenter="fileDragEnter(\''+idx+'\',\''+last+'\',event)" ondragleave="fileDragLeave(\''+idx+'\',\''+last+'\')" ondragover="fileDragOver(\''+idx+'\',\''+last+'\',event)" ondrop="fileDrop(\''+idx+'\',\''+last+'\',event)" onclick="fileInput(\''+idx+'\',\''+last+'\')"><span style="color:black;font-size:60px;">+</span><br/>이미지 첨부(드래그 첨부가능)</div>';
							strHtml+='<input type="file" name="me_up_image'+idx+'[]" class="me_image" id="me-up-image'+idx+last+'" style="display:none" onchange="fileChange(\''+idx+'\',\''+last+'\',event)">';
							strHtml+='<input type="hidden" name="me_image'+idx+'[]" id="me-image'+idx+last+'">';
						strHtml+='</td>';
					strHtml+='</tr>';
					strHtml+='<tr>';
						strHtml+='<td><input type="text" name="me_name'+idx+'[]" class="frm_input" style="width:100%" placeholder="메뉴명을 입력하세요" required></td>';
					strHtml+='</tr>';
					strHtml+='<tr>';
						strHtml+='<td><input type="text" name="me_price'+idx+'[]" class="frm_input" style="width:100%" placeholder="가격을 입력하세요" required></td>';
					strHtml+='</tr>';
					strHtml+='<tr>';
						strHtml+='<td align="center"><input type="checkbox" name="me_main_status'+idx+'[]" value="1">대표메뉴 설정</td>';
					strHtml+='</tr>';
				strHtml+='</table>';
			strHtml+='</div>';
		$("#menu-form"+idx).append(strHtml);
		
	}

	function fileInput(idx,last){
		$("#me-up-image"+idx+last).click();
	}
	function fileChange(idx,last,event){
		fileDrop(idx,last,event);
	}
	function removeMenu(idx){
		var last=$("#menu-form"+idx+" .menu-form").size();
		if(1<last){
			$("#menu-form"+idx+" .menu-form").eq(last-1).remove();
		}
	}
</script>
<style>
	.menu-form{
		width:33.3%;
		float:left;
	}
	.menu-image{
		width:99%;
		height:100px;
		display:table-cell;
		vertical-align:middle;
		text-align:center;
		float:left;
		overflow:hidden;

	}
	.menu-image img{
		width:100%;
	}
</style>
<div style="padding:10px">
<form name="form" method="post" action="./menu.form.update.php" enctype="multipart/form-data">

<table>
	<input type="hidden" name="bo_table" value="<?=$bo_table?>">
	<input type="hidden" name="wr_id" value="<?=$wr_id?>">
	
	<tr>
		<td colspan="2" style="font-weight:bold;font-size:20px;text-align:center"><?=$row[wr_subject]?> <?=$catTitleArr[$bo_table]?> 설정</td>
	</tr>

	<?
		$sql="select * from g5_dmenu_category where bo_table='$bo_table' and wr_id='$wr_id' order by idx asc";
		$result=sql_query($sql);
		while($row=sql_fetch_array($result)){
	?>
	<tr>
		<td>
			<input type="hidden" name="cat_idx[]" value="<?=$row[idx]?>">
			<?=$row[cat_name]?>
		</td>
		<td><a href="javascript:;" onclick="addMenu('<?=$row[idx]?>')">추가</a> <a href="javascript:;" onclick="removeMenu('<?=$row[idx]?>')">삭제</a></td>
	</tr>
	<tr>
		<td colspan="2" id="menu-form<?=$row[idx]?>">
			<?
				$sql="select * from g5_dmenu where cat_idx='$row[idx]'";
				$result2=sql_query($sql);
				$i=0;
				while($row2=sql_fetch_array($result2)){
			?>
			
			<div class="menu-form">	
				<input type="hidden" name="idx<?=$row[idx]?>[]" value="<?=$row2[idx]?>">
				<table width="">
					<tr>
						<td>
							<div class="menu-image" id="menu-image<?=$row[idx]?><?=$i?>" ondragenter="fileDragEnter('<?=$row[idx]?>','<?=$i?>',event)" ondragleave="fileDragLeave('<?=$row[idx]?>','<?=$i?>',event)" ondragover="fileDragOver('<?=$row[idx]?>','<?=$i?>',event)" ondrop="fileDrop('<?=$row[idx]?>','<?=$i?>',event)" onclick="fileInput('<?=$row[idx]?>','<?=$i?>')">
								<? if($row2[me_image]){?>
								<img src="<?=$row2[me_image]?>">
								<? }else{?>
								<span style="color:black;font-size:60px;">+</span><br/>이미지 첨부(드래그 첨부가능)</div>
								<? }?>
							<input type="file" name="me_up_image<?=$row[idx]?>[]" class="me_image" id="me-up-image<?=$row[idx]?><?=$i?>"  style="display:none" onchange="fileChange('<?=$row[idx]?>','<?=$i?>',event)">
							<input type="hidden" name="me_image<?=$row[idx]?>[]" id="me-image<?=$row[idx]?><?=$i?>" value="<?=$row2[me_image]?>">
						</td>
					</tr>
					<tr>
						<td><input type="text" name="me_name<?=$row[idx]?>[]" class="frm_input" style="width:100%" placeholder="메뉴명을 입력하세요" value="<?=$row2[me_name]?>" required></td>
					</tr>
					<tr>
						<td><input type="text" name="me_price<?=$row[idx]?>[]" class="frm_input" style="width:100%" placeholder="가격을 입력하세요" value="<?=$row2[me_price]?>" required></td>
					</tr>
					<tr>
						<td align="center"><input type="checkbox" name="me_main_status<?=$row[idx]?>[]" value="1"<?php echo $row2[me_main_status]=="1"?" checked":"";?>>대표메뉴 설정</td>
					</tr>
				</table>
			</div>
			<? $i++;}?>
			<div class="menu-form">	
				<table width="">
					<tr>
						<td>

							<div class="menu-image" id="menu-image<?=$row[idx]?><?=$i?>" ondragenter="fileDragEnter('<?=$row[idx]?>','<?=$i?>',event)" ondragleave="fileDragLeave('<?=$row[idx]?>','<?=$i?>',event)" ondragover="fileDragOver('<?=$row[idx]?>','<?=$i?>',event)" ondrop="fileDrop('<?=$row[idx]?>','<?=$i?>',event)" onclick="fileInput('<?=$row[idx]?>','<?=$i?>')">
								
								<span style="color:black;font-size:60px;">+</span><br/>이미지 첨부(드래그 첨부가능)</div>
							<input type="file" name="me_up_image<?=$row[idx]?>[]" class="me_image" id="me-up-image<?=$row[idx]?><?=$i?>"  style="display:none" onchange="fileChange('<?=$row[idx]?>','<?=$i?>',event)">
							<input type="hidden" name="me_image<?=$row[idx]?>[]" id="me-image<?=$row[idx]?><?=$i?>">
						</td>
					</tr>
					<tr>
						<td><input type="text" name="me_name<?=$row[idx]?>[]" class="frm_input" style="width:100%" placeholder="메뉴명을 입력하세요" required></td>
					</tr>
					<tr>
						<td><input type="text" name="me_price<?=$row[idx]?>[]" class="frm_input" style="width:100%" placeholder="가격을 입력하세요" required></td>
					</tr>
					<tr>
						<td align="center"><input type="checkbox" name="me_main_status<?=$row[idx]?>[]" value="1">대표메뉴 설정</td>
					</tr>
				</table>
			</div>

		</td>
	</tr>
	<tr>
		<td colspan="2" style="background-color:#000;height:10px"></td>
	</tr>
	<? }?>

	
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

