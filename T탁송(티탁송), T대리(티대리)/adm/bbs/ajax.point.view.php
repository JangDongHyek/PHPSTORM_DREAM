<?php
include_once('./_common.php');
$sql="select * from g5_point where mb_id='$member[mb_id]' and left(po_datetime,10) = '$po_datetime' order by po_id desc";
$result=sql_query($sql);
?>
    <div class="tbl">
    <table>
		<thead>
			<tr>
				<th>경로(포인트내용)</th>
				<th>포인트</th>
				<th>요금</th>
			</tr>
		</thead>
		<tbody id="mb-point-list">
		<? while($row=sql_fetch_array($result)){
				$sql="select * from g5_write_service where wr_id='$row[po_rel_id]'";
				$row2=sql_fetch($sql);
			?>
			<!--<tr>
				<th>경로</th>
				<td colspan="5"></td>
			</tr>-->
			<tr>
				<!--<th>금액</th>
				<td></td>-->
				<td><?=$row['po_content']?></td>
				<td><?=number_format($row['po_point'])?></td>
				<td><?=number_format($row2[wr_5])?></td>
			</tr>
			
		
		<? }?>
		</tbody>
	</table>
    
    </div>
