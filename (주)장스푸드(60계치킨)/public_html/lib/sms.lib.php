<?php
//include_once("./_common.php");

function goJangsSMS($recieveNum, $sendNum, $msg, $wr_id, $bo_table){

	$sendNum = ($sendNum == "")? "0260117043" : $sendNum;

	$conn_db = mysqli_connect("14.48.175.170", "chicken60", "kiuosro1", "chicken60");
	mysqli_select_db("chicken60");

	// SMS 발송
	$sql = "insert into TBL_SUBMIT_QUEUE values
			(
				'1".$wr_id."',
				'".$bo_table."',
				'4133',
				'1',
				'10',
				'I',
				CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
				'1',
				'".$recieveNum."',
				'".$sendNum."',
				'',
				'00000',
				'".$msg."',
				'',
				'1',
				'text/plain',
				'',
				CAST(DATE_FORMAT(now(),'%Y%m%d%H%i%s') AS CHAR),
				'',
				'',
				'',
				'',
				'0',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'0',
				'0'
			)";
	$result = mysqli_query($conn_db, $sql);

	if($result) { return true; } 
	else { return false; }
}


?>
