<?php
	include_once("./_common.php");
	$sql="select * from g5_model2 where ca_name='$ca_name'";
	$result=sql_query($sql);
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

