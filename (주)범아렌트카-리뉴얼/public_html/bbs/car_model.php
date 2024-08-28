<?php
	include_once("./_common.php");
	include_once(G5_PATH."/head.sub.php");
	if(!$is_admin){
		alert_close("관리자만 접근이 가능합니다.");
	}
	if(!$ca_name){
		$ca_name="경차/소형차량";
	}
	$sql="select * from g5_model where ca_name='$ca_name'";
	$result=sql_query($sql);
?>
<script type="text/javascript">
	$(function(){
		$("#add-btn").click(function(){
			var no=$("#model-list").find("tr").length+1;
			var strHtml='<tr><td class="text-center">'+no+'</td><td><input type="text" name="model[]" value=""></td><td></td></tr>';
			$("#model-list").append(strHtml);
		});
		$("#remove-btn").click(function(){
			var no=$("#model-list").find("tr").length;
			if(no==1){
				alert("더 이상 삭제는 안됩니다.");
				return;
			}
			$("#model-list").find("tr").last().remove();
			
		});
		$("#ca_name").change(function(){
			
			$.ajax({
				url:g5_bbs_url+'/ajax.car_model.php',
				data:{ca_name:$(this).val()},
				type:"GET",
				dataType:"html",
				success:function(data){
					$("#model-list").html(data);
				}
			});
		});
	});
	function modelRemove(idx,model){
		if(confirm(model+'을(를) 삭제하시겠습니까?')){
			location.href="./car_model_remove.php?ca_name="+$("#ca_name").val()+"&idx="+idx;
		}
	}
</script>
<h2>차종모델 추가/수정</h2>
	<form name="form" method="post" action="<?php echo G5_BBS_URL?>/car_model_update.php">
	
	차량 분류 : 
	<select name="ca_name" id="ca_name" class="frm_input">
		<option value="경차/소형차량"<?php echo $ca_name=="경차/소형차량"?" selected":"";?>>경차/소형차량</option>
		<option value="중형차량"<?php echo $ca_name=="중형차량"?" selected":"";?>>중형차량</option>
		<option value="준대형/대형차량"<?php echo $ca_name=="준대형/대형차량"?" selected":"";?>>준대형/대형차량</option>
		<option value="SUV/승합차량"<?php echo $ca_name=="SUV/승합차량"?" selected":"";?>>SUV/승합차량</option>
		<option value="수입차량"<?php echo $ca_name=="수입차량"?" selected":"";?>>수입차량</option>
	</select>
	<button class="btn btn-primary" id="add-btn" type="button">추가하기</button>
	<button class="btn btn-primary" id="remove-btn" type="button">삭제하기</button>

	<table class="to_table">
		<caption>범아렌트카 대여요금안내</caption>
		<colgroup>
			<col width="10%">
			<col width="80%">
		</colgroup>

		<thead>
			<tr>
				<th class="tit">
					번호
				</th>
				<th>모델명</th>
				<th>삭제</th>
			</tr>

		</thead>
		<tbody id="model-list">
			<?php
				for($i=0;$row=sql_fetch_array($result);$i++){
					
			?>
			<input type="hidden" name="old_idx[]" value="<?=$row[idx]?>">
			<tr>
				<td class="text-center">
					<?php echo $i+1;?>
					<input type="hidden" name="idx[]" value="<?=$row[idx]?>">
				</td>
				<td><input type="text" name="model[]" value="<?=$row[model]?>"></td>
				<td><button class="btn btn-danger" type="button" onclick="modelRemove('<?php echo $row[idx]?>','<?php echo $row[model]?>')">삭제</button></td>
			</tr>
			<?php }?>
			<tr>
				<td class="text-center"><?php echo $i+1?></td>
				<td><input type="text" name="model[]" value=""></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<div class="text-center">
		<button class="btn btn-success">수정하기</button>
	</div>
	</form>