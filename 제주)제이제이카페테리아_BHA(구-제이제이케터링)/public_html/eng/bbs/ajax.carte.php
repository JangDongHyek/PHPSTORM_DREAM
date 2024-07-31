<?php
include_once('./_common.php');


if(!empty($mktime))
	$now_date = date("Y-m-d", $mktime);

$sql = "select wr_2 from g5_write_carte where wr_3 = '{$now_date}' and wr_6 = {$now_sheet} and wr_1 = '{$sme}' group by wr_2 order by wr_id "; 

$view_tmcate = sql_query($sql);

$arr_mncate = array();
$arr_menu = array();
for ($i=0; $row=sql_fetch_array($view_tmcate); $i++){
		
		array_push($arr_mncate,$row['wr_2']);
		$arr_menu[$row['wr_2']] = array();
		
}

	$sql="select  * from g5_write_carte where wr_3 = '{$now_date}' and wr_1 = '{$sme}' and wr_6 = {$now_sheet} order by wr_id";
	$result_menu = sql_query($sql);

	for ($i=0; $row=sql_fetch_array($result_menu); $i++){
				array_push($arr_menu[$row['wr_2']], $row['wr_7']);
	}

	$first_rowspan = 0;
	for($i=0; $i<count($arr_mncate); $i++){
			
		$first_rowspan += count($arr_menu[$arr_mncate[$i]]);

	}

	$first_rowspan += count($arr_mncate)+1;

?>

<div class="tbl_head01 tbl_wrap" style="margin-top:20px;">
	<table>
		<colgroup>
		   <col style="width:12%" />
		   <col style="width:auto" />
		</colgroup>
		<tr>	
			
			<?for($i=0; $i<count($arr_menu); $i++){?>
			<tr><th rowspan="<?=count($arr_menu[$arr_mncate[$i]])+1?>"><?=$arr_mncate[$i]?></th></tr>			
				<?for($k=0; $k<count($arr_menu[$arr_mncate[$i]]); $k++){?>
					<tr><td><?=str_replace("|","<br>",$arr_menu[$arr_mncate[$i]][$k]);?></td></tr>				
				<?}?>
			<?}?>
			
		</tr>
	</table>
</div>