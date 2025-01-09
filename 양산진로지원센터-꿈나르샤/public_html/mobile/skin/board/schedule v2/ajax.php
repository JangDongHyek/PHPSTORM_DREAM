<?php
include_once("../../../../common.php");

$query = "SELECT * FROM g5_write_counsel WHERE wr_5 like '{$datas}%' and wr_1 !='1' ORDER BY wr_id DESC";
$result = sql_query($query);

for($i=0; $i<$row=sql_fetch_array($result); $i++){
	$arr = (int)substr($row['wr_5'],8,2);
	
	$schedule[$arr][] = $row;
}

for($i=0; $i<count($schedule[$cdays]); $i++){
	$wr_6 = $schedule[$cdays][$i]['wr_6'];
	$wr_7 = $schedule[$cdays][$i]['wr_7'];
	$wr_8 = $schedule[$cdays][$i]['wr_8'];
	$wr_9 = $schedule[$cdays][$i]['wr_9'];

	if($wr_6 < 10) $wr_6 = '0'.$wr_6;
	if($wr_7 < 10) $wr_7 = '0'.$wr_7;
	if($wr_8 < 10) $wr_8 = '0'.$wr_8;
	if($wr_9 < 10) $wr_9 = '0'.$wr_9;

	if($mode == '예약현황'){
		if($i < (count($schedule[$cdays])-1)){
			echo "<div style='margin:0; padding:5px 5px; border-top:1px solid #777;' onclick=\"location.href='./board.php?bo_table=counsel&b_wr_id=".$schedule[$cdays][$i]['wr_id']."&mode=identify_adm'\">";
		}else{
			echo "<div style='margin:0; padding:5px 5px; border-top:1px solid #777; border-bottom:1px solid #777;' onclick=\"location.href='./board.php?bo_table=counsel&b_wr_id=".$schedule[$cdays][$i]['wr_id']."&mode=identify_adm'\">";
		}
	}else if($mode == '예약신청'){
		if($i < (count($schedule[$cdays])-1)){
			if($schedule[$cdays][$i]['wr_10'] == '예약완료'){
				echo "<div style='margin:0; padding:5px 5px; border-top:1px solid #777;'>";
			}else{
				echo "<div style='margin:0; padding:5px 5px; border-top:1px solid #777;' onclick=\"location.href='./board.php?bo_table=counsel&b_wr_id=".$schedule[$cdays][$i]['wr_id']."&mode=book'\">";
			}
		}else{
			if($schedule[$cdays][$i]['wr_10'] == '예약완료'){
				echo "<div style='margin:0; padding:5px 5px; border-top:1px solid #777; border-bottom:1px solid #777;'>";
			}else{
				echo "<div style='margin:0; padding:5px 5px; border-top:1px solid #777; border-bottom:1px solid #777;' onclick=\"location.href='./board.php?bo_table=counsel&b_wr_id=".$schedule[$cdays][$i]['wr_id']."&mode=book'\">";
			}
		}
	}
	echo cut_str($schedule[$cdays][$i]['wr_subject'],15).'<br>';
	if($schedule[$cdays][$i]['wr_10'] == '예약완료'){
		echo $wr_6.':'.$wr_7.'&nbsp;~&nbsp;'.$wr_8.':'.$wr_9.' <span style="color:#ff0000;">[예약완료]</span><br>';
	}else{
		echo $wr_6.':'.$wr_7.'&nbsp;~&nbsp;'.$wr_8.':'.$wr_9.'<br>';
	}
	echo $schedule[$cdays][$i]['wr_content'];
	echo "</div>";
}
?>