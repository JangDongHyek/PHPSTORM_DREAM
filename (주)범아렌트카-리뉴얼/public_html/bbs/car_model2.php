<?php
	include_once("./_common.php");
	include_once(G5_PATH."/head.sub.php");
	if(!$is_admin){
		alert_close("관리자만 접근이 가능합니다.");
	}
	if(!$ca_name){
		$ca_name="경차";
	}
	$sql="select * from g5_model2 where ca_name='$ca_name'";
	$result=sql_query($sql);
?>
<script type="text/javascript">
	$(function(){
		$("#add-btn").click(function(){
			var no=$("#model-list").find("tr").length+1;
			var strHtml='<tr><td class="text-center">'+no+'</td>';
				strHtml+='<td><input type="text" name="model[]" value=""></td>';
				strHtml+='<td><input type="text" name="day_price[]" value=""></td>';
				strHtml+='<td><input type="text" name="insurance_price[]" value=""></td>';
				strHtml+='<td><input type="text" name="hour_price[]" value=""></td>';
				strHtml+='</tr>';
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
				url:g5_bbs_url+'/ajax.car_model2.php',
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
	<form name="form" method="post" action="<?php echo G5_BBS_URL?>/car_model2_update.php">
	
	차량 분류 : 
	<select name="ca_name" id="ca_name" class="frm_input">
		<option value="경차"<?php echo $ca_name=="경차"?" selected":"";?>>경차</option>
		<option value="준중형"<?php echo $ca_name=="준중형"?" selected":"";?>>준중형</option>
		<option value="중형"<?php echo $ca_name=="중형"?" selected":"";?>>중형</option>
		<option value="대형"<?php echo $ca_name=="대형"?" selected":"";?>>대형</option>
		<option value="SUV"<?php echo $ca_name=="SUV"?" selected":"";?>>SUV</option>
		<option value="승합"<?php echo $ca_name=="승합"?" selected":"";?>>승합</option>
	</select>
	<button class="btn btn-primary" id="add-btn" type="button">추가하기</button>
	<button class="btn btn-primary" id="remove-btn" type="button">삭제하기</button>

	<table class="to_table">
		<caption>범아렌트카 대여요금안내</caption>
		<colgroup>
			<col width="10%">
			<col width="20%">
			<col width="30%">
			<col width="30%">
			<col width="10%">
		</colgroup>

		<thead>
			<tr>
				<th class="tit">
					번호
				</th>
				<th>모델명</th>
				<th>일일요금</th>
				<th>자차보험</th>
				<th>시간당요금</th>
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
				<td><input type="text" name="day_price[]" value="<?=$row[day_price]?>"></td>
				<td><input type="text" name="insurance_price[]" value="<?=$row[insurance_price]?>"></td>
				<td><input type="text" name="hour_price[]" value="<?=$row[hour_price]?>"></td>
				<td><button class="btn btn-danger" type="button" onclick="modelRemove('<?php echo $row[idx]?>','<?php echo $row[model]?>')">삭제</button></td>
			</tr>
			<?php }?>
			<tr>
				<td class="text-center"><?php echo $i+1?></td>
				<td><input type="text" name="model[]" value=""></td>
				<td><input type="text" name="day_price[]" value=""></td>
				<td><input type="text" name="insurance_price[]" value=""></td>
				<td><input type="text" name="hour_price[]" value=""></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<div class="text-center">
		<button class="btn btn-success">수정하기</button>
	</div>
	</form>