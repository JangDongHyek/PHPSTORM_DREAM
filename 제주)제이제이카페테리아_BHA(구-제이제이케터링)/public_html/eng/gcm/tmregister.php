<?
	//$site_path="../bbs/";
	//require_once($site_path."include/lib.inc.php");
	//
	mysql_connect("localhost","ktlove004","kt8910088");
	mysql_select_db("ktlove004");
	mysql_query("set names utf8");
	require_once("./JSON.php");

	$userid = $_GET[userid];

	if($userid == "worini"){
		$charged_sales = "�����";
	} else if($userid == "3001jun"){
		$charged_sales = "������";
	} else if($userid == "kinsii"){
		$charged_sales = "��û�";
	} else if($userid == "jajeon"){
		$charged_sales = "������";
	} else if($userid == "psg1320"){
		$charged_sales = "�ڻ��";
	} else {
		return;
	}

	$date = date("Y-m-d-H-i-s");
	$result = mysql_query($sql);
	
	$sql = "Insert into `sales_app` (`charged_sales`,`accept_date`,`meet_date`) values ('$charged_sales', '$date', '$date') ";
	mysql_query($sql);


	echo json_encode($printArr);

	function json_encode($data) {
		$json = new Services_JSON();
		return( $json->encode($data) );
	}

	function json_decode($data) {
		$json = new Services_JSON();
		return( $json->decode($data) );
	}
?>